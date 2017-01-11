<?php  header('Content-Type: text/html; charset=utf-8');

session_start(); 
use classes\models  as dao;
use classes\librairies as lib;
use classes\models\ExpeditionsManager;

require_once 'classes/cls.utils.php';
require_once 'classes/cls.expeditionsManager.php';
require_once 'classes/cls.userManager.php';
require_once 'classes/cls.colisManager.php';
require_once 'classes/cls.adressesManager.php';
require_once 'classes/cls.annoncesManager.php';
require_once 'classes/cls.categoryManager.php';

$aAdresse = ["libelle"=>null,
			  "code_postal"=>null,
			  "ville"=>"Côte d'ivoire",
			  "pays"=>null ];

$aUser   = ["nom"=>"anaïs",
			"prenom"=>"jérôme",
			"mail"=>"test@admin.net",
			"password"=>"pass",
		    "telephone"=>null,
		    "identite"=>null,
		    "statut"=>lib\Utils::INSCRIT,
		    "date_inscription"=>date('Y-m-d H:i:s'),
		    "last_update"=>date('Y-m-d H:i:s'),
		    "alert"=>false,
		    "id_profils"=>lib\Utils::PROFIL_UTILISATEUR,
		    "id_adresse"=>1
           ];

$aColis = ["poids"=>1.5,
		"taille"=>"1*1*1",
		"nom"=>"Zongo",
		"prenom"=>"Boureima",
		"last_update"=>date('Y-m-d H:i:s'),
		"statut"=>lib\Utils::COMMISSION_COLIS,
		"category_id"=>1
];

$aAnnonce = ["statut"=>lib\Utils::COMMISSION_COLIS,
             "date_annonce"=>date('Y-m-d H:i:s'),
             "date_depart"=>null,
             "last_update"=>date('Y-m-d H:i:s'),
             "id_user"=>1,
             "id_adresse"=>1,
             "id_colis"=>1
             ];

$aExpedition = ["id_transporteur"=>1,
		        "id_colis"=>1,
		        "date_planif"=>date("Y-m-d H:i:s"),
		        "statut"=>lib\Utils::EXPEDITION_EN_COURS,
		        "last_update"=>date("Y-m-d H:i:s")
               ];


$annonceManager = new dao\AnnoncesManager();
$transporteur   = $annonceManager->getAnnoncesTransports();

print '<pre====================<br/>';
print_r($transporteur[10]);

print '<pre====================<br/>';
echo "Format Json :" .json_encode($transporteur[10]);

print '<pre>===============<br/>';
print_r($transporteur);

echo json_encode($transporteur);



#Récupération des transporteurs
/*$annonceManager = new dao\AnnoncesManager();
$annonce1 = $annonceManager->getAnnonce(6);

print '<pre>=====================<br/>';
var_dump($annonce1);

$annonce1->setStatut(3);
$annonce1->setDateDepart(date("Y-m-d H:i:s"));
echo "<br/> STATUT : " .$annonce1->getStatut();
echo "<br/> date_depart : " .$annonce1->getDateDepart();

$annonceManager->updateAnonnce($annonce1);
$annonce2 = $annonceManager->getAnnonce(6);
print '<pre>================<br/>';
var_dump($annonce2);*/



#====TEST Expedition
/*$expeditionManager = new dao\ExpeditionsManager();
//$expedition = new dao\Expeditions($aExpedition);
//$expeditionManager->addExpeditions($expedition);

$expedition = $expeditionManager->getExpeditions(1, 1);
$expedition->setStatut(lib\Utils::EXPEDITION_TERMINE);
$expedition->setLastUpdate(date('Y-m-d H:i:s'));
$expeditionManager->updateExpedition($expedition);
$expedition = $expeditionManager->getExpeditions(1, 1);
print '<pre>';
var_dump($expedition);*/


#===TEST annonces
/*$annonceManager = new dao\AnnoncesManager();
//$annonce = new dao\Annonces($aAnnonce);
//$annonceManager->addAnnonce($annonce);

$annonce = $annonceManager->getAnnonce(1);

$annonce->setDateDepart(date('Y-m-d H:i:s'));
$annonce->setLastUpdate(date('Y-m-d H:i:s'));
$annonce->setStatut(lib\Utils::TRANSPORT_COLIS);

$annonceManager->updateAnonnce($annonce);

$annonce = $annonceManager->getAnnonce(1);
print '<pre>';
var_dump($annonce);*/



#==== TEST colis

/*$colisManager = new dao\colisManager();
//$colis = new dao\Colis($aColis);
//$colisManager->addColis($colis);


$colis = $colisManager->getColis(1);
$colis->setNom("Ouédraogo");
$colis->setPrenom("Alima");
$colis->setPoids(1.2);
$colis->setTaille('2*2*2');
$colis->setCategoryId(2);

$colisManager->updateColis($colis);
$colis = $colisManager->getColis(1);
print ('<pre>');
var_dump($colis); */


#====== TEST Users
/*$userManager = new dao\UserManager();
$param = ["mail"=>"admin@admin.net","password"=>"pass"];
$user = $userManager->getUser($param);
$user->setTelephone('+22670011022');
$user->setStatut(lib\Utils::TRANSPORTEUR);
$user->setAlert(TRUE);
$userManager->updateUser($user);
$user = $userManager->getUser($param);
print '<pre>';
var_dump($user);*/

#============TEST adresses
/*$adresseManager = new dao\AdressesManager();
//$adresse = new dao\Adresses($aAdresse);
//$rtr = $adresseManager->addAdresse($adresse);
$adresse = $adresseManager->getAdresse(1);
$adresse->setLibelle('1 Place Kossyam');
$adresse->setCodePostal('01 BP: 1000 Ouagadougou 01');
$adresse->setVille('Ouagadougou');
$adresse->setPays('Burkina Faso');
$adresseManager->updateAdresse($adresse);
$adresse = $adresseManager->getAdresse(1);
print '<pre>';
var_dump($adresse);*/














?>