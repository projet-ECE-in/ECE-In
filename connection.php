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
            
            $sql = "SELECT COUNT(*) AS count FROM ami WHERE id_utilisateur =  ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i",$_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $_SESSION['nbAmis'] = $result->fetch_assoc()['count'];
            if($_SESSION['nbAmis'] == NULL){
                $_SESSION['nbAmis'] = 0;
            }
            else{
                $sql = "SELECT id_utilisateur_ami FROM ami WHERE id_utilisateur = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $_SESSION['id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $amis_ids = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $amis_ids[] = $row['id_utilisateur_ami'];
                    }
                    // Stocker les ID des amis dans la session
                    $_SESSION['amis_ids'] = $amis_ids;
                    
                    for ($i = 0; $i < count($_SESSION["amis_ids"]); $i++) {
                        $sql = "SELECT utilisateur_profile_picture FROM utilisateur WHERE id_utilisateur = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $amis_ids[$i]);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user = $result->fetch_assoc();
                        if ($i==1){$_SESSION['pdp_a'] = $user;}
                        
                    
                    }
                } else {
                    echo "Aucun résultat trouvé.";
                }
            }
            // Rediriger vers la page d'accueil ou une autre page sécurisée
            header("Location: mess.php");
            exit();
        } else {
            
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    // Fermer la connexion
    $stmt->close();
}

$conn->close();
?>
