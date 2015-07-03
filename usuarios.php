<?php

require_once "conexao.php";
require_once "Classes.php";


include "header.php";

$consulta = null;

if(isset($_REQUEST['nome']) && (isset($_REQUEST['cpf'])) && (isset($_REQUEST['email']))){
	
	
	 $nome = $_POST['nome'];
     $cpf = $_POST['cpf'];
     $email = $_POST['email'];
     
     
     if(($nome == '') && ($cpf == '') && ($email == '')){
		 
		 
		 $user = new user();
		 
		 $consulta = $user->listall();
		 
	 }
	 else{
		 
		 $user = new user();
		 
		 $consulta = $user->listByFiltro($nome,$cpf,$email);
		 
	 }
		 
		 
}
     
     

?>

<div class="main">
	<div class="about_banner_img"><img src="images/banner11.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11"> Usu&aacute;rios </h1>
      	</div>
		<div class="border"> </div>
        
       <div class="container">
		
		  <div class="row single-top">
			

					
			
			
							 <div class="col-md-3 ">
							   <ul class="blog-list">
								  <h4> Opções </h4>
								  <li><a href="usuarios.php"> Buscar Usu&aacute;rio </a></li>
								  <li><a href="insere.php"> Cadastrar Novo Usu&aacute;rio </a></li>
								</ul>
				              </div>
				              
<?php

if(isset($_REQUEST['usuario_delete'])){
	
	$id_usuario = $_POST['usuario_delete'];
	
	$venda = new venda();
	
	$resultado = $venda->listById_usuario($id_usuario);
	
	if($resultado->rowCount() > 0 ) {
		
		
		
		echo ' 
		             <br>
                       <div class=\"alert\">
                       <strong>  ESSE USUÁRIO NÃO PODE SER EXCLUÍDO, POIS, EXISTEM VENDAS REALIZADAS POR ELE !! </strong> 
                       </div>
                       <br>';
                      
		
	}
	else{
		
		$user = new user();
		
		$user->id_user = $id_usuario;
		
		$user->deletar();
		
		
		echo ' <div class= container> 
		        
		        <br><div class=\"alert\">
                       
                       <strong>  USUÁRIO EXCLUÍDO!! </strong> 
                       </div><br>
                       
                       </div>';
                                   
                       return;
		
		
		
	}
                   
}

				          
				          
?>
				          
				              
				              <div class="col-md-9">
				                <div class="login-page">
				                     <div class="login-title">
	           		                   <h4 class="title"> Buscar Usu&aacute;rio </h4>
					                      <div id="loginbox" class="loginbox">
						                    <fieldset class="input">
												<form name="busca" action="usuarios.php" method="post"  id="login" enctype="multipart/form-data" >
						  
													<p id="login-form-username">
													  <label for="modlgn_username"> Nome do Usu&aacute;rio: </label>
													  <input id="nome" type="text" name="nome" class="inputbox" size="17" >
													</p>
													<p id="login-form-password">
													  <label for="modlgn_passwd"> CPF: </label>
													  <input id="cpf" type="text" name="cpf" class="inputbox" size="17" >
													</p>
													<p id="login-form-password">
													  <label for="modlgn_passwd"> E-mail: </label>
													  <input id="email" type="email" name="email" class="inputbox" size="10" >
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
			
if(isset($_REQUEST['nome']) && (isset($_REQUEST['cpf'])) && (isset($_REQUEST['email']))){
			
			
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
			       
			       <p> &nbsp; USU&Aacute;RIOS REGISTRADOS: '.$numero_resultados.' <br> <br></p>';
			
			$imagem = new imagem_user();
			
			$count = 0;
			
			while ($rs = $consulta->fetch(PDO::FETCH_OBJ)) {
            
                  $imagem->id_user = $rs->id_user;
                  
                  $resp = $imagem->getImage();
            
            if($resp){
        
			     echo '
			                          <div class="col-md-7">
			                           <div class="blog_box">
										 <div class="blog_grid">
										  <h3> <img src="data:image/jpeg;base64,'.base64_encode($imagem->conteudo).'" class="img-circle" width="70px" height="70px" alt=""/> &nbsp; <a href="#"> '.$rs->nome.' </a></h3><i class="document"> </i>
										   <a href="#"></a> 
										  <div class="singe_desc">
											<p>   
												<b>ID Usu&aacute;rio:</b> &nbsp; '.$rs->id_user.'<br /> 
												<b> CPF: </b> &nbsp; '.$rs->cpf.'  <br />
												<b> E-mail: </b> &nbsp; '.$rs->email.' <br />
											    <b> Rua: </b> &nbsp; '.$rs->rua.'  <br />
											    <b> Número: </b> &nbsp;  '.$rs->numero.'  <br />
											    <b> Bairro: </b>  &nbsp; '.$rs->bairro.' <br />
											    <b> Cidade: </b> &nbsp; '.$rs->cidade.' <br /> 
											    <b> Estado: </b> &nbsp; '.$rs->uf.' <br />
											    
											</p>
											 <div class="comments">
												<ul class="links">
													
													
													 <form name="delete'.$count.'" id="delete'.$count.'" action="usuarios.php" method="post" >
													 
													<input type="hidden" name="usuario_delete" id="usuario_delete" value="'.$rs->id_user.'" >
													
													</form>
													
													
													<li><a href="#" OnClick=" if(confirm(\'TEM CERTEZA QUE DESEJA EXCLUIR O USUÁRIO ???\')) document.getElementById(\'delete'.$count.'\').submit(); else return false;"  ><i class="remove"> </i><br><span> Excluir </span></a></li>
													
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
			                          <div class="col-md-7">
			                           <div class="blog_box">
										 <div class="blog_grid">
										  <h3> <img src="img/user.jpg" class="img-circle" width="70px" height="70px" alt=""/> &nbsp; <a href="#"> '.$rs->nome.' </a></h3><i class="document"> </i>
										   <a href="#"></a> 
										  <div class="singe_desc">
											<p>   
												<b>ID Usu&aacute;rio:</b> &nbsp; '.$rs->id_user.'<br /> 
												<b> CPF: </b> &nbsp; '.$rs->cpf.'  <br />
												<b> E-mail: </b> &nbsp; '.$rs->email.' <br />
											    <b> Rua: </b> &nbsp; '.$rs->rua.'  <br />
											    <b> Número: </b> &nbsp;  '.$rs->numero.'  <br />
											    <b> Bairro: </b>  &nbsp; '.$rs->bairro.' <br />
											    <b> Cidade: </b> &nbsp; '.$rs->cidade.' <br /> 
											    <b> Estado: </b> &nbsp; '.$rs->uf.' <br />
											    
											</p>
											 <div class="comments">
												<ul class="links">
													
													
													
													<form name="delete'.$count.'" id="delete'.$count.'" action="usuarios.php" method="post" >
													 
													<input type="hidden" name="usuario_delete" id="usuario_delete" value="'.$rs->id_user.'" >
													
													</form>
													
													
													<li><a href="#" OnClick=" if(confirm(\'TEM CERTEZA QUE DESEJA EXCLUIR O USUÁRIO ???\')) document.getElementById(\'delete'.$count.'\').submit(); else return false;"  ><i class="remove"> </i><br><span> Excluir </span></a></li>
													
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
