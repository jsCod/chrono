<?php
/**
 * 
 * Joseph SILGA <silga.dev@gmail.com>
 * @date 2016-11-16
 * 
 */

namespace classes\models;

class Annonces {

	/**
	 * 
	 * @var int
	 * @access private
	 */
	private  $id;

	/**
	 * 
	 * @var int
	 * @access private
	 */
	private  $statut;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private  $date_annonce;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private  $date_depart;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $date_arrive;
	/**
	 * 
	 * @var string
	 * @access private
	 */
	private  $last_update;

	/**
	 * 
	 * @var int
	 * @access private
	 */
	private  $id_user;

	/**
	 * 
	 * @var int
	 * @access private
	 */
	private  $id_adresse;

	/**
	 * 
	 * @var int
	 * @access private
	 */
	private  $id_colis;
	

	public function __construct(array $aAnnonce)
	{
	  if(isset($aAnnonce['id']))
	  	$this->id             = $aAnnonce['id'];
	    $this->statut         = $aAnnonce["statut"];
	    $this->date_annonce   = $aAnnonce["date_annonce"];
	    $this->date_depart    = $aAnnonce["date_depart"];
	    $this->date_arrive    = $aAnnonce["date_arrive"];
	    $this->last_update    = $aAnnonce["last_update"];
	    $this->id_user        = $aAnnonce["id_user"];
	    $this->id_adresse     = $aAnnonce["id_adresse"];
	    $this->id_colis       = $aAnnonce["id_colis"];	
	}
	
	
	//==========Getters Setters
	
	public function getId() 
	{
	  return $this->id;
	}
	
	public function setId($value) 
	{
	  $this->id = $value;
	}
	
	
	public function getStatut() 
	{
	  return $this->statut;
	}
	
	public function setStatut($value) 
	{
	  $this->statut = $value;
	}
	
	public function getDateAnnonce() 
	{
	  return $this->date_annonce;
	}
	
	public function setDateAnnonce($value) 
	{
	  $this->date_annonce  = $value;
	}
	
	
	public function getDateDepart() 
	{
	  return $this->date_depart;
	}
	
	public function setDateDepart($value) 
	{
	  $this->date_depart = $value;
	}
	
	public function getDateArrive()
	{
		return $this->date_arrive;
	}
	
	public function setDateArrive($value)
	{
		$this->date_arrive = $value;
	}
	
	public function getLastUpdate() 
	{
	  return $this->last_update;
	}
	
	public function setLastUpdate($value) 
	{
	  $this->last_update = $value;
	}
	
	public function getIdUser() 
	{
	  return $this->id_user;
	}
	
	public function setIdUser($value) 
	{
	  $this->id_user = $value;
	}
	
	
	public function getIdAdresse() 
	{
	  return $this->id_adresse;
	}
	
	public function setIdAdresse($value) 
	{
	  $this->id_adresse = $value;
	}
	
	
	public function getIdColis() 
	{
	  return $this->id_colis;
	}
	
	public function setIdColis($value) 
	{
	  $this->id_colis = $value;
	}
	
	

}//end class annonces
?>