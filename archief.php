<?php
require_once 'Includes/login_check.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planten Archief</title>
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/archive.css">
    <script src="Includes/JS/archief.js" defer></script>
    <script src="Includes/JS/menu.js" defer></script>
</head>
<body>
    <?php include 'Includes/nav.php'; ?>
    <?php include 'Includes/hoofd.php'; ?>
    <main>
        <div class="filter-balk">
            <select id="lichtFilter" name="lichtFilter">
                <option value="">Licht</option>
                <option value="&sunlight=full_shade">Volledig in Schaduw</option>
                <option value="&sunlight=part_shade">Gedeeltelijk in Schadow</option>
                <option value="&sunlight=sun-part_shade">Zon en Schaduw</option>
                <option value="&sunlight=full_sun">Volle Zon</option>
            </select>
            <select id="waterFilter" name="waterFilter">
                <option value="">Water</option>
                <option value="&watering=frequent">Frequent</option>
                <option value="&watering=average">Normaal</option>
                <option value="&watering=minimum">Minimaal</option>
                <option value="&watering=none">Geen</option>
            </select>
            <select id="overigeFilter" name="overigeFilter">
                <option value="">Overige</option>
                <option value="&poisonous=0">Niet Giftig</option>
                <option value="&indoor=1">Binnenplant</option>
                <option value="&indoor=0">Buitenplant</option>
            </select>
        </div>
        <section id="plantenLijst" class="planten-lijst>">
            <!-- Planten worden hier dynamisch geladen -->
        </section>
        <div id="laadMeerKnop" class="laad-meer-knop">
            <p>Laad meer</p>
        </div>
    </main>
</body>
</html>
