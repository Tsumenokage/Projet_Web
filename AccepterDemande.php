<?php 

session_start();
include('include/menu.php');
$MaBase="Projet_Web";
$Server = "localhost";
$login="root";
$MDP="";

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