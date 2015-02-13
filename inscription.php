<?php include('include/menu.php'); ?>
<div id = "container">
	<h1>Inscription au site</h1>
	<form id="createCompte" method= 'post' action='TraiteInscription.php'/>
		<input type = "text" name = "login" placeholder="Pseudo">
		<input type = "password" name = "mdp" placeholder="Mot de Passe">
		<input type = "password" name = "mdp" placeholder="Confirmation du mot de passe">
		<input type = "email" name = "email" placeholder="Email"></label><br/>
		<input class = "submit" type = "submit" value = "Valider">
		<?php 
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
</body>
</html>