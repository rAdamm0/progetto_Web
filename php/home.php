<?php
    require_once("db/Bootstrap.php");
    $templateParams["titolo"] = "WebLio";
    $templateParams["h1"] = "Benvenuti su WebLio";
    $templateParams["baseUpperPage"] = "template/home-template.php";
    $templateParams["header"] = "template/headerHome.php";
    $templateParams["range"] = $dbh->getRange();
    $dbh->checkDailyTask();
    require("template/base.php");
?>
