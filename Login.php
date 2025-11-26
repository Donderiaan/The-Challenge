<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

// session word gestart en de email en wachtwoord worden in variabelen opgeslagen (deze worden alleen gebruikt tijdens een Sessie)
   if(isset($_POST['login'])){ 
       
      $id = session_create_id();    
      session_id($id);
      session_start();  
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['password']  = $_POST['password'];    
      session_commit();
   }
?>

    <?php

if(isset($_POST['login'])){
    // session word gestart en de database word geconnect aan de dbconnection file
    session_start();
    require 'dbconnection.php';

        
            try
            {
                // Juiste email word geselecteerd in de database
                $sQuery = "SELECT * FROM client WHERE email = :email";
               
                $oStmt =   $db_connection->prepare($sQuery);
                $oStmt->bindValue (':email',$_POST['email']);
                $oStmt->execute();
               
                if($oStmt->rowCount()==1)
                {
                    $rij= $oStmt->fetch(PDO:: FETCH_ASSOC);
                    if(password_verify($_POST['password'],$rij['password']))
                    {
                        $_SESSION['email']=$rij['email'];
                        $_SESSION['password']=$rij['password'];
                        
                        // als de kolom isadmin in de database een waarde heeft van 1 dan word je naar de beheerder pagina genavigeerd.
                        if($rij['isadmin']=="1") 
                        {
                        
                        /* include nav.html is niet nodig maar als je voor meerdere pagina's de zelfde layout wilt hoef je niet in iedere file 
                        al je html en css code te plakken
                        */
                            header ('Refresh: 1; url=beginb.php');
                             include "nav.html";
                            echo "<div class=\"panel-heading\">Beheer login is succsesvol.</div>";
                            exit();
                        }
                        else 
                        {
                        // als de kolom isadmin in de database een waarde heeft van 0 dan word je naar de Klanten pagina genavigeerd.
                            header('Refresh: 1; url=begink.php');
                            include "nav.html";
                            echo "<div class=\"panel-heading\">Klant login is succsesvol.</div>";
                            die();
                        }
                    }
                    else
                    {
                        echo "<div class=\"panel-heading\">Helaas, login niet succsesvol.</div>
                            <div class=\"panel-body\">Deze combinatie van de email en wachtwoord is niet juist!</div>";
                        header('Refresh: 3; url=index.php');
                        exit();
                    }
                }
                /* op het moment dat het wachtwoord of email niet overeen komt met dat gene dat in de database staat dan krijg je een
                fout melding en word je terug naar de index pagina terug verwezen
                */
                else {
                    echo "<div class=\"panel-heading\">Helaas, login niet succsesvol.</div>
                    <div class=\"panel-body\">Deze combinatie van de email en wachtwoord is niet juist!</div>";
                    header('Refresh: 3; url=index.php');
                    exit();
                }
            }
            catch(PDOExeption $e) {
                echo $e -> getMessage();
            }
            

        }
        // er voor zorgen dat als de login knop niet herkend word dan word je ook terug gestuurd naar de index pagina 
        else{
            echo "Login button niet herkend <br>";
            header('location:index.php');
            exit();
        }   
            ?>
</body>
</html>            
