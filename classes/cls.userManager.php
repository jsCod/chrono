<?php namespace classes\models;
use  classes\librairies as lib;
require_once 'cls.user.php';
require_once 'cls.db.php';
//require_once 'cls.utils.php';

class UserManager
{
   private $db;
   
   function __construct()
   {
	   new Db();
	   $this->db = Db::getConnexion();
   }
	
	public function addUser(User $user)
	{	
	  $q = $this->db->prepare('INSERT INTO users (nom,prenom,telephone,mail,password,statut,date_inscription,identite,alert,id_profils,id_adresse)
                                                VALUES
                                                (:nom,:prenom,:telephone,:mail,:password,:statut,:date_inscription,:identite,:alert,:id_profils,:id_adresse)');
	   $q->bindValue(':nom',$user->getNom());
	   $q->bindValue(':prenom',$user->getPrenom());
	   $q->bindValue(':telephone',$user->getTelephone());
	   $q->bindValue(':mail',$user->getMail());
	   $q->bindValue(':password',md5(lib\Utils::CONST_PWD . $user->getPassword()));
	   $q->bindValue(':statut',$user->getStatut());
	   $q->bindValue(':date_inscription',$user->getDateInscription());
	   $q->bindValue(':identite', $user->getIdentite());
	   $q->bindValue(':alert', $user->getAlert(),\PDO::PARAM_BOOL);
	   $q->bindValue(':id_profils',$user->getIdProfils());
	   $q->bindValue(':id_adresse',$user->getIdAdresse());
	   
	   return $q->execute(); //bool(true)  if OK
		
	}
	public function getUser($param)
	{
		if(is_integer($param))
		{
			$q = $this->db->prepare('SELECT * FROM  users WHERE id= :id');
			$q->execute(array(':id'=>$param));
			return new User($q->fetch(\PDO::FETCH_ASSOC));
		}
		else if(is_array($param) && count($param) > 0)
		{
			$q = $this->db->prepare('SELECT * FROM  users WHERE mail=:mail AND password=:password');
			$q->execute(array(':mail'=>$param['mail'],
					':password'=>md5(lib\Utils::CONST_PWD . $param['password'])
							)
							);
			if($q->rowCount() == 1)
			{
				return new User($q->fetch(\PDO::FETCH_ASSOC));
			}
		}
		
		return false;
	}
	
	public function updateUser(User $user)
	{

		  $q = $this->db->prepare('UPDATE users SET   nom       = :nom, 
													  prenom    = :prenom,
					                                  telephone = :telephone,
					                                  mail      = :mail,
													  password  = :password,
					                                  statut    =:statut,
													  alert     =:alert,
		  											  date_inscription = :date_inscription,
		  											  identite         = :identite,
		  											  last_update      = :last_update,
					                                  id_profils       = :id_profils,
													  id_adresse       = :id_adresse
					 							 WHERE id=:id');
		  
		   $q->bindValue(':nom',$user->getNom(),\PDO::PARAM_STR);
		   $q->bindValue(':prenom',$user->getPrenom(),\PDO::PARAM_STR);
		   $q->bindValue(':telephone',$user->getTelephone(),\PDO::PARAM_STR);
		   $q->bindValue(':mail',$user->getMail());
		   $q->bindValue(':password', $user->getPassword());
		   $q->bindValue(':statut',$user->getStatut(),\PDO::PARAM_INT);
		   $q->bindValue(':alert', $user->getAlert(),\PDO::PARAM_BOOL);
		   $q->bindValue(':date_inscription',$user->getDateInscription());
		   $q->bindValue(':identite',$user->getIdentite());
		   $q->bindValue(':last_update',$user->getLastUpdate());
		   $q->bindValue(':id_profils',$user->getIdProfils());
		   $q->bindValue(':id_adresse',$user->getIdAdresse());
		   $q->bindValue(':id',$user->getId(),\PDO::PARAM_INT);
		   
		   $q->execute();
		   
	}
	
	//vérifions l'existence de ce email
	public function emailExist($email)
	{
	
	 return (bool)$this->db->query("SELECT  COUNT(*) FROM users WHERE mail='".$email."'")->fetchColumn();
		
	}
	
	public function getAllUsers()
	{
		$aUsers   = [];
		$aProfils = [1=>"Administrateur",2=>"Utilisateur"];
		$aStatut  = [-1=>"inactif",0=>'actif',1=>"ND"];
		
		$q = $this->db->prepare("SELECT u.id,
				                        u.nom,
				                        u.prenom, 
				                        u.telephone,
				                        u.mail,
				                        u.statut,
				                        u.date_inscription,
				                        u.id_profils,
				                        a.ville, 
				                        a.pays 
				                from users u JOIN adresses a ON u.id_adresse= a.id ");
		$q->execute();
		while ($row = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$aUsers[$row['id']]['id_user']          = $row['id'];
			$aUsers[$row['id']]['nom']              = ucfirst(mb_strtolower($row['nom'],'UTF-8'));
			$aUsers[$row['id']]['prenom']           = ucfirst(mb_strtolower($row['prenom'],'UTF-8'));
			$aUsers[$row['id']]['telephone']        = $row['telephone'];
			$aUsers[$row['id']]['mail']             = $row['mail'];
			$aUsers[$row['id']]['etat']             = $aStatut[$row['statut']];
			$aUsers[$row['id']]['date_inscription'] = $row['date_inscription'];
			$aUsers[$row['id']]['profil']           = $aProfils[$row['id_profils']];
			$aUsers[$row['id']]['ville']            = ucfirst(mb_strtolower($row['ville'],'UTF-8'));
			$aUsers[$row['id']]['pays']             = ucfirst(mb_strtolower($row['pays'],'UTF-8'));
		}
		return $aUsers;
	}
	
	
	
}//end class UserManager

?>