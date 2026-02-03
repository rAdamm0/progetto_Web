<?php
    require_once("db/Bootstrap.php");
    $id = $_GET["id"];
    if (isset($_POST["action"]) && $_POST["action"] === "add_review") {
        if(empty($_SESSION["email"])){
            header("Location: login.php");
            exit;
        }
        $email = $_SESSION["email"];
        $bookId = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
        $valutation = isset($_POST["valutazione"]) ? (int)$_POST["valutazione"] : 0;
        $description = isset($_POST["descrizione"]) ? trim($_POST["descrizione"]) : null;
        if ($bookId != $id) {
            header("Location: book.php?id=" . $id . "&err=book_mismatch#recensioni");
            exit;
        }

        if ($valutation < 1 || $valutation > 5) {
            header("Location: book.php?id=" . $id . "&err=valutazione#recensioni");
            exit;
        }

        $ok = $dbh->addReview($email, $bookId, $valutation, $description);
        header("Location: book.php?id=" . $id . ($ok ? "&ok=review" : "&err=review") . "#recensioni");
        exit;
    }
    $templateParams["titolo"] = "WebLio";
    $templateParams["Libro"] = $dbh->getBookInfo($id);
    $templateParams["h1"] = $dbh->getCourseByBook($id)["nome_corso"];
    $templateParams["recensione"] = $dbh->bookReviews($id);
    $templateParams["header"] = "template/headerBook.php";
    $templateParams["baseUpperPage"] = "template/bookPage.php";
    require("template/base.php");
?>
