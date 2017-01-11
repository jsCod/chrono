<?php
header('Content-Type: application/json; charset=UTF-8');

use \classes\models  as dao;
use \classes\librairies as lib;

require_once '../classes/cls.expeditionsManager.php';


$expeditionManager = new dao\ExpeditionsManager();

$expeditions  = $expeditionManager->getAllExpeditions();

echo json_encode($expeditions);



?>