<?php 

session_start();
include('include/menu.php');

$idUser = $_SESSION['idUser']; 
echo $idUser;



$Connexion = mysql_connect($Server,$login,$MDP);
mysql_select_db($MaBase);

if(isset($_SESSION['idUser']))
{
    echo('<div id ="container">
 	 	<a href="CreationGroupe.php"><button class="submit">Créer un groupe</button></a>');

   
}



//Affichage des différents groupes
$sql="SELECT * FROM groupe INNER JOIN utilisateurs ON groupe.IdUtilisateur = utilisateurs.IdUtilisateur ";
$query=mysql_query($sql,$Connexion);
echo('
	<h2>Groupes</h2>
	<div id="tableau">
	<table>
		<th>Administrateur</th>
		<th>Nom du Groupe</th>
		<th>Description</th>
		<th>Illustration</th>
		<th>Page du Groupe</th>
		');
while($row=mysql_fetch_assoc($query)) 
	{
		echo '<tr>';
		echo '<td><a href="pagePerso.php?User='.$row['Login'].'">'.$row['Login'].'</a></td>';
		echo '<td><a href="pageGroupe.php?IDgroupe='.$row['IDgroupe'].'&">'.$row['nomGroupe'].'</a></td>';
		echo '<td>'.$row['Description'].'</td>';
		echo ('<td><img src="'.$row['imageUrl'].'" width="100" height="100"/></td>');
		echo  '<td><a href="pageGroupe.php?IDgroupe='.$row['IDgroupe'].'&"><button class="Littlesubmit">Accès</button></a></td>';
		echo '</tr>';
	}
	echo('</table>');
	echo('</div>');
	echo('</div>');	




include('include/footer.php');

?>
