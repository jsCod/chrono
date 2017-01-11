<?php session_start();
header('Content-Type: application/json; charset=UTF-8');
use \classes\models  as dao;
use \classes\librairies as lib;

require_once '../classes/cls.userManager.php';
require_once '../classes/cls.user.php';

if(isset($_SESSION['userid']))
{
  $userManager = new dao\UserManager();
  if(isset($_POST["idVoyageur"]))
  {
   $id = (int)$_POST["idVoyageur"];
  }
  else
  {
   $id = (int)$_POST["idExpediteur"];
  }
  
  $voyageur   = $userManager->getUser($id);
  
  $_SESSION['voyageurNom']      = $voyageur->getNom() ;
  $_SESSION['voyageurPrenom']   = $voyageur->getPrenom();
  $_SESSION['voyageurTelphone'] = $voyageur->getTelephone();
  $_SESSION['voyageurMail']     = $voyageur->getMail();
    
	$aUser = [
			"id"=>$_SESSION['userid'],
		    "nom"=>$_SESSION['nom'],
	        "prenom"=>$_SESSION['prenom'],
			"mail"=>$_SESSION['mail'],
			"voyageurNom"=>$voyageur->getNom(),
			"voyageurPrenom"=>$voyageur->getPrenom(),
			"voyageurMail"=>$voyageur->getMail(),
			"voyageurTelphone"=>$voyageur->getTelephone()
	        ] ;
	echo json_encode($aUser);
}
else 
{
	echo 0;
}