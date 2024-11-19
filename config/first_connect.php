<?php

try {
    $mysqlClient = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', HOST, NAME, PORT), USER, PASSWORD
    );
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $usersTable = "CREATE TABLE IF NOT EXISTS users(
        userId INT(11) NOT NULL AUTO_INCREMENT,
        password VARCHAR(200) NOT NULL,
        email VARCHAR(200) NOT NULL,
        username VARCHAR(255),
        profilePicture VARCHAR(256),
        PRIMARY KEY(userId)
    );";
    $mysqlClient->exec($usersTable);
    
    $postTable = "CREATE TABLE IF NOT EXISTS posts(
        postId INT(11) NOT NULL AUTO_INCREMENT,
        text TEXT NOT NULL,
        postImage VARCHAR(256),
        date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
        personId INT(11),
        PRIMARY KEY (postId),
        FOREIGN KEY (personId) REFERENCES users(userId)
    );";
    $mysqlClient->exec($postTable);
} catch (Exception $e) {
    die('Erreur: '. $e->getMessage());
}

