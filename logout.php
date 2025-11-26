<?php
//sessie word gestart zodat het systeem weet welke gebruiker is ingelogd en alles ddat word opgeslagen ook daadwerkelijk word bij gehouden
session_start();
// sessie word afgebroken 
session_destroy();
echo "U bent succesvol uitgelogt!";
header("Refresh:1; url=index.php");
?>

