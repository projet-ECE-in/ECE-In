<?php
include '../connection.php';
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
}


function accepterami($user_id,$conn){
    $sql = "SELECT id_utilisateur_ami FROM ami WHERE id_utilisateur = ? AND ami_accept = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $amis_ids = [];

    while($row = $result->fetch_assoc()){
        $amis_ids[]=$row['id_utilisateur_ami'];
    }
    $stmt->close();

    foreach($amis_ids as $amiid){
        $check_sql = "SELECT * FROM ami WHERE id_utilisateur = ?  AND id_utilisateur_ami = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ii", $amiid, $user_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0){
            $update_sql = "UPDATE ami SET ami_accept = 1 WHERE id_utilisateur = ? AND id_utilisateur_ami = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ii", $user_id, $amiid);
            $update_stmt->execute();
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ii", $amiid, $user_id);
            $update_stmt->execute();
            $update_stmt->close();

        }
        $check_stmt->close();
    }
}
?>