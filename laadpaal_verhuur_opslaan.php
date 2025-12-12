<?php
session_start();
if (!isset($_SESSION['id'])) {
    die("Je bent niet ingelogd. Geen client_id gevonden.");
}

include "dbconnection.php";

$lp_id = $_POST['LP_id'];
$uren  = $_POST['huur_tot'];
$client_id = $_SESSION['id'];

$starttijd = date("Y-m-d H:i:s");
$eindtijd  = date("Y-m-d H:i:s", strtotime("+$uren hours"));

try {
    // Check of deze gebruiker al een actieve verhuur heeft
    $huidigeTime = date("Y-m-d H:i:s");
    $checkQuery = "SELECT COUNT(*) as aantal 
                   FROM verhuur 
                   WHERE id = :client_id 
                   AND eindtijd > :huidigeTime";
    
    $checkStmt = $db_connection->prepare($checkQuery);
    $checkStmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $checkStmt->bindParam(':huidigeTime', $huidigeTime, PDO::PARAM_STR);
    $checkStmt->execute();
    
    $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['aantal'] > 0) {
        $_SESSION['error_message'] = "Je hebt al een laadpaal gehuurd. Je kunt maar één laadpaal tegelijk huren. Zeg eerst je huidige verhuur op.";
        header('Location: laadpaalhuren.php');
        exit();
    }
    

$query = "INSERT INTO verhuur (LP_id, id, starttijd, eindtijd, betaald)
          VALUES (:lp_id, :id, :starttijd, :eindtijd, 0)";

    $stmt = $db_connection->prepare($query);
    $stmt->bindParam(':lp_id', $lp_id);
    $stmt->bindParam(':id', $client_id);
    $stmt->bindParam(':starttijd', $starttijd);
    $stmt->bindParam(':eindtijd', $eindtijd);
    $stmt->execute();

    // Sla info op in session zodat betaalpagina weet welke laadpaal en uren
    $_SESSION['lp_id'] = $lp_id;
    $_SESSION['uren']  = $uren;

    $_SESSION['success_message'] = "Laadpaal succesvol gereserveerd en betaald! Veel plezier met laden.";
    header('Location: betaalmethode.php');
    exit();
    
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Fout bij opslaan: " . $e->getMessage();
    header('Location: laadpaalhuren.php');
    exit();
}
?>
