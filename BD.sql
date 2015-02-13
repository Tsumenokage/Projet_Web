-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 12 Février 2015 à 16:15
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `Projet_Web`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `IDutilisateur` int(11) NOT NULL,
  `IDgroupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
`IdEvenement` int(11) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
`IDgroupe` int(11) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `IDutilisateur` int(11) NOT NULL,
  `IDevenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relier`
--

CREATE TABLE `relier` (
  `IDutilisateur` int(11) NOT NULL,
  `IDevenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
`IdUtilisateur` int(11) NOT NULL,
  `Login` text NOT NULL,
  `Pasword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
 ADD PRIMARY KEY (`IDutilisateur`,`IDgroupe`), ADD KEY `ForeignKeyGroupe` (`IDgroupe`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
 ADD PRIMARY KEY (`IdEvenement`), ADD KEY `IdUtilisateur` (`IdUtilisateur`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
 ADD PRIMARY KEY (`IDgroupe`), ADD KEY `IdUtilisateur` (`IdUtilisateur`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
 ADD PRIMARY KEY (`IDutilisateur`,`IDevenement`), ADD KEY `ForeignKeyEvent` (`IDevenement`);

--
-- Index pour la table `relier`
--
ALTER TABLE `relier`
 ADD PRIMARY KEY (`IDutilisateur`,`IDevenement`), ADD KEY `IDevenement` (`IDevenement`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
 ADD PRIMARY KEY (`IdUtilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
MODIFY `IdEvenement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
MODIFY `IDgroupe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
MODIFY `IdUtilisateur` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
ADD CONSTRAINT `ForeignKeyGroupe` FOREIGN KEY (`IDgroupe`) REFERENCES `groupelll` (`IDgroupe`),
ADD CONSTRAINT `ForeignKeyUtilisateur` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
ADD CONSTRAINT `PrimaryKeyCreatorEvent` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
ADD CONSTRAINT `ForeignKeyEvent` FOREIGN KEY (`IDevenement`) REFERENCES `evenements` (`IdEvenement`),
ADD CONSTRAINT `ForeignKeyParticipe` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);

--
-- Contraintes pour la table `relier`
--
ALTER TABLE `relier`
ADD CONSTRAINT `relier_ibfk_2` FOREIGN KEY (`IDevenement`) REFERENCES `evenements` (`IdEvenement`),
ADD CONSTRAINT `relier_ibfk_1` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateurs` (`IdUtilisateur`);
