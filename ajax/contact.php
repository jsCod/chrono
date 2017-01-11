<?php session_start();
header('Content-Type:text/html; charset=UTF-8');

use \classes\models  as dao;
use \classes\librairies as lib;

require_once '../classes/cls.utils.php';

$nom     = $_POST['nom'];
$email   = $_POST['email'];
$message = $_POST['message'];
$alertme = $_POST['alertme'];


$to      =lib\Utils::CONTACT_MAIL;
$from    = $email;
$subject ="Prise de contact";

// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// En-têtes additionnels
$headers .= 'To: Administrateur <'.$to.'>' . "\r\n";
$headers .= 'From: '.$nom .' <'.$from .'>' . "\r\n";
//$headers .= 'Cc: anniversaire_archive@example.com' . "\r\n";
//$headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";
$headers .= 'Reply-To: <'.$from.'> ' . "\r\n";
$headers .= 'Subject: <'.$subject.'> ' . "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

$subject = utf8_encode($subject);
$message = utf8_encode($message);

if(mail($to,$subject,$message,$headers))
{
 	echo "Votre message a bien été envoyé, Nous reviendrons vers vous assez rapidement!";	
}
else
{
	echo "Désolé, une erreur est survenue.";
}





?>