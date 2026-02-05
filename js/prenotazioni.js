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
    eventRender: function (event, element) {

      $(element).tooltip({
        title:
          "Libro: " +
          event.title +
          " | Scadenza: " +
          (event.description ?? event.start.format()),
        container: "body",
        trigger: "hover",
        placement: "top",
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
  const end = document.querySelector("#data-fine");
  end.value = date.format();
}

function createSelection(startDate, endDate) {
  const end = document.getElementById("data-fine");
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
    await showSweetAlert();
    location.reload();
  } else {
    console.error("Server Error: ", result.message);
    const libroSelect = document.querySelector("#libro");
    const feedback = document.querySelector(".invalid-feedback");

    libroSelect.classList.add("is-invalid"); 
    feedback.textContent = result.message;
  }
}

function showSweetAlert() {
  window.alert = function () {};

  return Swal.fire({
    title: "Prenotazione Completata",
    text: "Libro prenotato con successo!",
    icon: "success",
    confirmButtonText: "OK",
  });
}

function showBadAlert() {
  window.alert = function () {};

  return Swal.fire({
    title: "Cancellazione Completata",
    text: "Prenotazione cancellata con successo",
    icon: "success",
    confirmButtonText: "OK",
  });
}

async function cancelBooking(formElement) {
  const formData = new FormData(formElement);
  const response = await fetch("utilis/cancelBook.php", {
    method: "POST",
    body: formData,
  });
  const result = await response.json();
  if (result.success) {
    await showBadAlert();
    location.reload();
  } else {
    console.error("Server Error: ", result.message);
    const libroSelect = document.querySelector("#id");
    const feedback = document.querySelector(".invalid-feedback.cancel");

    libroSelect.classList.add("is-invalid"); 
    feedback.textContent = result.message;
  }
}
