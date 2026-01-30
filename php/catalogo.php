<?php
    require_once("db/Bootstrap.php");
    $templateParams["Titolo"] = "WebLio";
    $q = isset($_GET["q"]) ? trim($_GET["q"]) : "";
    $templateParams["h1"] = "Catalogo libri";
    $templateParams["header"] = "template/headerCatalogue.php";
    $templateParams["baseUpperPage"] = "template/library-form.php";
    $templateParams["Libri"] = $dbh->getBooksBySearch($q);
    require("template/base.php");
?>
