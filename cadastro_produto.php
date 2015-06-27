<?php

require_once "conexao.php";
require_once "Classes.php";


include "header.php";



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
      	    <h1 class="m_11"> Cadastro de Novo Produto</h1>
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
		
   $novo_produto = new produto();
   
   $novo_produto->descricao_produto = $_POST['descricao'];
   $novo_produto->qtd_estoque = $_POST['estoque'];
   $novo_produto->valor = $valor; 
   $novo_produto->id_artesao = $artesao->id_artesao;
  
  
   if($novo_produto->salvar_novo() == false){
	   
	        echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  Cadastro de produto não realizado, verifique os campos !! </strong> 
</div><br>";  
	   
   }
   else{
  
   if($_FILES["foto"]["name"] != ''){
	 
	 $novo_produto->getByDescricao($novo_produto->descricao_produto);
	   
	$imagem_produto = new imagem_produto();
   
   $imagem_produto->id_produto = $novo_produto->id_produto;
	   
	   $imagem_produto->inserir_imagem("foto");
	   
   }
   
   echo " <div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>  Cadastro do produto realizado com sucesso!!! </strong> 
</div><br>";
   
}

}

   
}







?>
					 
					  <form name="cadastro_produto" action='cadastro_produto.php' method="post" enctype="multipart/form-data" onSubmit="return validar(this)"> 
								<div class="register-top-grid">
										<h3> Dados do novo produto </h3>
										<div>
											<span> Descrição do Produto: <label>*</label></span>
											<input type="text" name="descricao" id="descricao" > 
										</div>
										<div>
											<span> Quantidade em Estoque: <label>*</label></span>
											<input type="text" name="estoque" id="estoque"> 
										</div>
										<div>
											<span> Valor (R$) :<label>*</label></span>
											<input type="text" name="valor" id="valor"> 
										</div>
										<div>
											<span> Artesão:<label>*</label></span>
											
											     <input type="text" name="input" id="input" autocomplete="off"> 
										
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
								<input type="submit" value="Cadastrar">
						</form>
					 
					 
					 
			
			</div> 
	      </div>
      </div>
     </div>



<?php include "footer.php"; ?>
