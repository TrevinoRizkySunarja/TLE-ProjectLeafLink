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
            <select>
                <option>Licht</option>
            </select>
            <select>
                <option>Water</option>
            </select>
            <select>
                <option>Ruimte</option>
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
