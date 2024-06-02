<?php
include '../connection.php';

if (isset($_SESSION['id']) && isset($_POST['offer_id'])) {
    $user_id = $_SESSION['id'];
    $offer_id = $_POST['offer_id'];

    $stmt = $conn->prepare("UPDATE offer SET id_utilisateur = ? WHERE offer_id = ? ");
    $stmt->bind_param("ii", $user_id, $offer_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unable to apply.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>