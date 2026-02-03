<?php
session_start();
define("UPLOAD_DIR", "./upload/");
// Define the base directory of your project
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . 'utilis\functions.php';
require_once ROOT_PATH . 'db\db.php'; 
$dbh = new DatabaseHelper("localhost", "root", "", "weblio", 3306);

?>
