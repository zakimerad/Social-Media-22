<?php

    session_start();


require_once __DIR__.'/config/sql_constants.php';
require_once __DIR__.'/config/first_connect.php';
require_once __DIR__.'/config/queries.php';
require_once __DIR__.'/logic/data_handler.php';
?>

<!DOCTYPE html>
<html lang='fr'>
    <head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <title>My Social Network</title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS/styles.css">
    </head>
    <body>
        <?php 
            require_once __DIR__.'/header.php';
            require_once __DIR__.'/log_container.php';
            require_once __DIR__.'/new_post_view.php';
        ?>
        <?php if(isset($_SESSION['currentUser'])): ?>
            <?php foreach($postComplet as $post): ?>
                <?php 
                $userId =$post['userId'];
                $username = $post['username'];
                $avatar = $post['profilePicture'];
                echo createPost($post, $userId,$username, $avatar);
                ?>
                
            <?php endforeach; ?>
        <?php endif; ?>
        <?php require_once __DIR__.'/footer.php'?>
    </body>
</html>