<?php
session_start();
include 'connection.php'; // Assurez-vous de lier votre fichier de connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['message'], $_POST['friend_id'])) {
        $message = $_POST['message'];
        
        $friend_id = $_SESSION['current_friend_id'];
        $user_id = $_SESSION['id']; // ID de l'utilisateur actuel
        $user_pseudo = $_SESSION['pseudo']; // Pseudo de l'utilisateur actuel
        $timestamp = date('Y-m-d H:i:s');

        $sql = "INSERT INTO messages (user_sender, user_receptor, message, timestamp, user_pseudo)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisss", $user_id, $friend_id, $message, $timestamp, $user_pseudo);
        
        if ($stmt->execute()) {
            echo "Message envoyé";
        } else {
            echo "Erreur: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Données invalides";
    }
} else {
    echo "Méthode non autorisée";
}
?>
