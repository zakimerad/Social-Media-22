<?php 
session_start();

require_once __DIR__ ."/../config/sql_constants.php";
require_once __DIR__ ."/../config/connect.php";

$data = $_POST;
$_SESSION['error_post'] = "";

//ImageUrl pour le post
function setupImageUrl($img, $temp): String {
    if (empty($img)) { return "";}
    $directory = '../actions/uploads/';
    $file = basename($img);
    $path = $directory . $file;
    $type = pathinfo($file, PATHINFO_EXTENSION);
    $allowTypes = array("jpg", "png", "gif", "jpeg");
    if (!is_dir($directory)) {return "";}
    if (!is_writable($directory)) {return "";}
    if (!in_array($type, $allowTypes)) {return "";}
    if (!is_file($temp)) {return "";}
    if (!move_uploaded_file($temp, $path)) {return "";}
    return $file;
}

//Sécurisation du texte
function setupText($string): String {
    if (empty($string)) { return "";}
    return htmlspecialchars($string);
}

//Envoi vers MySQL
if (isset($data['text']) && isset($_SESSION['currentUser']['userId'])) {
    $personID = $_SESSION['currentUser']['userId'];
    $image = setupImageUrl($_FILES['file']['name'], $_FILES['file']['tmp_name']);
    $text = setupText($data['text']);
    $newPost = $mysqlClient->prepare('INSERT INTO posts (text, postImage, personId) VALUES (?, ?, ?)');
    $newPost->execute(array($text, $image, $personID));
} else {
    $_SESSION['error_post'] = "Données manquantes";
}

//Fermer le tout
header("Location: ../index.php");
exit();