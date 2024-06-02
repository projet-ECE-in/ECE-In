<?php
include "apply_offer.php";
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
}
?>

<?php
$offremploi = [];
$offrestage = [];

// Fetch offers from the database
$sql = "SELECT * FROM offer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['offer_type'] == 'emploi') {
            $offremploi[] = $row;
        } elseif ($row['offer_type'] == 'stage') {
            $offrestage[] = $row;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres d'emploi et de stage</title>
    <link rel="stylesheet" href="emploi.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="page-header header container-fluid">
        <h1 id="description">ECE In : Social Media Professionnel de l'ECE Paris</h1>
        
        <img id="logo" src="../image_mess/Logo_ECEIn.png" alt="Logo">

 </header>
    <div class="wrapper">
        <div class="navbar">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a href="../Accueil/accueil.php"><div class="image-container"><img src="../image_mess/accueil.png" alt="profil" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../code reseau/reseau.php"><div class="image-container"><img src="../image_mess/loupe.png" alt="loupe" height="95%" width="100%"></div><div class="item-nav"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../CodeVous/index.php"><div class="image-container"><img src="../image_mess/profil2.png" alt="profil" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="#"><div class="image-container"><img src="../image_mess/notif.png" alt="notif" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="../mess.html"><div class="image-container"><img src="../image_mess/mess.png" alt="notif" height="95%" width="100%"></div></a>
                <div class="spass"></div>
                <div class="spass"></div>
                <a href="#"><div class="image-container"><img src="../image_mess/empoie.png" alt="notif" height="95%" width="100%"></div><div class="cercle"></div></a>
            </div>
        </div>
        <div class="separator"></div>
        <div class="right-panel">
            <section id="emploi">
                <h2>Offres d'emploi</h2>
                <?php foreach($offremploi as $offre): ?>
                <div class="offreemploi">
                    <h3><?php echo htmlspecialchars($offre['offer_domain']);?></h3>
                    <p>Lieu : <?php echo htmlspecialchars($offre['offer_location'])?></p>
                    <p>Description : <?php echo htmlspecialchars($offre['offer_content']); ?></p>
                    <p>Salaire : <?php echo htmlspecialchars($offre['offer_salaire']);   ?> $/ans</p>
                    <?php  echo " <button class='postuler' data-id='" . htmlspecialchars($offre['offer_id']) . "'>postuler</button></li>";?>
                </div>
                <?php endforeach?>
            </section>
            <section id="stage">
                <h2>Offres de stage</h2>
                <?php foreach ($offrestage as $offer): ?>
                <div class="offreemploi">
                    <h3><?php echo htmlspecialchars($offer['offer_domain']); ?></h3>
                    <p>Lieu : <?php echo htmlspecialchars($offer['offer_location']); ?></p>
                    <p>Description : <?php echo htmlspecialchars($offer['offer_content']); ?></p>
                    <p>Salaire : <?php echo htmlspecialchars($offer['offer_salaire']);  ?> $/mois</p>
                    <?php  echo " <button class='postuler' data-id='" . htmlspecialchars($offer['offer_id']) . "'>postuler</button></li>";?>
                </div>
                <?php endforeach; ?>
            </section>
        </div>
    </div>
    <script src="emploi.js"></script>
    <script>
        $(document).ready(function(){
            $('.postuler').click(function() {
                var offerid = $(this).data('id');
                var button = $(this);

                $.ajax({
                    url: 'apply_offer.php',
                    type: 'POST',
                    data: { offerid: offerid },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.status === 'success') {
                            $('#offer-' + offerid).hide();
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
        });
        
    });
</script>
</body>
</html>
