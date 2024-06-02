<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['friend_id'])) {
        $_SESSION['current_friend_id'] = (int)$_POST['friend_id'];
        
        echo "Session mise à jour";
    } else {
        echo "Données invalides";
    }
} else {
    echo "Méthode non autorisée";
}
?>
