<?php

session_start();
if(!isset($_SESSION['idUser']))
{
	echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
	header("Refresh: 5;URL=Connexion.php");		
	include('include/footer.php');
	die();
}

session_unset();

session_destroy();

header('Location:index.php');