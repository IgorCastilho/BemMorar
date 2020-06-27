<?php
ob_start();

include("conexao/conecta.php");



if(isset($_SESSION['usuario_epura']) && (isset($_SESSION['senha_epura']))){
	header("Location: selecionaPainel.php");exit;
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta tags -->
	<title>ÉpurainCampo - Projeto Bem Morar</title>
 <meta name="keywords" content="Projeto Bem Morar, projeto, bem morar, projeto bem morar, prefeitura de Cuiabá, Cuiabá, a prefeitura reforma sua casa, epura, EPURA, UFMT, epura ufmt, EIT" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- stylesheets -->
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- google fonts  -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
</head>

<script type="text/javascript">
	function logouOk(){
		alert("Login realizado com sucesso");
	}
	function erroLogar(){
		alert("Dados incorretos, verifique e tente novamente");
	}
	function redirecionaLogar(){
	    window.location.href = "selecionaPainel.php";
	}
	function cadastrar(){
	    window.location.href = "novoUsuario.php";
	}
</script>





<?php

if(isset($_POST['logar'])){
		// RECUPERAR DADOS FORM
		$usuario = trim(strip_tags($_POST['usuario']));
		$senha	 = trim(strip_tags($_POST['senha']));
		
		// SELECIONAR BANCO DE DADOS
		
		$select = "SELECT * from usuariosExternos WHERE BINARY usuario=:usuario AND BINARY senha=:senha ";
		
		try{
			$result = $conexao->prepare($select);
			$result->bindParam(':usuario', $usuario, PDO::PARAM_STR);
			$result->bindParam(':senha', $senha, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
				$usuario = $_POST['usuario'];
				$senha	 = $_POST['senha'];
				$_SESSION['usuario_epura'] = $usuario;
				$_SESSION['senha_epura'] = $senha;
				
				while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
					$nivelAcesso = $mostra->nivelAcesso;
					$nomeCompleto = $mostra->nomeCompleto;
					$idUsuario = $mostra->id;
				}
				
				$_SESSION['nivel_acesso'] = $nivelAcesso;
				$_SESSION['nome'] = $nomeCompleto;
				$_SESSION['idUsuario'] = $idUsuario;
				
				echo '<script> redirecionaLogar() </script>';
			
			}else{
				echo '<script> erroLogar() </script>';
			}
			
		}catch(PDOException $e){
			echo $e;
		}
		
		
		
	}// se clicar no botão entrar no sistema

?>
	<body>
		<div class="externo">
	<h1>&nbsp; </h1>
			<div class="conteudo">
				<h2>Login</h2>
				<div class="formulario">
					<form action="" method="post">
						<label>Nome de usuário</label>
						<input type="text" name="usuario" placeholder="Nome de usuário" required/>
						<label>Senha</label>
						<input type="password" name="senha" placeholder="Senha" required />
						<a href="#" class="pass">Esqueceu a senha?</a>
						<input type="submit" name="logar" value="Entrar" />
						
					</form>
				
						<input type="button" name="cadastrar" value="Cadastrar" onclick="cadastrar()" />
				
					
				</div>
				
	
			</div>
		
	
		</div>

	</body>
</html>