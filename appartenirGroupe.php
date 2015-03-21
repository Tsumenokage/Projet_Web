<?php 
session_start();
include('include/menu.php');

$etat=0;
$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe'];

$Connexion = mysql_connect($Server,$LoginBD,$MDP);
mysql_select_db($MaBase);
$requete="SELECT IDutilisateur FROM appartient WHERE Etat=1 AND IDgroupe=$IDgroupe ";
$QUERY=mysql_query($requete,$Connexion)or die ('erreur SQL !'.$requete.'<br/>'.mysql_error());
if(mysql_num_rows($QUERY)==$idUser)
{
	echo ("<h2>Vous appartenez déjà au groupe $IDgroupe.</h2>");
}
else
{

$sql= "INSERT into appartient values ($idUser,$IDgroupe,0)";
$query=mysql_query($sql,$Connexion) or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());
}


include('include/footer.php');

 ?>