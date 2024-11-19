<?php

session_start();
require_once __DIR__ .'/../config/sql_constants.php';
require_once __DIR__ .'/../config/connect.php';

$data = $_POST;

if (isset($data['email']) && isset($data['password']) && isset($data['username'])) {
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "L'adresse mail n'est pas valide";
    } else {
        $email = $data["email"];
        $password = $data["password"];
        $username = $data["username"];

        $usersQuery = $mysqlClient->prepare("INSERT INTO users (email, password, username, profilePicture) VALUES (?, ?, ?, ?)");
        $user = $usersQuery->execute([$email, $password, $username, ""]);
        
        $usersQuery = $mysqlClient->prepare("SELECT * FROM users WHERE email=? AND password=?");
        $usersQuery->execute([$email, $password]);
        $userSelected = $usersQuery->fetch();

        if ($userSelected != null) {
            $_SESSION["error"] = "Nous avons réussi";
            $_SESSION["currentUser"] = array(
                "username"=> $userSelected['username'],
                "email"=> $userSelected['email'],
                "password"=> $userSelected['password'],
                "profilePicture"=> $userSelected['profilePicture'],
                "userId"=> $userSelected['userId'],
            );
        } else {
            $_SESSION["error"] = "Nous n'avons pas pu récupérer l'utilisateur";
        }

    }
} else {
    $_SESSION['error'] = "Veuillez entrer tous les champs pour continuer";
}

header('Location: ../index.php');
exit();