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
    <script src="Includes/JS/details.js" defer></script>
</head>
<body>
    <?php include 'Includes/hoofd.php'; ?>
    <div class="return-button" id="returnButton"></div>
    <main>
        <section class="plant-details-header">
            <div class="details-image-container">
                <img id="plantImage" src="" alt="Plant Image">
            </div>
            <section class="description">
                <h2 id="plantName"></h2>
                <p id="plantScientificName"></p>
            </section>
        </section>
        <section class="plant-details">
            <h2>Details</h2>
            <p id="description"></p>
            <!-- Extra details worden hier toegevoegd -->
        </section>
        <div id="voegPlantToe" class="add-plant-button"></div>
    </main>
</body>
</html>
