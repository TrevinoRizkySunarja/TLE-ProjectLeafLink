<?php 
    /** @var mysqli $db */
    require_once 'Includes/connectie.php';

    $query = "SELECT * FROM plants"; 

    $result = mysqli_query($db, $query)
    or die ('Error ' . mysqli_error($db) . ' with query ' . $query);

    $plants = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $plants[] = $row
    }

    mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
</body>
</html>