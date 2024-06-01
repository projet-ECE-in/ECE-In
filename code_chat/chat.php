
<?php
    session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Conversation</title>
    <style>
        #messages {
            width: 300px;
            height: 500px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .message {
            margin: 10px 0;
        }
        .sender {
            text-align: right;
            padding-left: 80%;
        }
        .receiver {
            text-align: left;
        }
    </style>
</head>
<body>
    
    <div id="messages">
    <?php
    foreach ($_SESSION['messages'] as $message) {
       
        echo "<div class='message " . ($message['user_pseudo'] === $_SESSION['pseudo'] ? 'sender' : 'receiver') . "'>";
        echo "<strong>{$message['user_pseudo']}</strong>: {$message['message']}<br>";
        echo "<small>{$message['timestamp']}</small>";
        echo "</div>";
    }
    
    ?>
    </div>
    
</body>
</html>