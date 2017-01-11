<?php session_start();
//header('Content-Type:text/html; charset=UTF-8');
header('Content-Type: application/json; charset=UTF-8');

use \classes\models  as dao;
use \classes\librairies as lib;

require_once '../classes/cls.userManager.php';
require_once '../classes/cls.utils.php';

$idAnnonce = (int)$_POST['id_annonce'];
$userMessage   = $_POST['message'];

$from         = $_SESSION['mail'];
$to           = lib\Utils::CONTACT_MAIL;
$expName      = $_SESSION['nom'];
$expPrenom    = $_SESSION['prenom'];
$expTelephone = $_SESSION['telephone'];

$voyageurNom        = $_SESSION['voyageurNom'];
$voyageurPrenom     = $_SESSION['voyageurPrenom'];
$voyageurTelephone  = $_SESSION['voyageurTelphone'];
$voyageurMail       = $_SESSION['mail'];

$subject         = "Un colis propos&eacute; à transporter par ".$voyageurNom." suite son annonce Num&eacute;ro :".$idAnnonce;

$fromVoyageur    = lib\Utils::CONTACT_MAIL;
$toVoyageur      = $voyageurMail;
$subjectVoyageur = "Une proposition de  colis &agrave; transporter suite  &agrave; votre annonce";
$messageVoyageur = "L'administrateur prendra contact avec vous pour planifier la prise en compte du colis";
$messageVoyageur .= "\r\n vous pouvez nous contactez &agrave; contact@72hchrono.net pour plus de d&eacute;tails";

$message ="Bonjour Administrateur,";
$message .="<br/>";
$message .="<br/>".$expName;
$message .="<br/>".$expPrenom;
$message .="<br/> Telephone : ".$expTelephone;
$message .="<br/> Mail : ".$from;
$message .="<br/>";
$message .="<br/> propose un colis au voyageur :";
$message .="<br/>";
$message .="<br/> ".$voyageurNom ;
$message .="<br/> ".$voyageurPrenom;
$message .="<br/> Telephone: ".$voyageurTelephone;
$message .="<br/>  Mail :".$voyageurMail;
$message .="<br/> Annonce N &deg; : ".$idAnnonce;
$message .="<br/> Merci de le contacter par mail ou telephone pour planifier une exp&eacute;dition";
$message .="<br/>";
$message .="<br/>";
$message .="<br/>************* Message de l'utilisateur :".$expPrenom." ***************<br/>";
$message .="<br/>";
$message .="<br/>";
$message .= $userMessage;

$subject         = utf8_encode($subject);
$message         = utf8_encode($message);
$messageVoyageur = utf8_encode($messageVoyageur);
$subjectVoyageur = utf8_encode($subjectVoyageur);

#Envoie d'un mail à l'annonceur
lib\Utils::sendMail("Admin", $fromVoyageur, $toVoyageur, $subjectVoyageur, $messageVoyageur);

#Envoie d'un mail à l'administrateur avec les informations utiles
echo lib\Utils::sendMail($expPrenom, $from, $to, $subject, $message);



?>