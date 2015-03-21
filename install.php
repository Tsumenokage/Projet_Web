<?php
include("config.php");

$Connexion = mysql_connect($Server, $LoginBD, $MDP) or die('Connection impossible au sgbd, l\'installation n\'a pu aboutir');

$createDataBase = "CREATE DATABASE IF NOT EXISTS `$MaBase` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;";

$Res = mysql_query($createDataBase) or die('Erreur SQL 1 !'.$createDataBase.'<br />'.mysql_error());
mysql_select_db($MaBase);


$createAppartient = "
		CREATE TABLE IF NOT EXISTS `appartient` (
		  `IDutilisateur` int(11) NOT NULL,
		  `IDgroupe` int(11) NOT NULL,
		  `Etat` int(11) NOT NULL,
		  PRIMARY KEY (`IDutilisateur`,`IDgroupe`),
		  KEY `ForeignKeyGroupe` (`IDgroupe`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		";

$createChatAnnonce = "
CREATE TABLE IF NOT EXISTS `chat_annonce` (
  `annonce_id` int(11) NOT NULL AUTO_INCREMENT,
  `annonce_text` varchar(300) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`annonce_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
";

$createChatMessage = "
CREATE TABLE IF NOT EXISTS `chat_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_user` int(11) NOT NULL,
  `message_time` bigint(20) NOT NULL,
  `message_text` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `message_user` (`message_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;
";

$createChatOnline = "
CREATE TABLE IF NOT EXISTS `chat_online` (
  `online_id` int(11) NOT NULL AUTO_INCREMENT,
  `online_ip` varchar(100) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_user` int(11) NOT NULL,
  `online_status` enum('0','1','2') CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_time` bigint(21) NOT NULL,
  PRIMARY KEY (`online_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;
";

$createEvenement = "
CREATE TABLE IF NOT EXISTS `evenements` (
  `IdEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `IdUtilisateur` int(11) NOT NULL,
  `NomEvenement` varchar(255) NOT NULL,
  `DateEvenement` date NOT NULL,
  `DateFinEvenement` date NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `CodePostal` int(11) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `UrlPhoto` varchar(255) NOT NULL,
  `EtatEvenement` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Prix` int(11) NOT NULL,
  PRIMARY KEY (`IdEvenement`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
";

$createGroupe = "
CREATE TABLE IF NOT EXISTS `groupe` (
  `IDgroupe` int(11) NOT NULL AUTO_INCREMENT,
  `IdUtilisateur` int(11) NOT NULL,
  `nomGroupe` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  PRIMARY KEY (`IDgroupe`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
";

$createParticipe = "
CREATE TABLE IF NOT EXISTS `participe` (
  `IDutilisateur` int(11) NOT NULL,
  `IDevenement` int(11) NOT NULL,
  PRIMARY KEY (`IDutilisateur`,`IDevenement`),
  KEY `ForeignKeyEvent` (`IDevenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$createRelier ="
CREATE TABLE IF NOT EXISTS `relier` (
  `IDGroupe` int(11) NOT NULL,
  `IDevenement` int(11) NOT NULL,
  PRIMARY KEY (`IDGroupe`,`IDevenement`),
  KEY `IDevenement` (`IDevenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$createUtilisateur = "
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `IdUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Login` text NOT NULL,
  `Password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`IdUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
";


//Requete d'ajout des contraintes sur les tables
$consAppartient ="ALTER TABLE `appartient`
  ADD CONSTRAINT `appartient_ibfk_1` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`),
  ADD CONSTRAINT `appartient_ibfk_2` FOREIGN KEY (`IDgroupe`) REFERENCES `groupe` (`IDgroupe`);
  ";

$consChatMessages ="ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`message_user`) REFERENCES `utilisateurs` (`IdUtilisateur`);";

$consChatOnline ="ALTER TABLE `chat_online`
  ADD CONSTRAINT `chat_online_ibfk_1` FOREIGN KEY (`message_user`) REFERENCES `utilisateurs` (`IdUtilisateur`);
";

$consEvenement = "ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);";

$consGroupe = "ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);";

$consParticipe = "ALTER TABLE `participe`
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`),
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`IDevenement`) REFERENCES `evenements` (`IdEvenement`);";

$consRelier ="ALTER TABLE `relier`
  ADD CONSTRAINT `relier_ibfk_1` FOREIGN KEY (`IDGroupe`) REFERENCES `groupe` (`IDgroupe`),
  ADD CONSTRAINT `relier_ibfk_2` FOREIGN KEY (`IDevenement`) REFERENCES `evenements` (`IdEvenement`);";


//Execution des requêtes
mysql_query($createAppartient);
mysql_query($createChatAnnonce);
mysql_query($createChatMessage);
mysql_query($createChatOnline);
mysql_query($createEvenement);
mysql_query($createGroupe);
mysql_query($createParticipe);
mysql_query($createRelier);
mysql_query($createUtilisateur);

mysql_query($consAppartient);
mysql_query($consChatMessages);
mysql_query($consChatOnline);
mysql_query($consEvenement);
mysql_query($consParticipe);
mysql_query($consRelier);

//Ajout de l'administrateur avec les informations contenues dans le config.php
$pass = md5($PasswordAdmin);
$AddAdmin = "INSERT INTO utilisateurs VALUES (null,'$LoginAdmin','$pass','$MailAdmin','$NomAdmin','$PrenomAdmin')" ;
mysql_query($AddAdmin,$Connexion);

//header('Location:index.php');





?>