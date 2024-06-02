<?php
$servername = "localhost:3308";
$username = "root";
$password = "";  // Remplace par ton mot de passe de base de données si nécessaire
$dbname = "ecein";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
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
                    // Préparer et exécuter la première requête pour obtenir les IDs des amis
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
                            
                        $sql = "SELECT utilisateur_pseudo FROM utilisateur WHERE id_utilisateur = ?";
                        $stmt = $conn->prepare($sql);
                        $amis_pseudo = array();
                        foreach ($amis_ids as $i => $id_ami) {
                            $stmt->bind_param("i", $id_ami);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $user = $result->fetch_assoc();
                                $amis_pseudo[$i] = $user['utilisateur_pseudo'];
                            } else {
                                $amis_pseudo[$i] = null; // Ou une valeur par défaut si nécessaire
                            }
                        }
                        $_SESSION['amis_pseudo'] = $amis_pseudo;
                        $sql = "SELECT utilisateur_firstname FROM utilisateur WHERE id_utilisateur = ?";
                        $stmt = $conn->prepare($sql);
                        $amis_firstname = array();
                        foreach ($amis_ids as $i => $id_ami) {
                            $stmt->bind_param("i", $id_ami);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $user = $result->fetch_assoc();
                                $amis_firstname[$i] = $user['utilisateur_firstname'];
                            } else {
                                $amis_firstname[$i] = null; // Ou une valeur par défaut si nécessaire
                            }
                        }
                        $_SESSION['amis_firstname'] = $amis_firstname;
                        // Préparer la requête pour obtenir les photos de profil
                        $sql = "SELECT utilisateur_profile_picture FROM utilisateur WHERE id_utilisateur = ?";
                        $stmt = $conn->prepare($sql);

                        $pdp_a = array();
                        foreach ($amis_ids as $i => $id_ami) {
                            $stmt->bind_param("i", $id_ami);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $user = $result->fetch_assoc();
                                $pdp_a[$i] = $user['utilisateur_profile_picture'];  // Correction : utiliser le nom de la colonne
                            } else {
                                $pdp_a[$i] = null; // Ou une valeur par défaut si nécessaire
                            }
                        }

                        // Stocker les chemins des photos de profil dans la session
                        $_SESSION['pdp_a'] = $pdp_a;
                    } else {
                        // Gérer le cas où l'utilisateur n'a pas d'amis
                        $_SESSION['amis_ids'] = [];
                        $_SESSION['pdp_a'] = [];
                    }

                } else {
                    echo "Aucun résultat trouvé.";
                }
            }


            
            if($_SESSION['nbAmis'] != NULL){
                $user_id = $_SESSION['id']; // L'utilisateur actuel
                $sql = "
                    SELECT messages_id, message, timestamp, user_pseudo
                    FROM messages
                    WHERE (user_sender = ? AND user_receptor = ?)
                    OR (user_sender = ? AND user_receptor = ?)
                    ORDER BY timestamp ASC";
                $stmt = $conn->prepare($sql);

                $_SESSION['messages'] = []; // Initialise le tableau des messages

                foreach ($_SESSION['amis_ids'] as $i => $friend_id) {
                    // Lier les paramètres pour cette exécution spécifique
                    $stmt->bind_param("iiii", $user_id, $friend_id, $friend_id, $user_id);
                    
                    // Exécuter la requête
                    $stmt->execute();
                    
                    // Obtenir le résultat
                    $result = $stmt->get_result();
                    
                    // Initialiser un tableau pour stocker les messages de cette conversation
                    $messages = [];
                    
                    // Parcourir les résultats et les ajouter au tableau des messages
                    while ($row = $result->fetch_assoc()) {
                        $messages[] = $row;
                    }
                    
                    // Stocker les messages de cette conversation dans $_SESSION['messages']
                    $_SESSION['messages'][$i] = $messages;
                }

   
                


                
              
            }
            // Rediriger vers la page d'accueil ou une autre page sécurisée
            
            header("Location: Accueil/accueil.php");
            
            exit();
        } else {
            
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    // Fermer la connexion
    $stmt->close();




?>

