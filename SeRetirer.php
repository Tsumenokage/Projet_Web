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

	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$IdEvenement = $_GET['IdEvenement'];
	$IdUser = $_SESSION['idUser'];
	
	$queryAdd = "DELETE FROM participe WHERE IDutilisateur = $IdUser AND IdEvenement = $IdEvenement";
	mysql_query($queryAdd,$Connexion) or die('Erreur SQL !<br />'.$queryAdd.'<br />'.mysql_error());;
	
	$urlRedirection = "PageEvenement.php?Id=".$IdEvenement;
	header('Location:'.$urlRedirection);
	
?>