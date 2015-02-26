<?php	
	session_start();
	$MaBase="projet_web";
	$Server = "localhost";
	$login="root";
	$MDP="";
		
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$IdEvenement = $_GET['IdEvenement'];
	$IdUser = $_SESSION['idUser'];
	
	$queryAdd = "DELETE FROM participe WHERE IDutilisateur = $IdUser AND IdEvenement = $IdEvenement";
	mysql_query($queryAdd,$Connexion) or die('Erreur SQL !<br />'.$queryAdd.'<br />'.mysql_error());;
	
	$urlRedirection = "PageEvenement.php?Id=".$IdEvenement;
	header('Location:'.$urlRedirection);
	
?>