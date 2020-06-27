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
        <style>
            .wrapperBene{
                width: 770px;
                
            }
        </style>
    
    
    </head>
    
     <script type="text/javascript">

	function voltar(){
		window.location.href = "epura.php";
	}
</script>
    
    <body>
        <div class="externo">
  
            <div class="conteudo" align="center" style="width: 800px;">
            <iframe src="https://calendar.google.com/calendar/b/2/embed?height=550&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=America%2FCampo_Grande&amp;src=YmVtbW9yYXJ1Zm10QGdtYWlsLmNvbQ&amp;src=cHQuYnJhemlsaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;color=%23039BE5&amp;color=%230B8043&amp;showCalendars=0&amp;showTz=0&amp;showTabs=1&amp;showPrint=0&amp;showNav=1" style="border-width:0" width="750" height="550" frameborder="0" scrolling="no"></iframe>
                <div class="formulario">
                    <input type="submit" name="voltar" value="Voltar" onclick="voltar()" />
                </div>
            </div>
            <br>
        </div>
    </body>
</html>