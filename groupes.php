<?php 

session_start();
include('include/menu.php');
$MaBase="Projet_Web";
$Server = "localhost";
$login="root";
$MDP="root";

$idUser = $_SESSION['idUser']; 
<<<<<<< Updated upstream
=======
$idUserAppartient=$_GET['IDutilisateur'];

>>>>>>> Stashed changes

$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase);

<<<<<<< Updated upstream
$sql="SELECT IDgroupe,idUtilisateur as ADMIN, nomGroupe, description, imageUrl FROM groupe ORDER BY nomGroupe ";
$query=mysql_query($sql,$Connexion) or die('Erreur SQL 1 !'.$sql.'<br/>'.mysql_error());
$array=mysql_fetch_array($query);
echo('<div id = container>
 	 	<a href="CreationGroupe.php"><button class="submit">Créer un groupe</button></a></div>');
=======
$requete="SELECT IDutilisateur FROM groupe";
$excuter=mysql_query($requete,$Connexion);

if(mysql_num_rows($excuter)!=0 )
{
    echo('<div id = container>
 	 	<a href="CreationGroupe.php"><button class="submit">Créer un groupe</button></a></div>');
   
}


>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
		echo '<td>'.$row['IdUtilisateur'].'</td>';// ICI PB tous les row sont égaux à 1, => pb ds la requete
		echo '<td><div id=container> 
		<a href="pageGroupe.php?IDgroupe='.$row['IDgroupe'].'&">'.$row['nomGroupe'].'</a></td>';
=======
		echo '<td>'.$row['IdUtilisateur'].'</td>';
		echo '<td><div id=container> 
		<a href="pageGroupe.php?IDgroupe='.$row['IDgroupe'].'&Etat='.$array['Etat'].'&">'.$row['nomGroupe'].'</a></td>';
>>>>>>> Stashed changes
		echo '<td>'.$row['description'].'</td>';
		echo ('<td><img src="'.$row['imageUrl'].'" width="150" height="150"/></td>');
     

		echo '</tr>';
	}



?>
