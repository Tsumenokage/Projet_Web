<?php 

session_start();
include('include/menu.php');
$MaBase="Projet_Web";
$Server = "localhost";
$login="root";
$MDP="";

$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe'];
$idUserAppartient=$_GET['IDutilisateur'];
$Etat=$_GET['Etat'];

$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase);
// PERMET DE FAIRE APPARAITRE LE BOUTON DE GESTION DES GROUPES.
$requete="SELECT IDutilisateur FROM groupe";
$excuter=mysql_query($requete,$Connexion);
//$requete2="SELECT Etat FROM appartient WHERE IDutilisateur=$idUser";

//$QUERY=mysql_query($requete2,$Connexion) or die ('erreur SQL !'.$requete2.'<br/>'.mysql_error());
//$array=mysql_fetch_array($QUERY);
echo($array['Etat']);
if(mysql_num_rows($excuter)!=0)
{
    echo('<div id = container>
 	 	<a href="CreationGroupe.php"><button class="submit">Créer un groupe</button></a></div>');
}

$sql="SELECT * FROM groupe ";
$query=mysql_query($sql,$Connexion);
echo('<table class="tab" align="center">
		<caption><h2><strong>Groupes</strong></h2></caption>
		<tr>
		<td>ADMIN</td><br/>
		<td>nomGroupe</td><br/>
		<td>descritpion</td><br/>
		<td>illustration</td><br/>
		
		</tr>');
while($row=mysql_fetch_assoc($query)) 
	{
		echo '<tr>';
		echo '<td>'.$row['IdUtilisateur'].'</td>';// ICI PB tous les row sont égaux à 1, => pb ds la requete
		echo '<td><div id=container> 
		<a href="pageGroupe.php?IDgroupe='.$row['IDgroupe'].'&Etat='.$array['Etat'].'&">'.$row['nomGroupe'].'</a></td>';
		echo '<td>'.$row['description'].'</td>';
		echo ('<td><img src="'.$row['imageUrl'].'" width="150" height="150"/></td>');
     

		echo '</tr>';
	}



?>
