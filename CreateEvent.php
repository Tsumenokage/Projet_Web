<?php 
	session_start();
	include('include/menu.php');
	
	if(!isset($_SESSION['idUser']))
	{
		echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}
	
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

	$idUser = $_SESSION['idUser'];
	
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$query = "Select * From evenements where NomEvenement = '$nom'";
	$res=mysql_query($query,$Connexion) or die('Erreur SQL 1 !'.$query.'<br />'.mysql_error());
	
	
	if(mysql_num_rows($res)!=0)
	{
		header("location:CreationEvenement.php?NameExist=1");
	}
	else
	{
		$queryAdd = "INSERT INTO evenements VALUES (null,'$idUser','$nom','$date','$adresse','$codepostal','$ville','$urlphoto','0','$description')";
		$Res3 = mysql_query($queryAdd,$Connexion) or die('Erreur SQL 1 !'.$queryAdd.'<br />'.mysql_error());
				
		$queryAdd2 = "Select * FROM evenements WHERE NomEvenement = '$nom'";
		$Res4 = mysql_query($queryAdd2,$Connexion) or die('Erreur SQL 2 !'.$queryAdd2.'<br />'.mysql_error());
		$Res4 = mysql_fetch_array($Res4);
		$IdEvenement = $Res4['IdEvenement'];
		
		
		$queryAdd3 = "INSERT INTO participe VALUES ($idUser, $IdEvenement)";
		mysql_query($queryAdd3,$Connexion);
		
		$urlRedirection = "PageEvenement.php?Id=".$IdEvenement;
		header('Location:'.$urlRedirection);
	}

?>