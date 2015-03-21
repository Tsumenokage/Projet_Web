<?php
session_start();
include('include/menu.php');


$Connexion = mysql_connect($Server,$LoginBD,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase);

$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe']; 
$sql="delete from appartient where IdUtilisateur=$idUser and IDgroupe=$IDgroupe";
$query=mysql_query($sql,$Connexion)or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());
echo ('Vous avez bien été supprimé du groupe.');

include('include/footer.php');


 ?>