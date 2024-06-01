<!DOCTYPE html>
<html>
<head>
    <title>ECE In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="accueil.css">
    <script type="text/javascript" src="accueil.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <header class="page-header header container-fluid">
           <h1 id="titre">ECE In : Social Media Professionnel de l'ECE Paris</h1>
           <img id="logo" src="Images/Logo_ECEIn.png" alt="Logo">

    </header>

    <nav class="navbar navbar-expand-md">       
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
        <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="accueil.php"> <div class="image-container"><img src="Images/accueil.png" alt="Accueil"> <span>Accueil</span> </div> </a> </li>  
        <li class="nav-item"><a class="nav-link" href="../code reseau/reseau.html"> <div class="image-container"><img src="Images/loupe.png" alt="Mon réseau"> <span>Mon Réseau</span> </div> </a> </li>
        <li class="nav-item"><a class="nav-link" href="../CodeVous/index.html"> <div class="image-container"><img src="Images/profil2.png" alt="Vous"> <span>Vous</span> </div> </a> </li>
        <li class="nav-item"><a class="nav-link" href="#"> <div class="image-container"><img src="Images/notif.png" alt="Notifications"> <span>Notifications</span> </div> </a> </li>
        <li class="nav-item"><a class="nav-link" href="../mess.html"> <div class="image-container"><img src="Images/mess.png" alt="Messagerie"> <span>Messagerie</span> </div> </a> </li>
        <li class="nav-item"><a class="nav-link" href="../code emploi/emploi.html"> <div class="image-container"><img src="Images/emploi.png" alt="Emplois"> <span>Emplois</span> </div> </a> </li>
        </ul>
        <script> 
        $(document).ready(function(){
            $('.nav-item a').hover(
                function() {
                    $(this).css('transform', 'scale(1.1)');
        
                },
                function() {
                    $(this).css('transform', 'scale(1)');
        
                }
            );
        });
        </script>
        </div>
    </nav>

    <h1 id="intro"> Bienvenue sur ECE In ! </h1>
    <p id="texte"> ECE In est un réseau social professionnel pour la communauté ECE Paris. Que vous soyez étudiant/e
        de licence, master ou doctorat, étudiant/e apprenti dans une entreprise, étudiant/e qui cherche
        un stage dans une entreprise ou encore un/e enseignant/e ou employé de l'école qui cherche
        des partenaires pour votre projet de recherche ou autre, ce réseau social s'adresse à tous ceux
        qui souhaitent prendre leur vie professionnelle au sérieux, trouver de nouvelles opportunités pour
        développer leur carrière et se connecter avec d'autres personnes pour des buts professionnels.</p>
    
    <div class="features">
        <div class="column"></div>
        <div class="column1">
            <div class="columnHead">
                <h3 class="feature-title">Évènements de la semaine</h3>
                <div class="container-fluid">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner row w-100 mx-auto">
                            <?php
                            $query2 = "SELECT DISTINCT utilisateur.*, post.* FROM ami LEFT JOIN utilisateur ON (
                            (ami.id_utilisateur = utilisateur.id_utilisateur AND ami.id_utilisateur_ami = $user_id) OR
                            (ami.id_utilisateur_ami = utilisateur.id_utilisateur OR ami.id_utilisateur_ami = $user_id))
                            LEFT JOIN post ON post.id_utilisateur = utilisateur.id_utilisateur WHERE 
                            (ami.ami_accept = 1 OR post.id_utilisateur = $user_id OR post.id_utilisateur = 1)
                            AND post.post0_event1 = 1 AND post.post_date >= CURDATE() 
                            AND post.post_date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)";

                            $query3 = "SELECT * FROM utilisateur WHERE id_utilisateur = $user_id";
                            $result3 = mysqli_query($db_handle, $query3);
                            $row3 = mysqli_fetch_assoc($result3);

                            $result2 = mysqli_query($db_handle, $query2);

                            $active = true;

                            while ($row = mysqli_fetch_assoc($result2)) {
                                echo '
                                <div class="carousel-item col-md-15 ' . ($active ? 'active' : '') . '">
                                    <div class="card">
                                        <img class="card-img-top img-fluid" src="' . $row['post_image'] . '" alt="logo">
                                        <div class="card-body">
                                            <h4 class="card-title">' . $row['post_content'] . '</h4>
                                            <p class="card-text">DATE ' . $row['post_date'] . '</p>
                                        </div>
                                    </div>
                                </div>';
                                $active = false;
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="feed">
            <div class="feedHead">
                <div class="post">
                    <div class="PostHead">
                        <a href="../Vous/vous.php">
                            <img src="<?php echo $row3['utilisateur_profile_picture']; ?>" alt="logo" width="50">
                        </a>
                        <button>Commencer un post</button>
                    </div>
                    <div class="Objet">
                        <button id="btn-evenement">Photo/Vidéo</button>
                        <div id="formulaire-container" style="display: none;">
                            <form action="traiter_formulaire2.php" method="post" enctype="multipart/form-data">
                                <label for="media">Image ou vidéo :</label>
                                <input type="file" id="media" name="media" accept="image/*,video/*"><br>
                                <label for="texte">Texte :</label><br>
                                <textarea id="texte" name="texte" rows="5" cols="40" required></textarea><br>
                                <input type="submit" value="Publier la Photo!">
                            </form>
                        </div>
                        <script>
                            var formulaireVisible1 = false;
                            document.getElementById("btn-evenement").addEventListener("click", function () {
                                if (formulaireVisible1) {
                                    document.getElementById("formulaire-container").style.display = "none";
                                    formulaireVisible1 = false;
                                } else {
                                    document.getElementById("formulaire-container").style.display = "block";
                                    formulaireVisible1 = true;
                                }
                            });
                        </script>
                        <button id="btn-evenement2">Évènement</button>
                        <div id="formulaire-container1" style="display: none;">
                            <form action="traiter_formulaire.php" method="post" enctype="multipart/form-data">
                                <label for="titre1">Titre :</label>
                                <input type="text" id="titre1" name="titre1" required><br>
                                <label for="date1">Date :</label>
                                <input type="date" id="date1" name="date1" required><br>
                                <label for="media1">Image ou vidéo :</label>
                                <input type="file" id="media1" name="media1" accept="image/*,video/*"><br>
                                <label for="texte1">Texte :</label><br>
                                <textarea id="texte1" name="texte1" rows="5" cols="40" required></textarea><br>
                                <input type="submit" value="Publier l'évènement!">
                            </form>
                        </div>
                        <script>
                            var formulaireVisible2 = false;
                            document.getElementById("btn-evenement2").addEventListener("click", function () {
                                if (formulaireVisible2) {
                                    document.getElementById("formulaire-container1").style.display = "none";
                                    formulaireVisible2 = false;
                                } else {
                                    document.getElementById("formulaire-container1").style.display = "block";
                                    formulaireVisible2 = true;
                                }
                            });
                        </script>
                        <button id="btn-evenement3">Rédiger un article</button>
                        <div id="formulaire-container3" style="display: none;">
                            <form action="traiter_formulaire3.php" method="post" enctype="multipart/form-data">
                                <label for="titre3">Titre :</label>
                                <input type="text" id="titre3" name="titre3" required><br>
                                <label for="texte3">Texte :</label><br>
                                <textarea id="texte3" name="texte3" rows="5" cols="40" required></textarea><br>
                                <input type="submit" value="Publier l'article!">
                            </form>
                        </div>
                        <script>
                            var formulaireVisible3 = false;
                            document.getElementById("btn-evenement3").addEventListener("click", function () {
                                if (formulaireVisible3) {
                                    document.getElementById("formulaire-container3").style.display = "none";
                                    formulaireVisible3 = false;
                                } else {
                                    document.getElementById("formulaire-container3").style.display = "block";
                                    formulaireVisible3 = true;
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="feedBody">
                <?php
                $query2 = "SELECT DISTINCT utilisateur.*, post.* FROM utilisateur LEFT JOIN post ON 
                (post.id_utilisateur = utilisateur.id_utilisateur) LEFT JOIN ami ON (
                (ami.id_utilisateur = utilisateur.id_utilisateur AND ami.id_utilisateur_ami = $user_id) OR
                (ami.id_utilisateur_ami = utilisateur.id_utilisateur AND ami.id_utilisateur = $user_id))
                WHERE (ami.ami_accept = 1 OR post.id_utilisateur = $user_id) AND (post.post0_event1 <> 1)
                ORDER BY post.post_date DESC";
                
                $result2 = mysqli_query($db_handle, $query2);
                while ($row = mysqli_fetch_assoc($result2)) {
                    $like_state = "SELECT * FROM `aime` WHERE id_post = " . $row['id_post'] . " AND id_utilisateur = " . $user_id;
                    $result_like = mysqli_query($db_handle, $like_state);
                    $post_like = "";
                    if ($result_like->num_rows > 0) {
                        $row_like = $result_like->fetch_assoc();
                        $post_like = $row_like["aime_state"];
                    }
                    $nombre_like = "SELECT COUNT(*) AS like_count
                    FROM `aime`
                    WHERE id_post = " . $row['id_post'] . " AND aime_state = 1";
                    $result_nombre_like = mysqli_query($db_handle, $nombre_like);
                    $post_nombre_like = "";
                    if ($result_nombre_like->num_rows > 0) {
                        $row_nombre_like = $result_nombre_like->fetch_assoc();
                        $post_nombre_like = $row_nombre_like['like_count'];
                    }
                    echo '
                    <div class="feature-title">
                        <div class="image">
                            <div class="header_publication">
                                <img src="' . $row['utilisateur_profile_picture'] . '" alt="pp" width="50">
                                <h4>' . $row['utilisateur_pseudo'] . '</h4>
                            </div>
                            <div class="body_publication">';
                    if ($row['post0_event1'] == 0) {
                        echo '<img src="' . $row['post_image'] . '">';
                    } elseif (!is_null($row['post_image']) && (strpos($row['post_image'], '.mp4') !== false || strpos($row['post_image'], '.mov') !== false || strpos($row['post_image'], '.avi') !== false || strpos($row['post_image'], '.wmv') !== false)) {
                        echo '<video src="' . $row['post_image'] . '" alt="video" width="150" controls></video>';
                    } elseif ($row['post0_event1'] == 2) {
                        echo '' . $row['post_content'] . '';
                    }
                    echo '
                            </div>
                            <p>' . $row['post_content'] . '</p>
                            <div class="footer_publication">
                                <div class="like" data-post-id="' . $row['id_post'] . '">';
                    if ($post_like) {
                        echo '<img src="../../images/icones/like_ok.png" alt="like" width="30">';
                    } else {
                        echo '<img src="../../images/icones/like.png" alt="like" width="30">';
                    }
                    echo ' ' . $post_nombre_like . '
                                </div>
                                <div class="comment" data-post-id="' . $row['id_post'] . '">
                                    <a href="comment.php">
                                        <img src="../../images/icones/comment.png" alt="comment" width="30">
                                    </a>
                                </div>
                                <div class="share">
                                    <img src="../../images/icones/share.png" alt="comment" width="32">
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>

        <div class="column2">
            <div class="columnHead">
                <h3 class="feature-title">Vos événements</h3>
                <?php
                $query1 = "SELECT * FROM post WHERE (id_utilisateur = $user_id) AND post0_event1  = 1";
                $result1 = mysqli_query($db_handle, $query1);

                while ($row = mysqli_fetch_assoc($result1)) {
                    echo '
                    <div class="feature-title">
                        <div class="image">';

                    if (strpos($row['post_image'], '.jpg') !== false || strpos($row['post_image'], '.jpeg') !== false || strpos($row['post_image'], '.png') !== false || strpos($row['post_image'], '.gif') !== false) {
                        echo '<img src="' . $row['post_image'] . '" alt="logo" width="150">';
                    } elseif (strpos($row['post_image'], '.mp4') !== false || strpos($row['post_image'], '.mov') !== false || strpos($row['post_image'], '.avi') !== false || strpos($row['post_image'], '.wmv') !== false) {
                        echo '<video src="' . $row['post_image'] . '" alt="video" width="150" controls></video>';
                    }

                    echo '
                            <div class="feedbody">
                                <p>' . $row['post_content'] . '</p>
                            </div>
                        </div>
                    </div>
                    <p class="date">Publié le : ' . $row['post_date'] . '</p>';
                }
                ?>
            </div>
        </div>
        <div class="column"></div>
    </div>

</body>
</html>