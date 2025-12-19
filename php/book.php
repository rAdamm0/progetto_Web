<?php
    require_once("db/Bootstrap.php");
    $id = $_GET["id"];
    $templateParams["titolo"] = "WebLio";
<<<<<<< HEAD
    $templateParams["Libro"] = $dbh->getBookInfo($id);
    $templateParams["h1"] = $dbh->getCourseByBook($id)["nome_corso"];
    $templateParams["recensione"] = $dbh->bookReviews($id);
=======
    $templateParams["Libro"] = $dbh->getBookInfo(id: $id);
    $templateParams["h1"] = $templateParams["Libro"]["nome_libro"];
>>>>>>> 4b0b9a08b76c344d449c4026ec85ba0976248f7c
    $templateParams["header"] = "template/headerBook.php";
    $templateParams["baseUpperPage"] = "template/bookPage.php";
    require("base.php");
?>
