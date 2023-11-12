<?php

$dsn  = 'mysql:host=localhost;dbname=wlkjsite;charset=utf8';
$user = 'root';
$pass = '';

try {
    $cnx = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    $msg = 'Une erreur est survenue dans la connexion à la base de donnée';
    header('Location:error.php?Error='.$msg);
}