<?php
include("dbconnection.php");

if(isset($_GET['id'])){
    $LP_ID = $_GET['id'];
    // Haal de laadpaal gegevens op basis van de LP_ID
    $query = "SELECT * FROM laadpaal WHERE LP_id = :LP_id";
    $stmt = $db_connection->prepare($query);
    $stmt->execute([':LP_id' => $LP_ID]);

    $paal = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laadpaal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Laadpaal Bewerken</h2>
       <!-- Formulier om de laadpaal gegevens te bewerken op basis van welk veld binnen het database variable er word geselecteerd -->
            <form action="Laadpaal_CRUD.php" method="POST">
                <input type="hidden" name="LP_ID" value="<?= $paal['LP_id'] ?>">

                <div class="form-group">
                    <label>Naam</label>
                    <input type="text" name="LP_name" class="form-control" value="<?= $paal['LP_name'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input type="text" name="Status" class="form-control" value="<?= $paal['Status'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Postcode</label>
                    <input type="text" name="Postcode" class="form-control" value="<?= $paal['Postcode'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Afstand (km)</label>
                    <input type="number" name="Afstand" step="0.1" class="form-control" value="<?= $paal['Afstand'] ?>" required>
                </div>

                <button type="submit" name="LaadpaalEdit" class="btn btn-primary">
                    Update
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
