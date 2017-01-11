<?php 
require_once 'header.php';
use classes\models  as dao;
use classes\librairies as lib;
require_once 'classes/cls.expeditionsManager.php';
require_once 'classes/cls.userManager.php';
require_once 'classes/cls.colisManager.php';
require_once 'classes/cls.annoncesManager.php';
require_once 'classes/cls.utils.php';

$annonceManager = new dao\AnnoncesManager();

if(isset($_POST) && count($_POST) > 0)
{
  $expeditionManager = new dao\ExpeditionsManager();
  $tansporteur       = $_POST['transporteur_id'];
  $tabTransportInfos = explode("_", $tansporteur);
  $id_transporteur   = $tabTransportInfos[0];
  $villeDestination  = trim($tabTransportInfos[1]);
  $villeDestination  = ucfirst(strtolower($villeDestination));
  
  $colis_annonces =   $_POST['duallistbox_demo1'];
  
  if(is_array($colis_annonces) && count($colis_annonces) > 0)
  {
  	$aExpedition['id_transporteur'] = intval($id_transporteur);
  	$aExpedition['date_planif']     = date("Y-m-d H:i:s");
  	$aExpedition['last_update']     = date("Y-m-d H:i:s");
  	$aExpedition['statut']          = lib\Utils::EXPEDITION_EN_COURS;
  
  	foreach ($colis_annonces as $k => $value)
  	{
  		$tabColisAnnonces = explode("_", $value);
  		

  		$villeColis = trim($tabColisAnnonces[2]);
  		$villeColis = ucfirst(strtolower($villeColis));
  		
  		/*print '<br/>==================================<br/>';
  		echo "<br/> villeDestination : " .$villeDestination;
  		echo "<br/> villeColis : " .$villeColis;*/
  		
  		/*if($villeColis != $villeDestination) 
  		continue;*/
  		
  		$aExpedition['id_colis'] = intval($tabColisAnnonces[0]);
  		$aIdAnnonces[]           = intval($tabColisAnnonces[1]);
  		
  		$expedition = new dao\Expeditions($aExpedition);
  		$rtn = $expeditionManager->addExpeditions($expedition);
  			
  	}//end foreach
  	
  	 $retour = $annonceManager->updateListeAnnonces($aIdAnnonces, lib\Utils::EXPEDITION_COLIS);
  	
  	 if($retour)
  	 $message=" <div class='alert alert-success'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				Les exp&eacute;ditions ont &eacute;t&eacute; planifi&eacute;es
				</div>";
  	 
  	 $transporteur   = $annonceManager->getAnnoncesTransports();
  	 $commissions    = $annonceManager->getAnnoncesCommissions();
  }
	
}//end if POST
else
{
	$transporteur   = $annonceManager->getAnnoncesTransports();
    $commissions    = $annonceManager->getAnnoncesCommissions();
	$message="";
}




?>
		   <div class="container">
			<div class="page-header"><h1><span class="glyphicon glyphicon-send"></span>&nbsp;Planifier une exp&eacute;dition</h1></div>
			
			 <?php if(!empty($message)) echo $message ; ?>
			 
			<div class="well well-sm">
					<form class="form-horizontal" method="POST" action="" name="">
						
						<div class="form-group">
							<label for="Transporteur" class="col-sm-3 control-label">Transporteur</label>
							<div class="col-sm-9">
								<div class="input-group">
									<select name="transporteur_id">
									   <option value="1" disabled selected>Selectionnez un transporteur </option>
									   <?php foreach((array)$transporteur as $user)
									   {
									    echo "<option value='".$user['id_user']."_".$user['villedepart']."'>".$user['nom']." ".$user['prenom']." va &agrave; ".$user['villedestination']." (".$user['paysdestination'].") le ".date('d/m/Y',strtotime($user['date_depart']))." &agrave; ".date('H',strtotime($user['date_depart']))."h</option>";
									   }?>	
									</select>
								</div>
							</div>
					    </div>
						
						<div class="row">
						<label for="colisDispo" class="col-sm-3 control-label">Colis</label>
							<div class="col-sm-9">
								<select multiple="multiple" size="10" name="duallistbox_demo1[]">
									  <?php foreach((array)$commissions as $col)
									   {
									      echo "<option value='".$col['id_colis']."_".$col['id_annonce']."_".$col['ville']."'> Colis (".$col['categorie']." ) pour ".$col['nom']." ".$col['prenom']." &agrave; ".$col['ville']." (".$col["pays"].") </option>";
									   }?>	
								</select>
							</div>
						</div>

					<!-- Bouton -->	
					<div class="clearfix">&nbsp;</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary btn-lg" id="formsubmit"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Enregistrer</button>
						</div>
					</div>
				    </form>
			</div>	
		</div><!-- end container  -->
		
	

<script>
    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
    $("#formsubmit").submit(function() {
      alert($('[name="duallistbox_demo1[]"]').val());
      return false;
    });
</script>
		
<?php 
require_once 'footer.php';
?>
