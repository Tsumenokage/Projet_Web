<?php 
session_start();
include('include/menu.php');

if(isset($_SESSION['idUser']))
{
	echo ("<div id='error'>Vous êtes déjà connecté cela ne sert à rien de vous inscrire...");
	echo ("Redirection vers la page d'acceuil en cours </div>");
	header("Refresh: 5;URL=Index.php");		
	die();
}

echo'
<div id = "container">
	<h1>Inscription au site</h1>
	<form id="createCompte" method= "post" action="TraiteInscription.php"/>
		<input type = "text" name = "nom" placeholder="Votre Nom:">
		<input type = "text" name = "prenom" placeholder="Votre Prenom:">
		<input type = "text" name = "login" placeholder="Pseudo">
		<input type = "password" name = "mdp1" placeholder="Mot de Passe">
		<input type = "password" name = "mdp2" placeholder="Confirmation du mot de passe">
		<input type = "email" name = "email" placeholder="Email"></label><br/>
		<input class = "submit" type = "submit" value = "Valider">';
		
		if(isset($_GET['LoginExist']))
		{
			echo('Désolé, votre Login existe déjà, veuillez en choisir un autre.');
		}
		else if(isset($_GET['MailExist']))
		{
			echo('Désolé, votre adresse Mail est déjà convoitée. Veuillez utiliser une aurte adresse mail.');
		}
		 ?>
	</form>
</div>
<?php
include('include/footer.php');
?>