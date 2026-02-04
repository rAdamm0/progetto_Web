<?php
require('../db/Bootstrap.php');

if (isset($_POST["emailLogin"]) && isset($_POST["passwordLogin"])) {
    $registrato = $dbh->checkUserInDatabase($_POST["emailLogin"], $_POST["passwordLogin"]);
    if (count($registrato) == 0) {
      echo json_encode(["success" => false,
      "message"=>"Utente non registrato o password sbagliata"]);
    } else {
        registerLoggedUser($registrato[0]);
        echo json_encode(["success" => true]);

    }

}
?>