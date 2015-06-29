<?php

require_once "conexao.php";
require_once "Classes.php";


include "header.php";

$id_produto = $_POST['id_produto'];

$produto = new produto();

$produto->getById($id_produto);

$produto->valor = str_replace('.',',',$produto->valor);



?>

<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery_maskmoney.js"></script>

<script type="text/javascript">
	
	
	
  $(document).ready(function()     {
    $('#input').autocomplete(
    {
      source: "auto_complete_artesao.php"
    });
  });
  
  $(document).ready(function(){
              $('#valor').maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
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

var er = /\,|\.|\-/g;
var texto = cadastro_artesao.valor.value;

texto = texto.replace(er, "");

var estoque = cadastro_artesao.estoque.value;
 
if(isNaN(estoque)){
	
	alert("O campo Quantidade em Estoque deve conter um valor numerico inteiro !!");
	cadastro_artesao.estoque.focus();
	return false;
}

if(isNaN(texto)){
	
	alert("O campo Valor deve conter um número !!");
	cadastro_artesao.valor.focus();
	return false;
}


return true;


}
  
  
  
</script>



<div class="main">
	<div class="about_banner_img"><img src="images/banner11.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11"> Edição de Produto </h1>
      	</div>
		<div class="border"> </div>
     <div class="register-grids">  
       <div class="container">
		
		  <div class="row single-top">
			  
			  <div class="col-md-3 ">
							   <ul class="blog-list">
								  <h4> Opções </h4>
								  <li><a href="produtos.php"> Buscar Produto </a></li>
								  <li><a href="cadastro_produto.php"> Cadastrar Novo Produto </a></li>
								</ul>
				              </div> 
                 <div class="col-md-9">
					 
<?php

if(isset($_REQUEST['descricao'])){
	 
	
	$artesao = $_POST['input'];
	
	$artesao = substr($artesao, -11);
	
	$conexao = new conexao();
	
    $artesao = $conexao->consulta("select * from artesaos where cpf = '$artesao'");
    
    if($artesao == false){

         echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  Artesão inválido ou ainda não foi cadastrado !! </strong> 
  </div><br>";  
		
		
		
	}
	
	else{
	
	$valor = $_POST['valor'];
	
	$valor = str_replace('.','',$valor);
	$valor = str_replace(',','.',$valor);
		
   $produto->descricao_produto = $_POST['descricao'];
   $produto->qtd_estoque = $_POST['estoque'];
   $produto->valor = $valor; 
   $produto->id_artesao = $artesao->id_artesao;
   $produto->nome_artesao = $artesao->nome;
   $produto->cpf_artesao = $artesao->cpf;
  
  
   if($produto->atualizar() == false){
	   
	        echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  Cadastro de produto não realizado, verifique os campos !! </strong> 
</div><br>";  
	   
   }
   else{
  
   if($_FILES["foto"]["name"] != ''){
	 
	   
	$imagem_produto = new imagem_produto();
   
   $imagem_produto->id_produto = $produto->id_produto;
	   
	   $result = $imagem_produto->getImage();
	   
	   if($result) $imagem_produto->trocar_imagem("foto");   
	  else
	      $imagem_produto->inserir_imagem("foto");
	   
   }
   
   echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  PRODUTO ATUALIZADO COM SUCESSO !!! </strong> 
</div><br>";

$produto->valor = str_replace('.',',',$produto->valor);
   
}

}

   
}

$imagem = new imagem_produto();

$imagem->id_produto = $id_produto;

$resultado = $imagem->getImage();

if($resultado) echo '<img src="data:image/jpeg;base64,'.base64_encode($imagem->conteudo).'" width="260px" height="210px" alt=""/> <p><br/></p>';
else echo '<img src="img/sem_imagem.png" width="260px" height="210px" alt=""/><p><br/></p>';


         echo 		'			 
					  <form name="cadastro_produto" action=\'editar_produto.php\' method="post" enctype="multipart/form-data" onSubmit="return validar(this)"> 
								<div class="register-top-grid">
										<h3> Dados do Produto </h3>
										<div>
										     <input type="hidden" name="id_produto" id="id_produto" value="'.$produto->id_produto.'" >
										
											<span> Descrição do Produto: <label>*</label></span>
											<input type="text" name="descricao" id="descricao" value="'.$produto->descricao_produto.'" > 
										</div>
										<div>
											<span> Quantidade em Estoque: <label>*</label></span>
											<input type="text" name="estoque" id="estoque" value="'.$produto->qtd_estoque.'"> 
										</div>
										<div>
											<span> Valor (R$) :<label>*</label></span>
											<input type="text" name="valor" id="valor" value="'.$produto->valor.'"> 
										</div>
										<div>
											<span> Artesão:<label>*</label></span>
											
											     <input type="text" name="input" id="input" autocomplete="off" value="'.$produto->nome_artesao.' - CPF: '.$produto->cpf_artesao.'" > 
										
										</div>
										
										<div>
											<span>Foto do Produto/tipo JPEG:<label></label></span>
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
