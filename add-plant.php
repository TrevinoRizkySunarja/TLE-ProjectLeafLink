<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

/* --- connectie.php inladen --- */
$possibleConnectPaths = [
    __DIR__ . '/connectie.php',
    __DIR__ . '/includes/connectie.php',
    __DIR__ . '/Includes/connectie.php',
    dirname(__DIR__) . '/connectie.php',
    dirname(__DIR__) . '/includes/connectie.php',
    dirname(__DIR__) . '/Includes/connectie.php',
];
$loaded = false;
foreach ($possibleConnectPaths as $p) {
    if (is_file($p)) { require_once $p; $loaded = true; break; }
}
if (!$loaded) { http_response_code(500); echo "Kan connectie.php niet vinden."; exit; }

/* Ondersteun $db of $conn uit connectie.php */
$mysqli = null;
if (isset($db) && $db instanceof mysqli)      $mysqli = $db;
elseif (isset($conn) && $conn instanceof mysqli) $mysqli = $conn;
if (!$mysqli) { http_response_code(500); echo "DB connectie niet beschikbaar."; exit; }

$TABLE = 'plants';

/* Helper: lijst van verplichte kolommen zonder default (excl. auto_increment) */
function required_columns_without_default(mysqli $m, string $table): array {
    $sql = "SELECT COLUMN_NAME, DATA_TYPE, EXTRA
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = ?
              AND IS_NULLABLE = 'NO'
              AND COLUMN_DEFAULT IS NULL";
    $stmt = $m->prepare($sql);
    $stmt->bind_param("s", $table);
    $stmt->execute();
    $res = $stmt->get_result();
    $out = [];
    while ($row = $res->fetch_assoc()) {
        // sla auto_increment kolommen over (bv. id)
        if (stripos($row['EXTRA'] ?? '', 'auto_increment') !== false) continue;
        $out[] = ['name' => $row['COLUMN_NAME'], 'type' => strtolower((string)$row['DATA_TYPE'])];
    }
    $stmt->close();
    return $out;
}

