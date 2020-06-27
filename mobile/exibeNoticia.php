<?php
ob_start();

include("../conexao/conecta.php");


if(isset($_REQUEST['codigo'])){
	$codigoNoticia = $_REQUEST['codigo'];
}
else{
	header("Location: index.php");
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta tags -->
	<title>ÉpurainCampo - Projeto Bem Morar</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- stylesheets -->
		<link rel="stylesheet" href="../css/menu2.css">
	<link rel="stylesheet" href="../css/font-awesome.css">

	
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/gallery.prefixed.css">
  <link rel="stylesheet" href="../css/gallery.theme.css">
	<link rel="stylesheet" href="../css/style.css">

	<!-- google fonts  -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<script type="text/javascript">
	function logouOk(){
		alert("Login realizado com sucesso");
	}
	function erroLogar(){
		alert("Dados incorretos, verifique e tente novamente");
	}
	function redirecionaLogar(){
	    window.location.href = "selecionaPainel.php";
	}
</script>






	<body>
		<div class="externo">
	
			<div class="conteudo">
				<div class="formulario">
			
				<center><div id="logo"><a href="index.php"><img src="../images/indexEpura.png" width="260px" height="75px"></a></div> </center>
            	
 <nav>
  
        <label for="drop" class="toggle">Menu</label>
        <input type="checkbox" id="drop" />
            <ul class="menu">
                <li><a href="#" style="color: #FFF;">Notícias</a></li>
                <li>
                    <!-- First Tier Drop Down -->
                    <label for="drop-1" class="toggle">Projetos ▼</label>
                 <!--   <a href="#">Projetos</a> !-->
                    <input type="checkbox" id="drop-1"/>
                    <ul>
                        <li><a style="font-size: 15px" href="bemMorar.php">Bem morar</a></li>
                   
                    </ul> 

                </li>
    

                <li><a href="#" style="color: #FFF;">Galeria de fotos</a></li>
                <li><a style="color: #FFF;" href="../login.php">Login</a></li>
              
            
            </ul>
        </nav>

</div>
<?php



$select = "SELECT * FROM noticias N 
			INNER JOIN usuariosExternos U on U.id = N.usuarioPostou
			WHERE N.id = :codigo";

try {
	$resultado = $conexao->prepare($select);
	$resultado->bindParam(':codigo', $codigoNoticia, PDO::PARAM_STR);
	$resultado->execute();
	$contar = $resultado->rowCount();
	if ($contar > 0){
		while($mostra = $resultado->FETCH(PDO::FETCH_OBJ)){ ?>

	<br> <br>
	<div class="exibeNoticiaMobile">
<h3> <?php echo $mostra->titulo; ?> </h3>
<i> <?php echo $mostra->subtitulo; ?> </i>
<br> <br> 
<center><img src="../images/noticias/<?php echo $mostra->imagem; ?>" width="100%" height="100%"></center>

<br> 

<?php echo $mostra->conteudo; ?> 

<br> <br> 
<div style="font-size: 14px">
<b>Postado por</b>

<i><?php echo $mostra->nomeCompleto; ?></i>
 <br> 
<b>Em</b>
<i><?php echo date('d/m/Y', strtotime($mostra->data)); ?></i> </div>

</div>


	<?php		
		}
	}

} catch(PDOException $e){
	echo $e;
}


?>











	
			</div>
		
			
		</div>

	</body>
</html>