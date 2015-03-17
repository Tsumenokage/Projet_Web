<?php 
session_start();
include('include/menu.php');

	
$Connexion = mysql_connect($Server,$login,$MDP);
mysql_select_db($MaBase);

$login = $_GET['User'];

$query = "SELECT * FROM utilisateurs WHERE Login = '$login'";
$res = mysql_query($query,$Connexion);

if(mysql_num_rows($res) == 0)
{

	echo("<h2>Cet utilisateur n'existe pas</h2>");
}
else
{
	$res = mysql_fetch_array($res);
	$mailGrav = md5($res['mail']);
	echo('<img id="imageprofil" src="http://www.gravatar.com/avatar/'.$mailGrav.'?s=50" alt="Image de profil"/>');
	echo("<p>Nom :".$res['nom']."</p>");
	echo("<p>Prénom :".$res['prenom']."</p>");
	echo("<p>Mail :".$res['mail']."</p>");
	echo("</br>");
}
include('include/footer.php');
?>

