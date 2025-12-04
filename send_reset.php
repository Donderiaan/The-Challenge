<?php
require 'dbconnection.php';
require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/PHPMailer-master/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'] ?? '';

// Check of e-mail is ingevuld
if (!$email) {
    die("Vul een geldig e-mailadres in.");
}

// Check of gebruiker bestaat
$stmt = $db_connection->prepare("SELECT * FROM client WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {

    // Token genereren van 32 bytes
    $token = bin2hex(random_bytes(32));
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);

    // Token opslaan in database (15 min geldig)
    $stmt = $db_connection->prepare("
        INSERT INTO password_resets (email, token, expires_at)
        VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 15 MINUTE))
    ");
    $stmt->execute([$email, $hashedToken]);

    // Reset link
    $resetLink = "http://localhost/The-Challenge/reset_password.php?email=$email&token=$token";

    
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'doneikmans@gmail.com'; 
        $mail->Password   = 'sjsw jijs cmhl pikc';    // App-wachtwoord Gmail(alleen beheerder van het gmail account kan dit zien)
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('doneikmans@gmail.com', 'Wachtwoord Reset');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Reset je wachtwoord';
        $mail->Body    = "
            Klik op de link hieronder om je wachtwoord te resetten:<br><br>
            <a href='$resetLink'>$resetLink</a>
            <br><br>Deze link is 15 minuten geldig.
        ";

        $mail->send();
    } catch (Exception $e) {
        // Als e-mail niet verzonden kan worden, log de fout
        error_log("PHPMailer Error: " . $mail->ErrorInfo);
    }
}

// melding voor veiligheid
echo "Als dit e-mailadres bestaat, is een reset link verstuurd.";
?>

