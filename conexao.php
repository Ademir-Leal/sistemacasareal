
<?php


class conexao{

private $conexao;

function __construct(){

try {
    $this->conexao = new PDO('mysql:host=localhost;dbname=casareal','root', '');
    $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


}



public function consulta($consulta,$tipo=NULL){

try{
 
 
 
    $resultado = $this->conexao->query($consulta);
    
    
    $count = $resultado->rowCount();
    
    if($count == 1 && $tipo == Null){
     
     return $resultado->fetch(PDO :: FETCH_OBJ);
    }
    else if($count == 0 && $tipo == Null ){
		
		return false;
	}
    else {
		
		return $resultado;
	}
    
 
 
 }
 catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }

}


public function insercao($consulta){
	try{
 $resultado = $this->conexao->prepare($consulta);

   return $resultado->execute();
  
 
 
 }
 catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }

}

public function update($consulta){
	try{
 $resultado = $this->conexao->prepare($consulta);

    $resultado->execute();
  
 
 
 }
 catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }

}


	
	
	
}


?>
