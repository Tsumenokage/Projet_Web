<?php 
session_start();
include('include/menu.php');

	
$Connexion = mysql_connect($Server,$LoginBD,$MDP);
mysql_select_db($MaBase);

$login = $_GET['User'];

$query = "SELECT * FROM utilisateurs WHERE Login = '$login'";
$res = mysql_query($query,$Connexion);

if(mysql_num_rows($res) == 0)
{

	echo("<h2>Cet utilisateur n'existe pas</h2>");
}
else
{
	$res = mysql_fetch_array($res);
	$mailGrav = md5($res['mail']);
	echo('<img id="imageprofil" src="http://www.gravatar.com/avatar/'.$mailGrav.'?s=50" alt="Image de profil"/>');
	echo("<p>Nom :".$res['nom']."</p>");
	echo("<p>Prénom :".$res['prenom']."</p>");
	echo("<p>Mail :".$res['mail']."</p>");
	echo("</br>");
}

if($res['Login'] == $_SESSION['login'])
{

	echo('<h3>Modifier votre mot de Passe</h3>');
	if(isset($_GET['Error']))
	{
		if($_GET['Error'] == 1)
			echo('Mot de passe incorrecte');
		else
			echo('Les deux mots de passes ne correspondant pas');
	}

	if(isset($_GET['OK']))
		echo('Changement de mot de passe effectué');
	echo('
		<form id="createCompte" method= "post" action="ModifierPassowrd.php">
		<input type="password" name="passActuel" placeholder="Mot de passe acutel" required/></br>
		<input type="password" name="nouveauPass" placeholder="Nouveau mot de passe" required/></br>
		<input type="password" name="nouveauPassVerif" placeholder="Vérification du nouveau mot de passe" required/></br>
		<input class = "submit" type="submit" value="Modifier le mot de passe" />
		</form>
		');
}
include('include/footer.php');
?>

