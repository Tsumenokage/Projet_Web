-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 17 Mars 2015 à 23:19
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
  ADD CONSTRAINT `appartient_ibfk_2` FOREIGN KEY (`IDgroupe`) REFERENCES `groupe` (`IDgroupe`),
  ADD CONSTRAINT `appartient_ibfk_1` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);

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
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`IDevenement`) REFERENCES `evenements` (`IdEvenement`),
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);

--
-- Contraintes pour la table `relier`
--
ALTER TABLE `relier`
  ADD CONSTRAINT `relier_ibfk_2` FOREIGN KEY (`IDevenement`) REFERENCES `evenements` (`IdEvenement`),
  ADD CONSTRAINT `relier_ibfk_1` FOREIGN KEY (`IDGroupe`) REFERENCES `groupe` (`IDgroupe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
