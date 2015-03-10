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

$sql= "INSERT into appartient values ($idUser,$IDgroupe,0)";
$query=mysql_query($sql,$Connexion) or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());





 ?>