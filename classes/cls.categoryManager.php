<?php

namespace classes\models;
use  classes\librairies as lib;
require_once 'cls.category.php';
require_once 'cls.db.php';


class CategoryManager
{
   private $db;
   
   function __construct()
   {
	   new Db();
	   $this->db = Db::getConnexion();
   }
	
	/*public function addCategory(Category $category)
	{	
	  
		
	}*/
   
	public function getCategrories()
	{
		$cat=[];
		$q = $this->db->prepare('SELECT * FROM  category');	
		     
		try 
		{
			$q->execute();	
			while ($row = $q->fetchAll(\PDO::FETCH_ASSOC) )
			{
				$cat[] = $row;
			}
			return $cat;
		} 
		catch (\PDOException $e) 
		{
		  	echo $e->getMessage();
		}
		return false;	
	}
	
	/*public function updateCategroy(Category $category)
	{

		
	}*/
	

	
	
}//end class CategoryManager

?>