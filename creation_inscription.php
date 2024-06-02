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
        echo "<script>'Inscription réussie!';</script> ";
    } else {
        echo "Erreur: " . $stmt->error;
    }
 $sql = "SELECT * FROM utilisateur WHERE utilisateur_pseudo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $new_name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si un utilisateur a été trouvé
    if ($result->num_rows > 0) {
        // Récupérer les données de l'utilisateur
        $user = $result->fetch_assoc();

        // Vérifier le mot de passe
       
            
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
        }
    header("Location: CodeVous/index.php");
    exit();
    // Fermer la connexion
    $stmt->close();

}
?>
