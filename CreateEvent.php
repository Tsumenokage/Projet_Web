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
		print_r($Res4);
		$urlRedirection = "PageEvenement.php?Id=".$Res4['IdEvenement'];
		header('Location:'.$urlRedirection);
	}

?>