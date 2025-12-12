<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laadpalen Lijst</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Table.css">
    <link rel="stylesheet" href="Nav.css">

</head>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="beginb.php">L Trappo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active " aria-current="page" href="klantenlijst.php">KlantenLijst</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="laadpalenlijst.php">LaadpalenLijst</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="logout.php">logout</a>
        </li>
        </ul>
        
    </div>
  </div>
</nav>
<div class="container mt-5 fade-in">

    <!-- Zoekformulier -->
    <form method="GET" class="form-inline mb-3 justify-content-center">
        <input type="text" name="search" class="form-control mr-2 mb-2" placeholder="Zoek op Username" 
               value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit" class="btn btn-primary mb-2">Zoek</button>
    </form>

    <!-- Toevoegen knop -->
    <div class="text-right mb-3">
        <a href="klantencreate.php" class="btn btn-success">Klant Toevoegen</a>
    </div>

    <!-- Laadpalen tabel -->
    <div class="table-responsive">
        <table class="table table-striped table-hover shadow-sm">
            <thead class="">
                <tr>
                    <th>Username</th>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Email</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
<?php
include "dbconnection.php";


try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = "%" . $_GET['search'] . "%";
        $query = "SELECT * FROM client WHERE username LIKE :search";
        $stmt = $db_connection->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    } else {
        $query = "SELECT * FROM client";
        $stmt = $db_connection->prepare($query);
    }

    $stmt->execute();
    $palen = $stmt->fetchAll();

    foreach ($palen as $paal) {
?>
                <tr>
                    <td><?= $paal["username"] ?></td>
                    <td><?= $paal["firstname"] ?></td>
                    <td><?= $paal["lastname"] ?></td>
                    <td><?= $paal["email"] ?></td>
                    <td>
                        <a href="klantenlijstEdit.php?id=<?= $paal['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <form action="Klanten_CRUD.php" method="POST" style="display:inline;">
                            <input type="hidden" name="delete_klant" value="<?= $paal['id'] ?>">
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