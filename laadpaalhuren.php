<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laadpalen Lijst</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Table.css">
</head>
<?php 
session_start(); 
include 'begink.php';

// Toon success bericht als die er is
if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
    echo $_SESSION['success_message'];
    echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    echo "</div>";
    unset($_SESSION['success_message']); // Verwijder bericht na tonen
}

// Toon error bericht als die er is
if (isset($_SESSION['error_message'])) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
    echo $_SESSION['error_message'];
    echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    echo "</div>";
    unset($_SESSION['error_message']); // Verwijder bericht na tonen
}
?>

<div class="container mt-5 fade-in">
    
    <!-- Zoek en filter formulier -->
    <form method="GET" class="form-inline mb-3 justify-content-center">
        <input type="text" name="search" class="form-control mr-2 mb-2" placeholder="Zoek op naam"
                value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        
        <select name="status" class="form-control mr-2 mb-2">
            <option value="">Alle statussen</option>
            <option value="beschikbaar" <?= (isset($_GET['status']) && $_GET['status'] == 'beschikbaar') ? 'selected' : '' ?>>
                Beschikbaar
            </option>
            <option value="verhuurd" <?= (isset($_GET['status']) && $_GET['status'] == 'verhuurd') ? 'selected' : '' ?>>
                Verhuurd
            </option>
        </select>
        
        <button type="submit" class="btn btn-primary mb-2">Zoek</button>
        
        <?php if (isset($_GET['search']) || isset($_GET['status'])): ?>
            <a href="laadpaalhuren.php" class="btn btn-secondary mb-2 ml-2">Reset filters</a>
        <?php endif; ?>
    </form>
              
    <!-- Laadpalen tabel -->
    <div class="table-responsive">
        <table class="table table-striped table-hover shadow-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Status</th>
                    <th>Postcode</th>
                    <th>Afstand</th>
                    <th>Verhuurd tot</th>
                    <th>Verhuurd door</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
<?php 
include "dbconnection.php";
  
try {
    // Query om laadpaal + verhuur informatie op te halen
    $huidigeTime = date("Y-m-d H:i:s");
    
   
    $query = "SELECT l.*, v.eindtijd, v.id as huurder_id 
              FROM laadpaal l
              LEFT JOIN verhuur v ON l.LP_id = v.LP_id 
                  AND v.eindtijd > :huidigeTime";
    
    $whereClauses = [];
    $params = [':huidigeTime' => $huidigeTime];
    
    // Voeg zoek filter toe
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $whereClauses[] = "l.LP_name LIKE :search";
        $params[':search'] = "%" . $_GET['search'] . "%";
    }
    
    // Voeg WHERE clauses toe aan query
    if (count($whereClauses) > 0) {
        $query .= " WHERE " . implode(" AND ", $whereClauses);
    }
    
    $query .= " ORDER BY l.LP_id";
    
    $stmt = $db_connection->prepare($query);
    
    // Bind alle parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    $palen = $stmt->fetchAll();
    
    // Filter op status (na database query, omdat dit afhangt van berekening)
    $statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
    
    foreach ($palen as $paal) { 
        // Bereken resterende tijd
        $verhuurInfo = "-";
        $huurderInfo = "-";
        $beschikbaar = true;
        
        if ($paal['eindtijd'] && strtotime($paal['eindtijd']) > time()) {
            $beschikbaar = false;
            $eindtijd = strtotime($paal['eindtijd']);
            $nu = time();
            $verschil = $eindtijd - $nu;
            
            $uren = floor($verschil / 3600);
            $minuten = floor(($verschil % 3600) / 60);
            
            $verhuurInfo = date("d-m-Y H:i", $eindtijd);
            $verhuurInfo .= "<br><small class='text-muted'>($uren uur, $minuten min)</small>";
            $huurderInfo = "ID: " . $paal['huurder_id'];
        }
        
        // Skip deze rij als status filter niet matcht
        if ($statusFilter == 'beschikbaar' && !$beschikbaar) {
            continue;
        }
        if ($statusFilter == 'verhuurd' && $beschikbaar) {
            continue;
        }
?>
                <tr class="<?= !$beschikbaar ? 'table-warning' : '' ?>">
                    <td><?= $paal["LP_id"] ?></td>
                    <td><?= $paal["LP_name"] ?></td>
                    <td>
                        <?php if ($beschikbaar): ?>
                            <span class="badge badge-success">Beschikbaar</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Verhuurd</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $paal["Postcode"] ?></td>
                    <td><?= $paal["Afstand"] ?> km</td>
                    <td><?= $verhuurInfo ?></td>
                    <td><?= $huurderInfo ?></td>
                    <td>
                        <?php if ($beschikbaar): ?>
                            <a href="LaadpaalhurenTS.php?id=<?= $paal['LP_id'] ?>" 
                               class="btn btn-sm btn-primary">Selecteer</a>
                        <?php else: ?>
                            <button class="btn btn-sm btn-secondary" disabled>Niet beschikbaar</button>
                        <?php endif; ?>
                    </td>
                </tr>
<?php 
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='8' class='text-danger'>".$e->getMessage()."</td></tr>";
} 
?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>