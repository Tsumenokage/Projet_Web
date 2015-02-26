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

$sql="select etat from appartient where etat=0";
$monRS=mysql_query($sql,$Connexion);
$nbtuple=mysql_num_rows($monRS);
if($nbtuple!=0)
{
	echo("Vous avez $nbtuple demande d'appartenance au groupe.");
    echo('<div id = container>
    <a href="quitGroup.php"><button class="submit">Quitter le groupe</button></a></div>');
}
 ?>