<?php
session_start();
include 'connection.php'; 



if (isset($_SESSION['current_friend_id'])) {
    $user_id = $_SESSION['id'];
    $friend_id = $_SESSION['current_friend_id'];

    $sql = "
        SELECT message, timestamp, user_pseudo
        FROM messages
        WHERE (user_sender = ? AND user_receptor = ?)
        OR (user_sender = ? AND user_receptor = ?)
        ORDER BY timestamp ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $user_id, $friend_id, $friend_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode($messages);
    
} else {
    echo json_encode([]);
}

?>
