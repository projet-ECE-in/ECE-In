<?php
include '../connection.php';
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réseau Social</title>
    <link rel="stylesheet" href="reseau.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="page-header header container-fluid">
        <div class="header-content">
            <h1 id="description">ECE In : Social Media Professionnel de l'ECE Paris</h1>
            <img id="logo" src="../Images/Logo_ECEIn.png" alt="Logo">
        </div>
    </header>
    <div class="wrapper">
        <div class="navbar">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a href="../accueil.html"><div class="image-container"><img src="../image_mess/accueil.png" alt="profil" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../code reseau/reseau.html"><div class="image-container"><img src="../image_mess/loupe.png" alt="loupe" height="95%" width="100%"></div><div class="item-nav"></div></a><div class="cercle"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../CodeVous/index.html"><div class="image-container"><img src="../image_mess/profil2.png" alt="profil" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="#"><div class="image-container"><img src="../image_mess/notif.png" alt="notif" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../mess.php"><div class="image-container"><img src="../image_mess/mess.png" alt="notif" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../code emploi/emploi.html"><div class="image-container"><img src="../image_mess/empoie.png" alt="notif" height="95%" width="100%"></div></a>
            </div>
        </div>
        <div class="separator"></div>
        <div class="right-panel">
            <div class="friends-suggestions-container">
            <section id="friends" class="friends-section">
                    <h2>Mes Amis</h2>
                    <input type="text" placeholder="Rechercher un ami">
                    <ul>
                        <?php
                        $sql = "SELECT u.utilisateur_firstname, u.utilisateur_lastname, u.utilisateur_pseudo 
                                FROM ami a 
                                JOIN utilisateur u ON a.id_utilisateur_ami = u.id_utilisateur 
                                WHERE a.id_utilisateur = $user_id AND a.ami_accept = 1";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<li>" . $row["utilisateur_firstname"]. " " . $row["utilisateur_lastname"]. " (" . $row["utilisateur_pseudo"]. ")</li>";
                            }
                        } else {
                            echo "0 résultats";
                        }
                        ?>
                    </ul>
                </section>
                <section id="suggestions" class="suggestions-section">
                    <h2>Suggestions d'amis</h2>
                    <input type="text" placeholder="Rechercher un ami">
                    <ul>
                        <?php
                        $stmt = $conn->prepare("SELECT id_utilisateur, utilisateur_pseudo FROM utilisateur WHERE id_utilisateur != ?");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $users = $result->fetch_all(MYSQLI_ASSOC);

                        foreach ($users as $user) {
                            // Check if the user is already a friend
                            $check_friend_sql = "SELECT 1 FROM ami WHERE id_utilisateur = ? AND id_utilisateur_ami = ? AND ami_accept = 1";
                            $check_friend_stmt = $conn->prepare($check_friend_sql);
                            $check_friend_stmt->bind_param("ii", $user_id, $user['id_utilisateur']);
                            $check_friend_stmt->execute();
                            $check_friend_result = $check_friend_stmt->get_result();

                            if ($check_friend_result->num_rows == 0) {
                                echo "<li>" . htmlspecialchars($user['utilisateur_pseudo']) . " <button id='ajouterami'>Ajouter</button></li>";
                            }

                            $check_friend_stmt->close();
                        }
                        $stmt->close();
                        ?>
                    </ul>
                </section>
            </div>
        </div>
    </div>
    <script >
        $(document).ready(function() {
            $('#ajouterami').click(function(){
                
            });
        });
    </script>
</body>
</html>