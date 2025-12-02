<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laadpalen Overzicht</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<!-- database en navigatie bar binnen deze pagina aanroepen zodat je niet per file alles dat je wilt hoeft te kopieren in iedere file -->
<?php include "dbconnection.php"; ?>
<?php include 'beginb.php'; ?>

<div class="container mt-5">
<!-- knop om naar de laadpaal create pagina te gaan -->
    <a href="laadpaalcreate.php" class="btn btn-success mb-3">Laadpaal Toevoegen</a>

    <table class="table">
        <thead>
            <tr>
<!-- alle header waardes van de table waar de ingevoerde waardes in komen -->
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
// Haal alle laadpalen op uit de database (dit werkt alleen als er al iets in de database staat)
try {
    $query = "SELECT * FROM laadpaal";
    $stmt = $db_connection->prepare($query);
    $stmt->execute();
    $palen = $stmt->fetchAll();

    foreach ($palen as $paal) {
?>
<!--haalt de waardes uit de database en toont ze in een Tabledown/td -->
        <tr>
            <td><?= $paal["LP_id"] ?></td>
            <td><?= $paal["LP_name"] ?></td>
            <td><?= $paal["Status"] ?></td>
            <td><?= $paal["Postcode"] ?></td>
            <td><?= $paal["Afstand"] ?> km</td>

            <td>
                <!-- een action in de table waar je per Id een laadpaal kan bewerken -->
                <a href="laadpaalEdit.php?id=<?= $paal['LP_id'] ?>" class="btn btn-primary">Edit</a>
                <!-- een form in de table waar je per Id een laadpaal kan verwijderen -->
                <form action="Laadpaal_CRUD.php" method="POST" style="display:inline;">
                    <input type="hidden" name="delete_laadpaal" value="<?= $paal['LP_id'] ?>">
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
<?php
    }
    // vangt fouten op bij het ophalen van de laadpalen
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

        </tbody>
    </table>

</div>

</body>
</html>
