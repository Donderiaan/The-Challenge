<?php
session_start();

// DEBUG - voeg dit toe bovenaan laadpaalhurenTS.php
/*echo "<pre>DEBUG INFO:\n";
echo "Session ID aanwezig? " . (isset($_SESSION['id']) ? 'JA' : 'NEE') . "\n";
if (isset($_SESSION['id'])) {
    echo "Session ID waarde: " . $_SESSION['id'] . "\n";
}
echo "Alle session data:\n";
var_dump($_SESSION);
echo "</pre>";
*/
include "dbconnection.php";


// Check of ID is meegegeven:
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Geen laadpaal geselecteerd.");
}

$lp_id = $_GET['id'];

// Haal data op van de geselecteerde laadpaal
try {
    $query = "SELECT * FROM laadpaal WHERE LP_id = :id";
    $stmt = $db_connection->prepare($query);
    $stmt->bindParam(':id', $lp_id, PDO::PARAM_INT);
    $stmt->execute();
    $paal = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$paal) {
        die("Laadpaal niet gevonden.");
    }

} catch (PDOException $e) {
    die("Database fout: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Laadpaal Huren</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2>Laadpaal huren: <?= htmlspecialchars($paal['LP_name']) ?></h2>
    <hr>

    <table class="table table-bordered w-50">
        <tr><th>ID</th><td><?= $paal['LP_id'] ?></td></tr>
        <tr><th>Naam</th><td><?= $paal['LP_name'] ?></td></tr>
        <tr><th>Status</th><td><?= $paal['Status'] ?></td></tr>
        <tr><th>Postcode</th><td><?= $paal['Postcode'] ?></td></tr>
        <tr><th>Afstand</th><td><?= $paal['Afstand'] ?> km</td></tr>
    </table>

    <form action="laadpaal_verhuur_opslaan.php" method="POST">
    <input type="hidden" name="LP_id" value="<?= $paal['LP_id'] ?>">
    <input type="number" name="huur_tot" required>
    <button type="submit" class="btn btn-success">Huren bevestigen</button>
</form>


</body>
</html>
