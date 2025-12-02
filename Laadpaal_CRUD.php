<?php
include "dbconnection.php";

// CREATE
if (isset($_POST["laadpaalcreate"])) {
// Haal de ingevoerde waardes uit het formulier
    $LP_name = $_POST["LP_name"];
    $Status = $_POST["Status"];
    $Postcode = $_POST["Postcode"];
    $Afstand = $_POST["Afstand"];
// Probeer de laadpaal toe te voegen aan de database
    try {
        $query = "INSERT INTO laadpaal (LP_name, Status, Postcode, Afstand)
                  VALUES (:LP_name, :Status, :Postcode, :Afstand)";
        $stmt = $db_connection->prepare($query);
// Voer de query uit met de ingevoerde waardes
        $stmt->execute([
            ':LP_name' => $LP_name,
            ':Status' => $Status,
            ':Postcode' => $Postcode,
            ':Afstand' => $Afstand
        ]);
// Bevestiging en terug naar de lijst pagina
        echo "Laadpaal toegevoegd!";
        header("Refresh:2; url=laadpalenlijst.php");
        exit;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// UPDATE

if (isset($_POST["LaadpaalEdit"])) {
// Haal de ingevoerde waardes uit het formulier
    $LP_ID = $_POST["LP_ID"];
    $LP_name = $_POST["LP_name"];
    $Status = $_POST["Status"];
    $Postcode = $_POST["Postcode"];
    $Afstand = $_POST["Afstand"];
// Probeer de laadpaal bij te updaten in de database
    try {
        $query = "UPDATE laadpaal SET 
                    LP_name = :LP_name,
                    Status = :Status,
                    Postcode = :Postcode,
                    Afstand = :Afstand
                  WHERE LP_ID = :LP_ID";

        $stmt = $db_connection->prepare($query);
// Voer de query uit met de ingevoerde waardes
        $stmt->execute([
            ':LP_ID' => $LP_ID,
            ':LP_name' => $LP_name,
            ':Status' => $Status,
            ':Postcode' => $Postcode,
            ':Afstand' => $Afstand
        ]);
// Bevestiging en terug naar de lijst pagina
        echo "Laadpaal bijgewerkt!";
        header("Refresh:2; url=laadpalenlijst.php");
        exit;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// DELETE
if (isset($_POST["delete_laadpaal"])) {
// Haal de LP_id op van de te laadpaal die je wilt verwijderen
    $LP_ID = $_POST["delete_laadpaal"];
// Probeer de laadpaal te verwijderen uit de database
    try {
        $query = "DELETE FROM laadpaal WHERE LP_id = :LP_id";
        $stmt = $db_connection->prepare($query);

        $stmt->execute([':LP_id' => $LP_ID]);
// Bevestiging en terug naar de lijst pagina
        echo "Laadpaal verwijderd!";
        header("Refresh:2; url=laadpalenlijst.php");
        exit;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
