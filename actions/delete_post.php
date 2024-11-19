<?php 
session_start();
require_once __DIR__."/../config/sql_constants.php";
require_once __DIR__."/../config/connect.php";

$get = $_GET;

if (isset($get["postId"]) && isset($get['userId'])) {
    if ($get['userId'] == $_SESSION['currentUser']['userId']) {
        $deletePost = $mysqlClient->prepare('DELETE FROM posts WHERE postId=?');
        $deletePost->execute([(int) $get['postId']]);
    }
}

header("Location: ../index.php");
exit();