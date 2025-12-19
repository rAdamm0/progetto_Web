<?php
function registerLoggedUser($user){
    $_SESSION["email"] = $user["email"];
    $_SESSION["numero"] = $user["nome"];
    $_SESSION[""] = $user["cognome"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}
?>