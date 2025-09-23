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
    <title>Hoofdpagina</title>
</head>
<body>
<header>
    <h1>Home</h1>
</header>
<main>
    <section id="RecentBagesSec">
        <div class="border">
            <h2>Recente badges</h2>
        </div>
        <div id="badges">
            <a href=""><img src="Includes/images/firstplantBadge.png" alt=""></a>
            <a href=""><img src="Includes/images/repotaplantBadge.png" alt=""></a>
            <a href=""><img src="Includes/images/wateringBadge.png" alt=""></a>
        </div>
        <!--Span or so for the 'title'-->
        <!--div (for every badge)-->
        <!--link to the badge page and "opening" the right badge-->
        <!--badge image-->
        <!--div-->
    </section>
    <section id="FavoritePlantsSec">
        <div id="shelfs">
            <img src="Includes/images/shelf.png" alt="plank">
            <img src="Includes/images/shelf.png" alt="plank">
        </div>
    </section>
    <section id="PlantStatusSec">
    </section>
</main>
</body>
</html>