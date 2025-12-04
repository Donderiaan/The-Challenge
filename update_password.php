<?php
require 'dbconnection.php';

// Haal gegevens uit POST via het formulier
$email = $_POST['email'];
$token = $_POST['token'];
$newPassword = $_POST['password'];

// Haal token op en controleer geldigheid
$stmt = $db_connection->prepare("
    SELECT * FROM password_resets
    WHERE email = ? AND expires_at > NOW()
    ORDER BY id DESC LIMIT 1
");
$stmt->execute([$email]);
$reset = $stmt->fetch();

// Token controle
if (!$reset || !password_verify($token, $reset['token'])) {
    die("Ongeldige of verlopen reset link.");
}

// Nieuw wachtwoord hashen
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Update wachtwoord in de client tabel
$stmt = $db_connection->prepare("UPDATE client SET password = ? WHERE email = ?");
$stmt->execute([$hashedPassword, $email]);

// Token verwijderen
$stmt = $db_connection->prepare("DELETE FROM password_resets WHERE email = ?");
$stmt->execute([$email]);

//redirect naar inlog pagina
header("Location: index2.php");
exit();
?>
