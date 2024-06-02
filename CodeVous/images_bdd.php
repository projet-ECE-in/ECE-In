<?php
session_start();
include 'connection.php'; // Assurez-vous de lier votre fichier de connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
        $message = $_SESSION['pdp_u'];
        $user_id = $_SESSION['id']; // ID de l'utilisateur actuel
        


        $sql = "UPDATE utilisateur SET utilisateur_profile_picture=? WHERE id_utilisateur=?";
                
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $message,$user_id);
        
        if ($stmt->execute()) {
            echo "Message envoyé";
        } else {
            echo "Erreur: " . $conn->error;
        }

        $stmt->close();
     
} else {
    echo "Méthode non autorisée";
}
?>
