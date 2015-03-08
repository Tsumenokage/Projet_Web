<?php 
	session_start();
	include('include/menu.php');
	if(!isset($_SESSION['idUser']))
	{
		echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}
	$IdEvenement = $_GET['IdEvenement'];
	
	$MaBase="projet_web";
	$Server = "localhost";
	$login="root";
	$MDP="";
	
	$nom = $_POST["nom"];
	$date = $_POST['date'];
	$adresse=$_POST['adresse'];
	$codepostal=$_POST['CodePostal'];
	$ville=($_POST['ville']);
	$urlphoto=($_POST['urlPhoto']);
	$description=$_POST['description'];
	$IdEvenement = $_POST['IdEvenement'];
	
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$query = "UPDATE Evenements SET DateEvenement = '$date', Adresse = '$adresse', CodePostal = $codepostal , Ville = '$ville',
		UrlPhoto  = '$urlphoto', Description = '$description' WHERE IdEvenement = $IdEvenement";
	
	mysql_query($query,$Connexion)or die('Erreur SQL !<br />'.$queryAdd.'<br />'.mysql_error());
	
	$urlRedirection = "ModifierEvenement.php?IdEvenement=".$IdEvenement;
	header('Location:'.$urlRedirection);