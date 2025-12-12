<?php
if(isset($_POST['login'])){
    session_start();
    require 'dbconnection.php';
                  
    try {
        $sQuery = "SELECT * FROM client WHERE email = :email";
                        
        $oStmt = $db_connection->prepare($sQuery);
        $oStmt->bindValue(':email', $_POST['email']);
        $oStmt->execute();
                        
        if($oStmt->rowCount() == 1) {
            $rij = $oStmt->fetch(PDO::FETCH_ASSOC);
            
            if(password_verify($_POST['password'], $rij['password'])) {
                $_SESSION['email'] = $rij['email'];
                $_SESSION['password'] = $rij['password'];
                $_SESSION['id'] = $rij['id']; 
                                         
                if($rij['isadmin'] == "1") {
                    header('Refresh: 1; url=beginb.php');
                    include "nav.html";
                    echo "<div class=\"panel-heading\">Beheer login is succesvol.</div>";
                    exit();
                } else {
                    header('Refresh: 1; url=begink.php');
                    include "nav.html";
                    echo "<div class=\"panel-heading\">Klant login is succesvol.</div>";
                    die();
                }
            } else {
                echo "<div class=\"panel-heading\">Helaas, login niet succesvol.</div>
                    <div class=\"panel-body\">Deze combinatie van de email en wachtwoord is niet juist!</div>";
                header('Refresh: 3; url=index.php');
                exit();
            }
        } else {
            echo "<div class=\"panel-heading\">Helaas, login niet succesvol.</div>
                <div class=\"panel-body\">Deze combinatie van de email en wachtwoord is niet juist!</div>";
            header('Refresh: 3; url=index.php');
            exit();
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
} else {
    echo "Login button niet herkend <br>";
    header('location:index.php');
    exit();
}
?>