<?php 
	session_start();
	include('include/menu.php');
	
	$IdEvenement = $_GET["IdEvenement"];
	
	if(!isset($_SESSION['idUser']) || $_SESSION['idUser'] != 1)
	{
		echo ("<div id='error'>Vous devez être connecté, ou vous n'avez pas les droits pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		include('include/footer.php');
		die();
	}
	
	
	$Connexion = mysql_connect($Server,$LoginBD,$MDP);
	mysql_select_db($MaBase);
	
	$query = "UPDATE evenements SET EtatEvenement = 1 WHERE IdEvenement = $IdEvenement" or die();
	mysql_query($query, $Connexion);
	
	header('Location:gestionSite.php');
	
	
?>