<?php
    require_once("db/Bootstrap.php");
    $templateParams["titolo"] = "WebLio";
    $templateParams["h1"] = "Benvenuti su WebLio";
    $templateParams["baseUpperPage"] = "template/home-template.php";
    $templateParams["header"] = "template/headerHome.php";
    require("template/base.php");
?>
