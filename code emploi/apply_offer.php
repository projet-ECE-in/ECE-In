<?php
include '../connection.php';
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
}

if (isset($_POST['offer_id'])) {
    $offer_id = $_POST['offer_id'];

    $update_sql = "UPDATE offer SET id_utilisateur = ? WHERE offer_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ii", $user_id, $offer_id);
    $update_stmt->execute();



    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unable to apply.']);
    }

    $stmt->close();
    $conn->close();
}
?>