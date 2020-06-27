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
include("conexao/conecta.php");
include("logout.php");
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
    </head>
    
     <script type="text/javascript">

	function voltar(){
		window.location.href = "../epura.php";
	}
</script>
    
    <body>
        <div class="externo">
            <div class="conteudo">
                <div class="resumo" align="center">
                    <h2>Agenda</h2>
                    <iframe src="https://calendar.google.com/calendar/b/2/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=America%2FCampo_Grande&amp;src=YmVtbW9yYXJ1Zm10QGdtYWlsLmNvbQ&amp;src=cHQuYnJhemlsaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;color=%23039BE5&amp;color=%230B8043&amp;showCalendars=0&amp;showTz=0&amp;showTabs=1&amp;showPrint=0&amp;showNav=1" style="border-width:0" width="250" height="400" frameborder="0" scrolling="no"></iframe>
                    <div class="formulario">
                        <input type="submit" name="voltar" value="Voltar" onclick="voltar()" />
                    </div>
                </div>
                <br>
    			               
            </div>
        </div>
       
    </body>
</html>