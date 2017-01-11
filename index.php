<?php
  require_once 'header.php';
  
  use classes\models  as dao;
  use classes\librairies as lib;
  require_once 'classes/cls.expeditionsManager.php';
  require_once 'classes/cls.userManager.php';
  require_once 'classes/cls.colisManager.php';
  require_once 'classes/cls.annoncesManager.php';
  require_once 'classes/cls.utils.php';
  

  
?>
            <div class="container">
			<div class="page-header"><h1><span class="glyphicon glyphicon-home"></span>&nbsp;Bienvenue sur 72hCHRONO</h1></div>
			
			<div class="row">
			 <div class='alert alert-info'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<p><a href="#"><strong>72hCHRONO.net</strong></a> est un outil de mise en relation, une aide pour le transport et la livraison de colis entre particuliers  par des particuliers en voyage.</p>
				<p>Nous nous engageons à livrer votre colis dans un delais de <strong>72h chrono </strong>à compter de la validation de votre colis suivant les <a href="<?php echo lib\Utils::BASE_DIR."conditions.php";?>">conditions g&eacute;n&eacute;rales du service</a> </p>
		    </div
			
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				 <div class="panel panel-info">
						<div class="panel-heading">Notre mission en images</div>
						<div class="panel-body">
							<div id="bestSellers" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#bestSellers" data-slide-to="0" class="active"></li>
									<li data-target="#bestSellers" data-slide-to="1"></li>
									<li data-target="#bestSellers" data-slide-to="2"></li>
									<li data-target="#bestSellers" data-slide-to="3"></li>
								</ol>

								<div class="carousel-inner">
									<div class="item active">
										<img src="img/valises.jpg" alt="Product 1">
										<div class="carousel-caption">Valises voyageurs</div>
									</div>
									<div class="item">
										<img src="img/plane.jpg" alt="Product 2">
										<div class="carousel-caption">Moyen de transport </div>
									</div>
									<div class="item">
										<img src="img/c3.png" alt="Product 3">
										<div class="carousel-caption">Product 3</div>
									</div>
									<div class="item">
										<img src="img/c4.png" alt="Product 4">
										<div class="carousel-caption">Product 4</div>
									</div>
								</div>

								<a class="left carousel-control" href="#bestSellers" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
								</a>
								<a class="right carousel-control" href="#bestSellers" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
								</a>
							</div>	
						</div>
					</div>
			     </div> <!-- div class col -->
				
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<div class="panel panel-info">
						<div class="panel-heading">Exemple de colis transportables</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<dl>
										<dt><img src="img/p1.png" class="img-responsive img-thumbnail" alt="Product 1" title="Photo"></dt>
										<dd>appareil photo</dd>
									</dl>
								</div>
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<dl>
										<dt><img src="img/p3.png" class="img-responsive img-thumbnail" alt="Product 3" title="Product 3"></dt>
										<dd>Product 3</dd>
									</dl>
								</div>
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<dl>
										<dt><img src="img/p2.png" class="img-responsive img-thumbnail" alt="Product 2" title="Beauté"></dt>
										<dd>coffret maquillage</dd>
									</dl>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<dl>
										<dt><img src="img/p2.png" class="img-responsive img-thumbnail" alt="Product 2" title="Product 2"></dt>
										<dd>Product 2</dd>
									</dl>
								</div>
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<dl>
										<dt><img src="img/p1.png" class="img-responsive img-thumbnail" alt="Product 1" title="Product 1"></dt>
										<dd>Product 1</dd>
									</dl>
								</div>
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<dl>
										<dt><img src="img/p3.png" class="img-responsive img-thumbnail" alt="Product 3" title="Product 3"></dt>
										<dd>Product 3</dd>
									</dl>
								</div>
							</div>
							<!-- a class="btn btn-info btn-sm" href="#" role="button">See all recent items...</a -->
						</div>
					</div>
			</div> <!-- div class col -->
				
		</div> <!-- class row --->
		
		<div class="row"> <!-- Test de fenetre modal pour proposer colis -->
			 
			    <!-- Gestion de la proposition de colis -->
			    <div class="modal" id="theModal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
							<h4 class="modal-title" id="theModalLabel">Votre message pour :</h4>
							</div>
							
							<div class="modal-body formProposition">
								<form action="" method="POST">
								<div class="form-group">
								    <label for="votreMessage">Votre Message</label>
								    <textarea class="form-control" id="votreMessage" rows="3"></textarea>
								</div>
	                           <div class="form-group">
   									<input id="annonce" type="hidden" name="annonce" value="" >
							   </div>
									<button type='button'class='btn btn-success btn-block' id='sendProposition'>Proposer</button>
							   </form>
							</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
						</div>
						
						</div>
					</div>
				</div>
				
				<!-- Boutton pour ouvrir la fenetre modal  -->
				<!-- button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#theModal">Open Modal</button -->
				
				<!-- Gestion l'offre de transport -->
			    <div class="modal" id="JeTransporte" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
							<h4 class="modal-title" id="JeTransporteLabel">Votre message pour :</h4>
							</div>
							
							<div class="modal-body formTransport">
								<form action="" method="POST">
								<div class="form-group">
								    <label for="messageTransport">Votre Message</label>
								    <textarea class="form-control" id="messageTransport" rows="3"></textarea>
								</div>
	                           <div class="form-group">
   									<input id="annonceTransport" type="hidden" name="annonceTransport" value="" >
							   </div>
									<button type='button'class='btn btn-success btn-block' id='sendTransport'>Proposer</button>
							   </form>
							</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
						</div>
						
						</div>
					</div>
				</div>
			</div> <!-- end class row  -->
			
			
	    </div> <!-- class container >
		
	    
		 <!-- Page centrale de traitement-->
		 <!-- Afficher les colis si admin ! -->
		 
		<div class="container" style="padding-top :15px;">
		  
		<div class="panel-group" id="catList">
		<div class="panel panel-primary" id="cat1Head">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#catList" href="#cat1"><span class="glyphicon glyphicon-plane"></span>&nbsp;Voyages Pr&eacute;visionnels annonc&eacute;s</a>
			</h4>
		</div>
			<div id="cat1" class="panel-collapse collapse in table-responsive">
			<table id="tab_voyage" class="table table-striped" width="100%" cellspacing="0">
			  <thead>
			   <tr>
			      <th>&nbsp;N°</th>
			      <th>&nbsp;Voyageur</th>
			      <th>&nbsp;Pays</th>
			      <th>&nbsp;Ville</th>
			      <th>&nbsp;D&eacute;part</th>
			      <th>&nbsp;Arriv&eacute;e</th>
			      <th>&nbsp;Pays</th>
			      <th>&nbsp;Ville</th>
			      <th>&nbsp;Actions</th>
			   </tr>
			  </thead>
			  <tbody id="tabVoyages">
		
			  
			  </tbody>
			</table>
		    </div>
		</div>
		<div class="panel panel-default" id="cat2Head">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#catList" href="#cat2" id="colis_dispo"><span class="glyphicon glyphicon-send"></span>Colis cherchant voyageurs</a>
				</h4>
			</div>
			<div id="cat2" class="panel-collapse collapse in table-responsive">
				   <table id="tab_colis" class="table table-striped" width="100%" cellspacing="0">
				  <thead>
				   <tr>
					  <th>&nbsp;N°</th>
					  <th>&nbsp;Exp&eacute;diteur</th>
					  <th>&nbsp;Pays</th>
					  <th>&nbsp;Ville</th>
					  <th>&nbsp;Destinataire</th>
					  <th>&nbsp;Pays</th>
					  <th>&nbsp;Ville</th>
					  <th>&nbsp;Cat&eacute;gorie</th>
					  <th>&nbsp;Actions</th>
				   </tr>
				  </thead>
				  <tbody id="tabCommissions">
				  
				  </tbody>
				</table>
			</div>
		</div>
	
		<div class="panel panel-default" id="cat3Head">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#catList" href="#cat3"><span class="glyphicon glyphicon-heart"></span>&nbsp;Exp&eacute;ditions planfifi&eacute;es</a>
				</h4>
			</div>
			<div id="cat3" class="panel-collapse collapse in table-responsive">
				 <table id="tab_expeditions" class="table table-striped" width="100%" cellspacing="0">
				  <thead>
				   <tr>
					  <th>&nbsp;Date</th>
					  <th>&nbsp;Transporteur(se)</th>
					  <th>&nbsp;Destinataire</th>
					  <th>&nbsp;Pays</th>
					  <th>&nbsp;Ville</th>
					  <th>&nbsp;Categorie</th>
					  <th>&nbsp;Statut</th>
					  <th>&nbsp;Actions</th>
				   </tr>
				  </thead>
				  <tbody id="tabExpeditions">
				  
				  </tbody>
				</table>
		
			</div>
		</div>
		
     </div> <!-- container -->
 </div> <!-- container  -->
 
