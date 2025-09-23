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
    <script src="Includes/JS/archief.js" defer></script>
</head>
<body>
    <?php include 'Includes/hoofd.php'; ?>
    <main>
        <h1>Planten Archief</h1>
        <div class="zoek-balk">
            <input type="text" id="zoekInvoer" placeholder="Zoek planten...">
        </div>
        <section id="plantenLijst" class="planten-lijst>">
            <!-- Planten worden hier dynamisch geladen -->
            <div id="laadMeerKnop" class="laad-meer-knop">
                <p>Laad meer</p>
            </div>
        </section>
    </main>
</body>
</html>
