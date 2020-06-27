<?php

include("conexao/conecta.php");

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
  	
           <div class="conteudo" style="width: 1000px; height: 570px; margin: auto; border-radius: 15px; padding: 0px;">
           <div id="logo"><a href="index.php"><img src="images/indexEpura.png" width="260px" height="75px"></a></div>
               <nav>
   

        <label for="drop" class="toggle">Menu</label>
        <input type="checkbox" id="drop" />
            <ul class="menu">
                <li style="margin-left: 4px;"><a href="#">Notícias</a></li>
                <li>
                    <!-- First Tier Drop Down -->
                    <label for="drop-1" class="toggle">Projetos ▼</label>
                    <a href="#">Projetos</a>
                    <input type="checkbox" id="drop-1"/>
                    <ul>
                        <li><a style="font-size: 15px" href="bemMorar.php">Bem morar</a></li>
                   
                    </ul> 

                </li>
    

                <li><a href="#">Galeria de fotos</a></li>
                <li style="margin-right: 4px;"><a href="login.php">Login</a></li>
              
            
            </ul>
        </nav>

<br> <br> 


<center><h3>TODAS AS NOTÍCIAS</h3></center>

   <div class="todasNoticias" sytle="text-align: left;">
      <table cellpadding="10" align="left">

   

<?php


$select = "SELECT * FROM noticias order by id DESC limit 3";

 try {

  
     $stmt = $conexao->prepare($select);
     $stmt->execute();
     $contar = $stmt->rowCount();
     
     if ($contar >0) { 
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         

         ?>



    <tr align="left">
        <td>
          <?php  echo date('d.m.Y', strtotime($mostra->data));?>
       <a href="exibeNoticia.php?codigo=<?php echo $mostra->id; ?>" id="aInicial">
          - <b>
           <?php echo $mostra->titulo; ?> </b> </a></td></tr>



       <?php    }

        ?>


</table>

<?php
           
   
     } else {
       echo "Erro interno do servidor";
     }
    } catch(PDOException $e){
     echo $e;
    }

?>
        </div> <!-- div exibeUltimas !-->


</div>
</div>




   
    </body>
</html>