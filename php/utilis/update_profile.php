<?php
require_once '../db/Bootstrap.php';


if(isset($_POST["nome"])){ 
    
    $email = $_SESSION["email"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $corso = $_POST["corso"];
    $anno = $_POST["anno"];
    $finalImagePath = $_POST['current_image_hidden'] ?? $_SESSION["img"]; 
    
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = time() . "_" . basename($_FILES['profile_pic']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], '../'.$targetPath)) {
            $finalImagePath = $targetPath;
        }
        if($_POST['current_image_hidden']!='default_avatar.png'){
            unlink('../'.$_POST['current_image_hidden']);
        }
    }

    if($dbh->updateUserInfos($email, $nome, $cognome, $corso, $anno, $finalImagePath)["success"]){
        echo 'success';
    } else {
        echo 'failure';
    }
}
?>