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
            <h2>Klant Toevoegen</h2>
            <form action="klanten_CRUD.php" method="POST">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Voornaam</label>
                    <input type="text" name="firstname" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Achternaam</label>
                    <input type="text" name="lastname" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" step="0.1" name="email" class="form-control" required>
                </div>

                <button type="submit" name="klantcreate" class="btn btn-primary">Opslaan</button>

            </form>
        </div>
    </div>
</div>

</body>
</html>
