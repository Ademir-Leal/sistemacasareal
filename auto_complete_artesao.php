<?php

require_once "conexao.php";
require_once "Classes.php";



$conexao = new conexao();
  
$resulta = $conexao->consulta("select * from artesaos","result");  


$json = '[';
$first = true;
while($row = $resulta->fetch(PDO::FETCH_OBJ))
{
  if (!$first) { $json .=  ','; } else { $first = false; }
  $json .= '{"value":"'.utf8_encode($row->nome).' - CPF: '.utf8_encode($row->cpf).'"}';
}
$json .= ']';
 
echo $json;

	    
?>
