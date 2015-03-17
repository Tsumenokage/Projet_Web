<?php

	session_start();
	include('include/menu.php');
	
	$IdEvenement = $_GET["IdEvenement"];
	
	if(!isset($_SESSION['idUser']) || $_SESSION['idUser'] != 1)
	{
		echo ("<div id='error'>Vous devez être connecté, ou vous n'avez pas les droits pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}
	
	include('include/footer.php');

	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$queryDelete = "DELETE FROM participe WHERE IdEvenement = $IdEvenement";
	mysql_query($queryDelete,$Connexion);
	
	$queryDelete2 = "DELETE FROM evenements WHERE IdEvenement = $IdEvenement";
	mysql_query($queryDelete2,$Connexion);
	
	header('Location:gestionSite.php');
	

	
?>