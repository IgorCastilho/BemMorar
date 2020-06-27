<?php
include("conexao/conecta.php");
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}
else{
    if (($_SESSION['nivel_acesso'] == 'prefeitura')||($_SESSION['nivel_acesso'] == 'null')){
        
        header("Location: selecionaPainel.php?nao_autorizado");
    }
}


$UsuarioAtual = $_SESSION['nome'];
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>
    <script type="text/javascript">
        var largura = screen.width;
        //Versão PC
	    if( largura >= 800 ) {
            function voltar(){
                window.location.href = "recados.php";
            }
	    }else{
	        function voltar(){
                window.location.href = "mobile/recados.php";
            }
	    }
    </script>
    <body>
        <?php
            //Logica para n add quando atualiza pagina
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $request = md5(implode($_POST));
                if(isset($_SESSION['ultima_request']) && $_SESSION['ultima_request'] == $request){

                }else{
                    $_SESSION['ultima_request'] = $request;
                    if(isset($_POST['assunto'])){
                        $inAssunto = trim(strip_tags($_POST['assunto']));
                        $inRecado = trim(strip_tags($_POST['recado']));
                        $result_recado = "INSERT INTO recados(mUser,mAssunto, recado, created) VALUES ('$UsuarioAtual','$inAssunto','$inRecado',NOW())";
                        $result = $conexao->prepare($result_recado);
                        $result->bindParam(':mUser', $$UsuarioAtual, PDO::PARAM_STR);
                        $result->bindParam(':mAssunto', $inAssunto, PDO::PARAM_STR);
                        $result->bindParam(':recado', $inRecado, PDO::PARAM_STR);
                        $result->bindParam(':created', $sTelefone, PDO::PARAM_STR);
                        $result->execute();
                    }
                }
                ?>
                    <script>
                        voltar();
                    </script>
                <?php
            }
        ?>        
        <div class="externo">
   
                <div class="conteudo">
                      <h2 align="center">Novo Recado</h2>
                    <table align="center">
                        <div class="formulario">
                        <tr>
                            <td>
                              
                                <form action=<?php echo $_SERVER['PHP_SELF'];?> method="POST">
                                    Assunto: <input type="text" name="assunto" require><br>
                                    Recado: <textarea name="recado" cols="25" rows="8"></textarea><br>
                                    <input type="submit" value="Enviar">
                                </form>
                                <input type="submit" onclick="voltar()" value="Voltar"> 
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>         
            </div>
        </div>
    </body>
</html>