<?php
    require_once("db/Bootstrap.php");
    $id = $_GET["id"];
    $templateParams["titolo"] = "WebLio";
    $templateParams["Libro"] = $dbh->getBookInfo(id: $id);
    $templateParams["h1"] = $templateParams["Libro"]["nome_libro"];
    $templateParams["header"] = "template/headerBook.php";
    $templateParams["baseUpperPage"] = "";
    require("base.php");
?>
