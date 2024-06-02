<?php
session_start();

$host = 'localhost:3308'; // ou 127.0.0.1
$db = 'ecein';
$user = 'root';
$pass = '';

// Connexion à la base de données
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>