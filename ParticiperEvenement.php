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
	
	$queryAdd = "INSERT INTO participe VALUES ($IdUser, $IdEvenement)";
	mysql_query($queryAdd,$Connexion);
	
	$urlRedirection = "PageEvenement.php?Id=".$IdEvenement;
	header('Location:'.$urlRedirection);
	
?>