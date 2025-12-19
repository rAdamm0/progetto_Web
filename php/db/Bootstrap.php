<?php
require_once("db.php");
require_once("utilis/functions.php");
$dbh = new DatabaseHelper("localhost", "root", "", "weblio", 3306);
define("UPLOAD_DIR", "./upload/");
?>
