<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord Reset – Ltrappo</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Jouw Style.css -->
    <link rel="stylesheet" href="styleindex.css">
</head>

<body>

<div class="container mt-5 fade-in">

    <div class="login-card shadow-lg">

        <h2 class="text-center mb-3">Wachtwoord Reset</h2>
        <p class="text-center text-muted mb-4">Voer je e-mail in om een resetlink te ontvangen</p>

        <form action="send_reset.php" method="POST">

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="email" 
                       class="form-control custom-input" 
                       name="email" 
                       placeholder="E-mail" 
                       required>
            </div>

            <button class="btn btn-primary btn-block login-btn" type="submit">
                Verstuur resetlink
            </button>

            <div class="text-center mt-4">
                <a href="index2.php">Terug naar Inloggen</a>
            </div>

        </form>

    </div>

</div>

<script src="scriptindex.js"></script>
</body>
</html>
