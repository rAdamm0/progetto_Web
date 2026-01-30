<?php
function registerLoggedUser($user){
    var_dump($user);
    $_SESSION["email"] = $user["email"];
    $_SESSION["numero_matricola"] = $user["num_matricola"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["img"] = $user["immagine_profilo"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}
?>