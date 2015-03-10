<?php
session_start();
include('include/menu.php');
$MaBase="Projet_Web";
$Server = "localhost";
$login="root";
$MDP="";

$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase);

$idUser = $_GET['idUser']; 
$IDgroupe=$_GET['IDgroupe']; 
$sql="delete from appartient where IDutilisateur=$idUser and IDgroupe=$IDgroupe";
$query=mysql_query($sql,$Connexion)or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());
echo ('Votre demande a bien été annulée.');




 ?>