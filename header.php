<?php session_start(); 
//header('Content-Type: text/html; charset=utf-8');

use classes\librairies as lib;
require_once 'classes/cls.utils.php';

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>72h CHRONO</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="bs/css/bootstrap.min.css" rel="stylesheet">
		<link href="bs/css/bootstrap-theme.min.css" rel="stylesheet">
		<!-- link href="bs/css/bootstrap-datetimepicker.css" rel="stylesheet"-->
		<link href="bs/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<!-- link href="bs/css/bootstrap-datetimepicker-standalone.min.css" rel="stylesheet"-->
		<link href="DataTables/css/jquery.dataTables.css" rel="stylesheet">
		<link href="DataTables/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<!-- link href="css/datepicker3.min.css" rel="stylesheet"-->
		<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
		
		<link href="css/style.css" rel="stylesheet">
		<!--link href="http://work.smarchal.com/twbscolor/css/005bbb257ddfecf0f10000001" rel="stylesheet" -->
		
		<script type="text/javascript" src="bs/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
		<!-- >script type="text/javascript" src="bs/js/transition.js"></script>
		<script type="text/javascript" src="bs/js/collapse.js"></script>
		<script type="text/javascript" src="bs/js/alert.js"></script>
		<script type="text/javascript" src="bs/js/modal.js"></script>
		<script type="text/javascript" src="bs/js/tooltip.js"></script -->
		<!-- script type="text/javascript" src="bs/js/dropdown.js"></script-->
		
		<script type="text/javascript" src="js/jquery.hotkeys.js"></script>
		<script type="text/javascript" src="js/bootstrap-wysiwyg.js"></script>
		
		
		
		
		<!-- dualselect box -->
		 <link rel="stylesheet" type="text/css" href="css/bootstrap-duallistbox.css">
         <script src="js/jquery.bootstrap-duallistbox.js"></script>
         <script type="text/javascript" src="DataTables/js/jquery.dataTables.js"></script>
         <script type="text/javascript" src="DataTables/js/dataTables.bootstrap.min.js"></script> 
		 <!-- http://www.virtuosoft.eu/code/bootstrap-duallistbox/ --> 
	</head>
	
