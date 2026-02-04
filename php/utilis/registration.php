<?php
require('../db/Bootstrap.php');
if (isset($_POST["emailReg"]) && isset($_POST["passwordReg"]) && isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["matricola"])) {
    if (strlen($_POST['matricola']) !== 10) {
        echo json_encode(["success"=>false, "message"=>"La matricola deve essere composta da 10 numeri","cause"=>"matricola"]);
    }else{
        $matricola = $dbh->checkMatrInDatabase($_POST["matricola"]);
        if(count($matricola)>0){
            echo json_encode(["success"=>false, "message"=>"Matricola già presente nel sistema","cause"=>"matricola"]);
        }else{
            $registrato = $dbh->checkUserInDatabase($_POST["emailReg"]);
            if (count($registrato) == 0) {
                if ($dbh->registerUser($_POST["emailReg"], $_POST["passwordReg"], $_POST["nome"], $_POST["cognome"], $_POST["matricola"])) {
                    $registrato = $dbh->checkUserInDatabase($_POST["emailReg"], $_POST["passwordReg"]);
                    registerLoggedUser($registrato[0]);
                echo json_encode(["success"=>true, "messaggio"=>"Registrazione effettuata con successo!"]);
                    
                } else {
                echo json_encode(["success"=>false, "messaggio"=>"Errore durante la fase di registrazione. Riprovare","cause"=>"general"]);
    
                }
            } else {
                echo json_encode(["success"=>false, "messaggio"=>"Utente già registrato","cause"=>"utente"]);
            }
        }
    }  
}
?>