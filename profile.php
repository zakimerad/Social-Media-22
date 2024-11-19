<?php
session_start();

require_once __DIR__ ."/config/sql_constants.php";
require_once __DIR__ ."/config/connect.php";

$getDatas = $_GET;
$isMe = (empty($getDatas) || ($getDatas['userId'] == $_SESSION["currentUser"]['userId'])); 


$personId = ($isMe) ? $_SESSION["currentUser"]['userId']: $getDatas['userId'];
$username = ($isMe) ? $_SESSION['currentUser']['username']: $getDatas['username'];
$profilePicture = ($isMe) ? $_SESSION['currentUser']['profilePicture']: $getDatas['profilePicture'];
$query = "SELECT * FROM posts WHERE personId=?";
$allPosts = $mysqlClient->prepare($query);
$allPosts->execute([$personId]);
$posts = $allPosts->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Mon Profil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS/styles.css">
    </head>
    <body>
        <?php require_once __DIR__.'/header.php' ?>
        <?php if ($isMe):?>
        <div class="container">
            <form action="actions/upload_profile_picture.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file">
                <input type="submit" name="submit" value="Télécharger">
            </form>
            <p><?php echo $_SESSION['upload'] ?? ""?></p>
            <a href="actions/logout.php" class="disconnect">Se déconnecter</a> 
        </div>
        <?php endif;?>
         
        <?php foreach($posts as $post): ?>
            <?php 
            echo createPost($post, $personId, $username, $profilePicture);
            ?>
        <?php endforeach;?>
        <?php require_once __DIR__.'/footer.php' ?>
    </body>
</html>