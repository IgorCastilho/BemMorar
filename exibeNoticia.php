<?php

include("conexao/conecta.php");



if(isset($_REQUEST['codigo'])){
	$codigoNoticia = $_REQUEST['codigo'];
}
else{
	header("Location: index.php");
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
        <link rel="stylesheet" href="css/menu.css">
       
        <!-- google fonts  -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
    </head>
    
     <script type="text/javascript">


</script>
    



    

    <body>
        <div class="externo">
  	
            <div class="conteudo" style="width: 1000px; height: auto; margin: auto; margin-bottom: 2%;  border-radius: 15px; padding: 0px; padding-bottom: 0px; background-color: #fff;">
                             <div id="logo"><a href="index.php"><img src="images/indexEpura.png" width="260px" height="75px"></a></div>
            	 <nav>
   

        <label for="drop" class="toggle">Menu</label>
        <input type="checkbox" id="drop" />
            <ul class="menu">
                <li style="margin-left: 4px;"><a href="noticias.php">Notícias</a></li>
                <li>
                    <!-- First Tier Drop Down -->
                    <label for="drop-1" class="toggle">Projetos ▼</label>
                    <a href="#">Projetos</a>
                    <input type="checkbox" id="drop-1"/>
                    <ul>
                        <li><a style="font-size: 15px" href="projBemMorar.html">Bem morar</a></li>
                   
                    </ul> 

                </li>
    

                <li><a href="#">Galeria de fotos</a></li>
                <li style="margin-right: 4px;"><a href="login.php">Login</a></li>
              
            
            </ul>
        </nav>

<br> <br>
    

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
	<div class="exibeNoticia">
<h3> <?php echo $mostra->titulo; ?> </h3>
<i> <?php echo $mostra->subtitulo; ?> </i>
<br> <br> <br>
<center><img src="images/noticias/<?php echo $mostra->imagem; ?>" width="40%" height="40%"></center>

<br> <br> <br>

<?php echo $mostra->conteudo; ?> 

<br> <br> <br>

<b>Postado por</b>

<i><?php echo $mostra->nomeCompleto; ?></i>
 <br> 
<b>Em</b>
<i><?php echo date('d/m/Y', strtotime($mostra->data)); ?></i>
<br> <br>
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