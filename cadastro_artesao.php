<?php

require_once "conexao.php";
require_once "Classes.php";


include "header.php";


?>

<script type="text/javascript" language="javascript">


      $(document).ready(function () {
        $('#data_nas').datepicker({
            format: "dd/mm/yyyy",
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
      	    <h1 class="m_11"> Cadastro de novo artesão </h1>
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
	
	echo $data;
	
	return;
	
   $novo_artesao = new Artesao();
   
   $novo_artesao->cpf = $_POST['cpf'];
   $novo_artesao->nome = $nome;
   $novo_artesao->email = $email;
   $novo_artesao->rua = $_POST['rua'];
   $novo_artesao->numero = $_POST['numero'];
   $novo_artesao->bairro = $_POST['bairro'];	
   $novo_artesao->cidade = $_POST['cidade'];
   $novo_artesao->estado = $_POST['uf'];	
   $novo_artesao->telefone = $_POST['telefone'];
   $novo_artesao->cep = $_POST['cep'];
   $novo_artesao->data_nascimento = $_POST['data_nas'];
  
   if($novo_artesao->salvar_novo() == false){
	   
	        echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  Algum artesão já está cadastrado com esse CPF ou EMAIL !! </strong> 
</div><br>";  
	   
   }
   else{
   $novo_artesao->getByEmail($email);
   
   $imagem_artesao = new imagem_artesao();
   
   $imagem_artesao->id_artesao = $novo_artesao->id_artesao;
   
   if($_FILES["foto"]["name"] != ''){
	   
	   
	   $imagem_artesao->inserir_imagem("foto");
	   
   }
   
   echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  Cadastro Realizado com Sucesso!!! </strong> 
</div><br>";
   
}

}
   
}



?>					 

					 
					 
                  <form name="cadastro_user" action='cadastro_artesao.php' method="post" enctype="multipart/form-data" onSubmit="return validar(this)"> 
								<div class="register-top-grid">
										<h3> Dados do novo artesão </h3>
										<div>
											<span> Nome do Artesão: <label>*</label></span>
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
											<span>Telefone:<label>*</label></span>
											<input type="text" name="telefone" id="telefone"> 
										</div>
										<div>
											<span>CPF:<label>*</label></span>
											<input type="text" name="cpf" id="cpf" maxlength="11" > 
										</div>
										<div>
											<span>Data de Nascimento :<label>*</label></span>
											<input type="text" name="data_nas" id="data_nas" maxlength="11" > 
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
											<span>CEP:<label>*</label></span>
											<input type="text" name="cep" id="cep"> 
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
								<input type="submit" value="Registrar">
						</form>
                    </div>


          </div>
      </div>
     </div>

<?php include "footer.php"; ?>
