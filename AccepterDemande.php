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

$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe'];

$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase);

$sql="UPDATE appartient
      SET Etat=1
      WHERE IDgroupe = $IDgroupe AND IDutilisateur = $";
$query=mysql_query($sql,$Connexion)or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());


$url = 'pageGroupe.php?IdGroupe='.$IDgroupe;
header('Location:'.$url);

 ?>