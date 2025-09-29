<?php
/** @var mysqli $db */
session_start();
require_once 'Includes/connectie.php';

$login = false;
// Is admin logged in?
$errors = []; // Initialize errors array

// Check if form is submitted
if (isset($_POST['submit'])) {

    // Get form data
    $username = mysqli_real_escape_string($db, $_POST['username'] ?? '');
    $password = mysqli_real_escape_string($db, $_POST['password'] ?? '');

    // Server-side validation
    if ($username === "") {
        $errors['username'] = "Enter a username";
    }
    if ($password === "") {
        $errors['password'] = "Enter a password";
    }

    // Proceed only if there are no validation errors
    if (empty($errors)) {
        // SELECT the admin from the database, based on the name
        $loginQuery = "SELECT * FROM owners WHERE username = ?";
        $stmt = $db->prepare($loginQuery);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the admin exists
        if ($result->num_rows === 1) {
            // Get admin data from result
            $user = $result->fetch_assoc();

            // Check if the provided password matches the stored password in the database
//            if (password_verify($password, $admin['password'])) {
            if (password_verify($password, $user['password'])) {

                // Password is correct

                // Store the admin in the session
                $_SESSION['user'] = $user; // Assuming admin details are stored in session

                // Redirect to secure page
                header('Location: index.php');
                exit;
            } else {
                // Password is incorrect
                $errors['loginFailed'] = "Incorrect login credentials";
            }
        } else {
            // User doesn't exist
            $errors['loginFailed'] = "Invalid login credentials";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/login.css">
    <title>Login</title>
    <script src="Includes/JS/login.js"></script> 
</head>
<body>
    <?php include 'Includes/nav.php'; ?>
    <?php include 'Includes/hoofd.php'; ?>
    <form action="" method="post">
        <div>
            <label for="username">gebruikersnaam</label>
            <input id="username" name="username" type="text" placeholder="Voer gebruikersnaam in" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            <p class="help is-danger">
                <?= $errors['username'] ?? '' ?>
            </p>
        </div>
        <div>
            <label for="password">Wachtwoord</label>
            <input id="password" name="password" type="password" placeholder="Voer wachtwoord in">
            <p class="help is-danger">
                <?= $errors['password'] ?? '' ?>
            </p>
        </div>
        <div>
            <button type="submit" name="submit">Login</button>
        </div>
        <?php if (
            isset($_POST['submit']) && 
            empty($errors['username']) && 
            empty($errors['password']) && 
            isset($errors['loginFailed'])
        ): ?>
        <p class="help is-danger" style="color: red;">
            <?= htmlspecialchars($errors['loginFailed']) ?>
        </p>
        <?php endif; ?>
    </form>
    <a href="./registratie.php">Registreer</a>

</body>
</html>