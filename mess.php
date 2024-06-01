<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resizable Split View</title>
    <link rel="stylesheet" href="styles_mess.css">
    <link rel="stylesheet"
 href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>


<body>
    <header class="page-header header container-fluid">
        <h1 id="description">ECE In : Social Media Professionnel de l'ECE Paris</h1>
        
        <img id="logo" src="Images/Logo_ECEIn.png" alt="Logo">

 </header>
    <div class="wrapper">
        
    
        
    <div class="navbar">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        
        <a  href="accueil.html" ><div class="image-container"><img src="image_mess/accueil.png" alt="profil" height="95%" width="100%"></div><div class="cercleG"></div></a>

      <div class="spass"></div>
      <div class="spass"></div>
      <a href="code reseau/reseau.html"><div class="image-container"><img src="image_mess/loupe.png" alt="loupe" height="95%" width="100%"></div><div class="item-nav"></div><div class="cercleG"></div></a>
      <div class="spass"></div>
      <div class="spass"></div>
      <a href="CodeVous/index.html" ><div class="image-container"><img src="image_mess/profil2.png" alt="profil" height="95%" width="100%"></div><div class="cercleG"></div></a>
      <div class="spass"></div>
      <div class="spass"></div>
      <a href="#"><div class="image-container"><img src="image_mess/notif.png" alt="notif" height="95%" width="100%"></div></a>
      
      <div class="spass"></div>
      <div class="spass"></div>
      <a href="#"><div class="image-container"><img src="image_mess/mess.png" alt="notif" height="95%" width="100%"></div><div class="cercle"></div></a>
      <div class="spass"></div>
      <div class="spass"></div>
      <a href="code emploi/emploi.html"><div class="image-container"><img src="image_mess/empoie.png" alt="notif" height="95%" width="100%"></div></a>
    </div>
</div>
<div class="separator"></div>
    <div class="left-panel">
        <div class="left-panel-haut">
            <h1>Messagerie</h1>
        </div>
        
            <input class="left-middle" type="text" placeholder="Rechercher un contact">
        
        <div class="left-panel-bas">
            
            <?php
            if(isset($_SESSION["amis_ids"])) {
              
                foreach ($_SESSION["pdp_a"] as $ami2) {
                    echo $ami2;
                }
               
                $i=0;
                foreach ($_SESSION["pdp_a"] as $ami) {
                    $i++;
                    echo '<div class="contact">
                    <img src="'.$ami.'" alt="profil"  class="image_contact"> cherki
                    
                    </div>';
                    
                }
                echo $i;
               }
                   
                 
                    
                
            
            if ($_SESSION["nbAmis"] == 0) {
                echo '<div class="aucun-ami">
                <h1>Aucun contact trouvé :( </h1>
                <p>Allez en ajouter !</p>
                <button onclick="window.location.href=\'code reseau/reseau.html\'">Rechercher des contacts</button></div>';
            }
            
            ?>
            
        </div>
        </div>
        <div class="separator"></div>
        <div class="right-panel">
            <div class="right-panel-haut"> nom du contact</div>
            <div class="separator2"></div>
            <div class="right-panel-middle"></div>
            <div class="right-panel-bas"><input class="message_u" type="text" placeholder="Envoyer un message"></div>
            

        </div>
  </div>
  
    <script src="script_mess.js"></script>
</body>
</html>