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

    	<style>
	
	@media screen and (max-width: 568px){
	    .wrapper{
	        margin-top: 10%;
	     
	    }
	}
	</style>


    <script type="text/javascript">
    
    	var largura = screen.width;
    
    	//Versão PC
    	if( largura >= 800 ) {  
    	
        	function redirecionaMural(){
        		window.location.href = "recados.php";
        	}
    		//Versão Celular
    	}else{
        	function redirecionaMural(){
        		window.location.href = "mobile/recados.php";
        	}
    	}
    
    
    if( largura >= 800 ) { 
        function redirecionaAgenda(){
    		window.location.href = "agenda.php";
    	}
    	
    } else {	
	    function redirecionaAgenda(){
    		window.location.href = "mobile/agenda.php";
    	}
    }
    
   
        function redirecionaCadastroNoticia(){
    		window.location.href = "gerenciarNoticias.php";
    	}
    	
   
    
    function voltar(){
    		window.location.href = "selecionaPainel.php";
    	}
    function presenca(){
        window.location.href="mobile/presenca/index.html";
    }    	
    </script>
    
    
    
    <?php
        //Pesquisar
        if(isset($_POST['pesquisar'])){

        }
    ?>
    <body>
        <div class="externo">
            
            <div class="conteudo">
                <h2>Épura</h2>
                <div class="formulario" align="center">  
                    
                    <br>
                    <table align="center" cellspacing="10px" >
                        <tr>
                            <td><input class="icones" type="image" name="btAgenda" href="#" src="images/calendario.png" width="120px" height="120px" align="right"  onclick="redirecionaAgenda()"></input></td>
                    
                            <td><input class="icones" type="image" name="btAgenda" href="#" src="images/recado.png" width="120px" height="120px" align="left" onclick="redirecionaMural()" ></input> </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input class="icones" type="image" name="btAgenda" href="#" src="images/news.png" width="120px" height="120px" align="center" onclick="redirecionaCadastroNoticia()" ></input> </td>
                        </tr>
                    </table>
                    
                    <input type="submit" name="voltar" value="Voltar" onclick="voltar()" />
                </div>


        </div>
        <br>
	
    </body>
</html>