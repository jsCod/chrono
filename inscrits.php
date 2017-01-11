<?php
//$status = session_status();
//if ( ($status == PHP_SESSION_NONE) ||(isset($_SESSION['id_profils']) && $_SESSION['id_profils'] != 1)) 
//header("Location:/chrono/");
//print '<pre>';
//print_r($status); die;


require_once 'header.php';
use classes\models  as dao;
require_once 'classes/cls.userManager.php';

$userManager = new dao\UserManager();
$aUsers = $userManager->getAllUsers();

?>

<div class="container" style="padding-top :30px;">
        <div class="row">
			<div class="">
			<div class="panel panel-info">
						<div class="panel-heading">Liste des inscrits</div>
						<div class="panel-body panel-collapse collapse in table-responsive">
							
								<table id="liste_users" class="table table-striped" width="100%" cellspacing="0">
								  <thead>
								   <tr>
								      <th>&nbsp;Nom</th>
								      <th>&nbsp;Prenom</th>
								      <th>&nbsp;Mail</th>
								      <th>&nbsp;Telephone</th>
								      <th>&nbsp;Pays</th>
								      <th>&nbsp;Ville</th>
								      <th>&nbsp;Date</th>
								      <th>&nbsp;Etat</th>
								      <th>&nbsp;Profil</th>
								      <th>&nbsp;Actions</th>
								   </tr>
								  </thead>
								  <tbody>
							        <?php 
							        foreach ((array)$aUsers as $id => $user) :
								    $lignes  ='<tr id="'.$id.'">';
							        $lignes .='<td>'.$user['nom'].'</td>';
							        $lignes .='<td>'.$user['prenom'].'</td>';
							        $lignes .='<td>'.$user['mail'].'</td>';
							        $lignes .='<td>'.$user['telephone'].'</td>';
							        $lignes .='<td>'.$user['pays'].'</td>';
							        $lignes .='<td>'.$user['ville'].'</td>';
							        $lignes .='<td>'.$user['date_inscription'].'</td>';
							        $lignes .='<td>'.$user['etat'].'</td>';
							        $lignes .='<td>'.$user['profil'].'</td>';
							        $lignes .='<td><a href="#">Modifier</a>&nbsp;<a href="#">supprimer</a></td>';
							        $lignes .='</tr>';
							        echo $lignes;
								    endforeach; ?>
								  </tbody>
								</table>
							    
								
						  
					</div>
					
			</div> <!-- div class col -->
       </div>
</div>

<script type="text/javascript">
$("#liste_users").DataTable({
	"language": {
        "lengthMenu": "Afficher _MENU_ lignes par page",
        "zeroRecords": "Aucune ligne à afficher - Désolé",
        "info": "Affichage page _PAGE_ sur _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(filtered from _MAX_ total records)"
    },

});
</script>




		
<?php
  require_once 'footer.php';
?>

