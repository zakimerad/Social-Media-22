<?php
session_start();

require_once __DIR__ ."/../config/sql_constants.php";
require_once __DIR__ ."/../config/connect.php";

$data = $_POST;

if (isset($data['email']) && isset( $data['password'])) {
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email invalide";
    } else {
        $email = $data["email"];
        $password = $data["password"];
        $usersQuery = $mysqlClient->prepare('SELECT * FROM users WHERE email=? AND password=?');
        $usersQuery->execute(array($email, $password));
        $user = $usersQuery->fetch();

        if ($user != null) {
            $_SESSION["error"] = "Nous avons réussi";
            $_SESSION["currentUser"] = array(
                "username"=> $user['username'],
                "email"=> $user['email'],
                "password"=> $user['password'],
                "profilePicture"=> $user['profilePicture'],
                "userId"=> $user['userId'],
            );
        } else {
            $_SESSION["error"] = "Nous n'avons pas pu récupérer l'utilisateur";
        }

    }
} else {
    $_SESSION['error'] = 'veuillez tout remplir pour continuer';
}

header("Location: ../index.php");
exit();