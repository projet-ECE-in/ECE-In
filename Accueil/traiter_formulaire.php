<?php
// Connexion à la base de données
include '../connection.php';
$user_id = "12";
$dsn = 'mysql:host=db;port=3308;dbname=ecein';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Récupération des données du formulaire
$titre = $_POST['titre1'];
$date = $_POST['date1'];
$texte = $_POST['texte1'];

// Récupération du fichier image
$image = $_FILES['media1']['name'];

// Déplacement du fichier vers un emplacement de votre choix
$cheminImage = '../Images/' . $image;
move_uploaded_file($_FILES['media1']['tmp_name'], $cheminImage);

// Construction de la requête SQL
$sql = "INSERT INTO post (post_image, post_date, post_content, post0_event1, post_confid, id_utilisateur)
        VALUES (:post_image, :post_date, :post_content, 1, :post_confid, :user_id)";


// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Affectation des valeurs aux paramètres de la requête
$stmt->bindParam(':post_image', $cheminImage);
$stmt->bindParam(':post_date', $date);
$stmt->bindParam(':post_content', $texte);
$stmt->bindValue(':post_confid', 0); // Valeur fixe pour post_confid
$stmt->bindParam(':user_id', $user_id);

// Exécution de la requête
if ($stmt->execute()) {
    // Insertion réussie
    header('accueil.php');
} else {
    // Erreur lors de l'insertion
  
}
?>
