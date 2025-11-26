<!--deze file hangt samen met Register.php (Dit is het backend gedeelte) -->
<?php

session_start();
//database connectie word gemaakt met de dbconnection file
require 'dbconnection.php';
// als de submitknop/ registreren knop word ingedrukt dan word het volgende uitgevoerd
if(isset($_POST['register'])){
    // de ingevulde gegevens worden variablen van gemaakt
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hier word het wachtwoord gehashed
  
  //  query/ code om de ingevulde gegevens van het formulier toe te voegen aan de database kolom "Client"
    $sql = "INSERT INTO client (username, firstname, lastname, email, password ) VALUES(:username, :firstname, :lastname, :email, :password)";
    $run =   $db_connection->prepare($sql);
  //dit is een array met de ingevulde gegevens van het formulier
    $client = [
        ':username' => $username,
        ':firstname' => $firstname,
        ':lastname' => $lastname,
        ':email' => $email,
        ':password' => $password
    ];
    //query /sql code word uitgevoerd en kijkt of het gelukt is of niet en of de gegevens zijn toegevoegd aan de database
    $result = $run->execute($client);
// alles is gelukt en gegevens zijn toegevoegd aan de database kolom "Client"
    if($result){
        echo "U heeft een account aangemaakt!";
        header("Refresh:3; url=login.php");
        exit(0);
        // als het niet is gelukt dan krijg je een melding dat het niet is gelukt en word je terug gestuurd naar de register.php
    } else{
        echo "Het is niet gelukt!";
        header("Refresh:3; url=register.php");
        exit(1);
    }

}
?>
