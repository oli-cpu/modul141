<?php
include("select.php");

try {

$sql="SELECT 
    fldKundenCode,
    fldKundenFirma,
    fldKundenKontakt,
    fldPosition,
    fldKundeStrasse,
    fldKundeOrt,
    fldKundeRegion,
    fldKundePLZ,
    fldKundeLand,
    fldKundeTelefon
FROM
    stu141.tblKunden 
ORDER BY fldKundenCode DESC";

$stmt = $conn->query($sql);

} catch (PDOException $e) {
    die("Datenbankfehler: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>M141 Kundenübersicht</title>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<style>

body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    color: white;
    min-height: 100vh;
}

.container {
    width: 95%;
    max-width: 1400px;
    margin: 40px auto;
    padding: 40px;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    box-shadow: 0 0 40px rgba(0,0,0,0.5);
}

h1 {
    font-family: 'Orbitron', sans-serif;
    text-align: center;
    font-size: 36px;
    margin-bottom: 10px;
    letter-spacing: 2px;
}

h2 {
    text-align: center;
    font-weight: 300;
    margin-bottom: 30px;
    color: #00ffe0;
}

.actions {
    text-align: center;
    margin-bottom: 25px;
}

.actions a {
    display: inline-block;
    margin: 8px;
    padding: 10px 22px;
    text-decoration: none;
    color: white;
    font-weight: 600;
    border-radius: 40px;
    background: linear-gradient(45deg, #00ffe0, #0072ff);
    transition: 0.3s ease;
}

.actions a:hover {
    transform: scale(1.08);
    box-shadow: 0 0 20px #00ffe0;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 15px;
    overflow: hidden;
    font-size: 14px;
}

thead {
    background: rgba(0,255,224,0.2);
}

th {
    padding: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

td {
    padding: 12px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

tbody tr {
    transition: 0.3s ease;
}

tbody tr:hover {
    background: rgba(255,255,255,0.05);
}

.icon-btn {
    text-decoration: none;
    font-size: 18px;
    margin-right: 10px;
    transition: 0.3s;
}

.icon-btn.edit {
    color: #00ffe0;
}

.icon-btn.delete {
    color: #ff4d4d;
}

.icon-btn:hover {
    transform: scale(1.3);
}

.footer {
    text-align: center;
    margin-top: 25px;
    font-size: 13px;
    opacity: 0.6;
}

</style>
</head>

<body>

<div class="container">

<h1>InfP.24 Startformular</h1>
<h2>M141 Kundenübersicht V2.0</h2>

<div class="actions">
    <a href="M141Erfassenpdo.php">+ Neuer Kunde</a>
    <a href="index.php">← Zurück</a>
</div>

<table>
<thead>
<tr>
<th>Code</th>
<th>Firma</th>
<th>Kontakt</th>
<th>Position</th>
<th>Strasse</th>
<th>Ort</th>
<th>Region</th>
<th>PLZ</th>
<th>Land</th>
<th>Telefon</th>
<th>Aktion</th>
</tr>
</thead>

<tbody>

<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
        <td>" . htmlspecialchars($row['fldKundenCode']) . "</td>
        <td>" . htmlspecialchars($row['fldKundenFirma']) . "</td>
        <td>" . htmlspecialchars($row['fldKundenKontakt']) . "</td>
        <td>" . htmlspecialchars($row['fldPosition']) . "</td>
        <td>" . htmlspecialchars($row['fldKundeStrasse']) . "</td>
        <td>" . htmlspecialchars($row['fldKundeOrt']) . "</td>
        <td>" . htmlspecialchars($row['fldKundeRegion']) . "</td>
        <td>" . htmlspecialchars($row['fldKundePLZ']) . "</td>
        <td>" . htmlspecialchars($row['fldKundeLand']) . "</td>
        <td>" . htmlspecialchars($row['fldKundeTelefon']) . "</td>
        <td>
            <a class='icon-btn edit' href='M141Editpdo.php?pk=" . urlencode($row['fldKundenCode']) . "'>✏</a>
            <a class='icon-btn delete' href='M141Deletepdo.php?pk=" . urlencode($row['fldKundenCode']) . "' onclick=\"return confirm('Wirklich löschen?')\">✖</a>
        </td>
    </tr>";
}

$conn = null;
?>

</tbody>
</table>

<div class="footer">
© <?php echo date("Y"); ?> Imperium Novum Romanum – König Oliver Edition
</div>

</div>

</body>
</html>
