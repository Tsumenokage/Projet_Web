<?php 
	session_start();
	include('include/menu.php');
	$IdEvenement = $_GET['Id'];
	
	$MaBase="projet_web";
	$Server = "localhost";
	$login="root";
	$MDP="";
	
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$query = "Select * FROM Evenements WHERE IdEvenement = $IdEvenement";
	$Res = mysql_query($query,$Connexion) or die('Erreur SQL 1 !'.$query.'<br />'.mysql_error());;
	$Res = mysql_fetch_array($Res);
	
	echo ("<h2>".$Res['NomEvenement']."</h2>");
	echo("<img src='".$Res['UrlPhoto']."' alt='Photo de évènement'/>");
?>
