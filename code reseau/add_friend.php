<?php
include '../connection.php';
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
}

$ami_id = $_POST['amiId'] ?? null;
if ($ami_id) {
    $sql = "SELECT * FROM ami WHERE id_utilisateur = ? AND id_utilisateur_ami = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $ami_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $update_sql = "UPDATE ami SET ami_accept = 1 WHERE id_utilisateur = ? AND id_utilisateur_ami = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $user_id, $ami_id);
        $update_stmt->execute();

        if ($update_stmt->affected_rows > 0) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        // Insert new friendship
        $insert_sql = "INSERT INTO ami (id_utilisateur, id_utilisateur_ami, ami_accept) VALUES (?, ?, 0)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ii", $user_id, $ami_id);
        $insert_stmt->execute();

        if ($insert_stmt->affected_rows > 0) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
} 
else {
    echo 'error';
}
?>
