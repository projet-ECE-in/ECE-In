<?php
session_start();
// Configuration de la base de données
$servername = "localhost:3308";
$username = "root";
$password = "";  // Remplace par ton mot de passe de base de données si nécessaire
$dbname = "ecein";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Préparer et exécuter la requête SQL pour récupérer l'utilisateur
    $sql = "SELECT * FROM utilisateur WHERE utilisateur_pseudo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si un utilisateur a été trouvé
    if ($result->num_rows > 0) {
        // Récupérer les données de l'utilisateur
        $user = $result->fetch_assoc();

        // Vérifier le mot de passe
        if (password_verify($password, $user['utilisateur_password'])) {
            echo "Connexion réussie!";
            // Démarrer une session et stocker les informations utilisateur
            
            $_SESSION['id'] = $user['id_utilisateur'];
            $_SESSION['name'] = $user['utilisateur_lastname'];
            $_SESSION['firstname'] = $user['utilisateur_firstname'];
            $_SESSION['pseudo'] = $user['utilisateur_pseudo'];
            $_SESSION['email'] = $user['utilisateur_mail'];
            $_SESSION['password'] = $user['utilisateur_password'];
            $_SESSION['role'] = $user['utilisateur_role'];
            $_SESSION['phone'] = $user['utilisateur_phone'];
            $_SESSION['pdp_u'] = $user['utilisateur_profile_picture'];
            $_SESSION['cv'] = $user['utilisateur_cv'];
            $_SESSION['bio'] = $user['utilisateur_xml'];

         



            $user_id = $_SESSION['id']; // L'utilisateur actuel
            $friend_id = "10"; // L'ID de l'ami (ou de l'autre utilisateur dans la conversation)

            // Requête SQL pour récupérer les messages entre l'utilisateur actuel et l'ami
            $sql = "
                SELECT messages_id, message, timestamp, user_pseudo
                FROM messages
                WHERE (user_sender = ? AND user_receptor = ?)
                OR (user_sender = ? AND user_receptor = ?)
                ORDER BY timestamp ASC";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiii", $user_id, $friend_id, $friend_id, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $messages = [];
            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
            $_SESSION["messages"] = $messages;
       
            
        } else {
            echo "Mot de passe incorrect!";
        }
    } else {

        echo "Utilisateur non trouvé!";
    }
}

            ?>
