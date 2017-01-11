<?php 
require_once 'header.php';

if( isset($_POST) && count($_POST) > 0 )
{
  $message=" <div class='alert alert-info'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 Merci, nous reviendrons vers vous assez rapidement!
				</div>";
}

?>



		<div class="container">
			<div class="page-header"><h1><span class="glyphicon glyphicon-envelope"></span>&nbsp;Nous sommes plus d&eacute;sireux de vous lire que vous de nous &eacute;crire</h1></div>
			
			<?php if(!empty($message)) echo $message ; ?>
			
			
			<div class="well well-sm">
				<form class="form-horizontal" method="POST" action="" id="formContact">
					<div class="form-group">
						<label for="yourName" class="col-sm-3 control-label">Votre Nom</label>
						<div class="col-sm-9">
							<div class="input-group">
								<!-- span class="input-group-addon glyphicon glyphicon-user"></span -->
								<span class="input-group-addon"></span>
								<input type="text" class="form-control" id="username" name="yourName" value=""  placeholder="Votre nom">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="yourEmail" class="col-sm-3 control-label">Votre Mail</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">@</span>
								<input type="email" class="form-control" id="useremail" name="yourEmail" placeholder="Votre email">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="yourComments" class="col-sm-3 control-label">Votre Message</label>
						<div class="col-sm-9">
							<div class="btn-toolbar" data-role="editor-toolbar" data-target="#yourComments">
								<div class="btn-group">
									<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
									<ul class="dropdown-menu"></ul>
								</div>
								<div class="btn-group">
									<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
										<li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
										<li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
									</ul>
								</div>
								<div class="btn-group">
									<a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
									<a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
									<a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
									<a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
								</div>
								<div class="btn-group hidden-xs hidden-sm">
									<a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
									<a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
									<a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
									<a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
								</div>
								<div class="btn-group hidden-xs hidden-sm">
									<a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
									<a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
									<a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
									<a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
								</div>
								<div class="btn-group hidden-xs hidden-sm">
									<a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
									<div class="dropdown-menu input-append">
										<input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
										<button class="btn" type="button">Add</button>
									</div>
									<a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>
								</div>
								<div class="btn-group hidden-xs hidden-sm">
									<a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
									<a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
								</div>
							</div>		
							<div id="yourComments">Saisir votre message ici.</div>								
						</div>
					</div>
					<div class="col-sm-9 col-sm-offset-3">
						<div class="checkbox">
							<label><input type="checkbox" name="alert" id="list_diffusion">M'inscrire à la newsletter</label>
						</div>
					</div>
					<div class="clearfix">&nbsp;</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Envoyer</button>
						</div>
					</div>
				</form>
			</div>
    	</div>
		
<script>
			function initEditorToolbar() {
				var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
					'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
				'Times New Roman', 'Verdana'],
				fontTarget = $('[title=Font]').siblings('.dropdown-menu');
				
				$.each(fonts, function (idx, fontName) {
					fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
				});
				$('a[title]').tooltip({container:'body'});
				$('.dropdown-menu input')
					.click(function() {return false;})
					.change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
					.keydown('esc', function () {this.value='';$(this).change();});

				$('[data-role=magic-overlay]').each(function () { 
					var overlay = $(this), target = $(overlay.data('target')); 
					overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
				});
			};

			initEditorToolbar();
			$('#yourComments').wysiwyg();
			$('#yourComments').cleanHtml();
			
//Gestion de l'envoi du form
$( "#formContact").submit(function( event ) {
  alertme = null;
  errorMsg="";
  nom = $('#username').val();
  email = $('#useremail').val();
  message = $('#yourComments').text();
  if(nom.length == 0)
  {
   errorMsg +="Le nom est obigatoire !";
  }
  else if(email.length == 0)
  {
   errorMsg +="Le mail est obigatoire !";
  }
  if( errorMsg.length > 0 )
  {
   alert(errorMsg);
   return false;
  }
  if ( $( "input:checked" ).length > 0 )
  {
   alertme = true;
  }
  userData = {"nom":nom,"email":email,"message":message,"alertme":alertme};
  
  $.post("ajax/contact.php", userData, function(data)
	  {
		alert ('Retour ajax:' + data );
	  });
  //alert('NOM:' + nom + '\n Email :' + email + ' \n Votre message :' + message + '\n Alertez-moi :' + alertme );
  event.preventDefault();
});
</script>
		
		
		
<?php 
require_once 'footer.php';
?>
