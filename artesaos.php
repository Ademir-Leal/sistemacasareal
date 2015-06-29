<?php

require_once "conexao.php";
require_once "Classes.php";


include "header.php";

$consulta = null;

if(isset($_REQUEST['nome']) && (isset($_REQUEST['cpf'])) && (isset($_REQUEST['cidade']))){
	
	
	 $nome = $_POST['nome'];
     $cpf = $_POST['cpf'];
     $cidade = $_POST['cidade'];
     
     
     if(($nome == '') && ($cpf == '') && ($cidade == '')){
		 
		 
		 $artesao = new Artesao();
		 
		 $consulta = $artesao->listall();
		 
	 }
	 else{
		 
		 $artesao = new Artesao();
		 
		 $consulta = $artesao->listByFiltro($nome,$cpf,$cidade);
		 
	 }
		 
		 
}
     
     

?>

<div class="main">
	<div class="about_banner_img"><img src="images/banner11.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11"> Busca de Artesão </h1>
      	</div>
		<div class="border"> </div>
        
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
				                <div class="login-page">
				                     <div class="login-title">
	           		                   <h4 class="title"> Buscar Artesão </h4>
					                      <div id="loginbox" class="loginbox">
						                    <fieldset class="input">
												<form name="busca" action="artesaos.php" method="post"  id="login" enctype="multipart/form-data" >
						  
													<p id="login-form-username">
													  <label for="modlgn_username"> Nome do Artesão: </label>
													  <input id="nome" type="text" name="nome" class="inputbox" size="17" >
													</p>
													<p id="login-form-password">
													  <label for="modlgn_passwd"> CPF: </label>
													  <input id="cpf" type="text" name="cpf" class="inputbox" size="17" >
													</p>
													<p id="login-form-password">
													  <label for="modlgn_passwd"> Cidade: </label>
													  <input id="cidade" type="text" name="cidade" class="inputbox" size="10" >
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
		 
		               
									   
		               
		               
		               
		         
		 
		    </div>
		    
<?php
			
