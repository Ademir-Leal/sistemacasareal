<?php

require_once "conexao.php";

class Artesao {
	
	
	public $id_artesao;
	public $cpf;
	public $nome;
	public $rua;
	public $numero;
	public $bairro;
	public $cidade;
	public $estado;
	public $telefone;
	public $email;
	public $cep;
	public $data_nascimento;
	
	
	
	public function getById($id){
		
		$conexao = new conexao();
		
	    $resultado = $conexao->consulta("select * from artesaos where id_artesao=$id");
		
		$this->id_artesao = $resultado->id_artesao; 
		$this->cpf = $resultado->cpf;
		$this->nome = $resultado->nome;
		$this->email = $resultado->email;
		$this->rua = $resultado->rua;
		$this->numero = $resultado->numero;
		$this->bairro = $resultado->bairro;
		$this->cidade = $resultado->cidade;
		$this->estado = $resultado->estado;
		$this->telefone = $resultado->telefone;
		$this->cep = $resultado->cep;
		$this->data_nascimento = $resultado->data_nascimento;         
	
	}
	
	public function getByEmail($email){
		
		$conexao = new conexao();
		
	    $resultado = $conexao->consulta("select * from artesaos where email='$email'");
		
		if($resultado){
		
			$this->id_artesao = $resultado->id_artesao; 
			$this->cpf = $resultado->cpf;
			$this->nome = $resultado->nome;
			$this->email = $resultado->email;
			$this->rua = $resultado->rua;
			$this->numero = $resultado->numero;
			$this->bairro = $resultado->bairro;
			$this->cidade = $resultado->cidade;
			$this->estado = $resultado->estado;
			$this->telefone = $resultado->telefone;
			$this->cep = $resultado->cep;
			$this->data_nascimento = $resultado->data_nascimento;
			return true;
		
	   }
	   else return false;         
			
	}
	
	public function listByFiltro($nome, $cpf, $cidade){
		
		$conexao = new conexao();
		
		return $conexao->consulta("select * from artesaos where nome like '%$nome%' and cpf like '%$cpf%' and cidade like '%$cidade%'",'result');
	   
	}
	
	public function listall(){
		
		$conexao = new conexao();
		
		return $conexao->consulta("select * from artesaos","vetor");
		
	}
	
