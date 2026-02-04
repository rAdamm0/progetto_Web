<?php 
require('../db/Bootstrap.php');
$res = $dbh->bookABook($_SESSION["email"], $_POST["libro"], $_POST["data-inizio"], $_POST["data-fine"]);

if ($res == true) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode([
        "success" => false,
        "message" => $res
    ]);
}
?>