<?php 

namespace classes\models;
require_once 'cls.expeditions.php';
require_once 'cls.db.php';

class ExpeditionsManager
{
   private $db;
   
   function __construct()
   {
	   new Db();
	   $this->db = Db::getConnexion();
   }
   
   public function addExpeditions(Expeditions $expedition)
	{	
	  $q = $this->db->prepare('INSERT INTO expeditions (id_transporteur,id_colis,date_planif,last_update,statut)
                                                VALUES
                                                (:id_transporteur,:id_colis,:date_planif,:last_update,:statut)');
	   $q->bindValue(':id_transporteur',$expedition->getIdTransporteur(),\PDO::PARAM_INT);
	   $q->bindValue(':id_colis',$expedition->getIdColis(),\PDO::PARAM_INT);
	   $q->bindValue(':date_planif',$expedition->getDatePlanif()); 
	   $q->bindValue(':last_update',$expedition->getLastUpdate());
	   $q->bindValue(':statut',$expedition->getStatut());
	   
	   //return $q->execute(); //bool(true)  if OK
	   try
	   {
		 return $q->execute() ; 		////bool(true)  if OK	 
	   }
	   catch(PDOExeption $e)
	   {
		   echo $e->getMessage();
	   }
		
	}

	public function getExpeditions($id_user,$id_colis)
	{
		$q = $this->db->prepare('SELECT * FROM  expeditions  WHERE id_transporteur = :id_transporteur AND id_colis = :id_colis');
		
		$q->execute( array(':id_transporteur'=>$id_user,':id_colis'=>$id_colis) );
		
		if($q->rowCount() == 1)
		{
		
			return  new Expeditions($q->fetch(\PDO::FETCH_ASSOC));
		
			/* while($row = $q->fetch(\PDO::FETCH_ASSOC))
			 {
			 Expeditions[] = $row ;
			 }
			return Expeditions; */
		}
		return false;
		
	}
    public function updateExpedition(Expeditions $expedition)
    {
    	$q = $this->db->prepare('UPDATE expeditions  SET  date_planif = :date_planif,
    			                                          last_update = :last_update,
    			                                          statut = :statut
    			                                     WHERE id_transporteur = :id_transporteur
    			                                     AND id_colis = :id_colis');
    	$q->bindValue(':date_planif',$expedition->getDatePlanif());
    	$q->bindValue(':last_update',$expedition->getLastUpdate());
    	$q->bindValue(':statut',$expedition->getStatut(),\PDO::PARAM_INT);
    	$q->bindValue(':id_transporteur',$expedition->getIdTransporteur(),\PDO::PARAM_INT);
    	$q->bindValue(':id_colis',$expedition->getIdColis(),\PDO::PARAM_INT);
    	
    	return $q->execute();
    }
	
    
    public function getAllExpeditions()
    {
    	$aResult = [];
    	
    	$statut =[1=>"En cours", 2=>"Terminée"];
    	
    	$sql="SELECT u.id as idtransporteur,u.nom nomtransporteur,u.prenom as prenomtransporteur,
				       c.id as colisId,c.nom as nomdestinataire, c.prenom as prenomdestinataire,
					   e.date_planif,e.statut, ca.nom as categorie, a.id_adresse as idDestination,ad.ville as villedestination, ad.pays as paysdestination
					   from 
					   expeditions e
					   JOIN users u ON e.id_transporteur = u.id
					   JOIN colis c ON e.id_colis       = c.id
					   JOIN category ca ON c.category_id   = ca.id
					   JOIN annonces a  ON c.id = a.id_colis
					   JOIN adresses ad   ON a.id_adresse = ad.id
    			       WHERE 1=1";
    	
    	$q = $this->db->query($sql,\PDO::FETCH_ASSOC);
    	
    	while ($row = $q->fetch(\PDO::FETCH_ASSOC) ) //fetchAll si pas de where
    	{
    		$row['transporteur']     = ucfirst(mb_strtolower($row["prenomtransporteur"],'UTF-8')) . ' '.strtoupper(substr($row["nomtransporteur"], 0,1)).'.';
    		$row['destinataire']     = ucfirst(mb_strtolower($row["prenomdestinataire"],'UTF-8')) . ' '.strtoupper(substr($row["nomdestinataire"], 0,1)).'.';
    		$row['paysdestination']  = ucfirst(mb_strtolower($row["paysdestination"],'UTF-8'));
    		$row['villedestination'] = ucfirst(mb_strtolower($row["villedestination"],'UTF-8'));
    		$row['statut']           = ucfirst(mb_strtolower($statut[$row["statut"]],'UTF-8'));
    		
    		$aResult[] = $row ;
    	}
    	 
    	return $aResult;
    	
    }
    
    
    
    
} //End class colisManager

?>