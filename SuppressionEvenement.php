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


	$IdEvenement = $_POST['IdEvenement'];
	
	$Connexion = mysql_connect($Server,$LoginBD,$MDP);
	mysql_select_db($MaBase);

	$queryDelete = "DELETE FROM participe WHERE IdEvenement = $IdEvenement";
	mysql_query($queryDelete,$Connexion);
	
	$queryDelete2 = "DELETE FROM evenements WHERE IdEvenement = $IdEvenement";
	mysql_query($queryDelete2,$Connexion);
	

	
	header("location:Evenement.php");