<script type="text/javascript">


//Chargement des offres de transport
params= null;
$.post("ajax/voyages.php",params,function(voyages) 
		{
	      //alert("Voyageur :" + voyages);
	      
		   if( voyages.length > 0)
		   {
		    //lignes='';
		    $.each(voyages, function(index, voyage)
		      {
		    	//alert("chaque Voyageur :" + voyage);
		    	
		    	lignes ='<tr>';
		    	lignes +='<td>'+voyage.id_annonce+'</td>';
		    	lignes +='<td>'+voyage.voyageur+'</td>';
		    	lignes +='<td>'+voyage.paysdepart+'</td>';
		    	lignes +='<td>'+voyage.villedepart+'</td>';
		    	lignes +='<td>'+voyage.date_depart+'</td>';
		    	lignes +='<td>'+voyage.date_arrive+'</td>';
		    	lignes +='<td>'+voyage.paysdestination+'</td>';
		    	lignes +='<td>'+voyage.villedestination+'</td>';
		    	lignes +='<td><a onclick="callModalProposition('+voyage.id_user+','+voyage.id_annonce+')"  href="javascript:void(0);">proposer un colis</a></td>';
		    	lignes +='</tr>';
		        $("tbody#tabVoyages").append(lignes);
		        
		      });//end each
		   }//end if voyages > 0
		   
		   $("#tab_voyage").DataTable({
				"language": {
			        "lengthMenu": "Afficher _MENU_ lignes par page",
			        "zeroRecords": "Aucune ligne à afficher - Désolé",
			        "info": "Affichage page _PAGE_ sur _PAGES_",
			        "infoEmpty": "No records available",
			        "infoFiltered": "(filtered from _MAX_ total records)"
			    }
			});   
		  

});//end post voyages
		
