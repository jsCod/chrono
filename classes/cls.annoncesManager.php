<?php 

namespace classes\models;

require_once 'cls.annonces.php';
require_once 'cls.db.php';

class AnnoncesManager
{
	private $db;
   
   function __construct()
   {
	   new Db();
	   $this->db = Db::getConnexion();
   }
   
   
   public function addAnnonce(Annonces $annonce)
	{	
	 
	  $q = $this->db->prepare('INSERT INTO annonces (statut,date_annonce,date_depart,date_arrive,last_update,id_user,id_adresse,id_colis)
                                                VALUES
                                                (:statut,:date_annonce,:date_depart,:date_arrive,:last_update,:id_user,:id_adresse,:id_colis)');
	  
	   $q->bindValue(':statut',$annonce->getStatut(),\PDO::PARAM_INT);
	   $q->bindValue(':date_annonce',$annonce->getDateAnnonce());
	   $q->bindValue(':date_depart',$annonce->getDateDepart());
	   $q->bindValue(':date_arrive',$annonce->getDateArrive());
	   $q->bindValue(':last_update',$annonce->getLastUpdate()); 
	   $q->bindValue(':id_user', $annonce->getIdUser(),\PDO::PARAM_INT);
	   $q->bindValue(':id_adresse', $annonce->getIdAdresse(),\PDO::PARAM_INT);
	   $q->bindValue(':id_colis', $annonce->getIdColis(),\PDO::PARAM_INT);
	
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
  
	 public  function getAnnonce($param)
	 {
	 	$where=null;
	 	
	 	if(is_int($param))
	 	{
	 		$sql='SELECT * FROM  annonces WHERE id=:id';
	 	}
	 	elseif(is_array($param) && count($param) > 0)
	 	{
	 		$sql='SELECT * FROM  annonces WHERE ';
	 		
	 	}
	 	
	 	else 
	 		
	 	 throw new \Exception("Paramètre invalide : ".$param ." <br/> dans :" .__FILE__ ." Function :" .__FUNCTION__);
	 	
	 	$q = $this->db->prepare($sql);
	 	$q->execute(array(':id'=>$param));
	 	
	 	if($q->rowCount() == 1)
	 	{
	 		return new Annonces($q->fetch(\PDO::FETCH_ASSOC));
	 	}
	 	return false;
	 }
	 
  public function updateAnonnce(Annonces $annonce)
  {
  	$q = $this->db->prepare('UPDATE annonces SET statut=:statut,
  			                                     date_depart =:date_depart,
  												 date_arrive =:date_arrive  			                                    
  			                                     WHERE id=:id'
  			                );
  	
  	$q->bindValue(':statut',$annonce->getStatut());
  	$q->bindValue(':date_depart',$annonce->getDateDepart());
  	$q->bindValue(':date_arrive',$annonce->getDateArrive());
  	$q->bindValue(':id', $annonce->getIdAdresse());
  	
  	try
  	{
  		return  $q->execute(); //bool(true)  if OK
  	}
  	catch(PDOExeption $e)
  	{
  		echo $e->getMessage();
  	}
  	
  }
	
  
  public function updateListeAnnonces( $idAnnonces, $statut)
  {
  	if(is_int($idAnnonces))
  	{
  	 $sql="UPDATE annonces SET statut=:statut,
  	 		                   date_depart=:date_depart
  	 		                   WHERE id=:id";
  	 $q = $this->db->prepare($sql);
  	 $q->bindValue(':statut', $statut);
  	 $q->bindValue(':date_depart', date("Y-m-d H:i:s"));
  	 $q->bindValue(':id', $idAnnonces);
  	}
  	elseif (is_array($idAnnonces) && count($idAnnonces) > 0)
  	{
  	  $sql="UPDATE annonces SET statut=:statut,
  	  							date_depart=:date_depart
  	  		                    WHERE id IN (".implode(",", $idAnnonces).") ";
  	  $q = $this->db->prepare($sql);
  	  $q->bindValue(':statut', $statut);
  	  $q->bindValue(':date_depart', date("Y-m-d H:i:s"));
  	}
  	
  	return $q->execute();
  	
  }
  
  
  public function getAnnoncesTransports()
  {
  	$aResult=[];
  	/*$sql="select a.id as id_annonce,a.date_depart,a.date_arrive,
		         u.id as id_user, u.nom, u.prenom, u.telephone,
		         ad.ville,ad.pays
			     from annonces a 
				   JOIN users u ON a.id_user = u.id
				   JOIN adresses ad ON a.id_adresse = ad.id
				   AND unix_timestamp(a.date_depart) > unix_timestamp(NOW())
				   AND a.statut =0";*/
  	$sql="select a.id as id_annonce,a.date_depart,a.date_arrive,
			  	u.id as id_user, u.nom, u.prenom, u.telephone,u.id_adresse as idAdressedepart,
			  	ad.ville as villedestination,ad.pays as paysdestination,ad2.ville as villedepart,ad2.pays as paysdepart
			  	from annonces a
			  	JOIN users u ON a.id_user = u.id
			  	JOIN adresses ad ON a.id_adresse = ad.id
			  	JOIN adresses ad2 ON u.id_adresse = ad2.id
			  	AND unix_timestamp(a.date_depart) > unix_timestamp(NOW())
			  	AND a.statut =0 ";
  	
  	 $q = $this->db->query($sql,\PDO::FETCH_ASSOC);
  	 
  	 while ($row = $q->fetch(\PDO::FETCH_ASSOC) )
  	 {
  	    $row['voyageur']           = ucfirst(mb_strtolower($row["prenom"],'UTF-8')) . ' '.strtoupper(substr($row["nom"], 0,1)).'.';
  	 	$row['paysdepart']         = ucfirst(mb_strtolower($row["paysdepart"],'UTF-8'));
  	    $row['villedepart']        = ucfirst(mb_strtolower($row["villedepart"],'UTF-8')) ;
  	 	$row['paysdestination']    = ucfirst(mb_strtolower($row["paysdestination"],'UTF-8')) ;
  	 	$row['villedestination']   = ucfirst(mb_strtolower($row["villedestination"],'UTF-8')) ;	
  	 	$aResult[] = $row ;
  	 	
  	 }
  	
  	 return $aResult;
  }
  
  public function getAnnoncesCommissions()
  {
  	$aResult=[];
  	
  	$sql="select a.id as id_annonce,a.date_annonce,
			       c.id as id_colis,c.nom,c.prenom , c.telephone,
				   ca.nom as categorie,
			       ad.ville, ad.pays,
                   ad2.ville as villeexp, ad2.pays paysexp,
                   u.id idexp , u.nom as nomexp, u.prenom as prenomexp,u.id_adresse as idAdresseexp
				   from annonces a
                   JOIN users u ON   a.id_user   = u.id
				   JOIN adresses ad  ON a.id_adresse = ad.id
                   JOIN adresses ad2 ON u.id_adresse = ad2.id
				   JOIN colis    c  ON a.id_colis   = c.id
				   JOIN category ca ON c.category_id = ca.id
				   AND a.statut =1";
  	
  	$q = $this->db->query($sql,\PDO::FETCH_ASSOC);
  	
  	while ($row = $q->fetch(\PDO::FETCH_ASSOC) )
  	{   //Formattage des données pour la sortie
  		$row['expediteur']    = ucfirst(mb_strtolower($row["prenomexp"],'UTF-8')) . ' '.strtoupper(substr($row["nomexp"], 0,1)).'.';
  		$row['destinataire']  = ucfirst(mb_strtolower($row["prenom"],'UTF-8')) . ' '.strtoupper(substr($row["nom"], 0,1)).'.';
  		$row['pays']          = ucfirst(mb_strtolower($row["pays"],'UTF-8'));
  		$row['ville']         = ucfirst(mb_strtolower($row["ville"],'UTF-8'));
  		$row['villeexp']      = ucfirst(mb_strtolower($row["villeexp"],'UTF-8'));
  		$row['paysexp']       = ucfirst(mb_strtolower($row["paysexp"],'UTF-8'));
  		//Collecte des données dans le tableau
  		$aResult[] = $row ;
  	}
  	 
  	return $aResult;
  }
	
  
}//end class AdressesManager


?>