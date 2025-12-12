<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Gehuurde Laadpalen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Table.css">
</head>
<body>

<?php 
session_start();

// Check of gebruiker is ingelogd
if (!isset($_SESSION['id'])) {
    die("Je bent niet ingelogd. <a href='index.php'>Ga naar login</a>");
}

include 'begink.php';
include "dbconnection.php";

$client_id = $_SESSION['id'];
$huidigeTime = date("Y-m-d H:i:s");

// Toon success of error berichten
if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
    echo $_SESSION['success_message'];
    echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    echo "</div>";
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
    echo $_SESSION['error_message'];
    echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    echo "</div>";
    unset($_SESSION['error_message']);
}
?>

<div class="container mt-5 fade-in">
    <h2>Mijn Gehuurde Laadpalen</h2>
    <hr>

<?php
try {
    // Haal alle actieve verhuren op voor deze gebruiker
    $query = "SELECT v.verhuur_id, v.LP_id, v.starttijd, v.eindtijd, 
                     l.LP_name, l.Postcode, l.Afstand, l.Status
              FROM verhuur v
              INNER JOIN laadpaal l ON v.LP_id = l.LP_id
              WHERE v.id = :client_id AND v.eindtijd > :huidigeTime
              ORDER BY v.eindtijd ASC";
    
    $stmt = $db_connection->prepare($query);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->bindParam(':huidigeTime', $huidigeTime, PDO::PARAM_STR);
    $stmt->execute();
    
    $verhuren = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Check of er verhuren zijn
    if (count($verhuren) == 0) {
        echo "<div class='alert alert-info'>";
        echo "<h4>Je hebt nog geen laadpaal gehuurd</h4>";
        echo "<p>Ga naar de <a href='laadpaalhuren.php' class='alert-link'>laadpalen lijst</a> om een laadpaal te huren.</p>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-success'>";
        echo "Je hebt momenteel " . count($verhuren) . " laadpaal(en) gehuurd.";
        echo "</div>";
        
        // Toon tabel met gehuurde laadpalen
        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped table-hover shadow-sm'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Laadpaal ID</th>";
        echo "<th>Naam</th>";
        echo "<th>Postcode</th>";
        echo "<th>Afstand</th>";
        echo "<th>Gehuurd vanaf</th>";
        echo "<th>Gehuurd tot</th>";
        echo "<th>Resterende tijd</th>";
        echo "<th>Actie</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        foreach ($verhuren as $verhuur) {
            // Bereken resterende tijd
            $eindtijd = strtotime($verhuur['eindtijd']);
            $nu = time();
            $verschil = $eindtijd - $nu;
            
            $dagen = floor($verschil / 86400);
            $uren = floor(($verschil % 86400) / 3600);
            $minuten = floor(($verschil % 3600) / 60);
            
            $resterendeTijd = "";
            if ($dagen > 0) {
                $resterendeTijd .= "$dagen dag(en) ";
            }
            $resterendeTijd .= "$uren uur, $minuten min";
            
            echo "<tr>";
            echo "<td>" . $verhuur['LP_id'] . "</td>";
            echo "<td>" . $verhuur['LP_name'] . "</td>";
            echo "<td>" . $verhuur['Postcode'] . "</td>";
            echo "<td>" . $verhuur['Afstand'] . " km</td>";
            echo "<td>" . date("d-m-Y H:i", strtotime($verhuur['starttijd'])) . "</td>";
            echo "<td>" . date("d-m-Y H:i", strtotime($verhuur['eindtijd'])) . "</td>";
            echo "<td><strong class='text-primary'>" . $resterendeTijd . "</strong></td>";
            echo "<td>";
            echo "<form method='POST' action='verhuur_opzeggen.php' style='display:inline;' onsubmit='return confirm(\"Weet je zeker dat je deze verhuur wilt opzeggen?\");'>";
            echo "<input type='hidden' name='verhuur_id' value='" . $verhuur['verhuur_id'] . "'>";
            echo "<button type='submit' class='btn btn-sm btn-danger'>Opzeggen</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }
    
    // Ook verlopen verhuren tonen (optioneel)
    $queryVerlopen = "SELECT v.*, l.LP_name, l.Postcode, l.Afstand
                      FROM verhuur v
                      INNER JOIN laadpaal l ON v.LP_id = l.LP_id
                      WHERE v.id = :client_id AND v.eindtijd <= :huidigeTime
                      ORDER BY v.eindtijd DESC
                      LIMIT 5";
    
    $stmtVerlopen = $db_connection->prepare($queryVerlopen);
    $stmtVerlopen->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmtVerlopen->bindParam(':huidigeTime', $huidigeTime, PDO::PARAM_STR);
    $stmtVerlopen->execute();
    
    $verlopenVerhuren = $stmtVerlopen->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($verlopenVerhuren) > 0) {
        echo "<h3 class='mt-5'>Huurgeschiedenis</h3>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-sm table-bordered'>";
        echo "<thead class='thead-light'>";
        echo "<tr>";
        echo "<th>Laadpaal</th>";
        echo "<th>Van</th>";
        echo "<th>Tot</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        foreach ($verlopenVerhuren as $verlopen) {
            echo "<tr>";
            echo "<td>" . $verlopen['LP_name'] . "</td>";
            echo "<td>" . date("d-m-Y H:i", strtotime($verlopen['starttijd'])) . "</td>";
            echo "<td>" . date("d-m-Y H:i", strtotime($verlopen['eindtijd'])) . "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }
    
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Database fout: " . $e->getMessage() . "</div>";
}
?>

    <div class="mt-4">
        <a href="laadpaalhuren.php" class="btn btn-primary">Terug naar laadpalen lijst</a>
    </div>

</div>

</body>
</html>