//Chargment des commissions		
$.post("ajax/commissions.php",params,function(commissions) 
{
   if( commissions.length > 0)
   {
    //lignes='';
    $.each(commissions, function(index, commission)
      {
    	lignes ='<tr>';
    	lignes +='<td>'+commission.id_annonce+'</td>';
    	lignes +='<td>'+commission.expediteur+'</td>';
    	lignes +='<td>'+commission.paysexp+'</td>';
    	lignes +='<td>'+commission.villeexp+'</td>';
    	lignes +='<td>'+commission.destinataire+'</td>';
    	lignes +='<td>'+commission.pays+'</td>';
    	lignes +='<td>'+commission.ville+'</td>';
    	lignes +='<td>'+commission.categorie+'</td>';
    	lignes +='<td><a onclick="callTransportModal('+commission.idexp+','+commission.id_annonce+')"  href="javascript:void(0);">je transporte</a></td>';
    	lignes +='</tr>';
        $("tbody#tabCommissions").append(lignes);
        
      });//end each
   }//end if commissions > 0
   
   $("#tab_colis").DataTable({
		"language": {
	        "lengthMenu": "Afficher _MENU_ lignes par page",
	        "zeroRecords": "Aucune ligne à afficher - Désolé",
	        "info": "Affichage page _PAGE_ sur _PAGES_",
	        "infoEmpty": "No records available",
	        "infoFiltered": "(filtered from _MAX_ total records)"
	    },

	});

});//end post commissions

//Chargement des expéditions en cours
$.post("ajax/expeditions.php",params,function(expeditions) 
		{
	       
   	    if( expeditions.length > 0)
		   {
		    $.each(expeditions, function(index, expedition)
		      {
			    //alert('Info : '+expedition.nomtransporteur+' '+expedition.prenomtransporteur);
			    
		    	lignes ='<tr>';
		    	lignes +='<td>'+expedition.date_planif+'</td>';
		    	lignes +='<td>'+expedition.transporteur+'</td>';
		    	lignes +='<td>'+expedition.destinataire+'</td>';
		    	lignes +='<td>'+expedition.paysdestination+'</td>';
		    	lignes +='<td>'+expedition.villedestination+'</td>';
		    	lignes +='<td>'+expedition.categorie+'</td>';
		    	lignes +='<td>'+expedition.statut+'</td>';
		    	lignes +='<td><a onclick="alert(\'NOT IMPLEMENTED!\');" href="javascript:void(0);">actions</a></td>';
		    	lignes +='</tr>';
		        $("tbody#tabExpeditions").append(lignes);
		        
		      });//end each
		   }//end if expeditions > 0
		   
		   $("#tab_expeditions").DataTable({
				"language": {
			        "lengthMenu": "Afficher _MENU_ lignes par page",
			        "zeroRecords": "Aucune ligne à afficher - Désolé",
			        "info": "Affichage page _PAGE_ sur _PAGES_",
			        "infoEmpty": "No records available",
			        "infoFiltered": "(filtered from _MAX_ total records)"
			    }
			});   
		  

});//end post expeditions

