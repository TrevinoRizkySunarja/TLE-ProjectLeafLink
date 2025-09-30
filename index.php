<?php
/** @var mysqli $db */
require_once 'Includes/login_check.php';
require_once 'Includes/connectie.php';

$id = $_SESSION['user']['owner_id'];

//badges uit database halen
$queryBadges = "SELECT * FROM badges WHERE owner_id = $id ORDER BY date_earned DESC LIMIT 3";
$resultBadges = mysqli_query($db, $queryBadges)
or die('Error ' . mysqli_error($db) . ' with query ' . $queryBadges);
//$badges = [];

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
$plants = [];

if (mysqli_num_rows($resultPlants) !== 0) {
    while ($row = mysqli_fetch_assoc($resultPlants)) {
        $plants[] = $row;
    }
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
    <script src="Includes/JS/menu.js" defer></script>
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
                    <!--linken naar de badgepage en de goeie badge laten zien-->
                    <a href="badges.php?badge=<?= $badge['badge_id'] ?>"><img
                                src="Includes/images/<?= $badge['image'] ?>.png" alt=""></a>
                <?php } ?>
            <?php } ?>
        </div>
    </section>
    <section id="FavoritePlantsSec">
        <div class="shelf">
            <?php foreach ($plants as $index => $plant) { ?>
                <?php if ($index <= 2) { ?>
                    <img id="<?= $plant['plant_id'] ?>" class="favoritePlant"
                         src="Includes/images/<?= $plant['species'] ?>.png" alt="">
                <?php } ?>
            <?php } ?>
        </div>
        <div class="shelf">
            <?php foreach ($plants as $index => $plant) { ?>
                <?php if ($index > 2) { ?>
                    <img id="<?= $plant['plant_id'] ?>" class="favoritePlant"
                         src="Includes/images/<?= $plant['species'] ?>.png"
                         alt="">
                <?php } ?>
            <?php } ?>
        </div>
    </section>
    <!--Popup voor info over de plant:-->
    <section id="PlantStatusSec">
        <div class="border">
            <h2>Favoriete planten</h2>
        </div>
        <div id="plantInfo">
            <p>Zieke info over de plant epic!</p>
        </div>
        <img class="closeButton" src="Includes/images/close.png" alt="">
    </section>
    <section id="plantFacts"></section>
</main>
</body>
</html>