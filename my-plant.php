<?php
//🐘

/** @var mysqli $db
 */
require_once 'Includes/connectie.php';

if (isset($_GET['id'])) {
    $plantId = $_GET['id']; //undo this once an idea is passed on to the next page
//$plantId = 1; //so this is now temporary

    $query = "SELECT * FROM `plants` WHERE plant_id = $plantId";

    $result = mysqli_query($db, $query)
    or die ('Errror ' . mysqli_error($db) . ' with query ' . $query);

    if (mysqli_num_rows($result) !== 0) {
        $plantData = mysqli_fetch_assoc($result);
    } else {
        header('Location: index.php');
        exit;
    }

} else {
    header('Location: index.php');
    exit;
}


//while ($row = mysqli_fetch_assoc($result)) {
//    $plantData[] = $row;
//}

//these are tests for data
// echo var_dump($plantData);
// echo var_dump($plantData[$plantId - 1]['name']);

//$plantId = $plantId - 1; //yes it's not okay and it's cheap but there's no other way ;w;
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/my-plant.css">
    <script src="Includes/JS/my-plant.js" defer></script>
    <script src="Includes/JS/menu.js" defer></script>
    <title>My plant - <?= $plantData['name'] ?></title>
</head>

<body>
<!--check if the data isset 🐘-->
<?php include 'Includes/nav.php'; ?>
<header>
    <h1>My plant</h1>
    <a href="profiel.php"><img src="Includes/images/profile.png" alt=""></a>
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
        <span>21°</span>
        <img src="Includes/images/alarmchoice_inactive.png" alt="alarm settings button" id="btnAlarmSet">
        <img src="Includes/images/waterplant.png" alt="temporary water plant button" id="btnWaterPlant">
    </div>
    <div id="plant">
        <img src="Includes/images/digitalPlant.png" alt="" id="plantImg">
    </div>
    <div id="infoBlock">
        <img src="Includes/images/woodtexture.png" id="woodTexture">
        <h2 id="plantName"><?= $plantData['name'] ?></h2>
        <div id="information">
            <span id="species"><?= $plantData['species'] ?></span>
            <span id="status">Status: Healthy</span> <!--Change via javascript-->
            <span id="userDescription"><?= $plantData['info'] ?></span>
            <span id="info">Info plant</span> <!--get from result link to plant 🐘-->
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