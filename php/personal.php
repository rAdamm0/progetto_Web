<?php
require_once 'db/Bootstrap.php';



if (isset($_POST["email-registrazione"]) && isset($_POST["password-registrazione"]) && isset($_POST["nome-registrazione"]) && isset($_POST["cognome-registrazione"]) && isset($_POST["matricola-registrazione"])) {
    if (strlen($_POST['matricola-registrazione']) !== 10) {
        $templateParams["errore_registrazione"]="Errore: La matricola deve essere di 10 cifre.";
    }else{
        $registrato = $dbh->checkUserInDatabase($_POST["email-registrazione"]);
        if (count($registrato) == 0) {
            if ($dbh->registerUser($_POST["email-registrazione"], $_POST["password-registrazione"], $_POST["nome-registrazione"], $_POST["cognome-registrazione"], $_POST["matricola-registrazione"])) {
                $registrato = $dbh->checkUserInDatabase($_POST["email-registrazione"], $_POST["password-registrazione"]);
                registerLoggedUser($registrato[0]);
            } else {
                $templateParams["errore_registrazione"] = "Errore durante la fase di registrazione. Riprovare";
            }
        } else {
            $templateParams["errore_registrazione"] = "Utente già registrato";
        }
    }  
}


if (isset($_POST["email-login"]) && isset($_POST["password-login"])) {
    $registrato = $dbh->checkUserInDatabase($_POST["email-login"], $_POST["password-login"]);
    if (count($registrato) == 0) {
        $templateParams["errore_registrazione"] = "Utente non registrato";
    } else {
        registerLoggedUser($registrato[0]);

    }

}

if (isUserLoggedIn()) {
    $templateParams["titolo"] = "Personal";
    $templateParams["infos"] = $dbh->getUserInfos($_SESSION["email"]);
    $templateParams["tags"] = $dbh->getCoursesTagsByEmail($_SESSION["email"]);
    $templateParams["bookings"] = $dbh->getPastBookings($_SESSION["email"]);
    $templateParams["reviews"] = $dbh->getReviewsByEmail($_SESSION["email"]);
    $templateParams["baseUpperPage"] = 'template/personal-page.php';
    $templateParams["script"] = "personal.js";
    $templateParams["courses"] = $dbh->coursesList();
} else {
    $templateParams["titolo"] = "Login";
    $templateParams["baseUpperPage"] = 'template/login-form.php';
}



require('template/base.php');

?>