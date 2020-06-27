<?php
include("conexao/conecta.php");
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}




    if(isset($_REQUEST['cod'])){
      $localizador = $_REQUEST['cod'];

      try{
      $select = "SELECT * from beneficiarios where codigoEpura=:localizador";
      $stmt = $conexao->prepare($select);
      $stmt-> bindParam(':localizador', $localizador, PDO::PARAM_STR);
     $stmt->execute();
     $contar = $stmt->rowCount();
     
     if ($contar >0) { 
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $idB = $mostra->id;
         
       }   
     } else {
       echo "Erro interno do servidor";
     }
    } catch(PDOException $e){
     echo $e;
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
    var largura = screen.width;
	function redirecionaPesquisa(){
		window.location.href = "pesquisa.php";
	}
	function redirecionaEpura(){
		window.location.href = "epura.php";
	}
	function redirecionaPrefeitura(){
		window.location.href = "prefeitura.php";
	}
		function sair(){
		window.location.href = "logout.php?sair";
	}
	
		function naoAutorizado(){
		alert("Acesso não autorizado");
	}
	//Versão PC
	if( largura >= 800 ) {
    	function voltar(){
    		window.location.href = "visualizaBeneficiario.php?cod=<?php echo $localizador ?>";
    	}
    }else{
        function voltar(){
    		window.location.href = "mobile/visualizaBeneficiario.php?cod=<?php echo $localizador ?>";
    	}
    }	
	function naoAtualizou(){
		alert("Não foi possível atualizar o checklist");
	}	
	
</script>

<?php 

if(isset($_POST['voltar'])){
	echo '<script> voltar() </script>';
}

?>

<?php 

if(isset($_POST['salvar']) && isset($_POST['checklist'])){
		// RECUPERAR DADOS FORM 
		$checklist = $_POST['checklist'];
		

$entrevista =0; $levantamento=0; $asbuilt=0; $proposta=0; $memorial=0; $tabelaServ=0; $quantitativo=0;
		
		for ($i=0; $i<count($checklist); $i++){

			if ($checklist[$i] == 'entrevista'){
				$entrevista = 1;
			}
			else if ($checklist[$i] == 'levantamento'){
				$levantamento = 1;
			}
			else if ($checklist[$i] == 'asbuilt'){
				$asbuilt = 1;
			}
			else if ($checklist[$i] == 'proposta'){
				$proposta = 1;
			}
			else if ($checklist[$i] == 'memorial'){
				$memorial = 1;
			}
			else if ($checklist[$i] == 'tabelaServ') {
			 $tabelaServ = 1;
			}
			else if ($checklist[$i] == 'quantitativo'){
				$quantitativo = 1;
			}
		}


		$update = "UPDATE etapas_beneficiario set entrevista=:entrevista, levantamento=:levantamento, asbuilt=:asbuilt, proposta=:proposta, memorial =:memorial, tabelaServ=:tabelaServ, 
		quantitativo =:quantitativo where cod_beneficiario=:idB";
		
   try{
        $result = $conexao->prepare($update);
        $result->bindParam(':idB', $idB, PDO::PARAM_INT);
        $result->bindParam(':entrevista', $entrevista, PDO::PARAM_INT);
        $result->bindParam(':levantamento', $levantamento, PDO::PARAM_INT);
        $result->bindParam(':asbuilt', $asbuilt, PDO::PARAM_INT);
        $result->bindParam(':proposta', $proposta, PDO::PARAM_INT);
        $result->bindParam(':memorial', $memorial, PDO::PARAM_INT);
        $result->bindParam(':tabelaServ', $tabelaServ, PDO::PARAM_INT);
        $result->bindParam(':quantitativo', $quantitativo, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();

        if ($contar > 0 ){
          
        	  // ARMAZENA QUEM EDITOU

 try {
     $stmt = $conexao->prepare('SELECT * FROM etapas_beneficiario WHERE cod_beneficiario = :idB');
     $stmt-> bindParam(':idB', $idB, PDO::PARAM_INT);
     $stmt->execute();
     $contar = $stmt->rowCount();

     if ($contar >0) {
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $idEtapa = $mostra->id_etapa;
       }
     } else {
       echo "Erro interno do servidor";
     }
    } catch(PDOException $e){
     echo $e;
    }

    $idUsuarioAtivo = $_SESSION['idUsuario'];

    $insert = "INSERT into alterou_etapas (usuarioEditor, etapaEditada) VALUES (:idUsuarioAtivo, :idEtapa)";
    


    try{
      $result = $conexao->prepare($insert);
      $result->bindParam(':idUsuarioAtivo', $idUsuarioAtivo, PDO::PARAM_INT);
      $result->bindParam(':idEtapa', $idEtapa, PDO::PARAM_INT);
 
      $result->execute();
      $contar = $result->rowCount();
  
      
    }catch(PDOException $e){
      echo $e;
    }






        }
        else{
          echo '<script> naoAtualizou() </script>';
        }

      } catch(PDOException $e){
       echo $e;
     }
  


		}
?>
<?php 
        //Coleta a linha de acordo com o código

    try {
     $stmt = $conexao->prepare('SELECT * FROM etapas_beneficiario WHERE cod_beneficiario = :idB');
     $stmt-> bindParam(':idB', $idB, PDO::PARAM_INT);
     $stmt->execute();
     $contar = $stmt->rowCount();
     
     if ($contar >0) { 
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $entrevistaAtt = $mostra->entrevista;
         $levantamentoAtt = $mostra->levantamento;
         $asbuiltAtt = $mostra->asbuilt;
         $propostaAtt = $mostra->proposta;
         $memorialAtt = $mostra->memorial;
         $tabelaServAtt = $mostra->tabelaServ;
         $quantitativoAtt = $mostra->quantitativo;
        
       }   
     } else {
       echo "Erro interno do servidor";
     }
    } catch(PDOException $e){
     echo $e;
    }
    ?>
	<body>
		<div class="externo">
			<div class="conteudo">
				<h2>Etapas</h2>
				<div class="formulario" align="center" style="padding-bottom: 0px">	
					<form action="" method="post" enctype="multipart/form-data">
					
							 <label><input type="checkbox" name="checklist[]" value="entrevista" <?php if ($entrevistaAtt == 1){ echo "checked";} ?>> Entrevista</label><br>
							<label><input type="checkbox" name="checklist[]" value="levantamento" <?php if ($levantamentoAtt == 1){ echo "checked";} ?>> Levantamento</label><br>
							<label><input type="checkbox" name="checklist[]" value="asbuilt" <?php if ($asbuiltAtt == 1){ echo "checked";} ?>> As built</label><br>
							<label><input type="checkbox" name="checklist[]" value="proposta" <?php if ($propostaAtt == 1){ echo "checked";} ?>> Proposta</label><br>
							<label><input type="checkbox" name="checklist[]" value="memorial" <?php if ($memorialAtt == 1){ echo "checked";} ?>> Memorial</label><br>
							<label><input type="checkbox" name="checklist[]" value="tabelaServ" <?php if ($tabelaServAtt == 1){ echo "checked";} ?>> Tabela de serviços</label><br>
							<label><input type="checkbox" name="checklist[]" value="quantitativo" <?php if ($quantitativoAtt == 1){ echo "checked";} ?>> Quantitativo</label><br>
						
							            <input type="submit" name="salvar" value="Salvar">
						
        	<input type="submit" id="botaoVoltar" name="voltar" value="Voltar"/>

	
							</form>	 
					          							
				</div>
	
			</div>
			
		</div>
	</body>
</html>