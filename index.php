<?php
session_start();

if (isset($_SESSION["Login"])) {
    $first_name = $_SESSION['first_name'];
} else {
    $first_name = "undefined";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/home.css">
    <title>Home</title>
</head>
<body>
    <header> <!--remove later on to put into a seperate file-->

    </header>
    <main>
        <section id="RecentBagesSec">
<!--Span or so for the 'title'-->
<!--div (for every badge)-->
    <!--link to the badge page and "opening" the right badge-->
        <!--badge image-->
        </section>
        <section id="FavoritePlantsSec">
<div id="shelfs">
            <img src="Includes/images/Shelf.png" alt="shelf">
            <img src="Includes/images/Shelf.png" alt="shelf">
        </div>
   
        </section>
        <section id="PlantStatusSec">
<!--div-->
    <!---->


        </section>
    </main>
</body>
</html>