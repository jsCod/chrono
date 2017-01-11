<?php 
/**
 * @author Joseph SILGA <silga.dev@gmail.com>
 * @date   2016-11-11
 * 
 *
 */

namespace classes\models;

class User
{
	/**
	 *
	 * @var int
	 * @access private
	 */
	private  $id;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $nom;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $prenom;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $telephone;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $mail;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $password;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $statut;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $date_inscription;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $last_update;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private  $identite;
		
	/**
	 *
	 * @var boolean
	 * @access private
	 */
	private  $alert;
	
	/**
	 *
	 * @var int
	 * @access private
	 */
	private  $id_proflis;
	
	/**
	 *
	 * @var int
	 * @access private
	 */
	private  $id_adresse;
	
    
	public function __construct(array $aUser){
		
	 if(isset($aUser['id'])) 
	 $this->id        = $aUser['id'];
	 $this->nom       = $aUser['nom'];
     $this->prenom    = $aUser['prenom'];
     $this->telephone = $aUser['telephone'];
     $this->mail      = $aUser['mail'];
     $this->password  = $aUser['password'];
     $this->statut    = $aUser['statut'];
     $this->date_inscription = $aUser['date_inscription'];
     $this->identite         = $aUser['identite'];
     $this->last_update      = $aUser['last_update'];
     $this->alert            = $aUser['alert'];
     $this->id_proflis       = $aUser['id_profils'];
     $this->id_adresse       = $aUser['id_adresse'];
	
	}//
 
    public function getId() 
    {
      return $this->id;
    }
    
    public function setId($value) 
    {
      $this->id = $value;
    }
	
    
    public function getNom() 
    {
      return $this->nom;
    }
    
    public function setNom($value) 
    {
      $this->nom = $value;
    }
    
    public function getPrenom() 
    {
      return $this->prenom;
    }
    
    public function setPrenom($value) 
    {
      $this->prenom = $value;
    }
   
    
    public function getTelephone() 
    {
      return $this->telephone;
    }
    
    public function setTelephone($value) 
    {
      $this->telephone = $value;
    }
    
    
    public function getMail() 
    {
      return $this->mail;
    }
    
    public function setMail($value) 
    {
      $this->mail = $value;
    }
    
    
    public function getPassword() 
    {
      return $this->password;
    }
    
    public function setPassword($value) 
    {
      $this->password = $value;
    }
    
    
    public function getStatut() 
    {
      return $this->statut;
    }
    
    public function setStatut($value) 
    {
      $this->statut = $value;
    }
    
    
    public function getDateInscription() 
    {
      return $this->date_inscription;
    }
    
    public function setDateInscription($value) 
    {
      $this->date_inscription = $value;
    }
    
    
    public function getLastUpdate() 
    {
      return $this->last_update;
    }
    
    public function setLastUpdate($value) 
    {
      $this->last_update = $value;
    }
     
     public function getIdentite() 
     {
       return $this->identite;
     }
     
     public function setIdentite($value) 
     {
       $this->identite = $value;
     }
    
    public function getAlert() 
    {
      return $this->alert;
    }
    
    public function setAlert($value=FALSE) 
    {
      $this->alert = $value;
    }
    
    
    public function getIdProfils() 
    {
      return $this->id_proflis;
    }
    
    public function setIdProfils($value) 
    {
      $this->id_proflis = $value;
    }
    
    public function getIdAdresse() 
    {
      return $this->id_adresse;
    }
    
    public function setIdAdresse($value) 
    {
      $this->id_adresse = $value;
    }
    
        
}//End User
?>