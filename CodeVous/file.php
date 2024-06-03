<?php
include '../connectionBDD.php'; // Assurez-vous de lier votre fichier de connexion à la base de données

// Vérifier si la photo de profil est téléchargée
if (isset($_FILES['profile_picture'])) {
    $dossier_cible = "../Images/";
    $fichier_cible = $dossier_cible . basename($_FILES["profile_picture"]["name"]);
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $fichier_cible)) {
        $_SESSION['pdp_u'] = $fichier_cible;
    } else {
        echo "Erreur lors du téléchargement de la photo.";
    }
}

// Vérifier si le formulaire de mise à jour du profil est soumis
if (isset($_POST['update_profile'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $user_id = $_SESSION['id']; // ID de l'utilisateur actuel
    $photo = isset($_SESSION['pdp_u']) ? $_SESSION['pdp_u'] : 'default_profile.png';
    $_SESSION['name']= $_POST['nom'];
    $_SESSION['firstname']=$_POST['prenom'];
    $sql = "UPDATE utilisateur SET utilisateur_profile_picture=?, utilisateur_lastname=?, utilisateur_firstname=? WHERE id_utilisateur=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $photo, $nom, $prenom, $user_id);

    if ($stmt->execute()) {
        echo "Profil mis à jour avec succès.";
    } else {
        echo "Erreur: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du profil</title>
    <style>
        #profile-picture-container {
            text-align: center;
        }
        #profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        #upload-photo {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="profile-picture-container">
        <img id="profile-picture" src="<?php echo isset($_SESSION['pdp_u']) ? $_SESSION['pdp_u'] : 'default_profile.png'; ?>" alt="Photo de profil">
        <form method="post" enctype="multipart/form-data">
            <input type="file" id="upload-photo" name="profile_picture" accept="image/*" onchange="previewImage(event)">
            <br>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
            <br>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
            <br>
            <input type="submit" name="update_profile" value="Mettre à jour le profil">
        </form>
        <a href="index.php">Revenir à la page</a>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profile-picture');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
