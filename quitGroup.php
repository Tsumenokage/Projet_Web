<?php
session_start();
include('include/menu.php');
$MaBase="Projet_Web";
$Server = "localhost";
$login="root";
$MDP="";

$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase);

$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe']; 
$sql="delete from appartient where IdUtilisateur=$idUser and IDgroupe=$IDgroupe";
$query=mysql_query($sql,$Connexion)or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());
echo ('Vous avez bien été supprimé du groupe.');




 ?>