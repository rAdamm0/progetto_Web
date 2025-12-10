<?php
    require_once("db/Bootstrap.php");
    $templateParams["Titolo"] = "WebLio";
    $templateParams["h1"] = "Catalogo libri";
    $templateParams["BaseUpperPage"] = "template/library-form.php";
    $templateParams["Libri"] = $dbh->getAvailableBooks();
    require("base.php");
?>
