<?php 
require('../db/Bootstrap.php');
$start = new DateTime($_POST["data-inizio"]);
$end = new DateTime($_POST["data-fine"]);

$interval = $start->diff($end);
if($interval->days > 31):
    {echo json_encode([
        "success" => false,
        "message" => "Non puoi prenotare un libro per più di un mese"
    ]);}
else:{
    $res = $dbh->bookABook($_SESSION["email"], $_POST["libro"], $_POST["data-inizio"], $_POST["data-fine"]);
    
    if ($res == true) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => $res
        ]);
    }
}
endif;
?>