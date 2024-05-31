<?php
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
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Rediriger vers la page d'accueil ou une autre page sécurisée
            header("Location: front.html");
            exit();
        } else {
        
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    // Fermer la connexion
    $stmt->close();
}

$conn->close();
?>
