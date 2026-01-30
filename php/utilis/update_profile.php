<?php
require_once '../db/Bootstrap.php';


// Check if the request is coming through
if(isset($_POST["nome"])){ 
    
    $email = $_SESSION["email"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $corso = $_POST["corso"];
    $anno = $_POST["anno"];
    
    // Default: Keep existing image if no new one is uploaded
    // (You might want to fetch the current image from DB first)
    $finalImagePath = $_POST['current_image_hidden'] ?? $_SESSION["img"]; 

    // Handle the File Upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = time() . "_" . basename($_FILES['profile_pic']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], '../'.$targetPath)) {
            $finalImagePath = $targetPath;
        }
        unlink('../'.$_POST['current_image_hidden']);
    }

    if($dbh->updateUserInfos($email, $nome, $cognome, $corso, $anno, $finalImagePath)["success"]){
        echo 'success';
    } else {
        echo 'failure';
    }
}
?>