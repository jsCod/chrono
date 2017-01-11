<?php namespace classes\models;
require_once 'cls.adresses.php';
require_once 'cls.adressesManager.php';

class Colis
{
   private $id,
			$poids,
			$taille,
			$nom,
			$prenom,
			$telephone,
			$last_update,
			$statut,
			$category_id;
	
			
	function __construct( array $aColis)
	{
		
	 if(isset($aColis['id']))
	 $this->id             = $aColis['id'];
	 $this->poids 			= $aColis['poids'];
	 $this->taille 			= $aColis['taille'];
	 $this->nom	            = $aColis['nom'];
	 $this->prenom	        = $aColis['prenom'];
	 $this->telephone	    = $aColis['telephone'];
	 $this->last_update 	= $aColis['last_update'];
	 $this->statut 			= $aColis['statut'];
	 $this->category_id 	= $aColis['category_id'];
 
	}

	#========== Getters
	public function getId()
	{
	 return $this->id;
	}
	public function getPoids()
	{
	 return $this->poids;
	}
	public function getTaille()
	{
	 return $this->taille;
	}
	public function getNom()
	{
	 return $this->nom;
	}
	public function getPrenom()
	{
		return $this->prenom;
	}
	
	public function getTelephone() 
	{
	  return $this->telephone;
	}
	
	public function setTelephone($value) 
	{
	  $this->telephone = $value;
	}
	public function getLastUpdate()
	{
	 return $this->last_update;
	}
	public function getStatut ()
	{
	 return $this->statut ;
	}
	
	public function getCategoryId()
	{
	 return $this->category_id;
	}
	
	
	#======== Setters 
	public function setId($val)
	{
		$this->id = $val;
	}
	public function setPoids($val)
	{
	 $this->poids = $val;
	}
	public function setTaille($val)
	{
	  $this->taille = $val;
	}
	public function setNom($val)
	{
	$this->nom = $val;
	}
	public function setPrenom($val)
	{
		$this->prenom = $val;
	}
	public function setLastUpdate($val)
	{
	
	  $this->last_update = $val;
	}
	public function setStatut($val)
	{
	 $this->statut = $val;
	}
	
	public function setCategoryId($val)
	{
	  $this->category_id = $val;
	}
	

	
}//Enc colis class

?>