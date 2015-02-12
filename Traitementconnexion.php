<?php


$loginUser = $_POST['pseudo'];
$passUser = $_POST['pass'];

echo($loginUser);
echo($passUser);

$Server = "localhost";
$login="root";
$MDP="";
$MaBase="projet_web"

$Connexion = mysql_connect($Server,$login,$MDP);






mysql_close($Connexion);

?>