if(isset($_REQUEST['nome']) && (isset($_REQUEST['cpf'])) && (isset($_REQUEST['cidade']))){
			
			
			$numero_resultados = $consulta->rowCount();
			
			if($numero_resultados == 0){ 
				
				echo " <center><div class=\"alert\">
                       <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                       <strong>  Nenhum Resultado !! </strong> 
                       </div></center><br>";
			  
			  return;
				
			}
			
			echo '<div class="container">
			       <div style=" position: relative; top: 50%; left: 32%; margin-top: -48px; margin-left: -100px;">
			       
			       <p> &nbsp; ARTESÃOS REGISTRADOS: '.$numero_resultados.' <br> <br></p>';
			
			$imagem = new imagem_artesao();
			
			$count = 0;
			
			while ($rs = $consulta->fetch(PDO::FETCH_OBJ)) {
            
                  $imagem->id_artesao = $rs->id_artesao;
                  
                  $resp = $imagem->getImage();
            
            if($resp){
        
			     echo '
			                          <div class="col-md-8">
			                           <div class="blog_box">
										 <div class="blog_grid">
										  <h3> <img src="data:image/jpeg;base64,'.base64_encode($imagem->conteudo).'" class="img-circle" width="70px" height="70px" alt=""/> &nbsp; <a href="#"> '.$rs->nome.' </a></h3><i class="document"> </i>
										   <a href="#"></a> 
										  <div class="singe_desc">
											<p>   
												<b>ID Artesão:</b> &nbsp; '.$rs->id_artesao.' &nbsp; | &nbsp; 
												<b> CPF: </b> &nbsp; '.$rs->cpf.' &nbsp; |&nbsp;
												<b> Data Nascimento: </b> &nbsp; '.date('d/m/Y',strtotime($rs->data_nascimento)).' <br /><br/>  
											    <b> Rua: </b> &nbsp; '.$rs->rua.' &nbsp; |&nbsp; 
											    <b> Número: </b> &nbsp;  '.$rs->numero.' &nbsp; |&nbsp; 
											    <b> Bairro: </b>  &nbsp; '.$rs->bairro.' &nbsp; |&nbsp;
											    <b> Cidade: </b> &nbsp; '.$rs->cidade.' <br /><br/>
											    <b> CEP: </b> &nbsp; '.$rs->cep.' &nbsp; |&nbsp;
											    <b> Estado: </b> &nbsp; '.$rs->estado.' &nbsp; |&nbsp;
											    <b> Telefone: </b> &nbsp;  '.$rs->telefone.' &nbsp; |&nbsp;
											    <b> E-mail: </b> &nbsp; '.$rs->email.' &nbsp;
											    
											</p>
											 <div class="comments">
												<ul class="links">
													
													<form name="'.$count.'" id="'.$count.'" action="editar_artesao.php" method="post"  >
													 
													 <input type="hidden" name="id_artesao" id="id_artesao" value="'.$rs->id_artesao.'" >
													
													<li><a href="#" OnClick="document.getElementById(\''.$count.'\').submit();" ><i class="blog_icon2"> </i><br><span> Editar </span></a></li>
													
													<li><a href="#"><i class="remove"> </i><br><span> Excluir </span></a></li>
													</form>
												</ul>
												
												<div class="clear"></div>
											 </div>
										  </div>
										 </div>
										</div>
										</div>';
						}
						else{
							
							echo '
			                          <div class="col-md-8">
			                           <div class="blog_box">
										 <div class="blog_grid">
										  <h3> <img src="img/user.jpg" class="img-circle" width="70px" height="70px" alt=""/> &nbsp; <a href="#"> '.$rs->nome.' </a></h3><i class="document"> </i>
										   <a href="#"></a> 
										  <div class="singe_desc">
											<p>   
												<b>ID Artesão:</b> &nbsp; '.$rs->id_artesao.' &nbsp;| &nbsp; 
												<b> CPF: </b> &nbsp; '.$rs->cpf.' &nbsp; |&nbsp;
												<b> Data Nascimento: </b> &nbsp; '.date('d/m/Y',strtotime($rs->data_nascimento)).' <br /><br/>    
											    <b> Rua: </b> &nbsp; '.$rs->rua.' &nbsp; |&nbsp; 
											    <b> Número: </b> &nbsp;  '.$rs->numero.' &nbsp; |&nbsp;
											    <b> Bairro: </b>  &nbsp; '.$rs->bairro.' &nbsp; |&nbsp;
											    <b> Cidade: </b> &nbsp; '.$rs->cidade.' &nbsp; |&nbsp;
											    <b> CEP: </b> &nbsp; '.$rs->cep.' &nbsp; |&nbsp;
											    <b> Estado: </b> &nbsp; '.$rs->estado.' &nbsp; |&nbsp;
											    <b> Telefone: </b> &nbsp;  '.$rs->telefone.' &nbsp; |&nbsp;
											    <b> E-mail: </b> &nbsp; '.$rs->email.' &nbsp;
											    
											</p>
											 <div class="comments">
												<ul class="links">
													
													<form name="'.$count.'" id="'.$count.'" action="editar_artesao.php" method="post" >
													 
													 <input type="hidden" name="id_artesao" id="id_artesao" value="'.$rs->id_artesao.'" >
													</form>
													
													<li><a href="#" OnClick="document.getElementById(\''.$count.'\').submit();" ><i class="blog_icon2"> </i><br><span> Editar </span></a></li>
													
													<li><a href="#"><i class="remove"> </i><br><span> Excluir </span></a></li>
													
												</ul>
												
												<div class="clear"></div>
											 </div>
										  </div>
										 </div>
										</div>
										</div>';
							
							
							
							
						}
						
						$count = $count + 1;
				}
				
				echo ' </div>
				      </div>';
			}
?>
			          
			
			
		</div>
       
        

</div>



<?php include "footer.php"; ?> 
