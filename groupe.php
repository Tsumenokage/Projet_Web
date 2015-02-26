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

$sql="SELECT IDgroupe,idUtilisateur as ADMIN, nomGroupe, descritpion, imageUrl FROM groupe ORDER BY nomGroupe ";
$query=mysql_query($sql,$Connexion);
$array=mysql_fetch_array($query);
echo($array);
echo('<div id = container>
 	 	<a href="CreationGroupe.php"><button class="submit">Créer un groupe</button></a></div>');
?>
