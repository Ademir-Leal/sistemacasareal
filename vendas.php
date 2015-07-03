<?php 
require_once "conexao.php";
require_once "Classes.php";


include "header.php";



?>

<script type="text/javascript" language="javascript">

 $(document).ready(function () {
        $('#data').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            language: "pt-BR"
        });
      });


$(document).ready(function () {
        $('#data_termino').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            language: "pt-BR"
        });
      });




</script>

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
								  <li><a href="vendas.php"> Pesquisar Venda Realizada </a></li>
								  <li><a href="realizar_venda.php"> Realizar Nova Venda </a></li>
								</ul>
				              </div>
				              
				              <div class="col-md-9">
				                <div class="login-page">
				                     <div class="login-title">
	           		                   <h4 class="title"> Buscar Venda Realizada </h4>
					                      <div id="loginbox" class="loginbox">
						                    <fieldset class="input">
												<form name="busca" action="vendas.php" method="post"  id="busca" enctype="multipart/form-data" >
						  
													<p id="login-form-username">
													  <label for="modlgn_username"> Produto: </label>
													  <input id="produto" type="text" name="produto" class="inputbox" size="17" >
													</p>
													<p id="login-form-username">
													  <label for="modlgn_username"> Artesão: </label>
													     
													     <input id="artesao" type="text" name="artesao" class="inputbox" size="17" >
													     
													</p>
													<p id="login-form-username">
													  <label for="modlgn_username"> Porcentagem para o Centro de Apoio: </label>
													     
													     <input id="percent" type="text" name="percent" class="inputbox" size="17" >
													     
													</p>
													<p id="login-form-username">
													  <label for="modlgn_username"> Período da Venda (Início): </label>
													      <input id="data" type="text" name="data" class="inputbox" size="17" >
													      
													     
													     <label for="modlgn_username"> Término: </label>
													      
													      <input id="data_termino" type="text" name="data_termino" class="inputbox" size="17" >
													</p>
													<div class="remember">
														
														<input type="submit" class="button" value="Buscar"><div class="clear"></div>
													 </div>
												  
												 </form>
												
				              
				               				</fieldset>
					                       </div>
			                          </div>
				                </div>
				                <div class="clear"></div>
				                <P><br><br> </P>
			                  </div>
			                  
			                  
				       
<?php				       
	
	if(isset($_REQUEST['produto']) && (isset($_REQUEST['data'])) && (isset($_REQUEST['artesao']))){			       
			
			$produto = $_POST['produto'];
            $artesao = $_POST['artesao'];
            $data_inicio = $_POST['data'];
            $data_termino = $_POST['data_termino'];
			
			$resul =0;	  
		
		if(($produto == '') && ($artesao == '') && ($data_inicio == '') && $data_termino == ''){
			
			$venda = new venda();
			
			$resul = $venda->listall();
				
			
		}
		else{
			
			
			$venda = new venda();
			
			$resul = $venda->listByFiltro($produto, $artesao, $data_inicio, $data_termino);
			
			
		}
		
		if($resul == false) {
		
		echo '<p> Nenhum resultado!! </p>';
		     return;
	    }
	     
	     $count = $resul->rowCount();
					              
				     echo'   <div class="container">
				             <div style=" position: relative; top: 50%; left: 40%; margin-top: -48px; margin-left: -100px;">
				             <div class="col-md-4">
     	                          <h3 class="m_2"> '.$count.' Vendas </h3>';
     	                          
     	               $imagem = new imagem_produto();
     	                          
				              
				     while($rs = $resul->fetch(PDO::FETCH_OBJ)){ 
						 
						 $imagem->id_produto = $rs->id_produto;  
						 $img = $imagem->getImage();      
				            
				            if($img){
				              
				            echo '  <div class="events">
									<div class="event-top">
										<ul class="event1">
											<h4> FOTO DO PRODUTO <h4>
											<img src="data:image/jpeg;base64,'.base64_encode($imagem->conteudo).'" alt=""/>
										</ul>
										<ul class="event1_text">
											<span class="m_5"> DATA DA VENDA: '.date('d/m/Y H:i:s', strtotime($rs->data_venda)).'   </span>
											<h4> '.$rs->descricao_produto.'  </h4>
											<p>  Artesão: '.$rs->nome_artesao.' <br><br>
											     Quantidade de Produtos Vendidos: '.$rs->qtd_do_produto.' <br>
											     Valor da Venda:  R$ '.$rs->valor_venda.' <br><br>
											     USUÁRIO QUE REALIZOU A VENDA: '.$rs->nome_user.' <br><br>
											 </p>
											
										</ul>
										<div class="clear"></div>
									</div>
									
								 </div>';
							 }
							 else{
								 
								 echo '  <div class="events">
									<div class="event-top">
										<ul class="event1">
											<h4> FOTO DO PRODUTO <h4>
											  <img src="img/sem_imagem.png" alt=""/>
										</ul>
										<ul class="event1_text">
											<span class="m_5"> DATA DA VENDA: '.date('d/m/Y H:i:s', strtotime($rs->data_venda)).'   </span>
											<h4> '.$rs->descricao_produto.'  </h4>
											<p>  Artesão: '.$rs->nome_artesao.' <br><br>
											     Quantidade de Produtos Vendidos: '.$rs->qtd_do_produto.' <br>
											     Valor da Venda:  R$ '.$rs->valor_venda.' <br><br>
											     USUÁRIO QUE REALIZOU A VENDA: '.$rs->nome_user.' <br><br>
											 </p>
											
										</ul>
										<div class="clear"></div>
									</div>
									
								 </div>';
								 
								 
								 
								 
							 }
							 
							 
							 }
								 
					echo '</div>
							 </div>
							 </div>';
				              
				              

}

			              
				             
?>
				              
				              
				              
				              
				              
	</div>	 
			 
 </div>
	
<?php include "footer.php"; ?> 
