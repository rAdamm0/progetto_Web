$(document).ready(function () {
  $("#calendar").fullCalendar({
    lang: "it",
    selectable: true,
    selectHelper: true,
    dayClick: function (date) {
      var today = moment().startOf("day");
      if (date < today) {
        alert("Non puoi prenotare in una data passata!");
        return false;
      }
      createEvent(date);
    },
    select: function (startDate, endDate) {
      var today = moment().startOf("day");
      if (startDate < today) {
        $("#calendar").fullCalendar("unselect");
        alert("La selezione include giorni passati!");
        return false;
      }
      var duration = moment.duration(endDate.diff(startDate)).asDays();
    if (duration > 1) {
        createSelection(startDate, endDate);
    }
    },
    events: "utilis/get_bookings.php",
    eventRender: function(event, element) {
        // 'event' contiene i dati dal database (title, start, end, ecc.)
        // 'element' è l'elemento HTML dell'evento nel calendario
        
        $(element).tooltip({
            title: "Libro: " + event.title + " | Scadenza: " + (event.description ?? event.start.format()),
            container: 'body',
            trigger: 'hover',
            placement: 'top'
        });
    },
    header: {
      left: "title",
      right: "prev, today, next",
    },
    buttonText: {
      today: "Oggi",
      month: "Mese",
      list: "Date",
    },
    viewRender: function (view) {
      var title = view.title;
      view.title = title.charAt(0).toUpperCase() + title.slice(1);
      $(".fc-left h2").text(view.title);
    },
  });
});


function createEvent(date) {
  const start = document.querySelector("#data-inizio");
  const end = document.querySelector("#data-fine");
  if (document.activeElement == start) {
    start.value = date.format();
  }
  if (document.activeElement == end) {
    end.value = date.format();
  }
}

function createSelection(startDate, endDate) {
  const start = document.querySelector("#data-inizio");
  const end = document.querySelector("#data-fine");
  start.value = startDate.format();
  end.value = endDate.format();
}

async function addBooking(formElement) {
  const formData = new FormData(formElement);
  const response = await fetch("utilis/booking.php", {
    method: "POST",
    body: formData,
  });
  const result = await response.json();
  if (result.success) {
    alert("Libro Prenotato con Successo!");
    location.reload();  
  } else {
    console.error("Server Error: ", result.message);
    const libroSelect = document.querySelector("#libro");
    const feedback = document.querySelector(".invalid-feedback");

    libroSelect.classList.add("is-invalid"); // Questo rende visibile il feedback
    feedback.textContent = result.message;
  }
}
