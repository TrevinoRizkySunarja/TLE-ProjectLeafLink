<?php

// Database connectie (pas eventueel aan naar jouw gegevens)
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "leaflink";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connectie mislukt: " . $conn->connect_error);
}

// Check of het formulier verzonden is
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (!empty($name) && !empty($description)) {
        $stmt = $conn->prepare("INSERT INTO plants (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);

        if ($stmt->execute()) {
            echo "<p>🌱 Plant succesvol toegevoegd aan LeafLink!</p>";
        } else {
            echo "<p>❌ Fout bij toevoegen: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>⚠️ Vul zowel een naam als een beschrijving in.</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/home.css">
    <title>LeafLink - Plant toevoegen</title>
</head>
<body>
<h1>Nieuwe plant toevoegen</h1>
<form method="POST" action="add-plant.php">
    <label for="name">Naam van de plant:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="description">Beschrijving:</label><br>
    <textarea id="description" name="description" rows="4" required></textarea><br><br>

    <button type="submit">Toevoegen</button>
</form>
</body>
</html>
