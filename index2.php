<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Ltrappo</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Jouw professionele stylesheet -->
    <link rel="stylesheet" href="styleindex.css">
</head>

<body>

<div class="container mt-5 fade-in">

    <!-- Login Card -->
    <div class="login-card shadow-lg">

        <h2 class="text-center mb-3">Inloggen Ltrappo</h2>
        <p class="text-center text-muted mb-4">Log in met je e-mail en wachtwoord</p>

        <form method="POST" action="login.php">

            <!-- Email -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="email" 
                       class="form-control custom-input" 
                       name="email" 
                       placeholder="E-mail" 
                       required>
            </div>

            <!-- Password -->
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                </div>
                <input type="password" 
                       class="form-control custom-input" 
                       id="pwd" 
                       name="password" 
                       placeholder="Wachtwoord" 
                       required>

                <div class="input-group-append">
                    <span class="input-group-text password-toggle" id="togglePwd">
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
            </div>

            <button class="btn btn-primary btn-block login-btn" name="login">Inloggen</button>

            <div class="text-center mt-4">
                <a href="pwreset.php" class="d-block">Wachtwoord vergeten?</a>
                <a href="register.php" class="d-block mt-2">Nog geen account? Registreer</a>
            </div>

        </form>

    </div>

</div>

<script src="scriptindex.js"></script>

</body>
</html>
