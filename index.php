<?php
include("select.php");

$sql="SELECT 
    pkArtikelID,
    fldArtikelname, 
    fldPreis 
FROM
    stu141.tblArtikel 
ORDER BY fldPreis DESC";

$stmt = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>M141 Artikelübersicht</title>

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
    width: 90%;
    max-width: 1200px;
    margin: 50px auto;
    padding: 40px;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    box-shadow: 0 0 40px rgba(0,0,0,0.5);
}

h1 {
    font-family: 'Orbitron', sans-serif;
    text-align: center;
    font-size: 40px;
    margin-bottom: 10px;
    letter-spacing: 2px;
}

h2 {
    text-align: center;
    font-weight: 300;
    margin-bottom: 40px;
    color: #00ffe0;
}

.actions {
    text-align: center;
    margin-bottom: 30px;
}

.actions a {
    display: inline-block;
    margin: 10px;
    padding: 12px 25px;
    text-decoration: none;
    color: white;
    font-weight: 600;
    border-radius: 50px;
    background: linear-gradient(45deg, #00ffe0, #0072ff);
    transition: 0.3s ease;
}

.actions a:hover {
    transform: scale(1.1);
    box-shadow: 0 0 20px #00ffe0;
}

.actions a.kunden {
    background: linear-gradient(45deg, #ff00cc, #3333ff);
}

.actions a.kunden:hover {
    box-shadow: 0 0 20px #ff00cc;
}

table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 15px;
}

thead {
    background: rgba(0,255,224,0.2);
}

th {
    padding: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

td {
    padding: 15px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

tbody tr {
    transition: 0.3s ease;
}

tbody tr:hover {
    background: rgba(255,255,255,0.05);
    transform: scale(1.01);
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

.price {
    font-weight: 600;
    color: #00ff88;
}

.footer {
    text-align: center;
    margin-top: 30px;
    font-size: 14px;
    opacity: 0.6;
}

</style>
</head>

<body>

<div class="container">

<h1>InfP.24 Startformular</h1>
<h2>M141 Hardware Übersicht V2.0</h2>

<div class="actions">
    <a href="M141Erfassenpdo.php">+ Neuer Hardware Eintrag</a>
    <a href="M141Bestellungkomplettpdo.php">+ Neue Bestellung</a>
    <a href="http://localhost/prj3/modul141/kundensicht.php" class="kunden">👥 Kundenübersicht</a>
</div>

<table>
<thead>
<tr>
<th>PK</th>
<th>Produkt</th>
<th>Preis (CHF)</th>
<th>Aktion</th>
</tr>
</thead>

<tbody>

<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
        <td>" . htmlspecialchars($row['pkArtikelID']) . "</td>
        <td>" . htmlspecialchars($row['fldArtikelname']) . "</td>
        <td class='price'>CHF " . htmlspecialchars($row['fldPreis']) . "</td>
        <td>
            <a class='icon-btn edit' href='M141Editpdo.php?pk=" . urlencode($row['pkArtikelID']) . "'>✏</a>
            <a class='icon-btn delete' href='M141Deletepdo.php?pk=" . urlencode($row['pkArtikelID']) . "' onclick=\"return confirm('Wirklich löschen?')\">✖</a>
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
