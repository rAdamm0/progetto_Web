<?php
require_once("db.php");
$dbh = new DatabaseHelper("localhost", "root", "", "weblio", 3306);
define("UPLOAD_DIR", "./upload/");
?>
