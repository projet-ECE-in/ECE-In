<?php

include '../connection.php';

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
}
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
 <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<style>
        .conversation {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
        }
        .message {
            margin-bottom: 10px;
        }
        .timestamp {
            color: #999;
            font-size: 0.8em;
        }
        .user_pseudo {
            font-weight: bold;
        }
        .contact {
            cursor: pointer;
            margin-bottom: 10px;
        }
        .image_contact {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .couleur {
            display: inline-block;
            vertical-align: middle;
        }
        .appelle {
            display: inline-block;
            vertical-align: middle;
            text-align: right;
            margin-left : 20px;
        }
        .contact-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
    </style>

<body>
    <header class="page-header header container-fluid">
        <h1 id="description">ECE In : Social Media Professionnel de l'ECE Paris</h1>
        
        <img id="logo" src="image_mess/Logo_ECEIn.png" alt="Logo">

 </header>
    <div class="wrapper">
        
    
        
    <div class="navbar">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        
        <a  href="../Accueil/accueil.php" ><div class="image-container"><img src="image_mess/accueil.png" alt="profil" height="95%" width="100%"></div><div class="cercleG"></div></a>

      <div class="spass"></div>
      <div class="spass"></div>
      <a href="../code reseau/reseau.php"><div class="image-container"><img src="image_mess/loupe.png" alt="loupe" height="95%" width="100%"></div><div class="item-nav"></div><div class="cercleG"></div></a>
      <div class="spass"></div>
      <div class="spass"></div>
      <a href="../CodeVous/index.php" ><div class="image-container"><img src="image_mess/profil2.png" alt="profil" height="95%" width="100%"></div><div class="cercleG"></div></a>
      <div class="spass"></div>
      <div class="spass"></div>
      <a href="#"><div class="image-container"><img src="image_mess/notif.png" alt="notif" height="95%" width="100%"></div></a>
      
      <div class="spass"></div>
      <div class="spass"></div>
      <a href="mess.php"><div class="image-container"><img src="image_mess/mess.png" alt="notif" height="95%" width="100%"></div><div class="cercle"></div></a>
      <div class="spass"></div>
      <div class="spass"></div>
      <a href="../code emploi/emploi.php"><div class="image-container"><img src="image_mess/empoie.png" alt="notif" height="95%" width="100%"></div></a>
    </div>
</div>
<div class="separator"></div>
    <div class="left-panel">
        <div class="left-panel-haut" >
            <h1>Messagerie</h1>
        </div>
        
            
        
        <div class="left-panel-bas">
            
            <?php
            if (isset($_SESSION["amis_ids"])) {
                $i = 0;
                
                foreach ($_SESSION["pdp_a"] as $ami) {
                    $prenom = $_SESSION["amis_firstname"][$i];
                    $pdp= $ami;
                    echo '<div class="contact" onclick="turn(' . $i . ',\'' . $prenom . '\',\'' . $pdp . '\')">';
                    echo '<img src="' . $ami . '" alt="profil" class="image_contact">';
                    echo '<div class="couleur">' . $prenom . '</div>';
                    echo '</div>';
                    
                    $i++;                 
                }
            }
                   
                 
                    
                
            
            if ($_SESSION["nbAmis"] == 0) {
                echo '<div class="aucun-ami">
                <h1>Aucun contact trouvé :( </h1>
                <p>Allez en ajouter !</p>
                <button onclick="window.location.href=\'../code reseau/reseau.php\'">Rechercher des contacts</button></div>';
            }
            
            ?>
            
        </div>
        </div>
        <div class="separator"></div>
        <div class="right-panel">
            <div class="right-panel-haut"> 
                <div id ="photo_conv"></div>
                <div id="nom_conv"></div>
                <div id= "appel"></div>
                
            </div>
            <div class="separator2"></div>
            <div class="right-panel-middle">

                <div class="message"> 
                <script>
                    var selectedFriendId;
                    var selectedFriendPdp;
                    var selectedRealidfriend;
                    tab=<?php echo json_encode($_SESSION["amis_ids"]); ?>;
                    function turn(index, prenom, pdp) {
                            
                            selectedFriendId = index;
                            selectedFriendPdp = pdp;
                            selectedRealidfriend = tab[index];
                            
                            // Mettre à jour l'image de profil de la conversation
                            var photoDiv = document.getElementById('photo_conv');
                            photoDiv.innerHTML = '<img src="' + pdp + '" class="image_contact">';
                            var nomDiv = document.getElementById('nom_conv');
                            nomDiv.innerHTML = '<div class="couleur">' + prenom + '</div>';
                            var nomDiv = document.getElementById('appel');
                            nomDiv.innerHTML = '<div class="appelle"><a href="https://teams.microsoft.com/l/meetup-join/19%3ameeting_Y2MwNjFkZTItM2NlNi00ZDAxLWJiMTUtYWMwMDZlYzQ4YTgz%40thread.v2/0?context=%7b%22Tid%22%3a%22a2697119-66c5-4126-9991-b0a8d15d367f%22%2c%22Oid%22%3a%229ecaaa49-f285-4ff9-af90-7e12f65dfd84%22%7d"><img src="image_mess/teams.png" alt="profil" class="image_contact"></a></div>';
                            // Charger les messages de la conversation sélectionnée
                            var messagesDiv = document.getElementById('test');
                            messagesDiv.innerHTML = '';

                            var messages = <?php echo json_encode($_SESSION['messages']); ?>;
                            if (messages[selectedFriendId]) {
                                messages[selectedFriendId].forEach(function(message) {
                                    var messageDiv = document.createElement('div');
                                    messageDiv.className = 'message';
                                    messageDiv.innerHTML = '<span class="user_pseudo">' + message.user_pseudo + '</span> ' +
                                                '<span class="text">' + message.message + '</span> ' +
                                                '<div class="timestamp">' + message.timestamp + '</div>'
                                                + '<div class="timestamp">' + selectedRealidfriend + '</div>';
                                    
                                    messagesDiv.appendChild(messageDiv);
                                    
                                });
                            } else {
                                messagesDiv.innerHTML = '<p>Aucun message dans cette conversation.</p>';
                            }
                          
                            // Mettre à jour la session avec l'ID du contact sélectionné
                            fetch('update_session.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: new URLSearchParams({
                                        'friend_id': selectedRealidfriend
                                    })
                             
                                })
                                .then(response => response.text())
                                .then(data => {
                                    if (data !== "Session mise à jour") {
                                        console.error("Erreur lors de la mise à jour de la session:", data);
                                    }
                                })
                             
                                
                            }
                           
                            function loadMessages() {
                                    $.ajax({
                                        url: "load_message.php",
                                        method: "POST",
                                        cache: false,
                                        success: function (data) {
                                            $("#test").html(data); // Insère le log de chat dans la #test div
                                        },
                                        error: function () {
                                            console.log("Erreur lors du chargement de la conversation.");
                                        }
                                    });
                                }
                                
                                
        function sendMessage() {
                    var messageInput = document.getElementById('message_input');
                    var message = messageInput.value;
                   
                    if (message.trim() === '') return;
                    
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "envoie_message.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    
                    xhr.onreadystatechange = function () {
                        
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            
                            // Ajouter le nouveau message dans la conversation actuelle
                            var messagesDiv = document.getElementById('messages_conv');
                            
                            var messageDiv = document.createElement('div');
                            messageDiv.className = 'message';
                            messageDiv.innerHTML = '<span class="user_pseudo">' + <?php echo json_encode($_SESSION["pseudo"]); ?> + '</span> ' +
                                                '<span class="text">' + message + '</span> ' +
                                                '<div class="timestamp">' + new Date().toLocaleString() + '</div>';
                            messagesDiv.appendChild(messageDiv);

                            // Effacer le champ de saisie
                            messageInput.value = '';
                        }
                    };
                    xhr.send("message=" + encodeURIComponent(message) + "&friend_id=" + selectedFriendId);
                    
                }
            setInterval(loadMessages, 100);
               
             
            </script>
            
  
        <div id="test"><h2>Séléctionner une conversation !</h2></div>
      
                
                    
                    
                
                    

                </div>
            </div>
            <div class="right-panel-bas"><input class="message_u" type="text" id="message_input" placeholder="Envoyer un message">
        <button onclick="sendMessage()">Envoyer</button></div>
        
        
            

        </div>
  </div>
  
    <script src="script_mess.js"></script>
</body>
</html>
