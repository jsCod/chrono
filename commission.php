<?php 
require_once 'header.php';
use classes\models  as dao;
use classes\librairies as lib;
use classes\models\AdressesManager;

require_once 'classes/cls.adressesManager.php';
require_once 'classes/cls.colisManager.php';
require_once 'classes/cls.utils.php';
require_once 'classes/cls.userManager.php';
require_once 'classes/cls.annoncesManager.php';
require_once 'classes/cls.categoryManager.php';

$message=" <div class='alert alert-info'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				Vous devez être connecté pour passer une annonce!
		 </div>";

$filemsg   = null;
$idente    = null;

if(!empty($_SESSION) && isset($_POST) && count ($_POST) > 0 )
{
	$adresse = unserialize( $_SESSION['adresse'] );
	$user    = unserialize( $_SESSION['user'] );
	
	$userMananger   = new dao\UserManager();
	$adresseManager = new dao\AdressesManager();
	$colisManager   = new dao\colisManager();
	
	//Gestion du fichier uploaded
	if(isset($_FILES['identite']) &&  (count($_FILES['identite']) > 0) && !empty($_FILES['identite']['name']))
	{
		//Traitement du fichier uploaded
		$docTaille  =  $_FILES['identite']['size'];
		$docError   =  $_FILES['identite']['error'];
		$docType    =  $_FILES['identite']['type'];
	
		$tabDoctype = explode("/",$docType);
		$idUser     =  $user->getId();
	
		if( ($docError != 0) || $docTaille > lib\Utils::TAILLE_MAX )
		{
			$filemsg ="Fichier invalide ou taille supérieure à " .lib\Utils::TAILLE_MAX." octets";
		}
		elseif ( ($tabDoctype[1] != "pdf") && ($tabDoctype[1] != "gif") )
		{
			$filemsg +="Le format ".$tabDoctype[1]." du fichier  ".$_FILES['identite']['name']." n'est pas accepté!";
		}
		//
		if(!empty($filemsg))
		{
			print "<pre>==================<br/>"; //TODO : controle ajax
			echo $filemsg; throw new \Exception("***********Problème avec le fichier : $filemsg <br/> dans le script".__FILE__);
		}
		else
		{
			$idente  = lib\Utils::filesManager($_FILES ,$idUser);
		}
	
	}//if isset $_FILES
	
	//TODO : Données obligatoire à controler dans l'interface!
	//Traitement de l'adresse du colis
	$aAdresse["libelle"]     = $_POST["adresseDest"];
	$aAdresse["code_postal"] = $_POST["codeDest"];
	$aAdresse["ville"]       = $_POST["villeDest"];
	$aAdresse["pays"]        = $_POST["paysDest"];
	$adresseColis = new dao\Adresses($aAdresse);
	$id_adresse = $adresseManager->addAdresse($adresseColis);
	if(!$id_adresse)
	die("Echec d'enregistrement de l'adresse du colis (destinataire)");
	
    //TODO : Données obligatoire à controler dans l'interface!
	$aColis["poids"]       = $_POST["poids"];
	$aColis["taille"]      = $_POST["taille"];
	$aColis["nom"]         = $_POST["nomDest"];
	$aColis["prenom"]      = $_POST["prenomDest"];
	$aColis["telephone"]   = $_POST["telephoneDest"];
	$aColis["last_update"] = date("Y-m-d H:i:s");
	$aColis["statut"]      = lib\Utils::COMMISSION_COLIS;
	$aColis["category_id"] = $_POST["category_id"];
	
	$colis    = new dao\Colis($aColis);
	$id_colis = $colisManager->addColis($colis);
	
	if(!$id_colis)
		die("Echec  du colis ");
	
	//Mise à jour des informations personnelles
	if(isset($_POST['updateAdresse']) && $_POST['updateAdresse'] == 'on')
	{
			
		//Mise à jour de l'adresse du user connecté
		if(isset($_POST["adresseExp"]))
		$adresse->setLibelle($_POST["adresseExp"]);
		if(isset($_POST["codeExp"]))
		$adresse->setCodePostal($_POST["codeExp"]);
		if(isset($_POST["villeExp"]))
		$adresse->setVille($_POST["villeExp"]);
		if(isset($_POST["paysExp"]))
		$adresse->setPays($_POST["paysExp"]);
		$adresseManager->updateAdresse($adresse);
		
		//Mise à jour des infos du user
		if($idente)
		$user->setIdentite($idente);
		if(isset($_POST["telephoneExp"]))
		$user->setTelephone($_POST["telephoneExp"]);
		if(isset($_POST["nomExp"]))
		$user->setNom($_POST["nomExp"]);
		if(isset($_POST["prenomExp"]))
		$user->setPrenom($_POST["prenomExp"]);
	    $userMananger->updateUser($user);
		
	}
	
	//Prise en compte de l'abonnement à l'alerte
	if(isset($_POST['alert']) && $_POST['alert']=='on' )
	{
		$user->setAlert(TRUE);
		$userMananger->updateUser($user);
	}
	elseif ($user->getStatut() && !isset($_POST['alert']))
	{
		$user->setAlert(FALSE);
		$userMananger->updateUser($user);
		
	}
	
	//Gestion de l'annonce
	$aAnnonce["statut"]       = lib\Utils::COMMISSION_COLIS;
	$aAnnonce["date_annonce"] = date("Y-m-d H:i:s");
	$aAnnonce["date_depart"]  = "0000-00-00 00:00:00";
	$aAnnonce["date_arrive"]  = "0000-00-00 00:00:00";
	$aAnnonce["last_update"]  = date("Y-m-d H:i:s");
	$aAnnonce["id_user"]      = $user->getId();
	$aAnnonce["id_adresse"]   = $id_adresse;
	$aAnnonce["id_colis"]     = $id_colis;
	
	$annonceManager = new dao\AnnoncesManager();
	$annonce = new dao\Annonces($aAnnonce);
	$id_annonce = $annonceManager->addAnnonce($annonce);
	
	if($id_annonce)
		$message=" <div class='alert alert-success'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<span class=\"glyphicon glyphicon-saved\"></span>Votre colis a bien &eacute;t&eacute; enregistr&eacute;
				</div>";

	$_SESSION['user']    = serialize($user);
	$_SESSION['adresse'] =  serialize($adresse);
	$_SESSION['nom']     = $user->getNom();
	$_SESSION['prenom']  = $user->getPrenom();
	//$_POST = [];
	//$_FILES = []; //vider
}
elseif( count($_SESSION) > 0 )
{
	$user    = unserialize( $_SESSION['user'] );
	$adresse = unserialize( $_SESSION['adresse'] );
	$message="";
	//$_POST = []; //Marche pas!
	//$_FILES = []; //vider
}
else
{
	$user=null;
	$adresse=null;
	
}