<?php
//Gestion des onglet actifs
$path   = $_SERVER["SCRIPT_NAME"];
$file   = explode("/", $path);
$onglet = explode(".", $file[1]);
?>
	<body style="padding-top: 30px;">
		<div class="modal fade" id="logonBox" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
						<h4 class="modal-title">Connexion/Inscription</h4>
					</div>
					<div class="modal-body">
						<div>
							<ul class="nav nav-pills">
								<li class="active"><a href="#signin" data-toggle="tab" data-caption="Connexion">Se connecter</a></li>
								<li ><a href="#signup" data-toggle="tab" data-caption="Inscription">S'inscire</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="signin">
									<form data-toggle="validator" role="form"  id="siginForm" style="padding-top: 5px" action="" method="POST" name="signin">
										<div class="form-group">
											<input type="email" class="form-control" id="mail" placeholder="votre mail *" required>
										</div>
										<div class="form-group">
											<input type="password" class="form-control" id="pass" placeholder="votre mot de passe *" required>
										</div>
										<button type="button" class="btn btn-success btn-block" id="doLogon">Se connecter</button>
										
									</form>
								</div>
								<div class="tab-pane" id="signup">
									<form data-toggle="validator" role="form" id="signupForm" style="padding-top: 5px" action="" method="POST" name="signup" accept-charset="utf-8">
										<div class="form-group">
											<input type="text" class="form-control" id="yourName" placeholder="Nom *"  name="nom" value="" required>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" id="yourUserName" placeholder="Prenom *" name="prenom" value="" required>
										</div>
										<div class="form-group">
											<input type="email" class="form-control" id="yourEmail" placeholder="Email *" name="email" value="" required>
										</div>
									
										<div class="form-group">
											<input type="password" class="form-control" id="yourPwd" placeholder="Mot de passe *" name="password" value="" required>
										</div>
										<div class="form-group">
											<input type="password" class="form-control" id="confirmPwd" placeholder="Confirmer le mot de passe *" name="confirmPassword" value="" required>
										</div>
										<button type="button" class="btn btn-success btn-block" id="createUser">S'inscrire</button>
										
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
					</div>
				</div>
			</div>
		</div>	

		<div class="container">
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#the-menu">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand brand" href="/chrono/index.php"><!-- span class="glyphicon glyphicon-home"--><!-- img alt="logo de 72h chrono" src="img/logo_chrono.png"--></a>
					</div>

					<div class="collapse navbar-collapse" id="the-menu">
						<ul class="nav navbar-nav">
							<li <?php if(!empty($onglet[0]) &&  $onglet[0]=="index") echo ' class="active"';?>><a href="<?php echo lib\Utils::BASE_DIR."index.php";?>"><span class="glyphicon glyphicon-home"></span>&nbsp;Accueil</a></li>
				            
				            <?php 
				            if(isset($_SESSION['id_profils']) && $_SESSION['id_profils'] == 1)
				            {
				            	$href= lib\Utils::BASE_DIR."expedition.php";
				            	if(!empty($onglet[0]) &&  $onglet[0]=="expedition")
				            	{
				                 $active ="active";
				            	}
				            	else
				            	{
				            	 $active ="";
				            	}
				            
				            	echo "<li class='$active'><a href='$href'><span class=\"glyphicon glyphicon-send\"></span>&nbsp;Exp&eacute;ditions</a></li>";
				            }//Si Admin
				            
				            ?>	
				
							<li<?php if(!empty($onglet[0]) &&  $onglet[0]=="commission") echo ' class="active"';?>><a href="<?php echo lib\Utils::BASE_DIR."commission.php";?>"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;Je commissionne</a></li>
							<li<?php if(!empty($onglet[0]) &&  $onglet[0]=="transport") echo ' class="active"';?>><a href="<?php echo lib\Utils::BASE_DIR."transport.php"; ?>"><span class="glyphicon glyphicon-plane"></span>&nbsp;Je transporte</a></li>
							<li<?php if(!empty($onglet[0]) &&  $onglet[0]=="contact") echo ' class="active"';?>><a href="<?php echo lib\Utils::BASE_DIR."contact.php"; ?>"><span class="glyphicon glyphicon-earphone"></span>&nbsp;Contactez-nous</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>Bienvenue&nbsp;<span class="bienvenu"><?php if(isset($_SESSION['prenom'])) echo $_SESSION['prenom']; ?></span><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<!-- >li><a href="#"><span class="glyphicon glyphicon-picture"></span>&nbsp;Mon profil</a></li>
									<li><a href="#"><span class="glyphicon glyphicon-gift"></span>&nbsp;Mes commissions&nbsp;<span class="badge">4</span></a></li>
									<li><a href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Mes offres de transport&nbsp;<span class="badge">4</span></a></li -->
									 <?php 
							            if(isset($_SESSION['id_profils']) && $_SESSION['id_profils'] == 1)
							            {
							             echo "<li><a href='".lib\Utils::BASE_DIR."inscrits.php'><span class=\"glyphicon glyphicon-user\"></span>&nbsp;Voir les inscrits</a></li>";
							            }
							            ?>
									<li class="divider"></li>
									<li><a href="#" id="disconnect"><span class="glyphicon glyphicon-off"></span>&nbsp;D&eacute;connexion</a></li>
									
									
								</ul>				
							</li>
							<?php if( !isset($_SESSION['nom']) ) echo '<li><a href="#" id="logonLink"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion/inscription</a></li>' ?>
						</ul>
						<form class="navbar-form navbar-right visible-md-inline visible-lg-inline" action="" method="GET" name="keyword">
							<div class="form-group" style="margin-top: 4px">
								<label class="sr-only" for="keyword">Keyword</label>
								<input type="text" class="form-control input-sm" id="keyword" placeholder="Entrer le N° du colis" name="search" value="" />
								 <input class="" type="submit" value="OK"/>
							</div>
						</form>
					</div>
				</div>
			</nav>
			
	    </div> <!-- container -->
	    
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>

<script type="text/javascript">
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
$( "#siginForm" ).validate({
  rules: {
    field: {
      required: true,
      email: true
    }
  }
});

</script> 
   