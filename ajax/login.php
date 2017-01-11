<?php session_start();
header('Content-Type:text/html; charset=UTF-8');

use \classes\models  as dao;
use \classes\librairies as lib;

require_once '../classes/cls.userManager.php';
require_once '../classes/cls.user.php';
require_once '../classes/cls.adressesManager.php';

$params['mail']      = $_POST['mail'];
$params['password']  = $_POST['password'];


$userManager = new dao\UserManager();
$user = $userManager->getUser($params);

if($user)
{
  session_regenerate_id();
  $id_adresse = $user->getIdAdresse();
  $adresseManager  = new dao\AdressesManager();
  $adresse = $adresseManager->getAdresse($id_adresse);
  
  $_SESSION['user']    = serialize($user);
  $_SESSION['adresse'] = serialize($adresse);
  
  $_SESSION['userid']  = $user->getId();
  $_SESSION['nom']     = $user->getNom();
  $_SESSION['prenom']  = $user->getPrenom();	  
  $_SESSION['mail']    = $user->getMail();
  $_SESSION['telephone'] = $user->getTelephone();
  
  $_SESSION['id_profils'] = $user->getIdProfils();
 
  
  $userInfo = ["nom"=>$user->getNom(),
			   "prenom"=>$user->getPrenom(),
			   "mail"=>$user->getMail(),
			   "id_profils"=>$user->getIdProfils()
			  ];
  echo json_encode($userInfo);
}
else
{
	echo 0;
}


?>