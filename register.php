<!-- de rest van de code staat inprincipe gedefiniert in Begink.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
</head>
<body>
<header>

        
    </header>
    <h2>
        Register 
    </h2>
<!--div / division is een verdeling van onderdelen. in dit geval is dat het formulier -->
    <div class="logindiv">
    <form class="registreer" method="POST" action="register_process.php" >

    <label for="username">Username:</label><br>
        <input type="username" id="username" name="username" class="username" required><br>

        <label for="firstname">Firstname:</label><br>
        <input type="text" id="firstname" name="firstname" class="firstname" required><br>

        <label for="lastname">Lastname:</label><br>
        <input type="text" id="lastname" name="lastname" class="lastname" required><br>

        <label for="email">email:</label><br>
        <input type="email" id="email" name="email" class="email" required><br>

        <label for="Wachtwoord">Wachtwoord:</label><br>
        <input type="password" id="password" name="password" class="password" required><br>

        <div class="lbutton">
<!-- input type = wat voor soort input veld het moet worden
 class definier je het voor aanroepen in de css
 name is hoe het input veld heet en dus hoe je het aanroept
 value is de tekst die in het input veld staat-->
        <input type="submit" class="Lbutton" name="register" value="Registreer"/>
        </div>
    </form>
  
    

<div class="container">
<!-- Bootstrap (andere versie van css) division die ik heb laten staat doet in principe niks lmao-->
<div class="panel panel-primary">

</div>
</div>




</body>
</html>
