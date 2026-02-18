<?php
include("select.php");

try {

    $Artname  = $_POST["Artname"] ?? '';
    $Artpreis = $_POST["Artpreis"] ?? '';

    $statement = $conn->prepare("
        INSERT INTO tblartikel
        (fldArtikelname, fldpreis) 
        VALUES (?, ?)
    ");

    $statement->execute([$Artname, $Artpreis]);

    $neue_pk = $conn->lastInsertId();

} catch (PDOException $e) {
    die("Fehler: " . $e->getMessage());
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Artikel gespeichert</title>

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

.success-container {
    width: 420px;
    padding: 40px;
    text-align: center;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    box-shadow: 0 0 40px rgba(0,0,0,0.6);
}

h2 {
    font-family: 'Orbitron', sans-serif;
    margin-bottom: 20px;
    letter-spacing: 2px;
    color: #00ff88;
}

p {
    margin: 10px 0;
    font-size: 15px;
}

.pk {
    font-weight: 600;
    color: #00ffe0;
}

.button {
    display: inline-block;
    margin-top: 25px;
    padding: 12px 25px;
    text-decoration: none;
    border-radius: 40px;
    font-weight: 600;
    background: linear-gradient(45deg, #00ffe0, #0072ff);
    color: white;
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
let seconds = 3;
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

<div class="success-container">

<h2>✔ Artikel erfolgreich gespeichert</h2>

<p>Ihr Eintrag wurde hinzugefügt.</p>

<p>Neuer Artikel mit PK 
<span class="pk"><?php echo htmlspecialchars($neue_pk); ?></span> 
angelegt.</p>

<a href="index.php" class="button">Zurück zur Übersicht</a>

<div class="countdown">
Weiterleitung in <span id="count">3</span> Sekunden...
</div>

</div>

</body>
</html>
