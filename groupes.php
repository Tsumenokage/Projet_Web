<?php 

session_start();
include('include/menu.php');

$idUser = $_SESSION['idUser']; 
echo $idUser;



$Connexion = mysql_connect($Server,$login,$MDP);
mysql_select_db($MaBase);

$sql="SELECT IDgroupe,idUtilisateur as ADMIN, nomGroupe, description, imageUrl FROM groupe ORDER BY nomGroupe ";
$query=mysql_query($sql,$Connexion) or die('Erreur SQL 1 !'.$sql.'<br/>'.mysql_error());
$array=mysql_fetch_array($query);

$requete="SELECT IDutilisateur FROM groupe";
$excuter=mysql_query($requete,$Connexion);

if(mysql_num_rows($excuter)!=0 )
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
		echo '<td>'.$row['IdUtilisateur'].'</td>';
		echo '<td><div id=container> 
		<a href="pageGroupe.php?IDgroupe='.$row['IDgroupe'].'&">'.$row['nomGroupe'].'</a></td>';
		echo '<td>'.$row['IdUtilisateur'].'</td>';
		echo '<td><div id=container> 
		<a href="pageGroupe.php?IDgroupe='.$row['IDgroupe'].'&Etat='.$array['Etat'].'&IDutilisateur='.$idUser.'">'.$row['nomGroupe'].'</a></td>';
		echo '<td>'.$row['description'].'</td>';
		echo ('<td><img src="'.$row['imageUrl'].'" width="150" height="150"/></td>');
     

		echo '</tr>';
	}

include('include/footer.php');

?>
