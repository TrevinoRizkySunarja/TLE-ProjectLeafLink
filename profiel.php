<?php
/** @var mysqli $db */
session_start();
require_once 'includes/connectie.php';


if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $userId = $_SESSION['user']['owner_id'];

    $result = mysqli_query($db, "SELECT COUNT(*) as total FROM plants WHERE owner_id = '$userId' ");
    $row = mysqli_fetch_assoc($result);
    $plantCount = $row['total'];

    $result = mysqli_query($db, "SELECT COUNT(*) as total FROM badges WHERE owner_id = '$userId' ");
    $row = mysqli_fetch_assoc($result);
    $badgeCount = $row['total'];
} else { //tijdelijk
    $username = "username";
    $userId = 0;
    $plantCount = 0;
    $badgeCount = 0;

}

if (isset($_GET['search'])) {
    $term = mysqli_real_escape_string($db, $_GET['search']);
    $result = mysqli_query($db, "SELECT name FROM plants WHERE name LIKE '%$term%'");
    $plants = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $plants[] = $row['name'];
    }
    header('Content-Type: application/json');
    echo json_encode($plants);
    exit; // belangrijk: stop verdere rendering van de pagina
}

//planten uit database halen
$id = $_SESSION['user']['owner_id'];
$queryPlants = "SELECT * FROM plants WHERE owner_id = $id LIMIT 6";
$resultPlants = mysqli_query($db, $queryPlants)
or die('Error ' . mysqli_error($db) . ' with query ' . $queryPlants);

if (mysqli_num_rows($resultPlants) !== 0) {
    while ($row = mysqli_fetch_assoc($resultPlants)) {
        $plants1[] = $row;
    }
} else {
    $plants1 = "Voeg planten toe om ze hier te zien!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/CSS/profiel.css">
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <script src="Includes/JS/profiel.js" defer></script>
    <script src="Includes/JS/menu.js" defer></script>
    <title>Profiel</title>
</head>
<body>
<?php include 'Includes/nav.php'; ?>


<header>
    <h1>Profiel</h1>

</header>

<main>
    <section class="profile-info">
        <div class="avatar-container">
            <img src="Includes/images/profile.png" >
            <div class="profile-username">
                @<?php echo htmlspecialchars($username); ?>
            </div>
        </div>
        <div class="pnb">
            <h3><?= $plantCount . " "?>Plants</h3>
             <h3 id="badges"><?= $badgeCount . " "?>Badges</h3>

        </div>
    </section>
    <section class="manage-plants">
        <a href="add-plant.php">Add Plant</a>
        <div class="search-wrapper">
            <input type="text" id="zoekInvoer" placeholder="Search Plant...">
            <div id="searchDropdown"></div>
        </div>
    </section>

    <section class="my-plants">
        <div class="board">
            <h2>My Plants</h2>
        </div>

        <div class="shelf">
            <?php if ($plants1 == "Voeg planten toe om ze hier te zien!") { ?>
                <p class="noPlants"><?= $plants1 ?></p>
            <?php } else { ?>
                <?php foreach ($plants1 as $index => $plant) { ?>
                    <?php if ($index <= 2) { ?>
                        <img class="favoritePlant"
                             src="Includes/images/<?= $plant['species'] ?>.png"
                             alt="">
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="shelf">
            <?php if ($plants1 == "Voeg planten toe om ze hier te zien!") { ?>
                <p class="noPlants"><?= $plants1 ?></p>
            <?php } else { ?>
                <?php foreach ($plants1 as $index => $plant) { ?>
                    <?php if ($index > 2) { ?>
                        <img class="favoritePlant"
                             src="Includes/images/<?= $plant['species'] ?>.png"
                             alt="">
                    <?php } else if ($index == 0) { ?>
                        <p class="noPlants">Voeg planten toe om ze hier te zien!</p>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>

    </section>


</main>

</body>
</html>