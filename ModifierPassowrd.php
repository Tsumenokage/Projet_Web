<?php

session_start();
include('include/menu.php');

if(!isset($_SESSION['idUser']))
{
	echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
	header("Refresh: 5;URL=Connexion.php");	
	include('include/footer.php');
	die();
}

$Connexion = mysql_connect($Server,$LoginBD,$MDP);
mysql_select_db($MaBase);

$idUser = $_SESSION['idUser'];
$PassVerif = $_POST['passActuel'];
$newPass = $_POST['nouveauPass'];
$newPassVerif = $_POST['nouveauPassVerif'];

$queryVerif = "SELECT * FROM utilisateurs WHERE idUtilisateur = $idUser";
$ResVerif = mysql_query($queryVerif,$Connexion);
$ResVerif = mysql_fetch_array($ResVerif);
if(md5($PassVerif) == $ResVerif["Password"])
{
	if($newPass != $newPassVerif)
	{
		header('Location:PagePerso.php?User='.$_SESSION['login'].'&Error=2');
	}
	else
	{
		$newPassword = md5($PassVerif);
		$queryUpdatePass = "UPDATE utilisateurs SET Password = $newPassword";
		header('Location:PagePerso.php?User='.$_SESSION['login'].'&OK=1');
	}
}
else
{
	header('Location:PagePerso.php?User='.$_SESSION['login'].'&Error=1');
}

?>