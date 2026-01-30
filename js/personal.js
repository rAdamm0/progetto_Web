const modal = document.getElementById('editModal');

function openEditModal() {
    modal.showModal(); // showModal() makes it a popup, show() makes it a flat element
}

function closeEditModal() {
    modal.close();
}

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('profilePreview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}


async function updateProfile(formElement) {
    const formData = new FormData(formElement);

    const response = await fetch('utilis/update_profile.php', {
        method: 'POST',
        body: formData
    });

    const result = await response.text();
    if (result.includes("success")) {
        alert("Profile Updated!");
        location.reload(); // Refresh to show new data
    }
}

document.getElementById("add-course").addEventListener("click", addCourse);
const dialog = document.getElementById("course-edit");

function addCourse(){
    dialog.showModal();
}

function closeTagModal(){
    dialog.close();
}

const courses = document.querySelectorAll(".coursePill");


    courses.forEach((course)=>course.addEventListener("click", function(event) {
        if (event.target.classList.contains("coursePill")) {
            const pill = event.currentTarget;
            const courseId = pill.getAttribute("id");
            console.log("Deleting course:", courseId);
            deleteCourse(courseId);
        }
    }));

async function deleteCourse(courseId){
    const formData = new FormData();
    formData.append("id_corso", courseId);
    console.log(formData);
    const response = await fetch('utilis/update_tags.php',{
        method : 'POST',
        body:formData
    });

    const result = await response.json();
    if(result.success){
        //alert(result.message);
        location.reload();
    }else{
        console.error("Server Error: ", result.message);
    }
}

async function updateTags(formElement){
    const formData = new FormData(formElement);
    const response = await fetch('utilis/update_tags.php',{
        method:'POST',
        body:formData
    });

    const result = await response.json();
    if(result.success){
        //alert(result.message);
        location.reload();
    }else{
        console.error("Server Error:", result.message);
    }
}

function get_cookie(name){
    return document.cookie.split(';').some(c => {
        return c.trim().startsWith(name + '=');
    });
}

function delete_cookie( name, path, domain ) {
  if( get_cookie( name ) ) {
    document.cookie = name + "=" +
      ((path) ? ";path="+path:"")+
      ((domain)?";domain="+domain:"") +
      ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
  }
}
