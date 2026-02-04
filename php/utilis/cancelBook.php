<?php
require('../db/Bootstrap.php');
  if($dbh->cancelBooking($_POST["id"])){
    echo json_encode(["success"=>true]);
  }else{
    echo json_encode(["success"=>false, "message"=>"Errore Server: riprovare"]);
  }
?>