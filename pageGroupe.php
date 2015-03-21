<?php 
session_start();
include('include/menu.php');


$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase); 

$idUser = $_SESSION['idUser']; 
$IDgroupe=$_GET['IDgroupe'];


$Connexion = mysql_connect($Server,$login,$MDP);// Ne pas oublier cela dans la page de traitement
mysql_select_db($MaBase); 


// Requête pour récuperer les informations du groupe
$sql="SELECT * 
	  FROM groupe 
	  INNER JOIN  appartient ON groupe.IDutilisateur = appartient.IDutilisateur
	  INNER JOIN utilisateurs ON utilisateurs.IDutilisateur = appartient.IDutilisateur
	  WHERE groupe.IDgroupe=$IDgroupe";
$query=mysql_query($sql,$Connexion) or die ('erreur SQL !'.$sql.'<br/>'.mysql_error());
$array=mysql_fetch_array($query);


// Requête pour récupérer informations de l'utilisateurs qui arrive sur la page du groupe
$sql2="SELECT * FROM appartient WHERE IDutilisateur=$idUser AND IDgroupe=$IDgroupe";
$resultat=mysql_query($sql2,$Connexion)or die ('erreur SQL !'.$sql2.'<br/>'.mysql_error());
$array2=mysql_fetch_array($resultat);


echo("<h2>Informations concernant le groupe</h2>");
echo("<p class='Informations'></p>");
echo("<fieldset>");
echo("<p class='Admin'><em>Administrateur du groupe:</em>".$array['Login']."</p><br/>");
echo("<p class='nomGroupe'><em>Nom du groupe:</em>    ".$array['nomGroupe'] ."</p><br/>");
echo("<p class='descritpion'><em>description:</em>    ".$array['Description'] ."</p><br/>");
echo"<p class='image'><img src='".$array['imageUrl']."'/></p>";
echo("</fieldset>");



 if($array['IdUtilisateur']==$idUser)
 {
 	
         echo('<a href="gestionGroupe.php?IDgroupe='.$IDgroupe.'"><button class="submit">Gestion du groupe</button></a>');
 }
else if(isset($array2['Etat']) && $array2['Etat']==0)
{
	echo("Votre demande d'appartenance au groupe $IDgroupe a bien été prise en compte. En attente de traitement.");
	echo ('<a href="quitGroup.php?IdUtilisateur='.$idUser.'&IDgroupe='.$IDgroupe.'"><button class="submit">Annulez la demande</button></a>');
}
 else if(isset($array2['Etat']) && $array2['Etat']==1)
 {
   echo ('<a href="quitGroup.php?IdUtilisateur='.$idUser.'&IDgroupe='.$IDgroupe.'"><button class="submit">Quittez ce groupe</button></a>');
 }

if($array['IdUtilisateur']==$idUser || (isset($array2['Etat']) && $array2['Etat']==0))
{
	echo("<h2>Evènements du groupe</h2>");

	//Affichage des évènements privés lié au groupes
	$RequeteEvent = "SELECT * 
					 FROM evenements 
					 INNER JOIN relier on evenements.idEvenement = relier.idEvenement
					 WHERE relier.IDgroupe = $IDgroupe AND evenements.EtatEvenement = 1";
	$resRequete = mysql_query($RequeteEvent,$Connexion);

	echo "<div id='tableau'>";
	echo '<table>';
	echo "<th>Evènement</th>
		<th>Date</th>
		<th>Adresse</th>
		<th>Description</th>
		<th>Illustration</th>";
	while($row = mysql_fetch_assoc($resRequete))
	{
		echo "<tr>";
		echo "<td><a href='pageEvenement.php?Id=".$row['IdEvenement']."'>".$row['NomEvenement']."</a></td>";
		echo "<td>".$row['DateEvenement']."</td>";
		echo "<td>".$row['Adresse']." ".$row['CodePostal']." ".$row['Ville']."</td>";
		echo "<td>".$row['Description']."</td>";
		echo "<td><img src='".$row['UrlPhoto']."' height='100' width='100' /img></td>";
		echo "</tr>";
	}
	
	echo '</table>'; 	
	echo "</div>";

	//Affichage des membres du groupe
	$requeteMembres = "SELECT *
	FROM utilisateurs
	INNER JOIN appartient ON utilisateurs.IdUtilisateur = appartient.IdUtilisateur
	WHERE appartient.Etat = 1 AND appartient.IDgroupe = $IDgroupe";
	$ResMembres = mysql_query($requeteMembres,$Connexion);

echo '<div id="Participants">
<h2>Membres du groupe</h2>';

	while ($row = mysql_fetch_assoc($ResMembres)) {
		$mailGrav = md5($row['mail']);
		echo('<img id="imageprofil" src="http://www.gravatar.com/avatar/'.$mailGrav.'?s=50" alt="Image de profil"/>');
		echo("<a href='pagePerso.php?User=".$row['Login']."'>".$row['Login']."</a>");
		echo("</br>");
	}

echo '</div>';
}



 include('include/footer.php');
 ?>

