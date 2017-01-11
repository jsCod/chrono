<?php

?>
		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<address>
							<strong>72hCHRONO</strong><br>
							Boulevard du developpement durable<br>
							75015 PARIS<br>
							<abbr title="Phone">P:</abbr> +33 (0) x 01 02 03 04<br>
							<a href="mailto:#">silga.dev@gmail.com</a>
						</address>					
					</div>
				</div>

				<div class="text-muted pull-left"><a href="#" target="_blank">72hchrono&reg; </a></div>
				<div class="text-muted pull-right">&copy; <a href="#" target="_blank">Copyright 72HCHRONO</a> 2016</div>
			</div>
			<div class="container"> <!-- Suivez-nous -->
			  <div class="row">
			   <div  class="">
			     <ul class="nav navbar-nav">
			        <li><a href="#"><span class="btn-facebook"></span>Facebook</a></li>
			        <li><a href="#">Twitter</a></li>
			        <li><a href="#">LinkedIN</a></li>
			        <li><a href="#">Youtube</a></li>
			     </ul>
			   </div>
			  </div>
			</div>
		</div>

<script type="text/javascript">

/*$("#signupForm").submit(function( event ) {
	
 alert("soumission du form");
 
 email        = $("#yourEmail").val();
	if(validateEmail(email))
	{
		param = {"mail":email};
		$.post("ajax/email.php",param,function(data)
		{
			if(data)
			{
			 alert("\n L'adresse mail :  "+email+" existe déjà !");
			 //event.preventDefault();
			 return false;
			}
					
	});//end post
	
  }//if mail valid
  else
  {
   return false;
  }

});*/

$( "#signupForm" ).validate({
	  rules: {
	    field: {
	      required: true,
	      email: true
	    }
	  }
});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

		 //diplay deconnexion
		 username = $("span.bienvenu").html(); 
		  if(username.length ==  0) 
		  {
			$("span.caret").remove();  
			$("li.dropdown").remove();
		  }
		  
		 //Clic sur le bouton de login
			$('#logonLink').on('click', function(e) {
				$('#logonBox').modal({
					keyboard: false,
					backdrop: 'static'
				});
			});
			$('#doLogon').on('click', function(e) {
				errorMsg ="";
				userMail    = $("#mail").val();
				userPassword = $("#pass").val();
				if(userMail.length == 0)
				{
				 errorMsg += 'Le mail est obligatoire ! \n';
				}
				else if(!validateEmail(userMail))
				{
                  errorMsg +='L\'email :'+ userMail +' n\'est pas valide !\n';
				}
				else if(userPassword.length == 0)
				{
				 errorMsg += "\n Le mot de passe est obligatoire !";
				}
				
				if(errorMsg.length != 0)
				{
				 alert('Veuillez coriger les erreurs : \n ' + errorMsg );
				 return false;
				}
				param = {"mail":userMail,"password":userPassword};  
				//Vérifier en base!
				$.post("ajax/login.php",param,function(data)
				{
					//alert("Retour :" + data);
					if(data == 0)
					{
					alert('Echer de connexion : Mail et/ou mot de passe invalide !');
                     return false;					
					}
					//$("span.bienvenu").text(data.nom);
					$(location).attr('href', '');
				});
				
				//alert('Thank you for Signing In');
				$('#logonBox').modal('hide');
			});
			
			$('#createUser').on('click', function(e) {

			    errorMsg = '';
			    nom         = $("#yourName").val();
				prenom      = $("#yourUserName").val();
				mail        = $("#yourEmail").val();
				password    = $("#yourPwd").val();
				confirmPass = $("#confirmPwd").val();
				
				if(nom.length == 0)
				{
				 errorMsg += 'Le nom est obligatoire ! \n';
				}
				else if(prenom.length == 0)
				{
				 errorMsg += "\n Le prenom est obligatoire !";
				}
				else if(mail.length == 0)
				{
				 errorMsg += "\n Le mail est obligatoire !";
				}
				else if(!validateEmail(mail))
				{
                  errorMsg +='L\'email :'+ mail +' n\'est pas valide !\n';
				}
				else if( $.trim(password) != $.trim(confirmPass) )
				{
				 errorMsg += "\n Les mots de passe ne sont pas identiques !";
				}
		 		if(errorMsg.length != 0)
				{
				 alert('Veuillez corrigez les erreurs suivants : \n ' + errorMsg);
				 
				 return false;
				}
					userData = {"nom":nom,
								"prenom":prenom,
								"mail":mail,
								"password":password
							   };
				
				//alert("nom :"+userData.nom+"\n prenom:"+userData.prenom+"\n mail:"+userData.mail+"\n pass :"+userData.password);
				
				$.post("ajax/user.php",userData, function(retour)
				{
				  //alert ("=== create user Retour ajax :" + retour);
				  
				  if(retour == 1)
				  {
				    //alert( 'Merci '+ userData.prenom +', vous aller recevoir un mail à votre adresse : '+ userData.mail +' pour terminer votre inscription !');
				    alert( 'Merci '+ userData.prenom +', vous pouvez déjà vous connecter ');
				  }
				  else if(retour == 2)
				  {
					  alert( 'Cet email : '+ userData.mail +' existe déjà !');
				  }
				  else
				  {
					  alert("Une erreur est survenue, merci de reessayer ultérieurement !");
				  }
				  //TODO: Vider les champs dans l'interface!
				});
				$('#logonBox').modal('hide');
					
			});
			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				var data = $(e.target).data('caption');
				var modal = $('#logonBox');
				modal.find('.modal-title').text(data);
			  
			});
			
		 $("#disconnect").click(function(e){
			e.preventDefault();
			username = $("span.bienvenu").html(); 
		   if(!username) return false;
			 //Destroy session
			 $.post("ajax/disconnect.php",null, function(data)
			 {
				 if(!data)
				 alert('Une erreur est survenue !');    
				 alert( 'Aurevoir '+ username + ' : Merci de votre visite, à bientôt!');
				//$("span.bienvenu").text(''); 
				//$(location).attr('href', '/chrono/index.php');//dev
				$(location).attr('href', '/index.php');
			 });
		    		   		
		 }); //disconnect
		 
		</script>
		
	</body>
<html>
