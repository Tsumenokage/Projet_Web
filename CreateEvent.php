<?php 
	session_start();
	$MaBase="projet_web";
	$Server = "localhost";
	$login="root";
	$MDP="";
	
	$nom = $_POST["nom"];
	$date = $_POST['date'];
	$adresse=md5($_POST['adresse']);
	$codepostal=md5($_POST['CodePostal']);
	$ville=($_POST['ville']);
	$urlphoto=($_POST['urlPhoto']);

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
		$queryAdd = "INSERT INTO evenements VALUES (null,'$idUser','$nom','$date','$adresse','$codepostal','$ville','$urlphoto','0')";
		$Res3 = mysql_query($queryAdd,$Connexion) or die('Erreur SQL 1 !'.$queryAdd.'<br />'.mysql_error());
		
	}

?>