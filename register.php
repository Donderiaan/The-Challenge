<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren – Ltrappo</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Jouw globale, moderne stylesheet -->
    <link rel="stylesheet" href="styleindex.css">
</head>

<body>

<div class="container mt-5 fade-in">

    <div class="login-card shadow-lg">

        <h2 class="text-center mb-3">Registreren</h2>
        <p class="text-center text-muted mb-4">Maak een nieuw account aan</p>

        <form method="POST" action="register_process.php">

            <!-- Username -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" 
                       class="form-control custom-input" 
                       id="username" 
                       name="username" 
                       placeholder="Gebruikersnaam" 
                       required>
            </div>

            <!-- Firstname -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                </div>
                <input type="text" 
                       class="form-control custom-input" 
                       id="firstname" 
                       name="firstname" 
                       placeholder="Voornaam" 
                       required>
            </div>

            <!-- Lastname -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                </div>
                <input type="text" 
                       class="form-control custom-input" 
                       id="lastname" 
                       name="lastname" 
                       placeholder="Achternaam" 
                       required>
            </div>

            <!-- Email -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="email" 
                       class="form-control custom-input" 
                       id="email" 
                       name="email" 
                       placeholder="E-mail" 
                       required>
            </div>

            <!-- Wachtwoord -->
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                </div>
                <input type="password" 
                       class="form-control custom-input" 
                       id="password" 
                       name="password" 
                       placeholder="Wachtwoord" 
                       required>

                <div class="input-group-append">
                    <span class="input-group-text password-toggle register-toggle">
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
            </div>

            <button class="btn btn-primary btn-block login-btn" name="register">Account aanmaken</button>

            <div class="text-center mt-4">
                <a href="index2.php">Al een account? Inloggen</a>
            </div>

        </form>

    </div>

</div>
<script src="scriptindex.js"></script>
</body>
</html>
