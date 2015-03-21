<?php
//Ce fichier contiendra la configuration du Site

//Configuration de l'accès à la BDD

	$MaBase ="Projet_Web_Test";
	$Server = "localhost";
	$LoginBD  ="root";
	$MDP    ="";

//Information concernant le compte administrateur utilisé lors de l'installation du site
	$LoginAdmin    = 'Admin';
	$MailAdmin     = 'MailFactice@exemple.fr';
	$NomAdmin     = 'Exemple';
	$PrenomAdmin   ='Exemple';
//CHANGER LE MOT DE PASSE DEPUIS L'ESPACE UTILISATEUR UNE FOIS L'INSTALLATION EFFECTUER
	$PasswordAdmin = 'root';

//Informations pour l'installation du service
//true si vous souhaitez remplir votre BDD avec des donées (utilisateurs, groupe, évènements) false sinon.
	$Donnees = true;