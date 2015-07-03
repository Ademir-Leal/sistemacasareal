<?php
session_start();

require_once "conexao.php";
require_once "Classes.php";

if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)) { 

unset($_SESSION['email']); 
unset($_SESSION['senha']); 

session_destroy();

header("Location: login.php");

}
else{
	
$email = $_SESSION['email'];

$usuario = new user();

$usuario->getByEmail($email);


$imagem_usuario = new imagem_user();

$imagem_usuario->id_user = $usuario->id_user;

		
}

?>


<!DOCTYPE html>
<html   ng-app="app">
<head>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        Casa Real
    </title>

<link type="text/css" href="js/jquery-ui.css" rel="stylesheet"/> 
 
 
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
<link href="css/datepicker.css" rel="stylesheet">

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
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

    
</head>
<body>
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
    <!-- end header_bottom -->
	<!-- start menu -->
    <div class="menu" id="menu">
		
		
		
	  <div class="container">
		  
		  
		  
		  
		  
		 <div class="logo">
			<a href="#"> <img src="img/logo.png" alt=""/>  </a>
		 </div>
		 <div class="h_menu4"><!-- start h_menu4 -->
		   <a class="toggleMenu" href="#">Menu</a>
			 <ul class="nav">
			   <li><a href="inicio.php"> Principal </a></li>
			   
			   <li><a href="artesaos.php"> Artesãos </a></li>
			   <li><a href="vendas.php"> Vendas </a></li>
			   <li><a href="produtos.php">  Produtos  </a></li>
			   <li><a href="insere.php"> Cadastrar Novo Usuário </a></li>
			  <li> <?php  $imagem_usuario->mostrar_imagem(); ?> </li>
			   
			   
			 </ul>
			  <script type="text/javascript" src="js/nav.js"></script>

		  </div><!-- end h_menu4 -->
		 <div class="clear"></div>
		  
		  <div style="margin-left: 91.8%; color"  >
		   <ul class="nav">
		   <li class="active"><a href="#"> Opções </a>
			   	 <ul>
					 
					<li><a href="editar_usuario.php"> Editar </a></li>
					<li><a href="logout.php"> Sair </a></li>
					
				 </ul></li>
			</ul>
		   </div>
		   
		  <!-- <div style="margin-left: 94.6%; color"  > <a href="logout.php"><font color="white" onMouseOver="color='red'" onMouseOut="color='white'" > Logout </font></a></div> -->
		  
	  </div>
	  
	</div>
