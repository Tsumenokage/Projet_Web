<?php 

session_start();
include('include/menu.php');

if(!isset($_SESSION['idUser']))
{
	echo ("<div id='error'>Vous devez être connecté pour accéder à cette page, redirection vers la page de Connexion en cours...");
	header("Refresh: 5;URL=Connexion.php");	
	include('include/footer.php');
	
	die();
}
else
{

	include('module/index.php');
	include('include/footer.php');
}