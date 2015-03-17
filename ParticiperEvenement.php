<?php	
	session_start();
	include('include/menu.php');
	if(!isset($_SESSION['idUser']))
	{
		echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}

	include('include/footer.php');
	
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$IdEvenement = $_GET['IdEvenement'];
	$IdUser = $_SESSION['idUser'];
	
	$queryAdd = "INSERT INTO participe VALUES ($IdUser, $IdEvenement)";
	mysql_query($queryAdd,$Connexion);
	
	$urlRedirection = "PageEvenement.php?Id=".$IdEvenement;
	header('Location:'.$urlRedirection);
	
?>