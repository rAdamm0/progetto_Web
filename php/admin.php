<?php
require_once("db/Bootstrap.php");
// 1)solo  l'admin può accedere
if (!isset($_SESSION["email"]) || $_SESSION["email"] !== "admin@university.it") {
    header("Location: home.php");
    exit;
}

// 2) Gestione azioni
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    switch ($action) {
        case "add_course":
            $codice = (int)($_POST["codice_corso"] ?? 0);
            $nome = trim($_POST["nome_corso"] ?? "");
            $descr = trim($_POST["descrizione"] ?? "");
            $lingua = trim($_POST["lingua"] ?? "Italiano");
            $docente = trim($_POST["docente"] ?? "");

            $dbh->addCourse($codice, $nome, $descr, $lingua, $docente === "" ? null : $docente);
            break;

        case "add_book":
            $nome = trim($_POST["nome_libro"] ?? "");
            $edizione = (int)($_POST["edizione"] ?? 1);
            $dataUscita = (int)($_POST["data_uscita"] ?? 2000);
            $descr = trim($_POST["descrizione"] ?? "");
            $disp = (int)($_POST["disponibile"] ?? 0);

            $dbh->addBook($nome, $edizione, $dataUscita, $descr === "" ? null : $descr, $disp);
            break;

        case "add_author":
            $nome = trim($_POST["nome_autore"] ?? "");
            $cognome = trim($_POST["cognome_autore"] ?? "");
            $descr = trim($_POST["descrizione"] ?? "");

            $dbh->addAuthor($nome, $cognome, $descr === "" ? null : $descr);
            break;

        case "link_book_course":
            $idLibro = (int)($_POST["codice_libro"] ?? 0);
            $codCorso = (int)($_POST["codice_corso"] ?? 0);
            $dbh->linkBookToCourse($idLibro, $codCorso);
            break;

        case "link_author_book":
            $idAutore = (int)($_POST["codice_autore"] ?? 0);
            $idLibro = (int)($_POST["codice_libro"] ?? 0);
            $dbh->linkAuthorToBook($idAutore, $idLibro);
            break;

        case "link_user_course":
            $email = trim($_POST["email"] ?? "");
            $codCorso = (int)($_POST["codice_corso"] ?? 0);
            $dbh->linkUserToCourse($email, $codCorso);
            break;

        case "delete_book":
            $idLibro = (int)($_POST["codice_libro"] ?? 0);
            $dbh->deleteBook($idLibro);
            break;

        case "delete_author":
            $idAutore = (int)($_POST["codice_autore"] ?? 0);
            $dbh->deleteAuthor($idAutore);
            break;

        case "delete_course":
            $codCorso = (int)($_POST["codice_corso"] ?? 0);
            $dbh->deleteCourse($codCorso);
            break;

        case "delete_user":
            $email = trim($_POST["email"] ?? "");
            $dbh->deleteUser($email);
            break;
    }
    header("Location: admin.php");
    exit;
}
// 3) creazione templateParams
$templateParams["titolo"] = "WebLio | Admin";
$templateParams["header"] = "";
$templateParams["baseUpperPage"] = "template/adminPage.php";
$templateParams["script"] = ""; 
$templateParams["libri"] = $dbh->getAvailableBooks();     
$templateParams["corsi"] = $dbh->coursesList();   
$templateParams["autori"] = $dbh->getAllAuthors();  
$templateParams["utenti"] = $dbh->getAllUsers();    

require("template/base.php");
