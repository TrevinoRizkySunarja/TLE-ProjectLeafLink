<?php
/** @var mysqli $db */
require_once 'Includes/login_check.php';
require_once 'Includes/connectie.php';

$id = $_SESSION['user']['owner_id'];

//badges uit database halen
$queryBadges = "SELECT * FROM badges WHERE owner_id = $id ORDER BY date_earned DESC LIMIT 3";
$resultBadges = mysqli_query($db, $queryBadges)
or die('Error ' . mysqli_error($db) . ' with query ' . $queryBadges);

if (mysqli_num_rows($resultBadges) !== 0) {
    while ($row = mysqli_fetch_assoc($resultBadges)) {
        $badges[] = $row;
    }
} else {
    $badges = "Geen badges gevonden";
}

//planten uit database halen
$queryPlants = "SELECT * FROM plants WHERE owner_id = $id LIMIT 6";
$resultPlants = mysqli_query($db, $queryPlants)
or die('Error ' . mysqli_error($db) . ' with query ' . $queryPlants);

if (mysqli_num_rows($resultPlants) !== 0) {
    while ($row = mysqli_fetch_assoc($resultPlants)) {
        $plants[] = $row;
    }
} else {
    $plants = "Voeg planten toe om ze hier te zien!";
}

if (isset($_GET['id'])) {
    $plantId = $_GET['id'];
    $queryInfo = "SELECT * FROM plants WHERE plant_id = $plantId";
    $resultInfo = mysqli_query($db, $queryInfo)
    or die('Error ' . mysqli_error($db) . ' with query ' . $queryInfo);
    $info = mysqli_fetch_assoc($resultInfo);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/home.css">
    <script src="Includes/JS/home.js" defer></script>
    <title>Hoofdpagina</title>
</head>
<body>
<?php include 'Includes/nav.php'; ?>
<?php include 'Includes/hoofd.php'; ?>
<main>
    <section id="RecentBagesSec">
        <div class="border">
            <h2>Recente badges</h2>
        </div>
        <div id="badges">
            <?php if ($badges == "Geen badges gevonden") { ?>
                <p id="noBadge"><?= $badges ?></p>
            <?php } else { ?>
                <?php foreach ($badges as $index => $badge) { ?>
                    <a href="badges.php?badge=<?= $badge['badge_id'] ?>"><img
                                src="Includes/images/<?= $badge['image'] ?>.png" alt=""></a>
                <?php } ?>
            <?php } ?>
        </div>
    </section>
    <section id="FavoritePlantsSec">
        <div class="shelf">
            <?php if ($plants == "Voeg planten toe om ze hier te zien!") { ?>
                <p class="noPlants"><?= $plants ?></p>
            <?php } else { ?>
                <?php foreach ($plants as $index => $plant) { ?>
                    <?php if ($index <= 2) { ?>
                        <a href="index.php?id=<?= $plant['plant_id'] ?>">
                            <img class="favoritePlant"
                                 src="Includes/images/<?= $plant['species'] ?>.png"
                                 alt=""></a>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="shelf">
            <?php if ($plants == "Voeg planten toe om ze hier te zien!") { ?>
                <p class="noPlants"><?= $plants ?></p>
            <?php } else { ?>
                <?php foreach ($plants as $index => $plant) { ?>
                    <?php if ($index > 2) { ?>
                        <a href="index.php?id=<?= $plant['plant_id'] ?>">
                            <img class="favoritePlant"
                                 src="Includes/images/<?= $plant['species'] ?>.png"
                                 alt=""></a>
                    <?php } else if ($index == 0) { ?>
                        <p class="noPlants">Voeg planten toe om ze hier te zien!</p>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </section>
    <!--Popup voor info over de plant:-->
    <?php if (isset($_GET['id'])) { ?>
        <section id="PlantStatusSec">
            <div class="border">
                <h2>Favoriete planten</h2>
            </div>
            <div id="plantInfo">
                <h3><?= $info['name'] ?></h3>
                <p>Zonlicht: <?= $info['sunlight'] ?></p>
                <p>Water behoefte: <?= $info['water_frequency'] ?></p>
                <p>Notities: <?= $info['info'] ?></p>
            </div>
            <img class="closeButton" src="Includes/images/close.png" alt="">
        </section>
    <?php } ?>
    <section id="plantFacts">
        <div id="plantFactContent">
            <!-- Feitjes komen hier dynamisch via JS -->
        </div>
    </section>
</main>
</body>
</html>