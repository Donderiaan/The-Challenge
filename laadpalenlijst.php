<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laadpalen Lijst</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Table.css">

</head>
<?php include 'beginb.php'; ?>
<div class="container mt-5 fade-in">

    <!-- Zoekformulier -->
    <form method="GET" class="form-inline mb-3 justify-content-center">
        <input type="text" name="search" class="form-control mr-2 mb-2" placeholder="Zoek op naam" 
               value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit" class="btn btn-primary mb-2">Zoek</button>
    </form>

    <!-- Toevoegen knop -->
    <div class="text-right mb-3">
        <a href="laadpaalcreate.php" class="btn btn-success">Laadpaal Toevoegen</a>
    </div>

    <!-- Laadpalen tabel -->
    <div class="table-responsive">
        <table class="table table-striped table-hover shadow-sm">
            <thead class="">
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Status</th>
                    <th>Postcode</th>
                    <th>Afstand</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
<?php
include "dbconnection.php";


try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = "%" . $_GET['search'] . "%";
        $query = "SELECT * FROM laadpaal WHERE LP_name LIKE :search";
        $stmt = $db_connection->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    } else {
        $query = "SELECT * FROM laadpaal";
        $stmt = $db_connection->prepare($query);
    }

    $stmt->execute();
    $palen = $stmt->fetchAll();

    foreach ($palen as $paal) {
?>
                <tr>
                    <td><?= $paal["LP_id"] ?></td>
                    <td><?= $paal["LP_name"] ?></td>
                    <td><?= $paal["Status"] ?></td>
                    <td><?= $paal["Postcode"] ?></td>
                    <td><?= $paal["Afstand"] ?> km</td>
                    <td>
                        <a href="laadpaalEdit.php?id=<?= $paal['LP_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <form action="Laadpaal_CRUD.php" method="POST" style="display:inline;">
                            <input type="hidden" name="delete_laadpaal" value="<?= $paal['LP_id'] ?>">
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
<?php
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='6' class='text-danger'>".$e->getMessage()."</td></tr>";
}
?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>