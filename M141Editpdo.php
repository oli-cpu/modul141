<?php
include("select.php");

// Primary-Key aus GET
$pk = $_GET['pk'] ?? null;

if (!$pk) {
    die("Kein gültiger Datensatz angegeben.");
}

try {
    // Datensatz abrufen
    $sql = "SELECT * FROM tblartikel WHERE pkArtikelID = ?";
    $statement = $conn->prepare($sql);
    $statement->execute([$pk]);
    $zeile = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$zeile) {
        die("Datensatz nicht gefunden.");
    }

    // Fallbacks für leere oder fehlende Felder
    $artikelname = $zeile['fldArtikelname'] ?? '';
    $preis       = $zeile['fldPreis'] ?? $zeile['fldpreis'] ?? '';

} catch (PDOException $e) {
    die("Fehler: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Artikel bearbeiten</title>

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

.form-container {
    width: 420px;
    padding: 40px;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    box-shadow: 0 0 40px rgba(0,0,0,0.6);
}

h2 {
    text-align: center;
    font-family: 'Orbitron', sans-serif;
    margin-bottom: 30px;
    letter-spacing: 2px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
}

input[type="text"] {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.1);
    color: white;
    font-size: 14px;
    transition: 0.3s;
}

input[type="text"]:focus {
    background: rgba(255,255,255,0.2);
    box-shadow: 0 0 10px #00ffe0;
}

button {
    width: 100%;
    padding: 12px;
    border-radius: 40px;
    border: none;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    background: linear-gradient(45deg, #00ffe0, #0072ff);
    color: white;
    transition: 0.3s ease;
}

button:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px #00ffe0;
}

.back-link {
    display: block;
    text-align: center;
    margin-top: 15px;
    text-decoration: none;
    color: #00ffe0;
    font-size: 14px;
}

.back-link:hover {
    text-decoration: underline;
}
</style>
</head>

<body>

<div class="form-container">

<h2>Artikel bearbeiten</h2>

<form method="post" action="M141EditGopdo.php">

    <div class="form-group">
        <label>Produktname</label>
        <input name="Artname" type="text" 
        value="<?php echo htmlspecialchars($artikelname); ?>" required>
    </div>

    <div class="form-group">
        <label>Preis (CHF)</label>
        <input name="Artpreis" type="text" 
        value="<?php echo htmlspecialchars($preis); ?>" required>
    </div>

    <input type="hidden" name="pk" 
    value="<?php echo htmlspecialchars($pk); ?>">

    <button type="submit">Änderungen speichern</button>

</form>

<a href="index.php" class="back-link">← Zurück zur Übersicht</a>

</div>

</body>
</html>

<?php
$conn = null;
?>
