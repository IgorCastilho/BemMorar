<?php
include("conexao/conecta.php");
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}




    if(isset($_REQUEST['cod'])){
      $localizador = $_REQUEST['cod'];

      try{
      $select = "SELECT * from beneficiarios where codigoEpura=:localizador";
      $stmt = $conexao->prepare($select);
      $stmt-> bindParam(':localizador', $localizador, PDO::PARAM_STR);
     $stmt->execute();
     $contar = $stmt->rowCount();
     
     if ($contar >0) { 
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $idB = $mostra->id;
         
       }   
     } else {
       echo "Erro interno do servidor";
     }
    } catch(PDOException $e){
     echo $e;
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
  <!-- stylesheets <script src="js/app.js"></script>-->
  <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
    
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>

   
<script type="text/javascript">

function novaFiscalizacao(){
  window.location.href = "cadastrarFiscalizacao.php?cod=<?php echo $localizador ?>";
  }
  
  function voltar(){
  window.location.href = "visualizaBeneficiario.php?cod=<?php echo $localizador ?>";
  }
</script>

</head>


<body>
    <div class="externo">
        
        <div class="conteudo" style="height: auto;">
                <h2>Fiscalizações</h2>
                <div class="formulario">
                    <input style="text-align: center" type="submit" value="Nova fiscalização" onclick="novaFiscalizacao()" />   
                     <input type="submit" value="Voltar" onclick="voltar()" />   
                    
                    <br> 
                    <center>
                    <table align="center" cellpadding="10" cellspacing="2">
                        <tr align="center">
                            <th>ID</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    <?php


$select = "SELECT * FROM fiscalizacao where idBeneficiario=:idB order by id DESC";

 try {

  
     $stmt = $conexao->prepare($select);
     $stmt->bindParam(':idB', $idB, PDO::PARAM_INT);
     $stmt->execute();
     $contar = $stmt->rowCount();
     
     if ($contar >0) { 
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         

         ?>



    <tr align="center">
        <td> <?php echo $mostra->id; ?> </td>
        <td> <?php echo date('d/m/Y',strtotime($mostra->dataFiscalizacao)); ?></td>
        <td> <a href="deletarFiscalizacao.php?codigo=<?php echo $mostra->id; ?>"><img src="images/deletarNoticia.png" width="15%" height="15%"></a> <a href="exportaFiscalizacao.php?codigoFiscalizacao=<?php echo $mostra->id; ?>&codigoBeneficiario=<?php echo $idB ?>"><img src="images/pdf.png" width="15%" height="15%"></a></td>
            
    </tr>
            
            
            
            
            
   



       <?php    }

        ?>


</table>
</center>

<?php
           
   
     } else {
         ?> <br> <?php
       echo "Sem fiscalizações cadastradas";
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