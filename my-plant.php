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
    <header>
        My plant
    </header>
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
            <img src="Includes/images/waterplant.png" alt="temporary water plant button" id="btnWaterPlant">
        </div>
        <div id="plant"> <!--plant image-->
            <!--tag-->
            <img src="Includes/images/digitalPlant.png" alt="" id="plantImg"> <!--plant-->
            <!--chair-->
        </div>
        <div id="infoBlock">
            <img src="Includes/images/woodtexture.png" id="woodTexture">
            <h2 id="plantName">Joyce</h2>
            <div id="information">
                <span id="species">Species</span>
                <span id="status">Status</span>
                <span id="userDescription">Description blah blah blahblah blah blahblah blah blahblah blah blahblah blah blah blah blah blahblah blah blahblah blah blah blah blah blah</span>
                <span id="info">Info plant</span>
            </div>
            <div id="interaction">
                <div id="alarmBtns">
                    <button id="btnNotifWaterPlant"><img src="./Includes/images/waterplant.png" alt=""></button>
                    <button id="btncChangePot"><img src="./Includes/images/newpot.png" alt=""></button>
                    <button id="btnFertalizePlant"><img src="./Includes/images/bemesten.png" alt=""></button>
                    <button id="btnTrimPlant"><img src="./Includes/images/trimplant.png" alt=""></button>
                    <button id="btnChangeLight"><img src="./Includes/images/lighttypebtn.png" alt=""></button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>