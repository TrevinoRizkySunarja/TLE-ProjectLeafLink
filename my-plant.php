<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/my-plant.css">
    <script src="Includes/JS/my-plant.js" defer></script>
    <title>My plant</title>
</head>
<body>
    <header></header>
    <main>
        <!--Pop up-->
        <div id="popUp" class="popUp">
            <div class="popup-content">
                <span class="close" id="closeSpan">&times;</span>
                <p id="popUpText">pop up text</p>
            </div>
        </div>
        <div id="windowDiv">
            <img src="Includes/images/windowwithcurtain.png" alt="window with curtain decoration" id="windowDeco">
        </div>

        <div id="tempAndAlarm">
            <span>21</span>
            <img src="Includes/images/alarmchoice_inactive.png" alt="alarm settings button" id="btnAlarmSet">
        </div>
        <div id="plant"> <!--plant image-->
<!--tag-->
<img src="Includes/images/digitalPlant.png" alt="" id="plantImg"> <!--plant-->
<!--chair-->
        </div>
        <div id="interaction">
            <div id="plantName">
                <h3>Joyce</h3>
                <button>edit name</button>
            </div>
            <div>
                <button id="btnWaterPlant">Water</button>
                <button id="btncChangePot">Verander pot</button>
                <button id="btnFertalizePlant">Bemest</button>
                <button id="btnTrimPlant">Bij knippen</button>
                <button id="btnChangeLight">Zon licht</button>
            </div>
        </div>
    </main>
</body>
</html>