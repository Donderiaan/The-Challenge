<?php
include "dbconnection.php";

// CREATE
if (isset($_POST["klantcreate"])) {
// Haal de ingevoerde waardes uit het formulier
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
// Probeer de laadpaal toe te voegen aan de database
    try {
        $query = "INSERT INTO client (username, firstname, lastname, email)
                  VALUES (:username, :firstname, :lastname, :email)";
        $stmt = $db_connection->prepare($query);
// Voer de query uit met de ingevoerde waardes
        $stmt->execute([
            ':username' => $username,
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email
        ]);
// Bevestiging en terug naar de lijst pagina
        echo "Laadpaal toegevoegd!";
        header("Refresh:2; url=klantenlijst.php");
        exit;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// UPDATE

if (isset($_POST["klantenEdit"])) {
// Haal de ingevoerde waardes uit het formulier
    $id = $_POST["id"];
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
// Probeer de laadpaal bij te updaten in de database
    try {
        $query = "UPDATE client SET 
                    username = :username,
                    firstname = :firstname,
                    lastname = :lastname,
                    email = :email
                  WHERE id = :id";

        $stmt = $db_connection->prepare($query);
// Voer de query uit met de ingevoerde waardes
        $stmt->execute([
            ':id' => $id,
            ':username' => $username,
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email
        ]);
// Bevestiging en terug naar de lijst pagina
        echo "Laadpaal bijgewerkt!";
        header("Refresh:2; url=klantenlijst.php");
        exit;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// DELETE
if (isset($_POST["delete_klant"])) {
// Haal de LP_id op van de te laadpaal die je wilt verwijderen
    $id = $_POST["delete_klant"];
// Probeer de laadpaal te verwijderen uit de database
    try {
        $query = "DELETE FROM client WHERE id = :id";
        $stmt = $db_connection->prepare($query);

        $stmt->execute([':id' => $id]);
// Bevestiging en terug naar de lijst pagina
        echo "Laadpaal verwijderd!";
        header("Refresh:2; url=klantenlijst.php");
        exit;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
