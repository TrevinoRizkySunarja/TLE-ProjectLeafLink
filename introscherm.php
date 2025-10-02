<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="Includes/CSS/intro.css">
    <script src="Includes/JS/intro.js" defer></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Intro</title>
</head>
<body>
<main>
    <div id="welcomeOverlay" class="overlay">
            <div class="step" id="step1">
                <img src="Includes/images/rowOfPlants.png">
                <h1 id="titel">Welkom bij LeafLink! 🌱</h1>
                <p>Ontdek hoe je gemakkelijk je planten kunt bijhouden en je groene oase kunt beheren.</p>
                <button class="nextbtn">Volgende</button>
            </div>

            <div class="step" id="step2">
                <img src="Includes/images/monsterplant.png">
                <h2>Ontdek!</h2>
                <p>Voeg je planten toe, verdien badges en beheer je planten makkelijk.</p>
                <button class="backbtn">Vorige</button>
                <button class="nextbtn">Volgende</button>
        </div>

        <div class="step" id="step3">
            <img src="Includes/images/plantBook.png">
            <h2>Klaar om plantenexpert te worden? </h2>
            <p>Maak nu je LeafLink account aan!</p>
            <button class="backbtn">Vorige</button>
            <button id="startBtn">Start</button>
        </div>

        <div id="stepIndicators">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>

    </div>

</main>

</body>
</html>