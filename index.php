<?php
require_once 'Includes/login_check.php';
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
            <!--linken naar de badgepage en de goeie badge laten zien-->
            <a href=""><img src="Includes/images/firstplantBadge.png" alt=""></a>
            <a href=""><img src="Includes/images/repotaplantBadge.png" alt=""></a>
            <a href=""><img src="Includes/images/wateringBadge.png" alt=""></a>
        </div>
    </section>
    <section id="FavoritePlantsSec">
        <div class="shelf">
            <img class="favoritePlant" src="Includes/images/cactus1.png" alt="">
            <img class="favoritePlant" src="Includes/images/cactus2.png" alt="">
        </div>
        <div class="shelf">
            <img class="favoritePlant" src="Includes/images/monsterplant.png" alt="">
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
        <img class="close" src="Includes/images/close.png" alt="">
    </section>
    <section id="plantFacts"></section>
</main>
</body>
</html>