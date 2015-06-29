<?php 
require_once "conexao.php";
require_once "Classes.php";


include "header.php";



$array = explode(" ",$usuario->nome);

$sobre_nome = str_replace($array[0],"",$usuario->nome);

$usuario->nome = $array[0];




?>

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




<div class="main">
	
	<div class="about_banner_img"><img src="images/banner11.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11"> Edição de Dados do Usuário </h1>
      	</div>
		<div class="border"> </div>
	 	 <div class="container">	         
	          
		 </div>
</div>


<div class="main">
          <div class="register-grids">
          	<div class="container">
			
			
<?php

if(isset($_REQUEST['email']) && isset($_REQUEST['cpf'])){
	 
		
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
		
    
   
   $usuario->cpf = $_POST['cpf'];
   $usuario->nome = $nome;
   $usuario->email = $email;
   $usuario->rua = $_POST['rua'];
   $usuario->numero = $_POST['numero'];
   $usuario->bairro = $_POST['bairro'];	
   $usuario->cidade = $_POST['cidade'];
   $usuario->uf = $_POST['uf'];	
   $usuario->senha = $_POST['senha'];
   $usuario->perm = "admin";
   
   
   $usuario->atualizar();
   
      
   $imagem_usuario = new imagem_user();
   
   $imagem_usuario->id_user = $usuario->id_user;
   
   if($_FILES["foto"]["name"] != ''){
	   
	   
	   $imagem_usuario->trocar_imagem("foto");
	   
   }
   
   $_SESSION['email'] = $usuario->email;
   $_SESSION['senha'] = $usuario->senha;
   
   echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  EDIÇAO REALIZADA COM SUCESSO!!! </strong> 
</div><br>";
   
   
   
}
   
}



echo '
						
						<form name="cadastro_user" action=\'editar_usuario.php\' method="post" enctype="multipart/form-data" onSubmit="return validar(this)"> 
								<div class="register-top-grid">
										<h3>Informação Pessoal</h3>
										<div>
											<span> Nome: <label>*</label></span>
											<input type="text" name="nome" id="nome" value="'.$usuario->nome.'" > 
										</div>
										<div>
											<span> Sobre Nome:<label>*</label></span>
											<input type="text" name="sobre_nome" id="sobre_nome" value="'.$sobre_nome.'"> 
										</div>
										<div>
											<span>Email:<label>*</label></span>
											<input type="text" name="email" id="email" value="'.$usuario->email.'"> 
										</div>
										<div>
											<span>CPF:<label>*</label></span>
											<input type="text" name="cpf" id="cpf" maxlength="11" value="'.$usuario->cpf.'"> 
										</div>
										<div>
											<span>Rua:<label>*</label></span>
											<input type="text" name="rua" id="rua" value="'.$usuario->rua.'"> 
										</div>
										<div>
											<span>Numero:<label>*</label></span>
											<input type="text" name="numero" id="numero" value="'.$usuario->numero.'"> 
										</div>
										<div>
											<span>Bairro:<label>*</label></span>
											<input type="text" name="bairro" id="bairro" value="'.$usuario->bairro.'"> 
										</div>
										<div>
											<span>Cidade:<label>*</label></span>
											<input type="text" name="cidade" id="cidade" value="'.$usuario->cidade.'"> 
										</div>
										<div>
											<span>Estado:<label>*</label></span>
											<input type="text" name="uf" id="uf" value="'.$usuario->uf.'"> 
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
											<input type="password" name="senha" id="senha" class="inputbox" value="'.$usuario->senha.'"   size = "50">
										</div>
										<div>
											<span> Confirma Senha<label>*</label></span>
											<input type="password" name="confir" id="confir"  class="inputbox" value="'.$usuario->senha.'" size = "50" >
										</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<input type="submit" value="Salvar">
						</form>
					</div>
				</div>
         </div>';

?>
<?php include "footer.php"; ?>
