<?php
	$MaBase ="Projet_Web";
	$Server = "localhost";
	$login  ="root";
	$MDP    ="";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Site de création d'évènements</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="menu.css" rel="stylesheet" type="text/css">
    <link href="footer.css" rel="stylesheet" type="text/css">
	<link href="Calendrier.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="module/chat.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>	<script src="js/ol.js"></script>
	<script src="modernizr.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>	
	<script src="webforms2/webforms2-p.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="module/chat.js"></script>
</head>
<body onload="loadJSON()">
<header>
    <div id="menu">
        <a href="index.php">
            <img alt="" src="/img/icons/png/Calendar.png">
        </a>
        <ul>
            <li>
                <a href="index.php">Accueil</a>
            </li>
            <li>
                <a href="Evenement.php">Evenement</a>
            </li>
			<li>
				<a href="groupes.php">Groupes</a>
			</li>
			<?php
			if(isset($_SESSION['idUser']))
			{
			?>
			<li>
                <a href="Chat.php">Chat</a>
            </li>
			<?php
			}?>			
			<?php
			if(isset($_SESSION['idUser']) && $_SESSION['idUser'] ==1 )
			{
			?>
			<li>
                <a href="gestionSite.php">Gestion</a>
            </li>
			<?php
			}?>
            <li>
                <a href="about.php">A propos</a>
            </li>
        </ul>
		<?php
		//error_reporting(0);
				
		if(isset($_SESSION['login']))
		{
		$mailGrav = md5( strtolower( trim($_SESSION["mail"])));
		echo('<img id="imageprofil" src="http://www.gravatar.com/avatar/'.$mailGrav.'?s=50" alt="Image de profil"/>');
		echo('<a id="connectionUtilisateur">Bonjour '.$_SESSION['login'].'</a>');
		echo('<a id="connectionUtilisateur" href="logout.php">Se deconnecter</a>');
		}
		else
		{
        echo('<a id="connectionUtilisateur" href="Connexion.php">Se connecter</a>');
		}
		 ?>
    </div>
</header>