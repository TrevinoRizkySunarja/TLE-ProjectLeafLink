<?php
session_start();

if (isset($_SESSION["Login"])) {
    $first_name = $_SESSION['first_name'];
} else {
    $first_name = "undefined";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/home.css">
    <title>Home</title>
</head>
<body>
<header>
    <H1>Home</H1>
</header>
<main>
    <section class="collection">
        <div id="shelfs">
            <img src="Includes/images/kast.png" alt="shelf">
            <img src="Includes/images/kast.png" alt="shelf">
        </div>
    </section>
</main>
</body>
</html>
