<?php
session_start();

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['email'])) {
    // Rediriger vers la page de connexion si l'email n'est pas dans la session
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Connexion à la base de données
// Assurez-vous que votre connexion à la base de données est déjà établie avant cette section

// Récupérer les informations de l'utilisateur depuis la base de données
$stmt = $dbh->prepare("SELECT * FROM utilisateurs WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe dans la base de données
if (!$user) {
    $error_message = "Erreur, l'adresse mail n'existe pas dans notre base";
}

// Si l'utilisateur soumet le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];

    // Gérer le téléchargement de la photo de profil
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $profilePicture = $targetDir . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profilePicture);
    } else {
        $profilePicture = $user['utilisateur_profile_picture'] ?? 'default_profile.png';
    }

    // Mettre à jour ou insérer les informations de l'utilisateur dans la base de données
    if ($user) {
        $stmt = $dbh->prepare("UPDATE utilisateurs SET utilisateur_lastname = :lastname, utilisateur_firstname = :firstname, utilisateur_profile_picture = :profilePicture WHERE email = :email");
    } else {
        $stmt = $dbh->prepare("INSERT INTO utilisateurs (email, utilisateur_lastname, utilisateur_firstname, utilisateur_profile_picture) VALUES (:email, :lastname, :firstname, :profilePicture)");
    }
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':profilePicture', $profilePicture);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Mettre à jour les variables de session
    $_SESSION['lastname'] = $lastname;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['pdp_u'] = $profilePicture;
}

// Réinitialiser les valeurs pour l'affichage
$lastname = $_SESSION['lastname'] ?? ($user['utilisateur_lastname'] ?? '');
$firstname = $_SESSION['firstname'] ?? ($user['utilisateur_firstname'] ?? '');
$profilePicture = $_SESSION['pdp_u'] ?? ($user['utilisateur_profile_picture'] ?? 'default_profile.png');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECE In - Vous</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="page-header header container-fluid">
        <h1 id="description">ECE In : Social Media Professionnel de l'ECE Paris</h1>
        <img id="logo" src="image_mess/Logo_ECEIn.png" alt="Logo">
    </header>

    <div class="wrapper">
        <div class="navbar">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a href="../front.html"><div class="image-container"><img src="image_mess/accueil.png" alt="Accueil" height="95%" width="100%"></div></a>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php } else { ?>
                    <h2>Bienvenue <?php echo htmlspecialchars($firstname . ' ' . $lastname); ?></h2>
                    <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Photo de profil" class="profile-picture">

                    <form action="index.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="lastname">Nom :</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Prénom :</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture">Photo de profil :</label>
                            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                        </div>
                        <button type="submit" name="update_info" class="btn btn-primary">Mettre à jour</button>
                    </form>

                    <h3>Formations</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Formation 1">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Formation 2">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Formation 3">
                    </div>

                    <h3>Projets</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Projet 1">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Projet 2">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Projet 3">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
