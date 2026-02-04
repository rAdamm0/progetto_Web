<?php
require_once('db/Bootstrap.php');

$templateParams["baseUpperPage"] = "prenotazioni-page.php";
$templateParams["titolo"] = "WebLio - Prenotazioni";
$templateParams["calendario"] = [
'<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />',
'<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>',
'<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>',
'<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>',
'<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale/it.js"></script>'];
$templateParams["script"]='prenotazioni.js';
if(isset($_SESSION["email"])){
  $templateParams["prenotati"] = $dbh->getBooked($_SESSION["email"]);
}
$templateParams["prenotabili"] = $dbh->getBookable();
require('template/base.php');
?>