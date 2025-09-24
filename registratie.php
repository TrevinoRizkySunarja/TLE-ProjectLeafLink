<?php 
/** @var mysqli $db */
require_once 'Includes/connectie.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $errors = []; 

    if ($username == '') {
        $errors['username'] = 'Gebruikersnaam vereist.';
    }
    if ($password == '') {
        $errors['password'] = 'Wachtwoord vereist.';
    }
    if ($email == '') {
        $errors['email'] = 'E-mail vereist.';
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Use prepared statements to prevent SQL injection
        $stmt = $db->prepare("INSERT INTO owners (username, password, email) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $username, $hashed_password, $email);
            try {
                $stmt->execute();
                $stmt->close();
                mysqli_close($db);
                header('Location: login.php');
                exit;
            } catch (mysqli_sql_exception $exception) {
                if (strpos($exception->getMessage(), 'email') !== false) {
                    $errors['email'] = "Dit email adres is al in gebruik.";
                } else {
                    $errors['general'] = "Registratie mislukt. Probeer opnieuw.";
                }
            }
        } else {
            $errors['general'] = "Database fout.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Includes/CSS/login.css">
    <title>Registratie</title>
</head>
<body>
    <main>
        <h1>Registreer Hier</h1>
        <form method="post">
            <div>
                <label for="username">Gebruikersnaam</label>
                <input id="username" name="username" type="text" placeholder="Voer een gebruikersnaam in" value="">
                <p class="help is-danger">
                    <?= $errors[''] ?? '' ?>
                </p>
            </div>
            <div>
                <label for="password">Wachtwoord</label>
                <input id="password" name="password" type="password" placeholder="Voer een wachtwoord in" value="">
                <p class="help is-danger">
                    <?= $errors[''] ?? '' ?>
                </p>
            </div>
            <div>
                <label for="email">Email-Adres</label>
                <input id="email" name="email" type="text" placeholder="Voer een email-adres in" value="">
                <p class="help is-danger">
                    <?= $errors[''] ?? '' ?>
                </p>
            </div>
            <div>
                <button type="submit" name="submit">Registreer</button>
            </div>
        </form>
    </main>
</body>
</html>