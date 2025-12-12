<?php
session_start();
include "dbconnection.php";

if (!isset($_SESSION['id']) || !isset($_SESSION['lp_id']) || !isset($_SESSION['uren'])) {
    die("Geen reserveringsinformatie ontvangen.");
}

$client_id = $_SESSION['id'];
$lp_id     = $_SESSION['lp_id'];

// Update betaald = 1 voor de bestaande reservering
try {
    $query = "UPDATE verhuur
              SET betaald = 1
              WHERE LP_id = :lp_id
                AND id = :client_id
                AND betaald = 0";  // update alleen de niet-betaalde reservering
    $stmt = $db_connection->prepare($query);
    $stmt->bindParam(':lp_id', $lp_id);
    $stmt->bindParam(':client_id', $client_id);
    $stmt->execute();

    // Sessie opruimen
    unset($_SESSION['lp_id'], $_SESSION['uren']);

    // Redirect direct naar overzichtspagina
    header('Location: laadpaalhuren.php');
    exit();

} catch (PDOException $e) {
    die("Database fout: " . $e->getMessage());
}
?>
