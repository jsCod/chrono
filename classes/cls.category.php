<?php 
/**
 * @author Joseph SILGA <silga.dev@gmail.com>
 * @date   2016-11-29
 * 
 *
 */

namespace classes\models;

class Category
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
	private  $description;
	
	/**
	 *
	 * @var string
	 * @access float
	 */
	private  $prix;
	
	
    
	public function __construct(array $aCategory){
		
	 if(isset($aCategory['id'])) 
	 $this->id           = $aCategory['id'];
	 $this->nom          = $aCategory['nom'];
	 $this->description  = $aCategory['description'];
	 $this->prix         = $aCategory['prix'];

	
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
    
    
    public function getDescription() 
    {
      return $this->description;
    }
    
    public function setDescription($value) 
    {
      $this->description = $value;
    }

    
    public function getPrix() 
    {
      return $this->prix;
    }
    
    public function setPrix($value) 
    {
      $this->prix = $value;
    }
    
    
    
    
    
    
    
}//End Category
?>