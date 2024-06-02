<?php
session_start();
?>
<!DOCTYPE html>
<html>
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
                <a href="../front.html"><div class="image-container"><img src="image_mess/accueil.png" alt="profil" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../code reseau/reseau.html"><div class="image-container"><img src="image_mess/loupe.png" alt="loupe" height="95%" width="100%"></div><div class="item-nav"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="index.html"><div class="image-container"><img src="image_mess/profil2.png" alt="profil" height="95%" width="100%"></div><div class="cercle"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="#"><div class="image-container"><img src="image_mess/notif.png" alt="notif" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../mess.html"><div class="image-container"><img src="image_mess/mess.png" alt="notif" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../code emploi/emploi.html"><div class="image-container"><img src="image_mess/empoie.png" alt="notif" height="95%" width="100%"></div></a>
            </div>
        </div>
        <div class="milieux">
            <div id="profile">
                <div id="profile-picture-container">
                    <img id="profile-picture" src="<?php echo $_SESSION['pdp_u']; ?>" alt="Profile Picture">
                    <input type="file" id="upload-photo" accept="image/*">
                </div>
                <div id="profile-info">
                    <form method="POST" action="">
                        <label for="lastname">Nom:</label>
                        <input type="text" id="lastname" name="lastname" value="<?php echo $_SESSION['name']; ?>" readonly>

                        <label for="firstname">Prénom:</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" readonly>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>
                    </form>
                </div>
            </div>
            
            <!-- Section pour les informations de formation -->
            <section>
                <h2>Formation</h2>
                <form method="POST" action="">
                    <label for="formation1">Formation 1:</label>
                    <input type="text" id="formation1" name="formation1" value="École Centrale d'Électronique (ECE) Paris" readonly>

                    <label for="formation2">Formation 2:</label>
                    <input type="text" id="formation2" name="formation2" value="Master en Informatique" readonly>

                    <label for="formation3">Formation 3:</label>
                    <input type="text" id="formation3" name="formation3" value="Diplôme en Science des Données" readonly>
                </form>
            </section>

            <!-- Section pour les informations sur les projets -->
            <section>
                <h2>Projets</h2>
                <form method="POST" action="">
                    <label for="projet1">Projet 1:</label>
                    <input type="text" id="projet1" name="projet1" value="Développement d'une application web pour la gestion des tâches" readonly>

                    <label for="projet2">Projet 2:</label>
                    <input type="text" id="projet2" name="projet2" value="Création d'un système de recommandation de films" readonly>

                    <label for="projet3">Projet 3:</label>
                    <input type="text" id="projet3" name="projet3" value="Analyse des données de ventes pour une entreprise de e-commerce" readonly>
                </form>
            </section>

            <!-- Section pour le CV -->
            <section>
                <h2>CV</h2>
                <div id="cv-output">
                    <!-- Le CV de l'utilisateur serait affiché ici -->
                    <iframe src="<?php echo $_SESSION['cv']; ?>" width="100%" height="400px"></iframe>
                </div>
            </section>

        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
