<?php
session_start();

// Check of gebruiker is ingelogd
if (!isset($_SESSION['id'])) {
    die("Je bent niet ingelogd. <a href='index.php'>Ga naar login</a>");
}

include "dbconnection.php";

// Check of verhuur_id is meegegeven
if (!isset($_POST['verhuur_id']) || empty($_POST['verhuur_id'])) {
    $_SESSION['error_message'] = "Geen verhuur ID opgegeven.";
    header('Location: gehuurdelaadpalen.php');
    exit();
}

$verhuur_id = $_POST['verhuur_id'];
$client_id = $_SESSION['id'];

try {
    // Check of deze verhuur wel van deze gebruiker is (veiligheidscheck)
    $checkQuery = "SELECT * FROM verhuur WHERE verhuur_id = :verhuur_id AND id = :client_id";
    $checkStmt = $db_connection->prepare($checkQuery);
    $checkStmt->bindParam(':verhuur_id', $verhuur_id, PDO::PARAM_INT);
    $checkStmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $checkStmt->execute();
    
    if ($checkStmt->rowCount() == 0) {
        $_SESSION['error_message'] = "Deze verhuur bestaat niet of is niet van jou.";
        header('Location: gehuurdelaadpalen.php');
        exit();
    }
    
    // Verwijder de verhuur uit de database
    $deleteQuery = "DELETE FROM verhuur WHERE verhuur_id = :verhuur_id AND id = :client_id";
    $deleteStmt = $db_connection->prepare($deleteQuery);
    $deleteStmt->bindParam(':verhuur_id', $verhuur_id, PDO::PARAM_INT);
    $deleteStmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $deleteStmt->execute();
    
    $_SESSION['success_message'] = "Verhuur succesvol opgezegd!";
    header('Location: gehuurdelaadpaal.php');
    exit();
    
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Fout bij opzeggen: " . $e->getMessage();
    header('Location: gehuurdelaadpaal.php');
    exit();
}
?>