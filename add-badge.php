<?php
/** @var mysqli $db */
require_once 'Includes/connectie.php';
require_once 'Includes/login_check.php';

if (isset($_POST['submit'])) {
    $owner_id = $_SESSION['user']['owner_id'] ?? 0;
    $badge = trim($_POST['badge'] ?? '');
    $image = trim($_POST['image'] ?? '');
    $description = trim($_POST['description'] ?? '');

    $errors = []; // Error handling

    if ($badge == '') {
        $errors['badge'] = 'Badge naam vereist.';
    }

    if ($image == '') {
        $errors['image'] = 'Image vereist.';
    }

    if ($description == '') {
        $errors['description'] = 'Descriptie vereist.';
    }

    if (empty($errors)) {
        $date_earned = date('Y-m-d H:i:s');
        // Inserts data into database
        $stmt = $db->prepare("INSERT INTO badges (name, image, details, owner_id, date_earned) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssis", $badge, $image, $description, $owner_id, $date_earned);
            try {
                $stmt->execute();
                $stmt->close();
                mysqli_close($db);
                header('Location: index.php');
                exit;
            } catch (mysqli_sql_exception $exception) { // Error handling
                $errors['general'] = "Database fout: " . $exception->getMessage();
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
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/badges.css">
    <title>Badge Toevoegen</title>
    <script src="Includes/JS/badges.js"></script>
</head>
<body>
<?php include 'Includes/hoofd.php'; ?>
<main>
    <form method="post">
        <div>
            <div>
                <label for="badge">Badge naam</label>
            </div>
            <div>
                <input id="badge" name="badge" type="text" placeholder="Voer een badge naam in" value="" required>
                <p class="help is-danger">
                    <?= $errors['badge'] ?? '' ?>
                </p>
            </div>
        </div>
        <div>
            <div>
                <label for="image">Badge image</label>
            </div>
            <div>
                <select id="image" name="image" required>
                    <option value="">Selecteer Image</option>
                    <option value="firstplantBadge">Eerste Plant Badge</option>
                    <option value="repotaplantBadge">Herpot een Plant</option>
                    <option value="wateringBadge">Water een Plant</option>
                </select>
                <p class="help is-danger">
                    <?= $errors['image'] ?? '' ?>
                </p>
            </div>
        </div>
        <div>
            <div>
                <label for="description">Badge Descriptie</label>
            </div>
            <div>
                <textarea id="description" name="description" rows="4" required></textarea>
                <p class="help is-danger">
                    <?= $errors['description'] ?? '' ?>
                </p>
            </div>
        </div>
        <?php if (isset($errors['general'])): ?>
            <p class="help is-danger"><?= $errors['general'] ?></p>
        <?php endif; ?>
        <div class="button-link">
            <button type="submit" name="submit">Registreer</button>
        </div>
    </form>
</main>
</body>
</html>
