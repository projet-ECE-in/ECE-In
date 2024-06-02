<?php

include '../connectionBDD.php'; // Assurez-vous de lier votre fichier de connexion à la base de données

// Vérifier si la photo de profil est téléchargée
if(isset($_FILES['profile_picture'])){
    $dossier_cible = "../Images/";
    $fichier_cible = $dossier_cible . basename($_FILES["profile_picture"]["name"]);
    move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $fichier_cible);
    $_SESSION['pdp_u'] = $fichier_cible;
    
}
if(isset($_SESSION['pdp_u'])){
        $message = $_SESSION['pdp_u'];
        $user_id = $_SESSION['id']; // ID de l'utilisateur actuel
        


        $sql = "UPDATE utilisateur SET utilisateur_profile_picture=? WHERE id_utilisateur=?";
                
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $message,$user_id);
        
        if ($stmt->execute()) {
           
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
    <title>Téléchargement de la photo de profil</title>
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
            <input type="submit" value="confirmer la photo de profil">
        </form>
         <a href="index.php">revenir à la page</a>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('profile-picture');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
        
    </script>
</body>
</html>
