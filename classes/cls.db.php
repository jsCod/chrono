<?php namespace classes\models;
use classes\librairies as lib;
require_once "cls.utils.php";

class Db
{
	private $user;
	private $pass;
	private $host;
	private $port;
	private $dbname; //utf8_general_ci
	private static $con;
	
	public function __construct()
	{
	//Cas de changement de base, construire !
		/*if (self::$con instanceof PDO )	
		return self::$con;*/
		
	$conf         = lib\Utils::getConfig('prod');
	$this->host   = $conf['dbhost'];
	$this->dbname = $conf['dbname'];
	$this->user   = $conf['dbuser'];
	$this->pass   = $conf['password'];
	$this->port   = $conf['dbport'];
	
	  try
		{
		   self::$con = new \PDO("mysql:host=".$this->getHost().";dbname=".$this->getDbname().";charset=utf8", $this->getUser(), $this->getPass());
		   self::$con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		   
		} catch (\PDOException $e) 
		{
			echo 'Connexion échouée : ' . $e->getMessage();
		}
	}
	
	public static function getConnexion()
	{
		return self::$con;	
	}

	public function getHost()
	{
		return $this->host;
	}
	public function getDbname()
	{
		return $this->dbname;
	}
	public function getUser()
	{
		return $this->user;
	}
	public function getPass()
	{
		return $this->pass;
	}
}//End Db

?>