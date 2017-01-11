<?php

namespace classes\models;

class Expeditions
{
   private $id_transporteur,
			$id_colis,
			$date_planif,
			$last_update,
			$statut;
	
			
	public function __construct( array $aExpedition)
	{
      $this->id_transporteur = $aExpedition['id_transporteur'];
      $this->id_colis        = $aExpedition['id_colis'];
      $this->date_planif     = $aExpedition['date_planif'];
      $this->last_update     = $aExpedition['last_update'];
      $this->statut          = $aExpedition['statut'];
	}

	#========== Getters
	public function getIdTransporteur()
	{
	 return $this->id_transporteur;
	}
	public function getIdColis()
	{
	 return $this->id_colis;
	}
	public function getDatePlanif()
	{
	 return $this->date_planif;
	}
	public function getLastUpdate()
	{
	 return $this->last_update;
	}
	public function getStatut()
	{
	 return $this->statut;
	}
	
	#======== Setters 
	public function setIdTransporteur($val)
	{
	 $this->id_transporteur = $val;
	}
	public function setIdColis($val)
	{
	  $this->id_colis = $val;
	}
	public function setDatePlanif($val)
	{
		$this->date_planif = $val;
	}
	public function setLastUpdate($val)
	{
	
	  $this->last_update = $val;
	}
	public function setStatut($val)
	{
	 $this->statut = $val;
	}
	
}//Enc Expeditions class

?>