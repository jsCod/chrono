<?php
header('Content-Type:text/html; charset=UTF-8');
//header('Content-Type: application/json; charset=UTF-8');
use \classes\models  as dao;
use \classes\librairies as lib;

require_once '../classes/cls.userManager.php';
require_once '../classes/cls.utils.php';
require_once '../classes/cls.adressesManager.php';

#Vérifions l'existence du mail
$userManager = new dao\UserManager();

if( !$userManager->emailExist($_POST["mail"]) )
{
	#créer une adresse pour le nouvel utilisateur
	$aAdresse = ["libelle"=>null,
				  "code_postal"=>null,
				  "ville"=>null,
				  "pays"=>null 
	            ];
	
	$adresseManager = new dao\AdressesManager();
	$adresse = new dao\Adresses($aAdresse);
	$id_adresse = $adresseManager->addAdresse($adresse);
	
	
	#Paramètres transmis par l'utilisateur
	$aUser["nom"]      = $_POST["nom"];
	$aUser["prenom"]   = $_POST["prenom"];
	$aUser["mail"]     = $_POST["mail"];
	$aUser["password"] = $_POST["password"];
	
	#Paramètres par défaut à ajouter
	$aUser["telephone"] = NULL;
	$aUser["statut"] = lib\Utils::INSCRIT;
	$aUser["date_inscription"] = date('Y-m-d H:i:s');
	$aUser["identite"] = NULL;
	$aUser["last_update"]      = date('Y-m-d H:i:s');
	$aUser["alert"]       = FALSE;
	$aUser["id_profils"] = lib\Utils::PROFIL_UTILISATEUR;
	$aUser["id_adresse"] = $id_adresse;
	
	#construction de l'objet user
	$user = new dao\User($aUser);
	//Ajout de l'utilisateur dans la base
	echo $userManager->addUser($user);
}
else 
{
	echo 2;
}









?>