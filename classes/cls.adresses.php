<?php namespace classes\models;
class Adresses
{
	private $id,
			$libelle,
			$code_postal,
			$ville,
			$pays;
			
			
	public function __construct( array $aAdresse)
	{   
		
		if(isset($aAdresse['id']))
		$this->id          = $aAdresse['id'];	
	    $this->libelle     = $aAdresse['libelle'];
		$this->code_postal = $aAdresse["code_postal"];
	    $this->ville       = $aAdresse["ville"];
		$this->pays        = $aAdresse["pays"];
		
	}
	
	#Getters
	public function getId()
	{
		return $this->id;
	}
	
	public function getLibelle()
	{
		return $this->libelle;
	}
	public function getCodePostal()
	{
		return $this->code_postal;
	}
	public function getVille()
	{
		return $this->ville;
	}
	public function getPays()
	{
		return $this->pays;
	}
	
	#Setters
	public function setLibelle($val)
	{
		$this->libelle = $val;
	}
	public function setCodePostal($val)
	{
		$this->code_postal = $val;
	}
	public function setVille($val)
	{
		$this->ville = $val;
	}
	public function setPays($val)
	{
		$this->pays = $val;
	}
	
}//End class Adresses

?>