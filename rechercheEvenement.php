<?php 
session_start();
include('include/menu.php');

$Connexion = mysql_connect($Server,$login,$MDP);
mysql_select_db($MaBase);

	if(!isset($_SESSION['idUser']))
	{
		echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}
	$IdUser = $_SESSION['idUser'];
	
	$recherche = $_GET['nom'];

//Cette requête va récupérer les 10 évènements les plus populaires du site
	$query = "SELECT * FROM evenements WHERE NomEvenement LIKE '%$recherche%' ";
	$Res = mysql_query($query, $Connexion) or die();

	if(mysql_num_rows($Res) != 0)
	{
		echo("<h2>Resultat de votre recherche</h2>");
		echo "<div id='tableau'>";
		echo '<table>';
		echo "<th>Evènement</th>
			<th>Date</th>
			<th>Adresse</th>
			<th>Description</th>
			<th>Illustration</th>";
		while($row = mysql_fetch_assoc($Res))
		{
			echo "<tr>";
			echo "<td><a href='pageEvenement.php?Id=".$row['IdEvenement']."'>".$row['NomEvenement']."</a></td>";
			echo "<td>".$row['DateEvenement']."</td>";
			echo "<td>".$row['Adresse']." ".$row['CodePostal']." ".$row['Ville']."</td>";
			echo "<td>".$row['Description']."</td>";
			echo "<td><img src='".$row['UrlPhoto']."' height='100' width='100' /img></td>";
			echo "</tr>";
		}
	}
	else
	{

			echo("<h2>Aucun résultat pour cette recherche</h2>");
	}

	include('include/footer.php');