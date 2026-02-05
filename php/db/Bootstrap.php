<?php
session_start();
define("UPLOAD_DIR", "./upload/");
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . 'utilis'.DIRECTORY_SEPARATOR.'functions.php';
require_once ROOT_PATH . 'db'.DIRECTORY_SEPARATOR.'db.php'; 
$dbh = new DatabaseHelper("localhost", "root", "", "weblio", 3306);

?>