//Récupération des categorie
$categoryManager  = new dao\CategoryManager();
$aCategories      = $categoryManager->getCategrories();


?>


		 <div class="container">
			<div class="page-header"><h1><span class="glyphicon glyphicon-briefcase"></span>&nbsp;Enregistrement d'une commision</h1></div>
			 
			 <?php if(!empty($message)) echo $message ; ?>
			 
				<form data-toggle="validator" role="form" enctype="multipart/form-data" id="commissionForm" class="form-horizontal" method="POST" action="" name="formcommission">
						
				   <fieldset class="well well-sm"> <!-- Informations sur le colis  -->
				   <legend>Colis :</legend>
				  
						<div class="form-group">
						<label for="votrePoids" class="col-sm-3 control-label">Poids</label>
						<div class="col-sm-9" >
							<div class="input-group">
								<span class="input-group-addon"></span>
								<input type="text" class="form-control" id="poids" pattern="^[0-9]{1,2}\.?[0-9]*$" maxlength="5"  	name="poids" placeholder="poids *" required>
							</div>
							<!-- >span class="glyphicon form-control-feedback" aria-hidden="true"></span -->
    						<div class="help-block with-errors">0.02 pour 20g (3 feuilles A4), 2.3 pour 2,3kg</div>
						</div>
						</div>
						<div class="form-group">
							<label for="votreTaille" class="col-sm-3 control-label">Taille</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon glyphicon-email"></span>
									<input type="text" class="form-control" id="taille" name="taille" placeholder="taille ">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="votreCategorie" class="col-sm-3 control-label">Cat&eacute;gorie</label>
							<div class="col-sm-9">
								<div class="input-group">
								<span class="input-group-addon"></span>
									<select name="category_id">
									 <?php 
									
									 foreach ((array)$aCategories[0] as $category) 
									 {
									  echo "<option value='".$category['id']."'>".$category['nom']." (".$category['description'].")</option>";
									 } 
									
									 ?>
						
									</select>
								</div>
								<div class="help-block with-errors">lettre:25€  Colis 7€/kg</div>
							</div>
						</div>
						 </fieldset>
						 
					    <!-- Informations sur l'expéditeur  -->
						<fieldset class="well well-sm">
						<legend>Exp&eacute;diteur :</legend>
						<div class="form-group">
							<label for="nomExp" class="col-sm-3 control-label">Nom</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="nomExp" name="nomExp" value="<?php if($user) echo $user->getNom();?>" placeholder="Nom *" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="prenomExp" class="col-sm-3 control-label">Pr&eacute;nom</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="prenomExp" name="prenomExp" value="<?php if($user) echo $user->getPrenom();?>" placeholder="Prenom *" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="adresseExp" class="col-sm-3 control-label">Adresse</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="adresseExp" name="adresseExp" value="<?php if($adresse) echo $adresse->getLibelle();?>" placeholder="Adresse *" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="codeExp" class="col-sm-3 control-label">Code postal</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="codeExp" name="codeExp" value="<?php if($adresse) echo $adresse->getCodePostal();?>" placeholder="Code postal ">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="villeExp" class="col-sm-3 control-label">Ville</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="villeExp" name="villeExp" value="<?php if($adresse) echo $adresse->getVille();?>" placeholder="Ville *" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="paysExp" class="col-sm-3 control-label">Pays</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="paysExp" name="paysExp" value="<?php if($adresse) echo $adresse->getPays();?>" placeholder="Pays *" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="teleExp" class="col-sm-3 control-label">T&eacute;l&eacute;phone</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" pattern="\+(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|4[987654310]|3[9643210]|2[70]|7|1)\d{1,14}$"
									 id="telephoneExp" name="telephoneExp" value="<?php if($user) echo $user->getTelephone();?>" placeholder="format:+33600112233 " required>
								</div>
								<!-- >span class="glyphicon form-control-feedback" aria-hidden="true"></span -->
    						    <div class="help-block with-errors">Format: +336406090xx (France) ou +226701207xx (Burkina Faso) ou +225077950xx (Côte d'Ivoire)</div>
							</div>
						</div>
						<div class="form-group">
							<label for="document" class="col-sm-3 control-label">Document d'identit&eacute;</label>
							<div class="col-sm-9">
								<div class="input-group">
								    <span class="input-group-addon"></span>
									<input type="file" class="" id="identite" name="identite"  <?php if($user && empty($user->getIdentite())) echo 'required'?>>
								</div>
								<!--  >span class="glyphicon form-control-feedback" aria-hidden="true"></span -->
    						    <div class="help-block with-errors">Scan lisible du document en cours de validit&eacute;(Pi&egrave;ce d'identit&eacute;, passport, titre de s&eacute;jour) au format .pdf ou .gif, Taille max : 500ko</div>
    						    <?php if($user && !empty($user->getIdentite())) echo '<span><a href="'.$user->getIdentite().'" target="_blank">Voir mon document d\'identit&eacute;</a></span> '?>
							</div>
						</div>
						<div class="form-group">
						    <div class="col-sm-9 col-sm-offset-3">
								<div class="checkbox">
									<label><input type="checkbox" name="updateAdresse" <?php if($user && empty($user->getIdentite())) echo 'required'?>>Mettre &agrave; jour mon adresse personnelle</label>
								</div>
							</div>
						</div>
						</fieldset>
						
					<!-- Informations sur le destinataire -->
					
					<fieldset class="well well-sm">
						<legend>Destinataire :</legend>
						<div class="form-group">
							<label for="nomDest" class="col-sm-3 control-label">Nom</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="nomDest" name="nomDest" placeholder="Nom *" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="prenomDest" class="col-sm-3 control-label">Pr&eacute;nom</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="prenomDest" name="prenomDest" placeholder="Prenom *" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="teleDest" class="col-sm-3 control-label">T&eacute;l&eacute;phone</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" pattern="\+(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|4[987654310]|3[9643210]|2[70]|7|1)\d{1,14}$"
									id="telephoneDest" name="telephoneDest" placeholder="format:+33600112233 " required>
								</div>
								<!-- >span class="glyphicon form-control-feedback" aria-hidden="true"></span -->
    						    <div class="help-block with-errors">Format: +336406090xx (France) ou +226701207xx (Burkina Faso) ou +225077950xx (Côte d'Ivoire)</div>
							</div>
						</div>
						<div class="form-group">
							<label for="adresseDest" class="col-sm-3 control-label">Adresse</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="adresseDest" name="adresseDest" placeholder="Adresse *" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="codeDest" class="col-sm-3 control-label">Code postal</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="codeDest" name="codeDest" placeholder="Code postal " >
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="villeDest" class="col-sm-3 control-label">Ville</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="villeDest" name="villeDest" placeholder="Ville *" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="paysDest" class="col-sm-3 control-label">Pays</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" id="paysDest" name="paysDest" placeholder="Pays *" required>
								</div>
							</div>
						</div>
						
						</fieldset>
					
					<div class="col-sm-9 col-sm-offset-3">
						<div class="checkbox">
							<label><input type="checkbox" name="alert" <?php if($user && $user->getAlert()) echo "checked" ?> >Je veux être informé des offres de transport de colis à cette destination!</label>
						</div>
					</div>
					<div class="col-sm-9 col-sm-offset-3">
						<div class="checkbox">
							<label><input type="checkbox" name="conditons" required ><a href="<?php echo lib\Utils::BASE_DIR."conditions.php";?>" target="_blank">&nbsp;J'ai pris connaissances des conditions g&eacute;n&eacute;rales du service</a></label>
						</div>
					</div>
					<!-- Bouton -->	
					<div class="clearfix">&nbsp;</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Enregistrer</button>
						</div>
					</div>
		 </form>
				
	</div><!-- end container  -->
		
<script type="text/javascript">
/*$("#commissionForm").submit(function( event ) {
	//event.preventDefault();
	alert("soumission");
	
    param=null;
	$.post("ajax/isLogged.php", param, function(data)
	 {
		alert ('Retour ajax:' + data );
		if(!data)
		{
		  alert("Merci de vous connecter pour pouvoir poster votre annonce !");
          return false;
		}	
	 });
});*/
</script>		
		
<?php 
require_once 'footer.php';
?>
