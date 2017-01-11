<?php
namespace classes\librairies;

class Utils
{
	  const  CONST_PWD="C!72h";
	  const  COMMISSION_COLIS=1;
	  const  TRANSPORT_COLIS=0;
	  const  EXPEDITION_COLIS=3;
	  //const  EXPEDITION_COLIS=2;
	  //const  LIVRAISON_COLIS=3;
	  const  EXPEDITION_EN_COURS=1;
	  const  EXPEDITION_TERMINE=4;
	  const  ADMIN_MAIL='admin@72hchrono.net';
	  const  CONTACT_MAIL='contact@72hchrono.net';
	  const  INSCRIT=0;
	  const  DESACTIVE=-1;
	  const  TRANSPORTEUR=1;
	  const  PROFIL_UTILISATEUR=2;
	  const  UPLOAD_DIR  ='/../documents/upload/';
	  const  TAILLE_MAX = 500000;//100 000 octets, 500Ko maxi
	  const  BASE_DIR   ='/';
	  //const  BASE_DIR   ='/chrono/';
	 
	 

	  
	  public static function getConfig($env)
	  {
	   $filepath = dirname(__FILE__) .'/../conf/conf.ini';
	   $filepath = realpath($filepath);
	   $aConf = parse_ini_file($filepath, true) or die('[ERREUR] : Impossible de lire le fichier conf.ini');
	   $aConf[$env]['passconcat']= self::CONST_PWD;
	   
	   return $aConf[$env];
	  }

	  public static function filesManager(array $aFile,$idUser)
	  {	  		
	  	
	  		$dirname   =  dirname(__FILE__ ) . self::UPLOAD_DIR;
	  		$dirname   = realpath($dirname);
	  		if($idUser < 10)
	  		$idUser    = "0".$idUser;
	  		$userRep    = $dirname."/".$idUser;
	  		$fileName   =  $aFile['identite']['name'];
	  		      
	  		if(!is_dir($userRep))
	  		{
	  			if(is_writable($dirname))
	  			{
	  				if(mkdir($userRep, 0660))
	  				{
	  					if(!move_uploaded_file($aFile['identite']['tmp_name'], "$userRep/$fileName") )
	  						throw new \Exception("[error] : file not uploaded ! ===========<br/>");
	  					return  self::BASE_DIR .'documents/upload/'.$idUser.'/'.$fileName;
	  						
	  				}
	  				else 
	  				{
	  					throw new \Exception("[error] : Impossible de créer le repertoire : $userRep <br/>");
	  				}
	  			}
	  			else
	  			{
	  			 throw new \Exception("[error] : Impossible d'écrire dans le repertoire : $dirname <br/>");
	  			}
	  	
	  		}
	  		else
	  		{
	  			if(!move_uploaded_file($aFile['identite']['tmp_name'], "$userRep/$fileName") )
	  				throw new \Exception("[error] : file not uploaded ! ===========<br/>");
	  			return  self::BASE_DIR .'documents/upload/'.$idUser.'/'.$fileName;
	  	    
	  		}
	  	
	  		return false;
	  		
	  }//end file manager
	  
	  public static function sendMail($nom,$from,$to,$subject,$message)
	  {

	  	//$to      =lib\Utils::CONTACT_MAIL;
	  	//$from    = $email;
	  	//$subject ="[72hchrono.net] Prise de contact";
	  	
	  	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
	  	$headers  = 'MIME-Version: 1.0' . "\r\n";
	  	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  	
	  	// En-têtes additionnels
	  	$headers .= 'To: Administrateur <'.$to.'>' . "\r\n";
	  	$headers .= 'From: '.$nom .' <'.$from .'>' . "\r\n";
	  	$headers .= 'Reply-To: <'.$from.'> ' . "\r\n";
	  	$headers .= 'Subject: <'.$subject.'> ' . "\r\n";
	  	$headers .= 'X-Mailer: PHP/' . phpversion();
	  	
	  	$rtn = mail($to,$subject,$message,$headers);
	  	
	  	return $rtn;
	  	
	  }
	  
	  
}//End class Utils



?>