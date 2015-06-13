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
        Registro
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


function validar(cadastro_cliente) {

for(i=0; i<cadastro_cliente.length; i++){


if((cadastro_cliente[i].name == 'senha') || (cadastro_cliente[i].name == 'confir') ){
	
	
	if(cadastro_cliente[i].value.length < 6 ){ 
		
	   alert(" A SENHA deve conter 6 dígitos no mínimo!!");
			
	   return false;	
		
	}
	
	
}


if ((cadastro_cliente[i].value=="") || (cadastro_cliente[i].value==null)){

if(cadastro_cliente[i].name == 'foto') continue;



alert("Por favor preencha o campo " + cadastro_cliente[i].name); 
cadastro_cliente[i].focus();

return false; 
}

}

if(cadastro_cliente.senha.value != cadastro_cliente.confir.value){

 alert(" A SENHA dos campos SENHA e CONFIRMA SENHA estão diferentes!!");
 
 return false;
 
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
      	    <h1 class="m_11"> Registro </h1>
      	</div>
		<div class="border"> </div>
	 	 <div class="container">
			 
	         
	         <div align="Right" >
	         <a align="Right" href="login.php"><span> Login </span></a></h3>
	         </div>
			 
		 </div>
</div>

<div class="main">
          <div class="register-grids">
          	<div class="container">
			
			
<?php

if(isset($_REQUEST['email'])){
	 
		
		$email = $_POST['email'];
		
		$ver = strstr($email, '@');
		
	if($ver ==''){
		
		echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  Email Inválido!!! </strong> 
</div><br>";	
		
	 
		
	}
	else{
	
	
	$nome = $_POST['nome'];

    $sobre = $_POST['sobre_nome'];
    
    $nome = $nome." ".$sobre;
    $email = $_POST['email'];		
		
   $novo_usuario = new user();
   
   $novo_usuario->cpf = $_POST['cpf'];
   $novo_usuario->nome = $nome;
   $novo_usuario->email = $email;
   $novo_usuario->rua = $_POST['rua'];
   $novo_usuario->numero = $_POST['numero'];
   $novo_usuario->bairro = $_POST['bairro'];	
   $novo_usuario->cidade = $_POST['cidade'];
   $novo_usuario->uf = $_POST['uf'];	
   $novo_usuario->senha = $_POST['senha'];
   $novo_usuario->perm = "admin";
   
   
   $novo_usuario->salvar_novo();
   
   
   $novo_usuario->getByEmail($email);
   
   $imagem_usuario = new imagem_user();
   
   $imagem_usuario->id_user = $novo_usuario->id_user;
   
   if($_FILES["foto"]["name"] != ''){
	   
	   
	   $imagem_usuario->inserir_imagem("foto");
	   
   }
   
   echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  Cadastro Realizado com Sucesso!!! Clique no Link Login para acessar o sistema. </strong> 
</div><br>";
   
   
   
}
   
}



?>
						
						<form name="cadastro_user" action='insere.php' method="post" enctype="multipart/form-data" onSubmit="return validar(this)"> 
								<div class="register-top-grid">
										<h3>Informação Pessoal</h3>
										<div>
											<span> Nome: <label>*</label></span>
											<input type="text" name="nome" id="nome" > 
										</div>
										<div>
											<span> Sobre Nome:<label>*</label></span>
											<input type="text" name="sobre_nome" id="sobre_nome"> 
										</div>
										<div>
											<span>Email:<label>*</label></span>
											<input type="text" name="email" id="email"> 
										</div>
										<div>
											<span>CPF:<label>*</label></span>
											<input type="text" name="cpf" id="cpf" maxlength="11" > 
										</div>
										<div>
											<span>Rua:<label>*</label></span>
											<input type="text" name="rua" id="rua"> 
										</div>
										<div>
											<span>Numero:<label>*</label></span>
											<input type="text" name="numero" id="numero"> 
										</div>
										<div>
											<span>Bairro:<label>*</label></span>
											<input type="text" name="bairro" id="bairro"> 
										</div>
										<div>
											<span>Cidade:<label>*</label></span>
											<input type="text" name="cidade" id="cidade"> 
										</div>
										<div>
											<span>Estado:<label>*</label></span>
											<input type="text" name="uf" id="uf"> 
										</div>
										<div>
											<span>Foto do Usuário/tipo JPEG:<label></label></span>
											<input type="file" name="foto" id="foto"> 
										</div>
										<div class="clear"> </div>
											<a class="news-letter" href="#">
												<span> Campos Obrigatórios <label>*</label></span>
											</a>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<div class="register-bottom-grid">
										<h3>  Autenticação: </h3>
										<div>
											<span> Senha - Mínimo 6 dígitos <label>*</label></span>
											<input type="password" name="senha" id="senha" class="inputbox"   size = "50">
										</div>
										<div>
											<span> Confirma Senha<label>*</label></span>
											<input type="password" name="confir" id="confir"  class="inputbox" size = "50" >
										</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<input type="submit" value="Registrar">
						</form>
					</div>
				</div>
         </div>
         
<?php include "footer.php"; ?>
