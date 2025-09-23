<?php 
/** @var mysqli $db */
require_once 'includes/connection.php';

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

        try {
            $query = "INSERT INTO owners (username, password, email)
            VALUES ('$username', '$hashed_password', '$email')";
            mysqli_query($db, $query);
            mysqli_close($db);
        } catch (mysqli_sql_exception $exception) {
            if (strpos($exception->getMessage(), 'email') !== false) {
                $errors['email'] = "Dit email addres is al in gebruik.";
            }
        }
        header('Location: login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie</title>
</head>
<body>
    
</body>
</html>