<?php 
	session_start();//commentaire pour moi
	include('include/menu.php');
	if(!isset($_SESSION['idUser']))
	{
		echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		include('include/footer.php');

		die();
	}

	$nomGroupe=$_POST["nomGroupe"];
	$description=$_POST["description"];
	$imageUrl=$_POST["imageUrl"];
	$idUser = $_SESSION['idUser'];
	$etat=1;
	
	$Connexion = mysql_connect($Server,$LoginBD,$MDP);// Ne pas oublier cela dans la page de traitement
	mysql_select_db($MaBase);

	$sql="SELECT nomGroupe From groupe where nomGroupe = '$nomGroupe' "; // On vérifie que le nom n'existe pas déjà dans la base de données
  
	$res=mysql_query($sql,$Connexion)or die('Erreur SQL 1 !'.$sql.'<br/>'.mysql_error());
    // S'il existe alors redirection avec message d'erreur vers la page de création de groupe
	
	if (mysql_num_rows($res!=0)) 
	{
      header("location:CreationGroupe.php?nomGroupeExist=1");
	}
	else
	{
		$SqlInsert= "INSERT INTO groupe Values (null, $idUser, '$nomGroupe','$description','$imageUrl')";
		$execute=mysql_query($SqlInsert,$Connexion) or die ('erreur SQL !'.$SqlInsert.'<br/>'.mysql_error());
        $requete="SELECT IDgroupe from groupe where nomGroupe='$nomGroupe'";
        $query=mysql_query($requete,$Connexion)or die ('erreur SQL !'.$requete.'<br/>'.mysql_error());
        $array=mysql_fetch_array($query);
        $idGroupe= $array['IDgroupe'];
        $inserer="INSERT INTO appartient values($idUser,$idGroupe,1)";
        $res=mysql_query($inserer,$Connexion)or die ('erreur SQL !'.$inserer.'<br/>'.mysql_error()) ;
        header("location:pageGroupe.php?IDgroupe=".$array['IDgroupe']);
	}

	mysql_close();	


?>



