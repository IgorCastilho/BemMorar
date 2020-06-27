<?php
ob_start();
session_start();
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}
else{
    if (($_SESSION['nivel_acesso'] == 'prefeitura')||($_SESSION['nivel_acesso'] == 'null')){
        
        header("Location: selecionaPainel.php?nao_autorizado");
    }
}
include("../conexao/conecta.php");
include("../logout.php");
$UsuarioAtual = $_SESSION['nome'];

$rId = 0;
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <!-- Meta tags -->
        <title>ÉpurainCampo - Projeto Bem Morar</title>
        <meta name="keywords" content="Apps Login Form Responsive widget, Flat Web Templates, Android Compatible web template, 
        Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
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
    	<style>
	
	@media screen and (max-width: 568px){
	    .wrapper{
	        margin-top: 10%;
	        height: auto;
	    }
	}
	</style>
    
    <script>
        function voltar(){
            window.location.href = "../epura.php";
        }
        function addRecado(){
            window.location.href = "../addRecado.php";
        }


    </script>

    <body>
        <div class="externo">
            <div class="conteudo">
                <div class="resumo">
                    <table align="center" id="tabRecados" cellspacing="10" cellpadding="4">
                        <tr><h2 align="center">Recados</h2></tr>
                        <tr></tr>
                    </table>
                    <script>
                        <?php
                            $stmt = $conexao->prepare('SELECT * FROM recados');
                            $stmt->execute();
                            $contar = $stmt->rowCount();                
                            if ($contar >0) { 
                                ?>
                                var count = 0;
                                <?php
                                while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
                                    //Coleta as informações                        
                                    $rNome = $mostra->mUser;
                                    $rAssunto = $mostra->mAssunto;
                                    $recado = $mostra->recado;
                                    $data = $mostra->created;
                                    if($UsuarioAtual == $rNome){
                                        $rId = $mostra->id; 
                                    }                        
                                    ?>
                                        var nome = "<?php echo $rNome?>";
                                        var uAtual = "<?php echo $UsuarioAtual?>";
                                        var assunto = "<?php echo $rAssunto?>";
                                        var recado = "<?php echo $recado?>";
                                        var idRecado = "<?php echo $rId?>";
                                        addCelula();                            
                                    <?php
                                }   
                            } else {
                                $rId = 0;
                            }
                        ?>
                        function addCelula() {
                                
                            var x = document.createElement("tr");
                            var y = document.createElement("td");
                            y.setAttribute("bgcolor", "YELLOW");
                            
                            document.getElementById("tabRecados").appendChild(x);
                            var cT = document.createElement("h4");
                            var t = document.createTextNode(nome);
                            var cA = document.createElement("h5");
                            var a = document.createTextNode(assunto);
                            var cD = document.createElement("text");
                            var d = document.createTextNode(recado);
                            
                            cT.appendChild(t);
                            y.appendChild(cT);

                            cA.appendChild(a);
                            y.appendChild(cA);

                            cD.appendChild(d);
                            y.appendChild(cD);

                            document.getElementById("tabRecados").appendChild(y);
                            
                        }
                    </script> 
                    <table align="center" id="tabRecados" cellspacing="10" cellpadding="4">
                        <tr>
                            <?php
                                if($rId == 0){
                                    ?>
                                        <input type="submit" onclick="addRecado()" value="Adicionar">
                                    <?php
                                }    
                            ?>
                        </tr>        
                        <tr>
                            <?php
                                if($rId != 0){
                                    ?>
                                        <form method="post"><input type="submit" name="excluir" value="Excluir"></form>
                                    <?php
                                }    
                            ?>
                        </tr>
                        <tr>
                            <input type="submit" onclick="voltar()" value="Voltar">
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php
            if($_POST['excluir']){
                $stmt = $conexao->prepare("DELETE FROM recados WHERE recados.id = $rId");
                $stmt->execute();
                header("Refresh: 0");
            }
        ?>
    </body>
</html>