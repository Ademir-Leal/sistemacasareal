<?php
session_start();

require_once "conexao.php";
require_once "Classes.php";


if((isset($_REQUEST['email'])) && (isset($_REQUEST['senha']))){
	
	
	$email = $_POST['email'];
	
	$senha = $_POST['senha'];
	
	$usuario = new user();
	
	$resultado = $usuario->getByEmail($email);
	
	
	if($resultado == true){
		
	  if($usuario->senha != $senha) header('Location: login.php?mensagem=1');	
	  else{
		  
		  $_SESSION['email'] = $usuario->email;
		  $_SESSION['senha'] = $usuario->senha;
		  
		  header('Location: inicio.php');
		  
		  
	  }
	  
		
		
	}
	else{ 
		
		unset ($_SESSION['email']);
        unset ($_SESSION['senha']);
		
		session_destroy();
		
		header('Location: login.php?mensagem=1');
		
		
		
	}
		

	
}

?>
