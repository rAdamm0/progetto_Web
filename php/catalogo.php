<?php
    require_once("db/Bootstrap.php");
    $templateParams["Titolo"] = "WebLio";
    $templateParams["h1"] = "Catalogo libri";
    $templateParams["header"] = "template/headerCatalogue.php";
    $templateParams["baseUpperPage"] = "template/library-form.php";
    $templateParams["Libri"] = $dbh->getAvailableBooks();
    require("template/base.php");
?>
