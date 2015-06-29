<?php 
require_once "conexao.php";
require_once "Classes.php";


include "header.php";


$venda = new venda();

$venda->getById(1);




?>

<div class="main">
	<div class="about_banner_img"><img src="images/banner11.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11"> Vendas </h1>
      	</div>
		<div class="border"> </div>
	
	
 <div class="container">
			 
   <div class="row single-top">
			

					
			
			
							 <div class="col-md-3 ">
							   <ul class="blog-list">
								  <h4> Opções </h4>
								  <li><a href="produtos.php"> Pesquisar Venda Realizada </a></li>
								  <li><a href="cadastro_produto.php"> Realizar Nova Venda </a></li>
								</ul>
				              </div>
<?php

	 echo '<p> '.date('d/m/Y H:i:s', strtotime($venda->data_hora_venda)).' </p>';			              
				             
?>
				              
				              
				              
				              
				              
	</div>	 
			 
 </div>
	
<?php include "footer.php"; ?> 
