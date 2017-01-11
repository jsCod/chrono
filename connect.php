<?php

use classes\models  as dao;
require 'classes/db.php';

$db = new dao\Db();

$con = $db->getConnexion();

print '<pre>==========================<br/>';
print_r($con);