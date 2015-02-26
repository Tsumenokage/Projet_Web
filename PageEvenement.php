<?php 
	session_start();
	include('include/menu.php');
	$IdEvenement = $_GET['Id'];
	
	$MaBase="projet_web";
	$Server = "localhost";
	$login="root";
	$MDP="";
	
	$Connexion = mysql_connect($Server,$login,$MDP);
	mysql_select_db($MaBase);
	
	$query = "Select * FROM Evenements WHERE IdEvenement = $IdEvenement";
	$Res = mysql_query($query,$Connexion) or die('Erreur SQL 1 !'.$query.'<br />'.mysql_error());
	$Res = mysql_fetch_array($Res);
	$IdUser = $Res['IdUtilisateur'];
	$IdEvenement = $Res['IdEvenement'];
	
	$query2 = "Select * FROM utilisateurs WHERE IdUtilisateur = '$IdUser'";
	$Res2 = mysql_query($query2,$Connexion) or die('Erreur SQL 1 !'.$query2.'<br />'.mysql_error());
	$Res2 = mysql_fetch_array($Res2);
	echo ("<h2>".$Res['NomEvenement']."</h2>");
	echo("<img src='".$Res['UrlPhoto']."' alt='Photo de évènement'/>");
	echo("<p> Créateur de l'évènement : ".$Res2['Login']."</p>");
	echo("<p> Description de l'évènement : ".$Res['Description']."</p>");
	
	$queryUser = "Select * From Utilisateurs NATURAL JOIN participe WHERE participe.IdEvenement = $IdEvenement";
	$Res3 = mysql_query($queryUser, $Connexion) or die('Erreur SQL 1 !'.$queryUser.'<br />'.mysql_error());
?>
<div id="Participants">
<h3>Participants</h3>
<?php
	while ($row = mysql_fetch_assoc($Res3)) {
		$mailGrav = md5($row['mail']);
		echo('<img id="imageprofil" src="http://www.gravatar.com/avatar/'.$mailGrav.'?s=50" alt="Image de profil"/>');
		echo("<a href='pagePerso.php?User=".$row['Login']."'>".$row['Login']."</a>");
		echo("</br>");
	}
?>
</div>
<?php
	
	if($_SESSION['idUser'] == $IdUser)
		echo ('<a href="ModifierEvenement.php?IdEvenement='.$IdEvenement.'"><button class="submit">Modifier cet évènement</button></a>');
	else
	{
		$queryIdUser = "Select IdUtilisateur From Utilisateurs NATURAL JOIN participe WHERE participe.IdEvenement = $IdEvenement";
		$Res4 = mysql_query($queryIdUser, $Connexion) or die('Erreur SQL 1 !'.$queryIdUser.'<br />'.mysql_error());
		$i = 0;
		while($row = mysql_fetch_assoc($Res4))
		{
			$TabIdParticipants[$i] = $row['IdUtilisateur'];
			$i++;
		}
		
		if(in_array($_SESSION['idUser'],$TabIdParticipants))
			echo ('<a href="SeRetirer.php?IdEvenement='.$IdEvenement.'"><button class="submit">Ne plus participer à l\'évènement</button></a>');
		else
			echo ('<a href="ParticiperEvenement.php?IdEvenement='.$IdEvenement.'"><button class="submit">Participer à cet évènement</button></a>');
			
	}
	
?>

