<?php
include("select.php");

try {
    // PK aus POST sicher auslesen
    $pk = $_POST["pk"] ?? null;
    $Artname = $_POST["Artname"] ?? '';
    $Artpreis = $_POST["Artpreis"] ?? '';

    if (!$pk || empty($Artname) || empty($Artpreis)) {
        throw new Exception("Fehlende Daten. Bitte alles ausfüllen.");
    }

    // Update vorbereiten
    $sql = "UPDATE tblartikel SET 
            fldArtikelname = ?, 
            fldpreis = ? 
            WHERE pkArtikelID = ?";

    $statement = $conn->prepare($sql);
    $statement->execute([$Artname, $Artpreis, $pk]);

    $erfolg = true;

} catch (Exception $e) {
    $erfolg = false;
    $fehlermeldung = $e->getMessage();
} catch (PDOException $e) {
    $erfolg = false;
    $fehlermeldung = "Datenbankfehler: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Artikel aktualisiert</title>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: white;
}

.container {
    width: 420px;
    padding: 40px;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    box-shadow: 0 0 40px rgba(0,0,0,0.6);
    text-align: center;
}

h2 {
    font-family: 'Orbitron', sans-serif;
    margin-bottom: 20px;
    color: #00ff88;
}

p {
    margin: 10px 0;
    font-size: 15px;
}

.button {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 25px;
    border-radius: 40px;
    font-weight: 600;
    background: linear-gradient(45deg, #00ffe0, #0072ff);
    color: white;
    text-decoration: none;
    transition: 0.3s ease;
}

.button:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px #00ffe0;
}

.countdown {
    margin-top: 15px;
    font-size: 13px;
    opacity: 0.7;
}
</style>

<script>
let seconds = 2;
function countdown() {
    const el = document.getElementById("count");
    if (seconds > 0) {
        el.innerText = seconds;
        seconds--;
        setTimeout(countdown, 1000);
    } else {
        window.location.href = "index.php";
    }
}
window.onload = countdown;
</script>
</head>

<body>

<div class="container">
<h2>
<?php echo $erfolg ? "✔ Artikel erfolgreich aktualisiert" : "✖ Fehler"; ?>
</h2>

<p>
<?php 
if ($erfolg) {
    echo "Die Änderungen wurden gespeichert.";
} else {
    echo htmlspecialchars($fehlermeldung);
}
?>
</p>

<div class="countdown">
Weiterleitung in <span id="count">2</span> Sekunden...
</div>

<a href="index.php" class="button">Zurück zur Übersicht</a>
</div>

</body>
</html>
