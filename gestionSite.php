<?php 
	session_start();
	include('include/menu.php');
	
	if(!isset($_SESSION['idUser']) || $_SESSION['idUser'] != 1)
	{
		echo ("<div id='error'>Vous devez être connecté, ou vous n'avez pas les droits pour accéder à cette page, redirection vers la page de Connexion en cours...");
		header("Refresh: 5;URL=Connexion.php");		
		die();
	}
	
	$MaBase="projet_web";
	$Server = "localhost";
	$login="root";
	$MDP="";
	
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$query = "Select * FROM evenements WHERE EtatEvenement = 0 ";
	
	$Res = mysql_query($query,$Connexion) or die('Erreur SQL 1 !'.$query.'<br />'.mysql_error());
	
	echo "<div id='tableau'>";
	echo '<table>';
	echo "<th>Evènement</th>
		<th>Date</th>
		<th>Adresse</th>
		<th>Description</th>
		<th>Illustration</th>
		<th>Actions</th>";
	while($row = mysql_fetch_assoc($Res))
	{
		echo "<tr>";
		echo "<td><a href='pageEvenement.php?Id=".$row['IdEvenement']."'>".$row['NomEvenement']."</a></td>";
		echo "<td>".$row['DateEvenement']."</td>";
		echo "<td>".$row['Adresse']." ".$row['CodePostal']." ".$row['Ville']."</td>";
		echo "<td>".$row['Description']."</td>";
		echo "<td><img src='".$row['UrlPhoto']."' height='100' width='100' /img></td>";
		echo "<td><a href='AccepterEvenement.php?IdEvenement=".$row['IdEvenement']."'><button>Accepter</button></a> 
		<a href='RefuserEvenement.php?IdEvenement=".$row['IdEvenement']."'><button>Refuser</button></a></td>";
		echo "</tr>";
	}
	echo '</table>';
	echo "</div>";
	
	
	
?>