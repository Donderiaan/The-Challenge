<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laadpaal Toevoegen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<!-- database en navigatie bar binnen deze pagina aanroepen zodat je niet per file alles dat je wilt hoeft te kopieren in iedere file -->
<?php include "dbconnection.php"; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Laadpaal Toevoegen</h2>
            <form action="Laadpaal_CRUD.php" method="POST">

                <div class="form-group">
                    <label for="LP_name">Laadpaal Naam</label>
                    <input type="text" name="LP_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input type="text" name="Status" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Postcode</label>
                    <input type="text" name="Postcode" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Afstand (km)</label>
                    <input type="number" step="0.1" name="Afstand" class="form-control" required>
                </div>

                <button type="submit" name="laadpaalcreate" class="btn btn-primary">Opslaan</button>

            </form>
        </div>
    </div>
</div>

</body>
</html>
