<?php
	try{
		$conexao = new PDO('mysql:host=localhost;dbname=PREENCHER', 'BD PREENCHER', 'SENHA PREENCHER');
		$conexao ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
	}
	

    session_start();
	
	// arquivos que armazenam horário, a diferença de fuso é de 4 horas. (14h (real) equivale a 18h (servidor))
	
?>