<?php

include("conexao/conecta.php");
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}

include("logout.php");
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
	<script src="js/relogio.js"></script>
	<style>
	
	@media screen and (max-width: 568px){
	    .wrapper{
	        margin-top: 10%;
	        height: auto;
	    }
	}
	</style>
</head>	

<script type="text/javascript">
	//Definindo a largura da tela do dispositivo que está acessando a pagina
	var largura = screen.width;
	
	function redirecionaPesquisa(){
		window.location.href = "pesquisa.php";
	}
	function redirecionaEpura(){
		window.location.href = "epura.php";
	}
	//Versão PC
	if( largura >= 800 ) {  
	
		function redirecionaPrefeitura(){
		window.location.href="prefeitura.php";
		}
		
	}else{
		function redirecionaPrefeitura(){
	alert("Os gráficos só estão disponibilizados na versão para computador.");
	
		}
	}

		function sair(){
		window.location.href = "logout.php?sair";
	}
	function gerenciamento(){
		window.location.href = "gerencia.php";
	}
		function naoAutorizado(){
		alert("Acesso não autorizado");
	}
	jQuery(window).load(function($){
		atualizaRelogio();
	});
	
</script>

<script>
		function atualizaRelogio(){ 
			var momentoAtual = new Date();
			
			var vhora = momentoAtual.getHours();
			var vminuto = momentoAtual.getMinutes();
			var vsegundo = momentoAtual.getSeconds();
			
			var vdia = momentoAtual.getDate();
			var vmes = momentoAtual.getMonth() + 1;
			var vano = momentoAtual.getFullYear();
			
			if (vdia < 10){ vdia = "0" + vdia;}
			if (vmes < 10){ vmes = "0" + vmes;}
			if (vhora < 10){ vhora = "0" + vhora;}
			if (vminuto < 10){ vminuto = "0" + vminuto;}
			if (vsegundo < 10){ vsegundo = "0" + vsegundo;}
 
			dataFormat = vdia + " / " + vmes + " / " + vano;
			horaFormat = vhora + " : " + vminuto + " : " + vsegundo;
 
			document.getElementById("data").innerHTML = dataFormat;
			document.getElementById("hora").innerHTML = horaFormat;
 
			setTimeout("atualizaRelogio()",1000);
		}
	</script>	

<?php

	if(isset($_REQUEST['nao_autorizado'])){	
		echo '<script> naoAutorizado() </script>';
	}
    
?>
    
<body>
	<div class="externo">
	
		
		<div class="conteudo" style="height: auto; margin-bottom: 2%;">
			<h2>Olá, <?php echo $_SESSION['nome']; ?></h2>
			
			<div class="formulario" align="center">
			    
			<div align="right"> 
           	    <h5><output id="data"></output></h5>
           	     <h5><output id="hora"></output></h5></div>
            
                <!-- <br> -->
        				<table align="center" cellpadding="25">
        				<tr>
            				<td><input class="icones" type="image" name="epura" value="Epura" href="#" src="images/epura.png" width="120px" height="120px" align="right"  onclick="redirecionaEpura()"></input></td>
            				<td>	<input class="icones" type="image" name="pref" value="pref" href="#" src="images/prefIco.png"  width="120px" height="120px" align="left" onclick="redirecionaPrefeitura()"></input></td>
        				</tr>
        				<tr>				
            				<td colspan="2" align="center">
            				 <!--   <form action="" method="post"> -->
                				<input class="icones" type="image" id="proc" name="proc" src="images/procurar.png" width="120px" height="120px" onclick="redirecionaPesquisa()"> </input>
            				   <!-- </form> -->
            			    </td>
        				</tr>
    				</table>
    				<?php
    				    if (($_SESSION['nivel_acesso'] == 'adm')){
    				        ?>
    				            <input type="submit" name="gerencia" value="Gerenciamento" onclick="gerenciamento()" />
    				        <?php
    				    }    
    				?>
    				<input type="submit" name="sair" value="Sair" onclick="sair()" />           
			</div>
							
		</div>

	
	</div>
	
</body>




</html>