<?php
session_start();
include('include/menu.php');
if(isset($_SESSION['idUser']))
{
	echo ("<div id='error'>Vous êtes déjà connecté, redirection vers la page d'Acceuil en cours...");
	header("Refresh: 5;URL=Connexion.php");		
	include('include/footer.php');

	die();
}

$loginUser = $_POST['pseudo'];
$passUser = $_POST['pass'];

$passUser = md5($passUser);


$Connexion = mysql_connect($Server,$LoginBD,$MDP);
mysql_select_db($MaBase);

$Requete = "SELECT * FROM utilisateurs WHERE Login = '$loginUser' AND Password = '$passUser'";
$Res = mysql_query($Requete,$Connexion) or die('Erreur SQL !<br />'.$Requete.'<br />'.mysql_error());


if(mysql_num_rows($Res) != 0)
{
	$array = mysql_fetch_array($Res);
	$_SESSION['login'] = $array['Login'];
	$_SESSION['mail'] = $array['mail'];
	$_SESSION['idUser'] = $array['IdUtilisateur'];
	header('Location:index.php');
}
else
{
	header("Location:Connexion.php?WrongPass=1");
}




mysql_close($Connexion);

?>