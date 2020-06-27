<?php


include("conexao/conecta.php");
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <!-- Meta tags -->
	<title>ÉpurainCampo - Projeto Bem Morar</title>
	 <meta name="keywords" content="Projeto Bem Morar, projeto, bem morar, projeto bem morar, prefeitura de Cuiabá, Cuiabá, a prefeitura reforma sua casa, epura, EPURA, UFMT, epura ufmt, EIT" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- stylesheets <script src="js/app.js"></script>-->
	<link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
    
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>

<script type="text/javascript">

	function erroCadastrar(){
		alert("Erro ao cadastrar");
	}

	function voltar(){
		window.location.href = "login.php";
	}
		function cadastrou(){
		alert("Cadastrado com sucesso");
		window.location.href = "login.php";
	}
	function formatarCampo(campoTexto) {
		if (campoTexto.value.length <= 11) {
			campoTexto.value = mascaraCpf(campoTexto.value);
		} else {
			alert("Formato do CPF errado!");
		}
	}
	function retirarFormatacao(campoTexto) {
		campoTexto.value = campoTexto.value.replace(/(\.|\/|\-)/g,"");
	}
	function mascaraCpf(valor) {
		return valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g,"\$1.\$2.\$3\-\$4");
	}
	function erroPreenche(){
		alert("Preencha todos os campos corretamente.");
	}
	function erroUsuario(){
		alert("ERRO: O nome de usuário deve ter no mínimo 5 caracteres.");
	}
	function erroSenha(){
		alert("ERRO: A senha deve ter no mínimo 5 caracteres.");
	}


</script>

</head>

<?php

if (isset($_POST['voltar'])){
	header("Location: index.php");
}


if(isset($_POST['finaliza'])){
		// RECUPERAR DADOS FORM 
		$usuario = trim(strip_tags($_POST['usuario']));
		$nome = trim(strip_tags($_POST['nome']));
		$senha	 = trim(strip_tags($_POST['senha']));
		$email	 = trim(strip_tags($_POST['email']));
		$CPF	 = trim(strip_tags($_POST['CPF']));
		$tipoAcesso = trim(strip_tags($_POST['tipoAcesso']));



		if ((isset($usuario))&&(isset($nome))&&(isset($senha))&&(isset($email))&&(isset($CPF))&&(isset($tipoAcesso))){



		if (strlen($usuario) >= 5){

			 if (strlen($senha) >= 5){




	
		
		$nivelAcesso = "null";

		
		$insert = "INSERT into usuariosExternos (usuario, nomeCompleto, senha, email, CPF, nivelAcesso, tipoAcesso) VALUES (:usuario, :nome, :senha, :email, :CPF, :nivelAcesso, :tipoAcesso)";
		


		try{
			$result = $conexao->prepare($insert);
			$result->bindParam(':usuario', $usuario, PDO::PARAM_STR);
			$result->bindParam(':nome', $nome, PDO::PARAM_STR);
			$result->bindParam(':senha', $senha, PDO::PARAM_STR);
			$result->bindParam(':email', $email, PDO::PARAM_STR);
			$result->bindParam(':CPF', $CPF, PDO::PARAM_STR);
			$result->bindParam(':nivelAcesso', $nivelAcesso, PDO::PARAM_STR);
			$result->bindParam(':tipoAcesso', $tipoAcesso, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
	
				echo '<script> cadastrou() </script>';
				
			}else{
				
    				echo '<script> erroCadastrar() </script>';
				
				header("Refresh: 1, index.php");
			}
			
		}catch(PDOException $e){
			echo $e;
		}
		
	} else {
		echo '<script> erroSenha() </script>';
	}


		} else {
			echo '<script> erroUsuario() </script>';
		}
		
	} else{
	echo '<script> erroPreenche() </script>';
}
}

	
?>










<body>
    <div class="externo">
       
        <div class="conteudo">
                <h2>Novo Usuário</h2>
                <div class="formulario">
                    <form action="" method="post" enctype="multipart/form-data">
    
                        <label>Nome de usuário</label>
                        <input type="text" id="idUser" name="usuario" placeholder="Nome de usuário" required />
                        <label>Nome completo</label>
                        <input type="text" id="idNome" name="nome" placeholder="Nome completo" required />
                        <label>Senha</label>
                        <input type="password" id="idPassword" name="senha" placeholder="Senha"  required/>
                        <label>Email</label>
                        <input type="email" id="idEmail" name="email" placeholder="E-mail"  required/>
                        <label>CPF</label>
						<input type="text" id="CPF" name="CPF" placeholder="Apenas números" onfocus="javascript: retirarFormatacao(this);" onblur="javascript: formatarCampo(this);"  minlength="11" maxlength="11"/>
                        <label>Tipo de acesso</label>
                         <input list="idAcesso" name="tipoAcesso" id="listaAcesso" placeholder="Selecione..."/>
                                  <datalist id="idAcesso">
                                    <option value="Bolsista">
                                    <option value="Professor pesquisador">
                                    <option value="Prefeitura">
                                  </datalist>
                        <input type="submit" id="salvar" name="finaliza" value="Salvar" />                     
                    </form>
                 <input type="button" name="voltar" value="Voltar" onclick="voltar()" />
                </div>
            </div>
        </div>
        <br>
        	<div class="copyright" align="center">
		
        </div>
       
      
</body>