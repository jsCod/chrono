<?php
session_start();
$_SESSION = [];
echo session_destroy();
?>