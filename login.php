<?php 

require_once "conexao.php";
require_once "Classes.php";


 

?>
<!DOCTYPE html>
<html>
<head>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        Casa Real
    </title>
    
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />-->
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
        
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
    
    
</head>
<body>
	
<script type="text/javascript" language="javascript">


function validar(login) {

for(i=0; i<login.length; i++){


if ((login[i].value=="") || (login[i].value==null)){


alert("O campo " + login[i].name + " está vazio!!  "); 
login[i].focus();

return false; 
}

}

return true;

}

</script>
	

	
    <div class="header-bottom">
		 <div class="container">
			<div class="header-bottom_left">
				<i class="phone"> </i><span> (38)3531 - 0000  </span>
			</div>
			<div class="social">	
			   <ul>	
				  <li class="facebook"><a href="#"><span> </span></a></li>
				  <li class="twitter"><a href="#"><span> </span></a></li>
				  <li class="pinterest"><a href="#"><span> </span></a></li>	
				  <li class="google"><a href="#"><span> </span></a></li>
				  <li class="tumblr"><a href="#"><span> </span></a></li>
				  <li class="instagram"><a href="#"><span> </span></a></li>	
				  <li class="rss"><a href="#"><span> </span></a></li>							
			   </ul>
		   </div>
		   <div class="clear"></div>
		</div>
	  </div>
        <footer>
        </footer>
    </div>


	<div class="main">
		<div class="about_banner_img"><img src="images/banner11.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11"> Login </h1>
      	</div>
		<div class="border"> </div>
	 <div class="container">		  

 <div class="main">
          <div class="login_top">
          	<div class="container">
			  
			  <div style=" position: relative; top: 50%; left: 35%; margin-top: -20px; margin-left: -100px;">
				<div class="col-md-6">
				 <div class="login-page">
				  <div class="login-title">
	           		<h4 class="title"> Usuários Registrados </h4>
					<div id="loginbox" class="loginbox">
						<fieldset class="input">
							
	<?php
	     
          if(isset($_REQUEST['mensagem'])){
	 
	 
	              $mensagem = $_GET['mensagem'];
	              
	              if($mensagem == 1){
			 
			           echo " <div class=\"alert\">
                       <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                       <strong>  Email e Senha não correspondem !! </strong> 
                       </div><br>";
			 
		          }
	 
          } 
	     
	     
	     
	
	?>
							
							
							
						<form name="login" action="autenticacao.php" method="post"  id="login" enctype="multipart/form-data" onSubmit="return validar(this)" >
						  
						    <p id="login-form-username">
						      <label for="modlgn_username">Email: </label>
						      <input id="email" type="email" name="email" class="inputbox" size="18" autocomplete="off">
						    </p>
						    <p id="login-form-password">
						      <label for="modlgn_passwd"> Senha: </label>
						      <input id="senha" type="password" name="senha" class="inputbox" size="18" autocomplete="off">
						    </p>
						    <div class="remember">
							    <p id="login-form-remember">
							      <label for="modlgn_remember"><a href="#"> Esqueceu sua senha ? </a></label>
							   </p>
							    <input type="submit" class="button" value="Login"><div class="clear"></div>
							 </div>
						  
						 </form>
						 </fieldset>
					</div>
			      </div>
				</div>
				<div class="clear"></div>
			  </div>
			</div>
			</div>
		  </div>
         </div>       
             
                         
			  
		 </div>
	</div>
	
<?php include "footer.php"; ?>
