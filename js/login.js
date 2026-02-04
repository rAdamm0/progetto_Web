async function login(formElement){
   const formData = new FormData(formElement);
    const response = await fetch('utilis/login.php',{
        method:'POST',
        body:formData
    });
    const result = await response.json();
    if(result.success){
        location.reload();
    }else{
      const loginInput = document.getElementById("emailLogin");
    const feedback = document.querySelector(".invalid-feedback, .login");

    loginInput.classList.add("is-invalid"); // Questo rende visibile il feedback
    feedback.textContent = result.message;
    }
}

async function registration(formElement){
    const formData = new FormData(formElement);
    const response = await fetch('utilis/registration.php',{
        method:'POST',
        body:formData
    });
    const result = await response.json();
    if(result.success){
        location.reload();
    }else{
      let loginInput = null;
      let feedback = null;
        switch(result.cause){
          case "general":
          loginInput = document.getElementById("emailReg");
           feedback = document.querySelector(".invalid-feedback.registration");  
          ;
            break;
          case "utente":
           loginInput = document.getElementById("emailReg");
           feedback = document.querySelector(".invalid-feedback.registration");  
          ;
            break;
          case "matricola":
           loginInput = document.getElementById("matricola");
           feedback = document.querySelector(".invalid-feedback.matricola");  
          ;
            break;
        }
        loginInput.classList.add("is-invalid"); // Questo rende visibile il feedback
        feedback.textContent = result.message;
    }
}
