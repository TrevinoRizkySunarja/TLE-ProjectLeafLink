<?php
/** @var mysqli $db */
require_once 'Includes/connectie.php';
require_once 'Includes/login_check.php';

$id = $_SESSION['user']['owner_id'];

if (isset($_GET['badge'])) {
    $badge_id = (int)$_GET['badge'];

    // Fetch specific badge that belongs to the logged-in user
    $queryBadge = "SELECT * FROM badges WHERE badge_id = ? AND owner_id = ?";
    $stmt = $db->prepare($queryBadge);
    $stmt->bind_param("ii", $badge_id, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $badge = $result->fetch_assoc();
    } else {
        $badge = null;
    }
    $stmt->close();
} else {
    $badge = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badge Detail</title>
    <link rel="stylesheet" href="Includes/CSS/style.css">
    <link rel="stylesheet" href="Includes/CSS/badges.css">
</head>
<body>
<?php include 'Includes/hoofd.php'; ?>
<main>
    <section class="badge-details-header">
        <div class="badge-image-container">
            <?php if ($badge): ?>
                <img id="badgeImage" src="Includes/images/<?= $badge['image'] ?>.png" alt="<?= htmlspecialchars($badge['name']) ?>">
            <?php else: ?>
                <img id="badgeImage" src="" alt="Badge niet gevonden">
            <?php endif; ?>
        </div>
    </section>
    <section class="badge-details">
        <?php if ($badge): ?>
            <h2><?= htmlspecialchars($badge['name']) ?></h2>
            <p id="description"><?= htmlspecialchars($badge['details']) ?></p>
            <p><small>Behaald op: <?= date('d-m-Y', strtotime($badge['date_earned'])) ?></small></p>
        <?php else: ?>
            <h2>Badge niet gevonden</h2>
            <p id="description">Deze badge bestaat niet of behoort niet tot jouw account.</p>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
