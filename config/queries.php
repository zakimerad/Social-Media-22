<?php 
/*

Pour récupérer uniquement les posts

$postQueries = $mysqlClient->prepare('SELECT * FROM posts');
$postQueries->execute();
$posts = $postQueries->fetchAll();
*/

$query = 'SELECT posts.*, users.* FROM posts LEFT JOIN users ON posts.personId = users.userId ORDER BY posts.date DESC;';
$postWithUsers = $mysqlClient->prepare($query);
$postWithUsers->execute();
$postComplet = $postWithUsers->fetchAll();