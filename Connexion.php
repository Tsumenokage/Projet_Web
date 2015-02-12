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
                <a href="catalogue.php">Catalogue</a>
            </li>
            <li>
                <a href="about.php">A propos</a>
            </li>
        </ul>
        <a id="connectionUtilisateur" href="connexion.php">Se connecter</a>
    </div>
</header>

<div id="container">
            <h1>Connexion à votre compte personnel</h1>
            <p class="center letterSpacing"><a href="inscription.php" class="lightColor">Pas de compte ?</a></p>

            <form id="formConnexion" method="post" action="Traitementconnexion.php">
                <input type="text" name="pseudo" placeholder="PSEUDO : prof"/>
                <input type="password" name="pass" placeholder="MOT DE PASSE : prof" />
                <input class="submit" type="submit" value="Se Connecter" />
            </form>
</div>


<footer>
</footer>
</body>