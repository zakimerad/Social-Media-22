<?php
session_start();
require_once __DIR__."/../config/sql_constants.php";
require_once __DIR__."/../config/connect.php";

$datas = $_POST;
$_SESSION['upload'] = "";
$directory = "../actions/uploads/";

if (isset($datas["submit"]) && !empty($_FILES['file']['name'])) {
    $file = basename($_FILES['file']['name']);
    $path = $directory.$file;
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    $tempName = $_FILES['file']['tmp_name'];
    if(!is_dir($directory) || !is_writable($directory)) {
        $_SESSION['upload'] = "Le dossier n'existe pas ou les droits d'écriture sont restreints";
    } else {
        if (!in_array($type, $allowTypes)) {
            $_SESSION["upload"] = "Type de fichier non pris en charge";
        } else {
            if(move_uploaded_file($tempName, $path)) {
                $insert = $mysqlClient->prepare("UPDATE users SET profilePicture = :imageUrl WHERE userId = :id");
                $result = $insert->execute(array("imageUrl"=> $file,"id"=> $_SESSION["currentUser"]['userId']));
                if ($result) {
                    $_SESSION['upload'] = "Image téléchargée";
                    $_SESSION["currentUser"]["profilePicture"] = $file;
                } else {
                    $_SESSION['upload'] = 'Nous n\'avons pas pu enregistrer la photo';
                }
            } else {
                $_SESSION["upload"] = "Oups, nous avons eu un problème";
            }
        }
    }
} else {
    $_SESSION["upload"] = "Rien n'a été envoyé";
}

header("Location: ../profile.php");
exit();