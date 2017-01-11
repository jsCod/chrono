<?php session_start();
header('Content-Type:text/html; charset=UTF-8');

use \classes\models  as dao;
use \classes\librairies as lib;

require_once '../classes/cls.userManager.php';

$userManager = new dao\UserManager();

echo  $userManager->emailExist($_POST['mail']) ;



?>