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
	<!-- stylesheets <script src="js/app.js"></script>-->
	<link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
    
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>

   
<script type="text/javascript">

function novaNoticia(){
	window.location.href = "cadastrarNoticia.php";
	}
	
	function voltar(){
	window.location.href = "epura.php";
	}
</script>

</head>


<body>
    <div class="externo">
        
        <div class="conteudo" style="overflow-y: auto; height: 500px;">
                <h2>Gerenciar notícias</h2>
                <div class="formulario">
                    <input type="submit" value="Cadastrar nova notícia" onclick="novaNoticia()" />   
                     <input type="submit" value="Voltar" onclick="voltar()" />   
                    
                    <br> 
                    <table align="center" cellpadding="10" cellspacing="10">
                        <tr align="center">
                            <th>ID</th>
                            <th>Título</th>
                            <th>Ações</th>
                        </tr>
                    <?php


$select = "SELECT * FROM noticias order by id DESC";

 try {

  
     $stmt = $conexao->prepare($select);
     $stmt->execute();
     $contar = $stmt->rowCount();
     
     if ($contar >0) { 
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         

         ?>



    <tr align="center">
        <td> <?php echo $mostra->id; ?> </td>
        <td> <?php echo $mostra->titulo; ?></td>
        <td> <a href="editarNoticia.php?codigo=<?php echo $mostra->id; ?>"><img src="images/editarNoticia.png" width="15%" height="15%"></a> <a href="deletaNoticia.php?codigo=<?php echo $mostra->id; ?>"><img src="images/deletarNoticia.png" width="15%" height="15%"></a></td>
            
    </tr>
            
            
            
            
            
   



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

                </div>
            </div>
        </div>
     
        	       </body>
        	       </html>