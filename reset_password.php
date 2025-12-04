<?php

// haal de gekozen email en token uit de zoekbalk/URL
$email = $_GET['email'] ?? '';
$token = $_GET['token'] ?? '';
?>

<form action="update_password.php" method="POST">
    <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <label>Nieuw wachtwoord:</label><br>
    <input type="password" name="password" required>

    <button type="submit">Wachtwoord wijzigen</button>
</form>
