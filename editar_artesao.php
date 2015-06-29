<?php

require_once "conexao.php";
require_once "Classes.php";


include "header.php";


 
$artesao = new Artesao();

$artesao->id_artesao = $_POST['id_artesao'];



$artesao->getById($artesao->id_artesao);

$artesao->data_nascimento = converte_data($artesao->data_nascimento);

$array = explode(" ",$artesao->nome);

$sobre_nome = str_replace($array[0]." ","",$artesao->nome);

$artesao->nome = $array[0];


?>
<script type="text/javascript" language="javascript">


      $(document).ready(function () {
        $('#data_nas').datepicker({
            format: "dd/mm/yyyy",
             autoclose: true,
            language: "pt-BR"
        });
      });




function validar(cadastro_artesao) {

for(i=0; i<cadastro_artesao.length; i++){


if ((cadastro_artesao[i].value=="") || (cadastro_artesao[i].value==null)){

if(cadastro_artesao[i].name == 'foto') continue;



alert("Por favor preencha o campo " + cadastro_artesao[i].name); 
cadastro_artesao[i].focus();

return false; 
}

}

 var cpf = cadastro_artesao.cpf.value;
 var cep = cadastro_artesao.cep.value;

if(isNaN(cpf)){
	
	alert("O CPF deve conter apenas números !!");
	cadastro_artesao.cpf.focus();
	return false;
}

if(isNaN(cep)){
	
	alert("O CEP deve conter apenas números !!");
	cadastro_artesao.cpf.focus();
	return false;
}

if(cadastro_artesao.senha.value != cadastro_artesao.confir.value){

 alert(" A SENHA dos campos SENHA e CONFIRMA SENHA estão diferentes!!");
 
 return false;
 
 }

return true;

}

</script>





<div class="main">
	<div class="about_banner_img"><img src="images/banner11.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11"> Editar Artesão </h1>
      	</div>
		<div class="border"> </div>
     <div class="register-grids">  
       <div class="container">
		
		  <div class="row single-top">
			  
			  <div class="col-md-3 ">
							   <ul class="blog-list">
								  <h4> Opções </h4>
								  <li><a href="artesaos.php"> Buscar Artesão</a></li>
								  <li><a href="cadastro_artesao.php"> Cadastrar Novo Artesão </a></li>
								</ul>
				              </div> 
                 <div class="col-md-9">
					 
					 
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
	
	
	$data = $_POST['data_nas'];
	
	$data = converte_data($data);

   
   $artesao->cpf = $_POST['cpf'];
   $artesao->nome = $nome;
   $artesao->email = $email;
   $artesao->rua = $_POST['rua'];
   $artesao->numero = $_POST['numero'];
   $artesao->bairro = $_POST['bairro'];	
   $artesao->cidade = $_POST['cidade'];
   $artesao->estado = $_POST['uf'];	
   $artesao->telefone = $_POST['telefone'];
   $artesao->cep = $_POST['cep'];
   $artesao->data_nascimento = $data;
  
   if($artesao->atualizar() == false){
	   
	        echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  Não foi possível atualizar artesão, houve algum erro verifique os campos !! </strong> 
</div><br>";  
	   
   }
   else{
   
   if($_FILES["foto"]["name"] != ''){
	
	$imagem_artesao = new imagem_artesao();
   
    $imagem_artesao->id_artesao = $artesao->id_artesao;
    
     $result = $imagem_artesao->getImage();
     
     if($result) $imagem_artesao->trocar_imagem("foto");   
	  else
	      $imagem_artesao->inserir_imagem("foto");
	   
   }
   
   echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  CADASTRO ATUALIZADO COM SUCESSO!!! </strong> 
</div><br>";

 return;
   
}

}
   
}

$imagem = new imagem_artesao();

$imagem->id_artesao = $artesao->id_artesao;

$resp = $imagem->getImage();

if($resp) echo '<img src="data:image/jpeg;base64,'.base64_encode($imagem->conteudo).'" class="img-circle" width="70px" height="70px" alt=""/> <p><br/></p>';
else echo '<img src="img/user.jpg" class="img-circle" width="70px" height="70px" alt=""/>';

echo '
					 
					 
                  <form name="cadastro_user" action="editar_artesao.php" method="post" enctype="multipart/form-data" onSubmit="return validar(this)"> 
								<div class="register-top-grid">
										<h3> Dados do Artesão </h3>
										
										<input type="hidden" name="id_artesao" id="id_artesao" value="'.$artesao->id_artesao.'" >
										
										<div>
											<span> Nome do Artesão: <label>*</label></span>
											<input type="text" name="nome" id="nome" value="'.$artesao->nome.'" > 
										</div>
										<div>
											<span> Sobre Nome:<label>*</label></span>
											<input type="text" name="sobre_nome" id="sobre_nome" value="'.$sobre_nome.'"  > 
										</div>
										<div>
											<span>Email:<label>*</label></span>
											<input type="text" name="email" id="email" value="'.$artesao->email.'"> 
										</div>
										<div>
											<span>Telefone:<label>*</label></span>
											<input type="text" name="telefone" id="telefone" value="'.$artesao->telefone.'"> 
										</div>
										<div>
											<span>CPF:<label>*</label></span>
											<input type="text" name="cpf" id="cpf" maxlength="11" value="'.$artesao->cpf.'" > 
										</div>
										<div>
											<span>Data de Nascimento :<label>*</label></span>
											<input type="text" name="data_nas" id="data_nas" maxlength="11" value="'.$artesao->data_nascimento.'" > 
										</div>
										<div>
											<span>Rua:<label>*</label></span>
											<input type="text" name="rua" id="rua" value="'.$artesao->rua.'"> 
										</div>
										<div>
											<span>Numero:<label>*</label></span>
											<input type="text" name="numero" id="numero" value="'.$artesao->numero.'"> 
										</div>
										<div>
											<span>Bairro:<label>*</label></span>
											<input type="text" name="bairro" id="bairro" value="'.$artesao->bairro.'"> 
										</div>
										<div>
											<span>Cidade:<label>*</label></span>
											<input type="text" name="cidade" id="cidade" value="'.$artesao->cidade.'"> 
										</div>
										<div>
											<span>Estado:<label>*</label></span>
											<input type="text" name="uf" id="uf" value="'.$artesao->estado.'"> 
										</div>
										<div>
											<span>CEP:<label>*</label></span>
											<input type="text" name="cep" id="cep" value="'.$artesao->cep.'"> 
										</div>
										<div>
											<span>Foto do Artesão/tipo JPEG:<label></label></span>
											<input type="file" name="foto" id="foto"> 
										</div>
										<div class="clear"> </div>
											<a class="news-letter" href="#">
												<span> Campos Obrigatórios <label>*</label></span>
											</a>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<input type="submit" value="Salvar">
						</form>';
					 
?>
					 
		         </div>


          </div>
      </div>
     </div>
					 
<?php include "footer.php"; ?>
