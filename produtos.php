<?php 
require_once "conexao.php";
require_once "Classes.php";


include "header.php";
 
?>

<div class="main">
	<div class="about_banner_img"><img src="images/banner11.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11"> Busca Produto </h1>
      	</div>
		<div class="border"> </div>
	
	
	 	<div class="container">
			 
		<div class="row single-top">
			

					
			
			
							 <div class="col-md-3 ">
							   <ul class="blog-list">
								  <h4> Opções </h4>
								  <li><a href="produtos.php"> Buscar Produto </a></li>
								  <li><a href="cadastro_produto.php"> Casdastrar Novo Produto </a></li>
								</ul>
				              </div>
				              
				              
				              <div class="col-md-9">
				                <div class="login-page">
				                     <div class="login-title">
	           		                   <h4 class="title"> Buscar Produto </h4>
					                      <div id="loginbox" class="loginbox">
						                    <fieldset class="input">
												<form name="busca" action="produtos.php" method="post"  id="busca" enctype="multipart/form-data" >
						  
													<p id="login-form-username">
													  <label for="modlgn_username"> Descrição do Produto: </label>
													  <input id="descricao" type="text" name="descricao" class="inputbox" size="17" >
													</p>
													<p id="login-form-username">
													  <label for="modlgn_username"> Artesão: </label>
													     
													     <input id="artesao" type="text" name="artesao" class="inputbox" size="17" >
													     
													</p>
													<p id="login-form-username">
													  <label for="modlgn_username"> Filtro: </label>
													   <select id="filtro" name="filtro" class="form-control">
														  <option value="N" > Nenhum </option>
														  <option value="baixo"> Estoque Baixo </option>
														  <option value="alto"> Estoque Alto </option>
													   </select>
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
			                  </div>
			                  
			                  
		 
<?php           
									   
  if(isset($_REQUEST['descricao']) && (isset($_REQUEST['artesao'])) && (isset($_REQUEST['filtro']))){
	
	
	 $descricao = $_POST['descricao'];
     $artesao = $_POST['artesao'];
     $filtro = $_POST['filtro'];
     
     
     $produto = new produto();
     
     $produto->id_artesao = 2;
     $produto->descricao_produto = 'Vaso feito de Barro';
     $produto->qtd_estoque = 15;
     $produto->valor = 10.70;
     
     
    
     
     
     if(($descricao == '') && ($artesao == '') && ($filtro == "N")){
		 
		 
		      $resul = $produto->listall();
		 
		 
	 }
	 else{
		 
		 
		 
		 
		 
	 }
	 
        

	 $count=0;
	 
	 $imagem = new imagem_produto();
	 $imagem_artesao = new imagem_artesao();
	 $artesao = new Artesao();
	 
	 echo '<div class="container">
	      <div style=" position: relative; top: 50%; left: 35%; margin-top: -48px; margin-left: -100px;">
		   <div class="classes_wrapper">
		 	<div class="row class_box">
	       
	    '; 
	         
	 
	 while ($rs = $resul->fetch(PDO::FETCH_OBJ)) {
	 
	         $imagem->id_produto = $rs->id_produto;
	         $imagem_artesao->id_artesao = $rs->id_artesao;
	         
	        $artesao->getById($rs->id_artesao);
	       $resultado =  $imagem->getImage();
	       $imagem_artesao->getImage();
	
        if($resultado) {                   
         echo'
         
         <div class="col-md-6">
				<div class="class_left">
					<img src="data:image/jpeg;base64,'.base64_encode($imagem->conteudo).'" width="260px" height="240px" alt=""/>
				</div>
				<div class="class_right">
					<h3> '.$rs->descricao_produto.'    </h3>
					<p> Artesão: '.$artesao->nome.'  </p>
					<div class="class_img">
					  <img src="img/user.jpg" alt=""/>
					  <div class="class_desc">
					  	<h4> Valor: R$ '.$rs->valor.' </h4>
					  	<h5> Quantidade em Estoque: '.$rs->qtd_estoque.'  </h5>
					  	<p> Está em estoque alto  </p>
					  </div>
					    <div class="clear"></div>
					     <ul class="buttons_class">
					  	 <li class="btn5"><a href="#"> Editar </a></li>	
				         <li class="btn6"><a href="#"> Excluir </a></li>	
			            <div class="clear"></div>
			         </ul>
					</div>
				</div>
				
			  </div>
			 <div class="clear"></div><br/>'; 
		  }
		  else{
			  echo'
         
         <div class="col-md-6">
				<div class="class_left">
					<img src="img/inicial.jpg" width="260px" height="240px" alt=""/>
				</div>
				<div class="class_right">
					<h3> '.$rs->descricao_produto.'    </h3>
					<p> Artesão: '.$artesao->nome.'  </p>
					<div class="class_img">
					   <img src="data:image/jpeg;base64,'.base64_encode($imagem_artesao->conteudo).'" alt=""/>
					  <div class="class_desc">
					  	<h4> Valor: R$ '.$rs->valor.' </h4>
					  	<h5> Quantidade em Estoque: '.$rs->qtd_estoque.'  </h5>
					  	<p> Está em estoque alto  </p>
					  </div>
					    <div class="clear"></div>
					     <ul class="buttons_class">
					  	 <li class="btn5"><a href="#"> Editar </a></li>	
				         <li class="btn6"><a href="#"> Excluir </a></li>	
			            <div class="clear"></div>
			         </ul>
					</div>
				</div>
				
			  </div>
			 
			 <div class="clear"></div><br/>'; 
			  
			  
			  
			  
		  }
		   
	   }
		 
		 echo '   </div>
		         </div> 
		       </div>
		       </div>';

		 
		 
}		               
		               
		               
?>	 
		    </div>
		 
		</div>	 
			 
 </div>
	
<?php include "footer.php"; ?> 
