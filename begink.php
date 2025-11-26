<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css file/ bootstrap link linken aan je html file-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<!-- Navigatie bar bovenaan je scherm-->
 <!-- class word gebruikt om iets specifieks aan te roepen in je css file-->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <!-- a = anchor is in het begin van je navigatie bar(linker kant) en word gebruikt om een Link toe te voegen aan zo'n knop-->
    <a class="navbar-brand" href="begink.php">L'Trappo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Ul = underordered list en dat zijn de knoppen na de hyperlink / Anchor om te navigeren tussen pagina's-->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- li = een listitem en zijn de items binnen een UL hier kan je een anchor aan toevoegen zodat je een link krijgt-->
        <li class="nav-item">
          <!-- href hord bij een anchor/ a tagg en die bepaalt naar welke pagina je genavigeerd word-->
          <a class="nav-link active" aria-current="page" href="nummers.php">Laadpaalhuren</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="genre.php">Uitleg</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="logout.php">logout</a>
          </li>
        </ul>

    </div>
  </div>
</nav>
<!-- h1 = een header en word gebruikt om tekst op een pagina te tonen-->
<h1>Welkom op de klanten pagina!</h1>
<!-- script wordt gebruikt om een javascript file of een script te linken aan je bestand-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
