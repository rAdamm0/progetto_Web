<?php
header('Content-Type: application/json');

require_once '../db/Bootstrap.php';
$response = [
    'success' => true,
    'message' => 'Corsi aggiunti correttamente.'
];

if (isset($_POST['codici']) && is_array($_POST['codici'])) {
    
    foreach ($_POST['codici'] as $codice) {
        $result = $dbh->addTagByEmail($_SESSION["email"], $codice);
        
        if (!$result["success"]) {
            $response['success'] = false;
            $response['message'] = 'Errore durante l\'aggiunta di alcuni corsi.';
            break;
        }
    }
}else if(isset($_POST["id_corso"])){
  $result = $dbh->deleteTagByEmail($_SESSION["email"], $_POST["id_corso"]);
  if(!$result["success"]){
    $response['success'] = false;
    $response['message'] = 'Errore durante la cancellazione del corso.';
  }else{
    $response['message'] = 'Corso eliminato con successo';
  }
}else {
    $response['success'] = false;
    $response['message'] = 'Nessun dato ricevuto.';
}



echo json_encode($response);
exit;