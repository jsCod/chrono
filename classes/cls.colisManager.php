<?php namespace classes\models;
require_once 'cls.colis.php';
require_once 'cls.db.php';

class colisManager
{
   private $db;
   
   function __construct()
   {
	   new Db();
	   $this->db = Db::getConnexion();
   }
   
   public function addColis(Colis $colis)
	{	
	  $q = $this->db->prepare('INSERT INTO colis (poids,taille,nom,prenom,telephone,last_update,statut,category_id)
                                                VALUES
                                                (:poids,:taille,:nom,:prenom,:telephone,:last_update,:statut,:category_id)');
	   $q->bindValue(':poids',$colis->getPoids());
	   $q->bindValue(':taille',$colis->getTaille());
	   $q->bindValue(':nom',$colis->getNom()); 
	   $q->bindValue(':prenom',$colis->getPrenom()); 
	   $q->bindValue(':telephone',$colis->getTelephone());
	   $q->bindValue(':last_update',$colis->getLastUpdate());
	   $q->bindValue(':statut',$colis->getStatut());
	   $q->bindValue(':category_id',$colis->getCategoryId());
	  
	   //return $q->execute(); //bool(true)  if OK
	   try
	   {
		 $q->execute() ; 		////bool(true)  if OK	 
		 return $this->db->lastInsertId();
	   }
	   catch(PDOExeption $e)
	   {
		   echo $e->getMessage();
	   }
		
	}
	
	public function getColis($id)
	{
		$q = $this->db->prepare('SELECT * FROM  colis  WHERE id = :id');
		
		$q->execute( array(':id'=>$id)  );
		
		if($q->rowCount() == 1)
		{ 
		  
		 return  new Colis($q->fetch(\PDO::FETCH_ASSOC));			  
		
		 /* while($row = $q->fetch(\PDO::FETCH_ASSOC))
		  {
			$colis[] = $row ;
		  }
			return $colis; */
		}
	    return false;
	}

    public function updateColis(Colis $colis)
    {
    	
    	$q = $this->db->prepare('UPDATE colis SET poids  = :poids,
    											  taille = :taille,
    			                                  nom    = :nom,
  			                                      prenom = :prenom,
    			                                  telephone = :telephone,
  												  statut = :statut,
    			                                  category_id = :category_id
  			                                 WHERE id = :id'
    	                        );
    	 
    	$q->bindValue(':poids',$colis->getPoids());
    	$q->bindValue(':taille',$colis->getTaille());
    	$q->bindValue(':nom',$colis->getNom(),\PDO::PARAM_STR);
    	$q->bindValue(':prenom',$colis->getPrenom(),\PDO::PARAM_STR);
    	$q->bindValue(':telephone',$colis->getTelephone(),\PDO::PARAM_STR);
    	$q->bindValue(':statut', $colis->getStatut(),\PDO::PARAM_STR);
    	$q->bindValue(':category_id', $colis->getCategoryId(),\PDO::PARAM_INT);
    	$q->bindValue(':id', $colis->getId(),\PDO::PARAM_INT);
    	
    	 
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
	
	
	
	
	
	
} //End class colisManager

?>