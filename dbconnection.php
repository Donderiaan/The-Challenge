<?php

$server = "localhost"; // server waar het op word gehost
$username = "root"; // gebruikersnaam om in te loggen op deze database
$password = ""; // ingestelde wachtwoord voor de database (geen ww)
$db = "ltrappo"; // gelinkte database in PhpMyAdmin

try {
    $db_connection = new PDO("mysql:host=$server; dbname=$db", $username, $password);
    $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // error catch als de database niet goed word geconnect 
} catch(PDOException $e){
    echo "verbinding mislukt" . $e->getMessage();

}

?>
