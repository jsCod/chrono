<?php namespace classes\models;
require_once 'cls.adresses.php';
require_once 'cls.db.php';

class AdressesManager
{
	private $db;
   
   function __construct()
   {
	   new Db();
	   $this->db = Db::getConnexion();
   }
   
   
   public function addAdresse(Adresses $adresse)
	{	
	 
	  $q = $this->db->prepare('INSERT INTO adresses (libelle,code_postal,ville,pays)
                                                VALUES
                                                (:libelle,:code_postal,:ville,:pays)');
	   $q->bindValue(':libelle',$adresse->getLibelle(),\PDO::PARAM_STR);
	   $q->bindValue(':code_postal',$adresse->getCodePostal());
	   $q->bindValue(':ville',$adresse->getVille(),\PDO::PARAM_STR);
	   $q->bindValue(':pays',$adresse->getPays(),\PDO::PARAM_STR); 
	
       try
	   {
		 $q->execute(); //bool(true)  if OK	
		 return $this->db->lastInsertId();		 
	   }
	   catch(PDOExeption $e)
	   {
		   echo $e->getMessage();
	   }
	}
  
	 public  function getAdresse($id)
	 {
	 	$q = $this->db->prepare('SELECT * FROM  adresses WHERE id=:id');
	 	$q->execute(array(':id'=>$id));
	 	
	 	if($q->rowCount() == 1)
	 	{
	 		return new Adresses($q->fetch(\PDO::FETCH_ASSOC));
	 	}
	 	return false;
	 }
	 
  public function updateAdresse(Adresses $adresse)
  {
  	$q = $this->db->prepare('UPDATE adresses SET libelle=:libelle,
  			                                     code_postal=:code_postal,
  			                                     ville=:ville,
  												 pays=:pays
  			                                 WHERE id=:id'
  			                );
  	
  	$q->bindValue(':libelle',$adresse->getLibelle(),\PDO::PARAM_STR);
  	$q->bindValue(':code_postal',$adresse->getCodePostal());
  	$q->bindValue(':ville',$adresse->getVille(),\PDO::PARAM_STR);
  	$q->bindValue(':pays',$adresse->getPays(),\PDO::PARAM_STR);
  	$q->bindValue(':id', $adresse->getId(),\PDO::PARAM_INT);
  	
  	try
  	{
  		return $q->execute(); //bool(true)  if OK
  		//return $this->db->lastInsertId(); //Retour quoi?
  	}
  	catch(PDOExeption $e)
  	{
  		echo $e->getMessage();
  	}
  	
  }
	
	
}//end class AdressesManager


?>