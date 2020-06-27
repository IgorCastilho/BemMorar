<?php

include("conexao/conecta.php");


if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}


if(isset($_REQUEST['codigo'])){
	$codigoFiscalizacao = $_REQUEST['codigo'];
}else{
	header("Location: index.php");
}


  $deleta = "DELETE from fiscalizacao WHERE id=:codFiscalizacao";
        
        try{
          $result = $conexao->prepare($deleta);
          $result->bindParam(':codFiscalizacao', $codigoFiscalizacao, PDO::PARAM_INT);
          $result->execute();
          $contar = $result->rowCount();
          if($contar>0){
            echo "<script>javascript:history.back()</script>";
          } 
        }catch(PDOException $e){
          echo $e;
        }
              
              



?>