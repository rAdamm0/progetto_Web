<?php
    require_once("db/Bootstrap.php");
    $id = $_GET["id"];
    $templateParams["titolo"] = "WebLio";
    $templateParams["Libro"] = $dbh->getBookInfo($id);
    $templateParams["h1"] = $dbh->getCourseByBook($id)["nome_corso"];
    $templateParams["recensione"] = $dbh->bookReviews($id);
    $templateParams["header"] = "template/headerBook.php";
    $templateParams["baseUpperPage"] = "template/bookPage.php";
    require("base.php");
?>