/* Form handling */
$messageHtml = '';
$redirectHtml = '';
$popupJs = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $info = trim($_POST['info'] ?? '');
    $soort = trim($_POST['soort'] ?? '');
    $watering = trim($_POST['watering'] ?? '');
    $sunlight = trim($_POST['sunlight'] ?? '');

    if ($name === '' || $info === '') {
        $messageHtml = "<div class='message error'>⚠️ Vul zowel een naam als een beschrijving in.</div>";
        $popupJs = "<script>alert('Vul zowel een naam als een beschrijving in.');</script>";
    } else {
        // Basis: alleen name + info vanuit formulier
        $cols = ['name', 'info', 'species', 'water_frequency', 'sunlight'];
        $placeholders = ['?', '?', '?', '?', '?'];
        $types = 'sssss';
        $values = [$name, $info, $soort, $watering, $sunlight];

        // Haal verplichte kolommen zonder default op en vul veilige standaardwaarden in
        $required = required_columns_without_default($mysqli, $TABLE);
        $already = array_flip($cols); // om duplicaten te voorkomen

        foreach ($required as $col) {
            $cname = $col['name'];
            if (isset($already[$cname])) continue; // sla over als we 'm al zetten

            $dtype = $col['type'];
            // Bepaal veilige default op basis van type
            switch ($dtype) {
                case 'int': case 'bigint': case 'smallint': case 'tinyint':
                case 'decimal': case 'float': case 'double':
                case 'real': case 'numeric':
                $def = 0;  $types .= 'd'; break;

                case 'date':
                    $def = date('Y-m-d'); $types .= 's'; break;

                case 'datetime': case 'timestamp':
                $def = date('Y-m-d H:i:s'); $types .= 's'; break;

                default: // varchar, char, text, json, etc.
                    $def = ''; $types .= 's';
            }
            $cols[] = $cname;
            $placeholders[] = '?';
            $values[] = $def;
            $already[$cname] = true;
        }

        // Bouw en voer INSERT uit
        $sql = "INSERT INTO `$TABLE` (`" . implode("`,`", $cols) . "`) VALUES (" . implode(",", $placeholders) . ")";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param($types, ...$values);
            if ($stmt->execute()) {
                $messageHtml = "<div class='message success'>🌱 Plant succesvol toegevoegd aan LeafLink!</div>";
                $redirectHtml = "
                  <div class='redirect-wrap'>
                    <div class='msg'>Je wordt binnen <span id='sec'>5</span> seconden teruggestuurd…</div>
                    <div class='bar'><div id='barFill'></div></div>
                  </div>";
                $popupJs = "
                  <script>
                  (function(){
                    alert('Success: plant toegevoegd!');
                    var total=5000,start=Date.now();
                    function tick(){
                      var left=Math.max(0,total-(Date.now()-start));
                      var pct=100*(1-left/total);
                      var bar=document.getElementById('barFill');
                      var sec=document.getElementById('sec');
                      if(bar) bar.style.width=pct+'%';
                      if(sec) sec.textContent=Math.ceil(left/1000);
                      if(left<=0){ window.location.href='index.php'; return; }
                      requestAnimationFrame(tick);
                    }
                    tick();
                  })();
                  </script>";
            } else {
                $messageHtml = "<div class='message error'>❌ Fout bij toevoegen: " . htmlspecialchars($stmt->error) . "</div>";
                $popupJs = "<script>alert('Fout bij toevoegen: ".addslashes($stmt->error)."');</script>";
            }
            $stmt->close();
        } else {
            $messageHtml = "<div class='message error'>❌ Query voorbereiden mislukt: " . htmlspecialchars($mysqli->error) . "</div>";
            $popupJs = "<script>alert('Query voorbereiden mislukt.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <title>LeafLink - Plant toevoegen</title>
    <link rel="stylesheet" href="Includes/CSS/add-plant.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="Includes/JS/add-plant.js" defer></script>
    <style>
        .redirect-wrap { margin:1rem 0; }
        .redirect-wrap .msg { text-align:center; font-weight:bold; margin-bottom:.5rem; }
        .redirect-wrap .bar { height:8px; background:#eee; border-radius:6px; overflow:hidden; }
        #barFill { height:100%; width:0; background:var(--color1,#7da44d); transition: width .05s linear; }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Nieuwe plant toevoegen</h1>
    <?php
    if ($messageHtml) echo $messageHtml;
    if ($redirectHtml) echo $redirectHtml;
    if ($popupJs) echo $popupJs;
    ?>
    <form method="POST" action="add-plant.php" novalidate>
        <label for="name">Naam van de plant:</label>
        <input type="text" id="name" name="name" required>

        <label for="soort">Soort Plant:</label>
        <select id="soort" name="soort" required>
            <option value="">Selecteer Soort</option>
            <option value="cactus1">Bloeiende Cactus</option>
            <option value="cactus2">Cactus</option>
            <option value="fatpant">Vetplant</option>
            <option value="floweredplant">Bloemen</option>
        </select>

        <label for="watering">Water behoeften:</label>
        <select id="watering" name="watering" required>
            <option value="">Selecteer water behoeften</option>
            <option value="frequent">Frequent</option>
            <option value="average">Gemiddeld</option>
            <option value="minimum">Minimaal</option>
            <option value="none">Geen</option>
        </select>

        <label for="sunlight">Lichtbehoeften:</label>
        <select id="sunlight" name="sunlight" required>
            <option value="">Selecteer lichtbehoeften</option>
            <option value="full_sun">Vol zonlicht</option>
            <option value="part_shade">Halfschaduw</option>
            <option value="full_shade">Volledige schaduw</option>
            <option value="part_sun">Deels zonlicht</option>
        </select>

        <label for="info">Beschrijving:</label>
        <textarea id="info" name="info" rows="4" required></textarea>

        <button type="submit">Toevoegen</button>
    </form>
    <div style="text-align:center;margin-top:1rem;">
        <a href="index.php">← Terug naar overzicht</a>
    </div>
</div>
</body>
</html>
