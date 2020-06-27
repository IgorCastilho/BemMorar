<?php

include("conexao/conecta.php");


if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}


if(isset($_REQUEST['codigo'])){
	$codigoNoticia = $_REQUEST['codigo'];
}else{
	header("Location: index.php");
}


  $deleta = "DELETE from noticias WHERE id=:codNoticia";
        
        try{
          $result = $conexao->prepare($deleta);
          $result->bindParam(':codNoticia', $codigoNoticia, PDO::PARAM_INT);
          $result->execute();
          $contar = $result->rowCount();
          if($contar>0){
           header("Location: gerenciarNoticias.php");exit;
          } 
        }catch(PDOException $e){
          echo $e;
        }
              
              



?>