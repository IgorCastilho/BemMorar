<?php
include("conexao/conecta.php");
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}
else{
    if (($_SESSION['nivel_acesso'] != 'adm')){
        
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
        <link rel="stylesheet" href="../css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
        <!-- google fonts  -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>
        <script>
        function voltar() {
            window.location.href = "selecionaPainel.php";
        }
        function erroGerencia(){
        	alert("Selecione o usuário e o nível de acesso corretamente.")
        }
        function erroGerenciaBanco(){
        	alert("Erro ao atualizar dados.");
        }
    </script>


    <?php


    if (isset($_POST['voltar'])){
    	echo '<script> voltar () </script>';
    }


    if (isset($_POST['salvar'])){



    	$idCapturado = $_POST['usuario'];



    	$nivelCapturado = $_POST['acesso'];

    	if ((isset($idCapturado))&&(isset($nivelCapturado))){

    		if ($nivelCapturado == 'Bolsista'){
    			$nivelCapturadoAtt = 'bolsista';
    		}
    		else if ($nivelCapturado == 'Professor pesquisador'){
    			$nivelCapturadoAtt = 'profPesq';
    		}
    		else if ($nivelCapturado == 'Prefeitura'){
    			$nivelCapturadoAtt = 'prefeitura';
    		}




    		$atualizar = "UPDATE usuariosExternos set nivelAcesso=:nivelCapturadoAtt
    						where id=:idCapturado";



    						try{

$result = $conexao->prepare($atualizar);
$result->bindParam(':nivelCapturadoAtt', $nivelCapturadoAtt, PDO::PARAM_STR);
$result->bindParam(':idCapturado', $idCapturado, PDO::PARAM_STR);
    $result->execute();
        $contar = $result->rowCount();


if ($contar > 0 ){

        }
        else{
          echo '<script> erroGerenciaBanco() </script>';
        }


} catch (PDOException $e){
 echo $e;
}

    	} else{
    		echo '<script> erroGerencia() </script>';
    	}


    }

    ?>








    <body>
        <div class="externo">
            <div class="conteudo">
                <div class="resumo">
                    <h2>Gerenciamento de acesso</h2>
                    <table>
                    	<form action="" method="post" enctype="multipart/form-data">
                        <tr>                                                         
                            <label>Selecione o usuário:</label>
                            <input type="text" id="favCktPlayer" name="usuario" list="usuarios">  
                            <datalist id="usuarios">
                                <?php
                                    $stmt = $conexao->prepare('SELECT * FROM usuariosExternos');
                                    $stmt->execute();
                                    $contar = $stmt->rowCount();
                                    if ($contar >0) {             
                                        while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){            
                                            //Coleta as informações                                    
                                            $Nome = $mostra->nomeCompleto;
                                            $idUserAtt = $mostra->id;
                                            ?>
                                                <option value="<?php echo $idUserAtt ?>" align="center"><?php echo $Nome ?> </option>
                                            <?php 
                                        }   
                                    }                                         
                                ?>
                            </datalist>                              
                        </tr>
                        <tr>
                            <label> Defina o nivel de acesso: </label>
                            <input type="text" id="favCktPlayer" list="permissao" name="acesso"> 
                            <datalist id="permissao">
                                        <option value="Bolsista">
                                        <option value="Prefeitura">
                                        <option value="Professor pesquisador">
                            </datalist>
                        </tr>
                        <tr>
                            <input type="submit" name="salvar" value="Salvar"/>
                        </tr>
                        <tr>
                            <input type="submit" name="voltar" value="Voltar" onclick="voltar()"/>
                        </tr>
                    </form>
                    </table>
                </div>
            </div>
        </div>         
    </body>
</html>