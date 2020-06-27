<?php

include("conexao/conecta.php");
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}
else{
    
    $_SESSION['teste'] = $_SESSION['usuario_epura'];
    
    if ($_SESSION['nivel_acesso'] == 'null'){
        
        header("Location: selecionaPainel.php?nao_autorizado");
    }
}




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
        <!-- stylesheets -->
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- google fonts  -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
    </head>
    
    <script type="text/javascript">

	function voltar(){
		window.location.href = "selecionaPainel.php";
	}
	
	function beneficiarioNaoEncontrado(){
	    alert("Código inválido ou beneficiário inexistente");
		window.location.href = "selecionaPainel.php";
	}
</script>


    
    
    
    <?php
        //Pesquisar
        if(isset($_POST['pesquisar'])){
            
           
            
            $codBeneficiario = $_POST['cdBeneficiario'];
            
            
            
            
            $select = "SELECT * from beneficiarios WHERE BINARY codigoEpura=:codBeneficiario";
            
            
            
            try{
			$result = $conexao->prepare($select);
			$result->bindParam(':codBeneficiario', $codBeneficiario, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
		       ?>
		       
		       
		       <script type="text/javascript">
if(screen.width > 700){
        window.location.href = "visualizaBeneficiario.php?cod=<?php echo $codBeneficiario ?>"; 
}
else {
    window.location.href = "mobile/visualizaBeneficiario.php?cod=<?php echo $codBeneficiario ?>"; 
}
</script>
		       
		       
		       <?php
			}else{
			    
				echo '<script> beneficiarioNaoEncontrado() </script>';
			}
			
		}catch(PDOException $e){
			echo $e;
		}
            
            
            
            
            
        }
        
        ?>
    <body>
        <div class="externo">
            <h1>&nbsp;</h1>		
            <div class="conteudo">
                <h2>Pesquisa</h2>
                <div class="formulario">
					<form action="" method="post" enctype="multipart/form-data">
						<label>Codigo do Beneficiário</label>
						<input type="text" name="cdBeneficiario" placeholder="Código do Beneficiário" required/>
						<input type="submit" name="pesquisar" value="Pesquisar" />
						
					</form>					
					<input type="submit" name="voltar" value="Voltar" onclick="voltar()" /> 
				</div>
    </body>
</html>