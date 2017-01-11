<?php
header('Content-Type: application/json; charset=UTF-8');

use \classes\models  as dao;
use \classes\librairies as lib;

require_once '../classes/cls.annoncesManager.php';
  
$annonceManager = new dao\AnnoncesManager();

$transporteur   = $annonceManager->getAnnoncesTransports();

echo json_encode($transporteur);







?>