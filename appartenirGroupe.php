<?php 
session_start();
include('include/menu.php');
$MaBase="Projet_Web";
$Server = "localhost";
$login="root";
$MDP="root";
$etat=0;
$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe'];

$Connexion = mysql_connect($Server,$login,$MDP);
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




 ?>