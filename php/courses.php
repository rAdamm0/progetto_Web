<?php
    require_once("db/Bootstrap.php");
    $templateParams["titolo"] = "WebLio - Corsi";
    $templateParams["h1"] = "Corsi Suggeriti";
    $q = isset($_GET["q"]) ? trim($_GET["q"]) : "";
    $templateParams["randomCourses"] = $dbh->getRandomCourses(3);
    $templateParams["courses"] = $dbh->getCoursesByResearch($q);
    $templateParams["searchQuery"] = $q;
    $templateParams["baseUpperPage"] = "template/course_page.php";
    require("template/base.php");
?>
