<?php
// haal de gekozen email en token uit de URL
$email = $_GET['email'] ?? '';
$token = $_GET['token'] ?? '';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuw wachtwoord instellen – Ltrappo</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Jouw CSS -->
    <link rel="stylesheet" href="styleindex.css">
</head>

<body>

<div class="container mt-5 fade-in">

    <div class="login-card shadow-lg">

        <h2 class="text-center mb-3">Nieuw Wachtwoord</h2>
        <p class="text-center text-muted mb-4">Voer je nieuwe wachtwoord in</p>

        <form action="update_password.php" method="POST">

            <!-- email + token -->
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <!-- Nieuw wachtwoord -->
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-key"></i>
                    </span>
                </div>
                <input type="password" 
                       class="form-control custom-input" 
                       name="password" 
                       placeholder="Nieuw wachtwoord" 
                       required>

                <div class="input-group-append">
                    <span class="input-group-text password-toggle" id="togglePwd">
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
            </div>

            <button class="btn btn-primary btn-block login-btn" type="submit">
                Wachtwoord wijzigen
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
