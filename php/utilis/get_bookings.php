<?php
require('../db/Bootstrap.php');

$startDates=$dbh->getAllBookingsStarts($_SESSION["email"]);
$endDates=$dbh->getAllBookingsEnds($_SESSION["email"]);
foreach($startDates as &$starts):
    $starts["color"] = "green";
endforeach;
unset($starts); 

foreach($endDates as &$ends):
    $ends["color"] = "red";
endforeach;
unset($ends);

echo json_encode(array_merge($startDates, $endDates));
?>