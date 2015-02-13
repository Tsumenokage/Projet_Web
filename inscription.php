<html>
<head>
	<title> Formulaire inscription</title>
</head>
<body>
<form
method= 'post' action='TraiteInscription.php'/>
<label >Login:<input type = "text" name = "login"><br/>
<label>Mot de passe:<input type = "text" name = "mdp"><br/>
<label>Confirmation du mot de passe<input type = "text" name = "mdp"><br/>//confirmation du mot de passe
<input type = "text" name = "email"><br/>
<input type = "submit" value = "Valider">
<?php 
if(isset($_GET['LoginExist'])
{
	echo('Désolé, votre Login existe déjà, veuillez en choisir un autre.');
}
else if(isset($_GET['MailExist']))
{
	echo('Désolé, votre adresse Mail est déjà convoitée. Veuillez utiliser une aurte adresse mail.')
}
 ?>
</form>
</body>
</html>