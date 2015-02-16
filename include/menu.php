<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Site de création d'évènements</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="menu.css" rel="stylesheet" type="text/css">
</head>
<body>
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
				<a href="Groupes.php">Groupes</a>
            <li>
                <a href="about.php">A propos</a>
            </li>
        </ul>
		<?php if(isset($_SESSION['login']))
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