    public function salvar_novo(){
    
         $conexao = new conexao();
         
         $resultado = $conexao->consulta("select * from artesaos where cpf = $this->cpf || email = '$this->email'",'result');
         
         if($resultado->rowCount() > 0)
			 return false;
         else{
         
         $conexao->insercao("insert into artesaos(cpf,nome,email,rua,numero,bairro,cidade,estado,telefone,cep,data_nascimento) 
                     values($this->cpf,'$this->nome','$this->email','$this->rua',$this->numero,'$this->bairro','$this->cidade','$this->estado','$this->telefone','$this->cep',date('$this->data_nascimento'))");
                     return true;
         }
     
    } 
    
    
    public function atualizar(){
		
		
		$conexao = new conexao();
		
		$conexao->update("update artesaos set cpf=$this->cpf, nome='$this->nome', rua='$this->rua', email='$this->email', 
		            numero=$this->numero, bairro='$this->bairro', cidade='$this->cidade', estado='$this->estado', telefone='$this->telefone', 
		            cep='$this->cep', data_nascimento=date('$this->data_nascimento') where id_artesao=$this->id_artesao");
		
		return true;
		
	}
	
	
	
	
}



class user{
	
	
	public $id_user;
	public $cpf;
	public $nome;
	public $email;
	public $rua;
	public $numero;
	public $bairro;
	public $cidade;
	public $uf;
	public $perm;
	public $senha;
	
	
	public function getById($id){
		
		$conexao = new conexao();
		
	    $resultado = $conexao->consulta("select * from users where id_user=$id");
		
		$this->id_user = $resultado->id_user; 
		$this->cpf = $resultado->cpf;
		$this->nome = $resultado->nome;
		$this->email = $resultado->email;
		$this->rua = $resultado->rua;
		$this->numero = $resultado->numero;
		$this->bairro = $resultado->bairro;
		$this->cidade = $resultado->cidade;
		$this->uf = $resultado->uf;
		$this->perm = $resultado->perm;
		$this->senha = $resultado->senha;         
		
		
	}
	
	public function getByEmail($email){
		
		$conexao = new conexao();
		
	    $resultado = $conexao->consulta("select * from users where email='$email'");
		
		if($resultado){
		
			$this->id_user = $resultado->id_user; 
			$this->cpf = $resultado->cpf;
			$this->nome = $resultado->nome;
			$this->email = $resultado->email;
			$this->rua = $resultado->rua;
			$this->numero = $resultado->numero;
			$this->bairro = $resultado->bairro;
			$this->cidade = $resultado->cidade;
			$this->uf = $resultado->uf;
			$this->perm = $resultado->perm;
			$this->senha = $resultado->senha;
			
			return true;
		
	   }
	   else 
		   return false;         
			
	}
	
	public function listall(){
		
		$conexao = new conexao();
		
		return $conexao->consulta("select * from users");
		
	}
	
	public function salvar_novo(){
    
         $conexao = new conexao();
         
         $conexao->insercao("insert into users(nome,cpf,email,rua,numero,bairro,cidade,uf,perm,senha) 
                     values('$this->nome',$this->cpf,'$this->email','$this->rua',$this->numero,'$this->bairro','$this->cidade','$this->uf','$this->perm','$this->senha')");
         
         
     
    }
	
	public function atualizar(){
		
		$conexao = new conexao();
		
		$conexao->update("update users set cpf=$this->cpf, nome='$this->nome', email='$this->email', rua='$this->rua', 
		            numero=$this->numero, bairro='$this->bairro', cidade='$this->cidade', uf='$this->uf', 
		            perm='$this->perm', senha='$this->senha' where id_user=$this->id_user");
		
	}

}

class imagem_artesao {

     public $id_image;
     public $id_artesao;
     public $nome_imagem;
     public $tipo;
     public $tamanho;
     public $conteudo;

public function inserir_imagem($nome_campo){


	if($nome_campo == Null)
		return false;
//recebe metadados da imagem
	$this->nome_imagem = $_FILES[$nome_campo]["tmp_name"];
	$this->tipo = $_FILES[$nome_campo]["type"];
	$this->tamanho = $_FILES[$nome_campo]["size"];

//trata a imagem

	$this->conteudo = file_get_contents($this->nome_imagem);
	$this->conteudo = addslashes($this->conteudo);
	$this->nome_imagem = $_FILES[$nome_campo]["name"];

	$conexao = new conexao();

   $conexao->insercao("insert into imagens_artesao(id_artesao, nome_imagem, tipo, tamanho, conteudo) values($this->id_artesao,'$this->nome_imagem','$this->tipo','$this->tamanho','$this->conteudo')");

}

public function trocar_imagem($nome_campo){
	
	if($nome_campo == Null)
		return false;
//recebe metadados da imagem
	$this->nome_imagem = $_FILES[$nome_campo]["tmp_name"];
	$this->tipo = $_FILES[$nome_campo]["type"];
	$this->tamanho = $_FILES[$nome_campo]["size"];

//trata a imagem

	$this->conteudo = file_get_contents($this->nome_imagem);
	$this->conteudo = addslashes($this->conteudo);
	$this->nome_imagem = $_FILES[$nome_campo]["name"];

	$conexao = new conexao();

	$conexao->insercao("update imagens_artesao set nome_imagem='$this->nome_imagem', tipo='$this->tipo', tamanho='$this->tamanho', conteudo ='$this->conteudo' where id_artesao=$this->id_artesao");
   
}



public function getImage(){
	
   if($this->id_artesao == NULL) return false;

   $conexao = new conexao();

   $resultado = $conexao->consulta("select * from imagens_artesao where id_artesao = $this->id_artesao",'result');
	
   if($resultado->rowCount() > 0){
     
     $resultado = $resultado->fetch(PDO::FETCH_OBJ);
     
     $this->conteudo = $resultado->conteudo;
     $this->id_image = $resultado->id_image;
     $this->nome_imagem = $resultado->nome_imagem;
     $this->tipo = $resultado->tipo;
     $this->tamanho = $resultado->tamanho;
     return true;
   
   }
   else return false;
	
}


public function mostrar_imagem(){

   if($this->id_artesao == NULL) return false;

   $conexao = new conexao();

   $resultado = $conexao->consulta("select * from imagens_artesao where id_artesao = $this->id_artesao",'result');

  if($resultado->rowCount() > 0){
	  
	  $resultado = $resultado->fetch(PDO::FETCH_OBJ);

      echo '<img src="data:image/jpeg;base64,'.base64_encode($resultado->conteudo).'" class="img-circle" width="70px" height="70px" alt=""/>';
      
  }
  else{
	  
	  echo '<img src="img/user.jpg" class="img-circle" width="70px" height="70px" alt=""/>';	  
	  return false;
	  
  }

}

}

class imagem_user {

     public $id_image;
     public $id_user;
     public $nome_imagem;
     public $tipo;
     public $tamanho;
     public $conteudo;

public function inserir_imagem($nome_campo){


	if($nome_campo == Null) return false;
//recebe metadados da imagem
	$this->nome_imagem = $_FILES[$nome_campo]["tmp_name"];
	$this->tipo = $_FILES[$nome_campo]["type"];
	$this->tamanho = $_FILES[$nome_campo]["size"];

//trata a imagem

/*$pont = fopen($this->nome_imagem, "rb"); 

$this->conteudo = fread($pont,filesize($this->nome_imagem));

fclose($pont);

$this->conteudo = addslashes($this->conteudo);*/ 

	$this->conteudo = file_get_contents($this->nome_imagem);


	$this->conteudo = addslashes($this->conteudo);


	$this->nome_imagem = $_FILES[$nome_campo]["name"];

	$conexao = new conexao();

	$conexao->insercao("insert into imagens_user(id_user, nome_imagem, tipo, tamanho, conteudo) values($this->id_user,'$this->nome_imagem','$this->tipo','$this->tamanho','$this->conteudo')");
   
}

public function mostrar_imagem(){

   if($this->id_user == NULL) return false;

   $conexao = new conexao();

   $resultado = $conexao->consulta("select * from imagens_user where id_user = $this->id_user",'vetor');

  if($resultado->rowCount() > 0){
	  
	  $resultado = $resultado->fetch(PDO::FETCH_OBJ);

      echo '<img align="Right" src="data:image/jpeg;base64,'.base64_encode($resultado->conteudo).'" class="img-circle" width="70px" height="70px" alt=""/>';

  }
  else{
	  echo '<img align="Right" src="img/user.jpg" class="img-circle" width="70px" height="70px" alt=""/>';  
	  return false;
	  
  }

}

public function trocar_imagem($nome_campo){
	
	if($nome_campo == Null) 
		return false;
//recebe metadados da imagem
	$this->nome_imagem = $_FILES[$nome_campo]["tmp_name"];
	$this->tipo = $_FILES[$nome_campo]["type"];
	$this->tamanho = $_FILES[$nome_campo]["size"];

//trata a imagem
	$this->conteudo = file_get_contents($this->nome_imagem);
	$this->conteudo = addslashes($this->conteudo);
	$this->nome_imagem = $_FILES[$nome_campo]["name"];

	$conexao = new conexao();

   $conexao->insercao("update imagens_user set nome_imagem='$this->nome_imagem', tipo='$this->tipo', tamanho='$this->tamanho', conteudo ='$this->conteudo' where id_user=$this->id_user");
	
}

public function getImage(){
	
   if($this->id_artesao == NULL) return false;

   $conexao = new conexao();

   $resultado = $conexao->consulta("select * from imagens_user where id_user = $this->id_user",'result');
	
   if($resultado->rowCount() > 0){
     
     $resultado = $resultado->fetch(PDO::FETCH_OBJ);
     
     $this->conteudo = $resultado->conteudo;
     $this->id_image = $resultado->id_image;
     $this->nome_imagem = $resultado->nome_imagem;
     $this->tipo = $resultado->tipo;
     $this->tamanho = $resultado->tamanho;
     return true;
   
   }
	else return false;
	
}

}

class produto{
	
	public $id_produto;
	public $id_artesao;
	public $cpf_artesao;
	public $nome_artesao;
	public $descricao_produto;
	public $qtd_estoque;
	public $valor;
		
	public function getById($id){
		
		$conexao = new conexao();
		
	    $resultado = $conexao->consulta("select * from produtos_artesao where id_produto=$id");
		
		$this->id_produto = $resultado->id_produto; 
		$this->id_artesao = $resultado->id_artesao;
		$this->nome_artesao = $resultado->nome;
		$this->cpf_artesao = $resultado->cpf_artesao;
		$this->descricao_produto = $resultado->descricao_produto;
		$this->qtd_estoque = $resultado->qtd_estoque;
		$this->valor = $resultado->valor;
	
	}
	
	public function getByDescricao($descricao){
		
		$conexao = new conexao();
		
	    $resultado = $conexao->consulta("select * from produtos where descricao_produto='$descricao'");
		
		$this->id_produto = $resultado->id_produto; 
		$this->id_artesao = $resultado->id_artesao;
		$this->descricao_produto = $resultado->descricao_produto;
		$this->qtd_estoque = $resultado->qtd_estoque;
		$this->valor = $resultado->valor;
		
	}
	
	
	public function listall(){
		
		$conexao = new conexao();
		
	    $resultado = $conexao->consulta("select * from produtos",'vetor');
		
		return $resultado;
		
	}
	
	public function listByFiltro($descricao, $artesao, $estoque){
		
		
		if($estoque == '') $estoque = 10000;
		
		$conexao = new conexao();
		
		
		return $conexao->consulta("select * from produtos_artesao where nome like '%$artesao%' and descricao_produto like '%$descricao%' and qtd_estoque < $estoque",'result');
	   	
	}
	
	public function salvar_novo(){
		
		
		$conexao = new conexao();
		
	    $conexao->insercao("insert into produtos(id_artesao,descricao_produto,qtd_estoque,valor) values($this->id_artesao,'$this->descricao_produto',$this->qtd_estoque,$this->valor)");
	    
	    return true;
		
	}
	
	public function atualizar(){
		
		
		$conexao = new conexao();
		
		$conexao->update("update produtos set id_artesao=$this->id_artesao, descricao_produto='$this->descricao_produto', qtd_estoque='$this->qtd_estoque', valor='$this->valor' 
		                  where id_produto=$this->id_produto");
		
		return true;
		
	}
}




class imagem_produto {


     public $id_image;
     public $id_produto;
     public $nome_imagem;
     public $tipo;
     public $tamanho;
     public $conteudo;



public function inserir_imagem($nome_campo){


 if($nome_campo == Null || $this->id_produto == Null) return false;
//recebe metadados da imagem
$this->nome_imagem = $_FILES[$nome_campo]["tmp_name"];
$this->tipo = $_FILES[$nome_campo]["type"];
$this->tamanho = $_FILES[$nome_campo]["size"];

//trata a imagem

$this->conteudo = file_get_contents($this->nome_imagem);


$this->conteudo = addslashes($this->conteudo);


$this->nome_imagem = $_FILES[$nome_campo]["name"];



   $conexao = new conexao();

   $conexao->insercao("insert into imagens_produto(id_produto, nome_imagem, tipo, tamanho, conteudo) values($this->id_produto,'$this->nome_imagem','$this->tipo','$this->tamanho','$this->conteudo')");


}


public function trocar_imagem($nome_campo){
	
if($nome_campo == Null) return false;
//recebe metadados da imagem
$this->nome_imagem = $_FILES[$nome_campo]["tmp_name"];
$this->tipo = $_FILES[$nome_campo]["type"];
$this->tamanho = $_FILES[$nome_campo]["size"];

//trata a imagem

$this->conteudo = file_get_contents($this->nome_imagem);


$this->conteudo = addslashes($this->conteudo);


$this->nome_imagem = $_FILES[$nome_campo]["name"];



   $conexao = new conexao();

   $conexao->insercao("update imagens_produto set nome_imagem='$this->nome_imagem', tipo='$this->tipo', tamanho='$this->tamanho', conteudo ='$this->conteudo' where id_produto=$this->id_produto");


	
}



public function getImage(){
	
   if($this->id_produto == NULL) return false;

   $conexao = new conexao();

   $resultado = $conexao->consulta("select * from imagens_produto where id_produto = $this->id_produto",'result');
	
   if($resultado->rowCount() > 0){
     
     $resultado = $resultado->fetch(PDO::FETCH_OBJ);
     
     $this->conteudo = $resultado->conteudo;
     $this->id_image = $resultado->id_image;
     $this->nome_imagem = $resultado->nome_imagem;
     $this->tipo = $resultado->tipo;
     $this->tamanho = $resultado->tamanho;
     return true;
   
   }
   else return false;
	
}

}


class venda {
	
	public $id_venda;
	public $id_artesao;
	public $nome_artesao;
	public $id_produto;
	public $descricao_produto;
	public $id_user;
	public $nome_user;
	public $data_hora_venda;
	public $qtd_do_produto;
	public $valor_venda;
	
	
	public function getById($id){
		
		$conexao = new conexao();
		
	    $resultado = $conexao->consulta("select * from vendas_produtos where id_venda=$id");
		
	    $this->id_venda = $resultado->id_venda;
	    $this->id_artesao = $resultado->id_artesao;
	    $this->nome_artesao = $resultado->nome_artesao;
	    $this->id_produto = $resultado->id_produto;
	    $this->descricao_produto = $resultado->descricao_produto;
	    $this->id_user = $resultado->id_user;
		$this->nome_user = $resultado->nome_user;
		$this->data_hora_venda = $resultado->data_venda;
		$this->qtd_do_produto = $resultado->qtd_do_produto;
		$this->valor_venda = $resultado->valor_venda;
		
		return true;
		
		
	}
	
	public function listall(){
		
		$conexao = new conexao();
		
	    return $conexao->consulta("select * from vendas_produtos order by data_venda DESC",'vetor');
			
	}
	
	public function listByFiltro($produto,$artesao,$data_inicio,$data_termino){
		

        if($data_inicio == '' && $data_termino == ''){
			
		$conexao = new conexao();
		
	    return $conexao->consulta("select * from vendas_produtos where descricao_produto like 
	                    '%$produto%' and nome_artesao like '%$artesao%' order by data_venda DESC",'vetor');
				
		} 
		else if($data_inicio == '' && $data_termino != '') { 
			
			$data_termino = converte_data($data_termino);
			
			$conexao = new conexao();
		
	        return $conexao->consulta("select * from vendas_produtos where descricao_produto like 
	           '%$produto%' and nome_artesao like '%$artesao%' and data_venda <= date('$data_termino') order by data_venda DESC ",'vetor');
			
		}
		else if($data_inicio != '' && $data_termino == ''){
			
			$data_inicio = converte_data($data_inicio);
			
			$conexao = new conexao();
		
	        return $conexao->consulta("select * from vendas_produtos where descricao_produto 
	                  like '%$produto%' and nome_artesao like '%$artesao%' and data_venda >= date('$data_inicio') order by data_venda DESC",'vetor');
			
		}
		else {
			
			$data_inicio = converte_data($data_inicio);
			
			$data_termino = converte_data($data_termino);
			
			$conexao = new conexao();
		
	        return $conexao->consulta("select * from vendas_produtos where descricao_produto 
	             like '%$produto%' and nome_artesao like '%$artesao%' and data_venda >= date('$data_inicio') and data_venda <= date('$data_termino') order by data_venda DESC",'vetor');
			
			
		}
		
	}
	
	public function salvar_novo(){
		
		$conexao = new conexao();
		
	    $conexao->insercao("insert into vendas(id_artesao,id_produto,id_user,data_venda,qtd_do_produto,valor_venda) 
	                          values($this->id_artesao,'$this->id_produto',$this->id_user,now(),$this->qtd_do_produto,$this->valor_venda)");
	    
	    return true;
		
		
		
		
	}
	
	
	
}




function converte_data($data){
	
	return implode(preg_match("~\/~", $data) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $data) == 0 ? "-" : "/", $data)));
	
	
}



?>
