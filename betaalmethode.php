<?php

session_start();
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/

if (isset($_SESSION['lp_id']) && isset($_SESSION['uren'])) {
    $lp_id = $_SESSION['lp_id'];
    $uren  = $_SESSION['uren'];
} else {
    die("Ongeldige aanvraag. Geen laadpaal of aantal uren gevonden.");
}


$bedrag = $uren * 2.50;
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Kies betaalmethode</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2>Betaalmethode kiezen</h2>
<p>Je gaat de laadpaal huren voor <strong><?= htmlspecialchars($uren) ?></strong> uur.</p>
<p>Te betalen bedrag: <strong>€<?= number_format($bedrag, 2) ?></strong></p>

<hr>

<h4>Betaal met PayPal</h4>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="doneikmans@gmail.com">
    <input type="hidden" name="item_name" value="Laadpaal huren voor <?= $uren ?> uur">
    <input type="hidden" name="amount" value="<?= number_format($bedrag, 2, '.', '') ?>">
    <input type="hidden" name="currency_code" value="EUR">

    <!-- Terugsturen naar jouw website -->
    <input type="hidden" name="return" value="http://localhost/The-Challenge/paypal_success.php">
    <input type="hidden" name="cancel_return" value="http://localhost/The-Challenge/paypal_cancel.php">

    <button class="btn btn-primary">Betaal met PayPal</button>
</form>

</body>
</html>
