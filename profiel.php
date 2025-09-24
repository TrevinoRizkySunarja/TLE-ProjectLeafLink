<?php
session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
} else {
    $username = "username"; // tijdelijke naam
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/CSS/profiel.css">
	<link rel="stylesheet" href="Includes/CSS/style.css">
    <title>Profiel</title>
</head>
<body>


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
        <h3>Plants</h3>
        <h3>Badges</h3>      
</div>
</section>
<section class="manage-plants">
        <a href="add-plant.php">Add Plant</a>
		<input type="text" id="zoekInvoer" placeholder="Search Plant...">
</section>

<section class="my-plants">
	<div class="board">
    <h2>My Plants</h2>
</div>
    
    <div class="shelf">
    <!-- insert plants -->
 </div>
 <div class="shelf">
    <!-- insert plants -->
 </div>
 
</section>

        
</main>

</body>
</html>