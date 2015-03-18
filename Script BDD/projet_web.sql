-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Mars 2015 à 00:44
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE IF NOT EXISTS `appartient` (
  `IDutilisateur` int(11) NOT NULL,
  `IDgroupe` int(11) NOT NULL,
  PRIMARY KEY (`IDutilisateur`,`IDgroupe`),
  KEY `ForeignKeyGroupe` (`IDgroupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chat_annonce`
--

CREATE TABLE IF NOT EXISTS `chat_annonce` (
  `annonce_id` int(11) NOT NULL AUTO_INCREMENT,
  `annonce_text` varchar(300) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`annonce_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `chat_annonce`
--

INSERT INTO `chat_annonce` (`annonce_id`, `annonce_text`) VALUES
(1, 'Chat du Site');

-- --------------------------------------------------------

--
-- Structure de la table `chat_messages`
--

CREATE TABLE IF NOT EXISTS `chat_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_user` int(11) NOT NULL,
  `message_time` bigint(20) NOT NULL,
  `message_text` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `message_user` (`message_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `chat_messages`
--

INSERT INTO `chat_messages` (`message_id`, `message_user`, `message_time`, `message_text`) VALUES
(5, 1, 1426718442, 'coucou ?'),
(6, 1, 1426718448, 'nickel'),
(7, 1, 1426718455, 'aah '),
(8, 1, 1426718463, 'on a pas ce qu''il faut'),
(9, 1, 1426718469, 'pas de pseudo'),
(10, 1, 1426718474, 'pas normal'),
(11, 1, 1426718581, 'root '),
(12, 1, 1426718641, 'mieux'),
(13, 1, 1426718647, 'root '),
(14, 1, 1426718814, 'root  2526'),
(15, 1, 1426718827, 'root> '),
(16, 1, 1426721254, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `chat_online`
--

CREATE TABLE IF NOT EXISTS `chat_online` (
  `online_id` int(11) NOT NULL AUTO_INCREMENT,
  `online_ip` varchar(100) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_user` int(11) NOT NULL,
  `online_status` enum('0','1','2') CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_time` bigint(21) NOT NULL,
  PRIMARY KEY (`online_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `chat_online`
--

INSERT INTO `chat_online` (`online_id`, `online_ip`, `online_user`, `online_status`, `online_time`) VALUES
(14, '127.0.0.1', 1, '2', 1426722242);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE IF NOT EXISTS `evenements` (
  `IdEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `IdUtilisateur` int(11) NOT NULL,
  `NomEvenement` varchar(255) NOT NULL,
  `DateEvenement` date NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `CodePostal` int(11) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `UrlPhoto` varchar(255) NOT NULL,
  `EtatEvenement` int(11) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`IdEvenement`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `evenements`
--

INSERT INTO `evenements` (`IdEvenement`, `IdUtilisateur`, `NomEvenement`, `DateEvenement`, `Adresse`, `CodePostal`, `Ville`, `UrlPhoto`, `EtatEvenement`, `Description`) VALUES
(1, 1, 'Semaine de Campagne du BDA', '2015-03-18', '216 Rue de Suzon', 33400, 'Talence', '', 1, 'Semaine de campagne de notre cher BDA XD');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `IDgroupe` int(11) NOT NULL AUTO_INCREMENT,
  `IdUtilisateur` int(11) NOT NULL,
  `nomGroupe` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  PRIMARY KEY (`IDgroupe`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE IF NOT EXISTS `participe` (
  `IDutilisateur` int(11) NOT NULL,
  `IDevenement` int(11) NOT NULL,
  PRIMARY KEY (`IDutilisateur`,`IDevenement`),
  KEY `ForeignKeyEvent` (`IDevenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `participe`
--

INSERT INTO `participe` (`IDutilisateur`, `IDevenement`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `relier`
--

CREATE TABLE IF NOT EXISTS `relier` (
  `IDGroupe` int(11) NOT NULL,
  `IDevenement` int(11) NOT NULL,
  PRIMARY KEY (`IDGroupe`,`IDevenement`),
  KEY `IDevenement` (`IDevenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `IdUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Login` text NOT NULL,
  `Password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`IdUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`IdUtilisateur`, `Login`, `Password`, `mail`, `nom`, `prenom`) VALUES
(1, 'root', '63a9f0ea7bb98050796b649e85481845', 'jeremy.tsume@gmail.com', 'ALBOUYS', 'JÃ©rÃ©my');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `appartient_ibfk_1` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`),
  ADD CONSTRAINT `appartient_ibfk_2` FOREIGN KEY (`IDgroupe`) REFERENCES `groupe` (`IDgroupe`);

--
-- Contraintes pour la table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`message_user`) REFERENCES `utilisateurs` (`IdUtilisateur`);

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`),
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`IDevenement`) REFERENCES `evenements` (`IdEvenement`);

--
-- Contraintes pour la table `relier`
--
ALTER TABLE `relier`
  ADD CONSTRAINT `relier_ibfk_1` FOREIGN KEY (`IDGroupe`) REFERENCES `groupe` (`IDgroupe`),
  ADD CONSTRAINT `relier_ibfk_2` FOREIGN KEY (`IDevenement`) REFERENCES `evenements` (`IdEvenement`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
