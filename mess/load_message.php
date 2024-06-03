<?php

include '../connectionBDD.php'; 

if (isset($_SESSION['current_friend_id'])) {
    $user_id = $_SESSION['id'];
    $friend_id = $_SESSION['current_friend_id'];

    $sql = "
    SELECT message, timestamp, user_pseudo
    FROM messages
    WHERE (user_sender =$user_id AND user_receptor = $friend_id)
    OR (user_sender = $friend_id AND user_receptor = $user_id)
    ORDER BY timestamp ASC";
    $result = $conn->query($sql);

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    
    // Retourne les messages en JSON
    echo json_encode($messages);
}
?>
