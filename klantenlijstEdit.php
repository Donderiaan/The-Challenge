<?php
include("dbconnection.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Haal de laadpaal gegevens op basis van de LP_ID
    $query = "SELECT * FROM client WHERE id = :id";
    $stmt = $db_connection->prepare($query);
    $stmt->execute([':id' => $id]);

    $klant = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit klant</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Laadpaal Bewerken</h2>
       <!-- Formulier om de laadpaal gegevens te bewerken op basis van welk veld binnen het database variable er word geselecteerd -->
            <form action="klanten_CRUD.php" method="POST">
                <input type="hidden" name="id" value="<?= $klant['id'] ?>">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $klant['username'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" name="firstname" class="form-control" value="<?= $klant['firstname'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Lastname</label>
                    <input type="text" name="lastname" class="form-control" value="<?= $klant['lastname'] ?>" required>
                </div>

                <div class="form-group">
                    <label>email</label>
                    <input type="text" name="email" step="0.1" class="form-control" value="<?= $klant['email'] ?>" required>
                </div>

                <button type="submit" name="klantenEdit" class="btn btn-primary">
                    Update
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
