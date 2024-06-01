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
    $new_name = $_POST['new_name'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Hacher le mot de passe
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête SQL pour insérer les données
    $sql = "INSERT INTO utilisateur (utilisateur_pseudo, utilisateur_mail, utilisateur_password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $new_name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Inscription réussie!";
    } else {
        echo "Erreur: " . $stmt->error;
    }
    header("location=Accueil/accueil.php");
    exit();
    // Fermer la connexion
    $stmt->close();
}

?>
