<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groene Login</title>

   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<style>
/* url word gebruikt/geimporteerd naar de file en in dit geval */
@import url('https://fonts.googleapis.com/css?family=Abel|Playfair+Display');

/* Global word aangeroepen met een "*" en dat is voor heel de pagina en word dus niet met classes of Id's bepaalt*/
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

/* de achtergrond van de website*/
body {
    background-image: linear-gradient(to top, #c8ffe0 0%, #a0f2c5 100%);
    background-attachment: fixed;
    background-repeat: no-repeat;
    font-family: 'Abel', sans-serif;
    opacity: .97;
}

/* bepaald hoe het formulier er uit gaat zien dus de breedte en die minimale hoogte*/
form {
    width: 450px;
    min-height: 500px;
    border-radius: 5px;
    margin: 3% auto;
    box-shadow: 0 9px 50px rgba(0, 128, 0, 0.20);
    padding: 2%;
    background-image: linear-gradient(-225deg, #caffdf 50%, #caffdf 50%);
}

/* de header dus H1, h2, h3 etc worden gecentered in het midden*/
header {
    margin: 2% auto 10% auto;
    text-align: center;
}
/* bepaald in dit geval hoe groot de h2 tekst moet wezen, welke font en welke kleur*/
header h2 {
    font-size: 250%;
    font-family: 'Playfair Display', serif;
    color: #225533;
}
/* header p / paragraaf is voor alle paragraven in de file en bepaalt in dit geval hoeveel pixels/em er tussen de letters staat en welke kleur de tekst word */
header p {
    letter-spacing: 0.05em;
    color: #2f704d;
}

/* dit is voor items die gebruikt worden binnen de input velden dus in dit geval het sleutel icoontje*/
.input-item {
    background: #fff;
    color: #333;
    padding: 14.5px 0px 15px 9px;
    border-radius: 5px 0 0 5px;
}

/* hier gebruik ik een # om dat ik nu een ID definier en dit is voor het maken van het oog naast het wachtwoord input veld
ik gebruik hier een ID omdat het voor een specifiek iets is en kan het dus niet voor een andere input opnieuw aanroepen wat bij een classe wel kan*/
#eye {
    background: #caffdf;
    color: #333;
    margin-left: -20px;
    padding: 15px 9px 19px 0px;
    border-radius: 0 5px 5px 0;
    float: right;
    position: relative;
    right: 1%;
    top: -.2%;
    cursor: pointer;
}

/* dit is voor alle input velden dus in dit geval het Email en het Wachtwoord input veld */
input.form-input {
    width: 240px;
    height: 50px;
    padding: 15px;
    font-size: 16px;
    border: none;
    border-radius: 0 5px 5px 0;
    margin-top: 2%;
    color: #5E6472;
    transition: 0.2s linear;
    background: #f0fff8;
}

/* Dit werkt het zelfde als een Hover(staat beneden gedefinierd) en dit is ook voor het input veld en als je in dit geval op het input veld klikt/gebruikt
dan zoomt hij in op het input veld en vergroot hij de letters*/
input:focus {
    transform: translateX(-2px);
    border-radius: 5px;
}

/* dit is de css van de button te bepalen de grootte van de knoppen, de achtergrondkleur en de radius van de knoppen*/
button {
    width: 280px;
    height: 50px;
    background: #fff;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    letter-spacing: 0.05em;
    transition: 0.2s linear;
    margin: 7% auto;
    display: block;
}

/* dit is ook voor de knoppen alleen deze keer hoef je hem niet te selecteren maar hoef je er alleen met je muis op te staan/hoveren */
button:hover {
    transform: translateY(3px);
}

/* dit is voor alle submit knoppen */
.submits {
    width: 48%;
    float: left;
    margin-left: 2%;
}

/* dit is voor de forgot password knop deze heeft een transpirante background zodat hij inprincipe de zelfde kleur heeft als het formulier */
.frgt-pass {
    background: transparent;
    color: #2a714d;
}

/* dit is voor de signup knop. deze heb ik een iets lichtere achtergrond gegeven omdat je hem anders niet in het formulier ziet */
.sign-up {
    background: #b6ffda;
    color: #225533;
}


</style>
<body>
    

<div class="overlay">
<!-- een formulier met een Methode Post is om backend te linken aan je formulier en als je op de submit knop klikt dan word je action geactiveerd
 en dus door verwezen naar je login.php -->
<form method="POST" action="login.php">

   <div class="con">

      <header class="head-form">
         <h2>Log In</h2>
         <p>login hier met je email en wachtwoord</p>
      </header>

      <div class="field-set">

         <span class="input-item">
            <i class="fa fa-user"></i>
         </span>

         <input class="form-input" 
                type="email" 
                name="email" 
                placeholder="Email" 
                required>

         <br>

         <span class="input-item">
            <i class="fa fa-key"></i>
         </span>

         <input class="form-input" 
                type="password" 
                id="pwd" 
                name="password" 
                placeholder="Wachtwoord" 
                required>

         <span>
            <i class="fa fa-eye" id="eye"></i>
         </span>

         <br>

         <button class="log-in" name="login">Log In</button>

      </div>

      <div class="other">

         <a href="forgot.php">
            <button type="button" class="btn submits frgt-pass">
               Wachtwoord Vergeten
            </button>
         </a>

         <a href="register.php">
            <button type="button" class="btn submits sign-up">
               Sign Up <i class="fa fa-user-plus"></i>
            </button>
         </a>

      </div>

   </div>

</form>
</div>

<script src="script.js"></script>
</body>
</html>
