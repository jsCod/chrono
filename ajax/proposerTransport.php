<?php session_start();
//header('Content-Type:text/html; charset=UTF-8');
header('Content-Type: application/json; charset=UTF-8');

use \classes\models  as dao;
use \classes\librairies as lib;

require_once '../classes/cls.utils.php';


$idAnnonce             = (int)$_POST['id_annonce'];
$userMessage           = $_POST['message'];

$from                  = $_SESSION['mail'];
$to                    = lib\Utils::CONTACT_MAIL;
$nomTransporteur       = $_SESSION['nom'];
$prenomTransporteur    = $_SESSION['prenom'];
$telephoneTransporteur = $_SESSION['telephone'];

$nomExpColis        = $_SESSION['voyageurNom'];
$prenomExpColis     = $_SESSION['voyageurPrenom'];
$telExpColis        = $_SESSION['voyageurTelphone'];
$mailExpColis       = $_SESSION['voyageurMail'];

$subject         =  $nomTransporteur . " propose de transporter le colis de l' annonce N° :".$idAnnonce;

$fromSenderMail    = lib\Utils::CONTACT_MAIL;
$toExpediteur      = $mailExpColis;
$subjectExpediteur = "Une offre de transport de votre  colis suite &agrave; votre annonce ";
$messageToExp = "L'administrateur prendra contact avec vous pour planifier la prise en compte du colis";
$messageToExp .= "\r\n vous pouvez nous contactez &agrave; contact@72hchrono.net pour plus de d&eacute;tails";

$message ="Bonjour Administrateur,";
$message .="<br/>";
$message .="<br/>".$nomTransporteur;
$message .="<br/>".$prenomTransporteur;
$message .="<br/> Telephone : ".$telephoneTransporteur;
$message .="<br/> Mail : ".$from;
$message .="<br/>";
$message .="<br/> propose de transporter le colis dont l'exp&eacute;diteur est :";
$message .="<br/>";
$message .="<br/> ".$nomExpColis ;
$message .="<br/> ".$prenomExpColis;
$message .="<br/> Telephone: ".$telExpColis;
$message .="<br/>  Mail :".$mailExpColis;
$message .="<br/> Annonce N° : ".$idAnnonce;
$message .="<br/> Merci de le contacter par mail ou telephone pour planifier une exp&eacute;dition";
$message .="<br/>";
$message .="<br/>";
$message .="<br/>************* Message de l'utilisateur :".$nomTransporteur." *************<br/>";
$message .="<br/>";
$message .="<br/>";
$message .= $userMessage;

$subject           = utf8_encode($subject);
$message           = utf8_encode($message);
$messageVoyageur   = utf8_encode($messageToExp);
$subjectExpediteur = utf8_encode($subjectExpediteur);

#Envoie d'un mail à l'annonceur
lib\Utils::sendMail("Admin", $fromSenderMail, $toExpediteur, $subjectExpediteur, $messageVoyageur);

#Envoie d'un mail à l'administrateur avec les informations utiles
echo lib\Utils::sendMail($nomTransporteur, $from, $to, $subject, $message)



?>