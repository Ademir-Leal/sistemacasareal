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

var unidades = cadastro_artesao.unidades.value;
 
if(isNaN(unidades) || (unidades.indexOf('.') > 0)){
	
	alert("O campo UNIDADES A SEREM VENDIDAS deve conter um número inteiro !!");
	cadastro_artesao.unidades.focus();
	return false;
}

if(isNaN(texto)){
	
	alert("O campo Valor deve conter um número !!");
	cadastro_artesao.valor.focus();
	return false;
}

if( Number(cadastro_artesao.unidades.value) > Number(cadastro_artesao.estoque.value)){
	
	alert("O VALOR DE UNIDADES A SEREM VENDIDAS ESTÁ MAIOR QUE O ESTOQUE DISPONÍVEL !! ");
	
	cadastro_artesao.unidades.focus();
	return false;
	
}


if(confirm("TEM CERTEZA QUE DESEJA CONCLUIR A VENDA??")) {
	
	return true;
	
}
else return false;



}

function calculo_total() {
       
       var total = document.getElementById('venda').valor_total;
       var unidades = document.getElementById('venda').unidades;
       
       var valor = document.getElementById('venda').valor;  
       
       var aux = valor.value.replace(',','.');
       
       aux = unidades.value * (aux);
       
       total.value = aux.toFixed(2).replace('.',',');
     
}
	
	
	
</script>

<div class="main">
	<div class="about_banner_img"><img src="images/banner11.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11"> Nova Venda </h1>
      	</div>
		<div class="border"> </div>
     <div class="register-grids">  
       <div class="container">
		
		  <div class="row single-top">
			  
			  <div class="col-md-3 ">
							   <ul class="blog-list">
								  <h4> Opções </h4>
								  <li><a href="vendas.php"> Pesquisar Venda Realizada </a></li>
								  <li><a href="realizar_venda.php"> Realizar Nova Venda </a></li>
								</ul>
				              </div>
                 <div class="col-md-9">

					
			
			
<?php


if(isset($_REQUEST['unidades'])){



$valor_venda = $_POST['valor_total'];

$nova_venda = new venda();

 
	 $nova_venda->id_artesao = $_POST['id_artesao'];
	 $nova_venda->nome_artesao = $_POST['artesao'];
	 $nova_venda->id_produto = $_POST['id_produto'];
	 $nova_venda->descricao_produto = $_POST['descricao'];
	 $nova_venda->id_user = $usuario->id_user;
	 $nova_venda->nome_user = $usuario->nome;
	 $nova_venda->qtd_do_produto = $_POST['unidades'];
	 $nova_venda->valor_venda = str_replace(',','.',$valor_venda);
	 
	 
	 
    $nova_venda->salvar_novo();
    
    $produto->qtd_estoque = ($produto->qtd_estoque - $nova_venda->qtd_do_produto);
    
    $produto->valor = str_replace(',','.',$produto->valor);
    
    $produto->atualizar();



echo " <br/> <br/> <div class=\"alert\">
                       <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                       <strong>  VENDA REGISTRADA COM SUCESSO!! </strong> 
                       </div><br>";
return;

}

$imagem = new imagem_produto();

$imagem->id_produto = $id_produto;

$resultado = $imagem->getImage();

if($resultado) echo '<img src="data:image/jpeg;base64,'.base64_encode($imagem->conteudo).'" width="260px" height="210px" alt=""/> <p><br/></p>';
else echo '<img src="img/sem_imagem.png" width="260px" height="210px" alt=""/><p><br/></p>';
						 
				              
				  echo '       <form name="venda" id="venda" action="nova_venda.php" method="post" enctype="multipart/form-data" onSubmit="return validar(this)">
				                              <input type="hidden" name="id_produto" id="id_produto" value="'.$produto->id_produto.'" > 
											
											<input type="hidden" name="id_artesao" id="id_artesao" value="'.$produto->id_artesao.'" >
											 
								<div class="register-top-grid">
										<h3> Dados da Nova Venda </h3>
										<div>
											<span> Descrição do Produto: <label>*</label></span>
											
											
											
											<input type="text" name="descricao" id="descricao" readonly="readonly"  value="'.$produto->descricao_produto.'" > 
										</div>
										<div>
											<span> Artesão do Produto:<label>*</label></span>
											
											    <input type="text" name="artesao" id="artesao" value="'.$produto->nome_artesao.'" READONLY > 
										
										</div>
										<div>
											<span> Quantidade em Estoque: <label>*</label></span>
											<input type="text" name="estoque" id="estoque" value="'.$produto->qtd_estoque.'" READONLY> 
										</div>
										<div>
											<span> Unidades a serem vendidas: <label>*</label></span>
											<input type="text" name="unidades" id="unidades" value="1" onKeyup="calculo_total()"> 
										</div>
										<div>
											<span> Valor unitário do produto (R$): <label>*</label></span>
											<input type="text" name="valor" id="valor" value="'.$produto->valor.'" READONLY> 
										</div>
										<div>
											<span> Valor total da venda (R$) :<label>*</label></span>
											<input type="text" name="valor_total" id="valor_total" value="'.$produto->valor.'" READONLY> 
										</div>
										
										<div class="clear"> </div>
											<div class="news-letter" >
												<span> Campos Obrigatórios <label>*</label></span>
											</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<input type="submit" value="Registrar Venda">
						</form>';
				          
?>    

      </div>	 
	</div>		 
  </div>
 </div>

</div>

<?php include "footer.php"; ?>			           
