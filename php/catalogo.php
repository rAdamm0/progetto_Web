<?php
    require_once("db/Bootstrap.php");
    $templateParams["titolo"] = "WebLio - Catalogo";
    $q = isset($_GET["q"]) ? trim($_GET["q"]) : "";
    $course = isset($_GET["course"]) ? (int) $_GET["course"] : 0;
    $templateParams["h1"] = "Catalogo libri";
    $templateParams["selectedCourse"] = $course;
    $templateParams["css"] = "../html/css/catalogo.css";
    $templateParams["baseUpperPage"] = "template/library-form.php";
    $templateParams["Libri"] = $dbh->getBooksBySearch($q,$course);
    require("template/base.php");
?>