//Gestion du collapse

$('#cat1').on('show.bs.collapse', function () {
	$('#cat1Head').removeClass('panel-default').addClass('paneldefault');
	$('#cat2Head').removeClass('panel-warning').addClass('paneldefault');
	$('#cat3Head').removeClass('panel-warning').addClass('paneldefault');
	$('#cat4Head').removeClass('panel-warning').addClass('paneldefault');
});
$('#cat2').on('show.bs.collapse', function () {
	$('#cat1Head').removeClass('panel-primary').addClass('paneldefault');
	$('#cat2Head').removeClass('panel-default').addClass('panelsuccess');
	$('#cat3Head').removeClass('panel-warning').addClass('paneldefault');
	$('#cat4Head').removeClass('panel-warning').addClass('paneldefault');
});
$('#cat3').on('show.bs.collapse', function () {
	$('#cat1Head').removeClass('panel-primary').addClass('paneldefault');
	$('#cat2Head').removeClass('panel-default').addClass('paneldefault');
	$('#cat3Head').removeClass('panel-warning').addClass('panelsuccess');
	$('#cat4Head').removeClass('panel-warning').addClass('paneldefault');	
});

function callModalProposition(idVoyeur,idAnnonce)
{
  params = {"idVoyageur":idVoyeur};
  $("#annonce").val(idAnnonce);
  
  $.post("ajax/isLogged.php",params, function(info)
    {
	    if(info == 0)
	    {
	      alert("Vous devez être connecté pour faire votre proposition");
	    }
	    else
	    {
		   //alert("Retour Ajax User connecte:" + info.nom+ "Nom voyageur :"+info.voyageurNom);
    	  $("#theModalLabel").text(info.prenom + ', vous voulez proposer un colis à ' +info.voyageurPrenom);
    	  $('#theModal').modal({
    		    keyboard: false,
				backdrop: 'static'
			});
		}

	}); 
}

$('#sendProposition').on('click', function(e) {
	userMessage     = $("#votreMessage").val();
	id_annonce      = $("#annonce").val();
	if(userMessage.length == 0)
	{
      alert("Merci d'écrire votre message");
      return false;
	}
	else
	{
	 $params = {"id_annonce":id_annonce,
			 	"message":userMessage
			 	};
     $.post("ajax/proposerColis.php",$params, function(sendMessage){

         //alert("Retour :" + sendMessage);
         if(sendMessage == 1)
         {
        	alert("Nous vous remercions, votre message a bien été prise en compte, nous vous reviendrons vers vous assez rapidement");
         }
         else
         {
        	 alert("Désolé, une erreur est survenue, merci de reessayer ultérieurement !");
         }

      $('#theModal').modal('hide');
     });//end POST
	}

});

//Gestion de Je transport
function callTransportModal(idExpediteur,idAnnonce)
{
  params = {"idExpediteur":idExpediteur};
  $("#annonceTransport").val(idAnnonce);
 
  $.post("ajax/isLogged.php",params, function(info)
    {
	    if(info == 0)
	    {
	      alert("Vous devez être connecté pour faire votre proposition");
	    }
	    else
	    {
		  //voyageur ici represente l'expediteur
		  //Info. nom = user connecté!
    	  $("#JeTransporteLabel").text('Vous vous proposez de transporter la commission de  ' +info.voyageurPrenom);
    	  $('#JeTransporte').modal({
    		    keyboard: false,
				backdrop: 'static'
			});
		}

	}); 
}

//Envoie de la proposition de transport
$('#sendTransport').on('click', function(e) {
	userMessage     = $("#messageTransport").val();
	id_annonce      = $("#annonceTransport").val();
	if(userMessage.length == 0)
	{
      //alert("Merci d'écrire votre message");
      return false;
	}
	else
	{
	 $params = {"id_annonce":id_annonce,
			 	"message":userMessage
			 	};
     $.post("ajax/proposerTransport.php",$params, function(sendMessage){

         //alert("Retour :" + sendMessage);
         if(sendMessage == 1)
         {
        	alert("Nous vous remercions, votre message a bien été prise en compte, nous vous reviendrons vers vous assez rapidement");
         }
         else
         {
        	 alert("Désolé, une erreur est survenue, merci de reessayer ultérieurement !");
         }

      $('#JeTransporte').modal('hide');
     });//end POST
	}

});
</script>
 


		
		
<?php
  require_once 'footer.php';
?>