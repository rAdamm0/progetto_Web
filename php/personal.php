<?php
require_once 'db/Bootstrap.php';

if (isUserLoggedIn()) {
    $templateParams["titolo"] = "Personal";
    $templateParams["infos"] = $dbh->getUserInfos($_SESSION["email"]);
    $templateParams["tags"] = $dbh->getCoursesTagsByEmail($_SESSION["email"]);
    $templateParams["bookings"] = $dbh->getPastBookings($_SESSION["email"]);
    $templateParams["reviews"] = $dbh->getReviewsByEmail($_SESSION["email"]);
    $templateParams["script"] = "personal.js";
    $templateParams["baseUpperPage"] = 'template/personal-page.php';
    $templateParams["courses"] = $dbh->coursesList();
} else {
    $templateParams["script"] = "login.js";
    $templateParams["titolo"] = "Login";
    $templateParams["baseUpperPage"] = 'template/login-form.php';
}



require('template/base.php');

?>