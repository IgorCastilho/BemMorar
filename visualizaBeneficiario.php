<?php

 include("conexao/conecta.php");

 if(isset($_REQUEST['cod'])){
      $localizador = $_REQUEST['cod'];

    }


    
    
  if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
      header("Location: index.php");exit;
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



    <script type="text/javascript">
      function atualizouDados(){
        alert("Dados atualizados com sucesso");
      }
      
      function naoAtualizou(){
       alert("Erro interno ao atualizar os dados");
     }
     function voltar() {
       window.location.href = "pesquisa.php";
     }
     function deuErrado() {
       alert("Não foi possível realizar o upload da foto");
     }
    
  

    </script>

    </head>


    <?php
    
    if(isset($_POST['voltar'])){
    echo '<script> voltar() </script>';
    }
    


    if (isset($_POST['atualiza_perfil'])){
        
          //INFO IMAGEM




        if(!empty($_FILES['img_perfil']['name'])){
        $file     = $_FILES['img_perfil'];


        $numFile  = count(array_filter($file['name']));
        
        //PASTA
        $folder   = 'images/perfil';
        
        //REQUISITOS
        $permite  = array('image/jpeg', 'image/png');
        $maxSize  = 1024 * 1024 * 10;
        
        //MENSAGENS
        $msg    = array();
        $errorMsg = array(
          1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
          2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
          3 => 'o upload do arquivo foi feito parcialmente',
          4 => 'Não foi feito o upload do arquivo'
        );
        
        if($numFile <= 0){
          echo "Imagem não foi selecionada";
        }
        else if($numFile >=2){
          echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Você ultrapassou o limite de upload. Selecione apenas uma foto e tente novamente!
              </div>';
        }else{
          for($i = 0; $i < $numFile; $i++){
            $name   = $file['name'][$i];
            $type = $file['type'][$i];
            $size = $file['size'][$i];
            $error  = $file['error'][$i];
            $tmp  = $file['tmp_name'][$i];
            
            $extensao = @end(explode('.', $name));
            $novoNome = rand().".$extensao";
            
          
            
            if($error != 0)
              echo $msg[] = "<b>$name :</b> ".$errorMsg[$error];
            else if(!in_array($type, $permite))
              echo $msg[] = "<b>$name :</b> Erro imagem não suportada!";
            else if($size > $maxSize)
              echo $msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
            else{
              
              if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                //$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
                
              }
               else
                $msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
            
            }
            
            foreach($msg as $pop)
            echo '';
              //echo $pop.'<br>';
     
}
}

// se o input file n estiver vazio
     } else{
        $novoNome = $imagem;
      }
      


        $atualiza = "UPDATE beneficiarios SET imagemBene=:imagem  WHERE codigoEpura=:localizador";
        
        try{
          $result = $conexao->prepare($atualiza);
          $result->bindParam(':localizador', $localizador, PDO::PARAM_STR);
          $result->bindParam(':imagem', $novoNome, PDO::PARAM_STR);
          $result->execute();
          $contar = $result->rowCount();
          if($contar>0){
           // deu certo
          }else{
            echo '<script> deuErrado() </script>';
          }     
        }catch(PDOException $e){
          echo $e;
        }
              }
              


    ?>





<?php
 if (isset($_POST['atualiza_fachada'])){
        
          //INFO IMAGEM

        if(!empty($_FILES['img_fachada']['name'])){
        $files     = $_FILES['img_fachada'];


        $numFile  = count(array_filter($files['name']));
        
        //PASTA
        $folder   = 'images/fachada';
        
        //REQUISITOS
        $permite  = array('image/jpeg', 'image/png');
        $maxSize  = 1024 * 1024 * 10;
        
        //MENSAGENS
        $msg    = array();
        $errorMsg = array(
          1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
          2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
          3 => 'o upload do arquivo foi feito parcialmente',
          4 => 'Não foi feito o upload do arquivo'
        );
        
        if($numFile <= 0){
          echo "Imagem não foi selecionada";
        }
        else if($numFile >=2){
          echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Você ultrapassou o limite de upload. Selecione apenas uma foto e tente novamente!
              </div>';
        }else{
          for($i = 0; $i < $numFile; $i++){
            $name   = $files['name'][$i];
            $type = $files['type'][$i];
            $size = $files['size'][$i];
            $error  = $files['error'][$i];
            $tmp  = $files['tmp_name'][$i];
            
            $extensao = @end(explode('.', $name));
            $novoNome = rand().".$extensao";
            
          
            
            if($error != 0)
              echo $msg[] = "<b>$name :</b> ".$errorMsg[$error];
            else if(!in_array($type, $permite))
              echo $msg[] = "<b>$name :</b> Erro imagem não suportada!";
            else if($size > $maxSize)
              echo $msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
            else{
              
              if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                //$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
            
              }
               else
                $msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
            
            }
            
            foreach($msg as $pop)
            echo '';
              //echo $pop.'<br>';
     
}
}

// se o input file n estiver vazio
     } else{
       // $novoNome = $imagem;
      }
      


        $atualiza = "UPDATE beneficiarios SET imagemFachada=:novoNome  WHERE codigoEpura=:localizador";
        
        try{
          $result = $conexao->prepare($atualiza);
          $result->bindParam(':localizador', $localizador, PDO::PARAM_STR);
          $result->bindParam(':novoNome', $novoNome, PDO::PARAM_STR);
          $result->execute();
          $contar = $result->rowCount();
          if($contar>0){
           // deu certo
          }else{
            echo '<script> deuErrado() </script>';
          }     
        }catch(PDOException $e){
          echo $e;
        }
              }
              


  


?>














    <?php
    if(isset($_POST['salvar'])){
        //Coleta os dados e atualiza o banco de dados

        //Pega o valor de cada input


      $sEndereco = trim(strip_tags($_POST['endereco']));
      $sBairro = trim(strip_tags($_POST['bairro']));
      $sTelefone = trim(strip_tags($_POST['telefone']));
      $sPerfil = trim(strip_tags($_POST['perfil']));

      $update = "UPDATE beneficiarios SET endereco=:sEndereco, bairro=:sBairro, 
      telefone=:sTelefone, perfil=:sPerfil WHERE codigoEpura=:localizador";

      try{
        $result = $conexao->prepare($update);
        $result->bindParam(':localizador', $localizador, PDO::PARAM_STR);

        $result->bindParam(':sEndereco', $sEndereco, PDO::PARAM_STR);
        $result->bindParam(':sBairro', $sBairro, PDO::PARAM_STR);
        $result->bindParam(':sTelefone', $sTelefone, PDO::PARAM_STR);
        $result->bindParam(':sPerfil', $sPerfil, PDO::PARAM_STR);
        $result->execute();
        $contar = $result->rowCount();

        if ($contar > 0 ){
          // ARMAZENA QUEM EDITOU

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

    $idUsuarioAtivo = $_SESSION['idUsuario'];

    $insert = "INSERT into alterou_visualizaBene (usuarioEditor, beneficiarioEditado) VALUES (:idUsuarioAtivo, :idB)";
    


    try{
      $result = $conexao->prepare($insert);
      $result->bindParam(':idUsuarioAtivo', $idUsuarioAtivo, PDO::PARAM_INT);
      $result->bindParam(':idB', $idB, PDO::PARAM_INT);
 
      $result->execute();
      $contar = $result->rowCount();
  
      
    }catch(PDOException $e){
      echo $e;
    }
        }
        else{
          echo '<script> naoAtualizou() </script>';
        }

      } catch(PDOException $e){
       echo $e;
     }


    }
   


        //Coleta a linha de acordo com o código

    try {


     $stmt = $conexao->prepare('SELECT * FROM beneficiarios WHERE codigoEpura = :localizador');
     $stmt-> bindParam(':localizador', $localizador, PDO::PARAM_STR);
     $stmt->execute();
     $contar = $stmt->rowCount();
     
     if ($contar >0) { 
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $codigoEpura = $mostra->codigoEpura;
         $idMapa = $mostra->idMapa;
         $nome = $mostra->nome;
         $endereco = $mostra->endereco;
         $idCompleto = $mostra->codigoCompleto;
         $bairro = $mostra->bairro;
         $telefone = $mostra->telefone;
         $perfil = $mostra->perfil;
         $imagemPerfil = $mostra->imagemBene;
         $imagemFachada = $mostra->imagemFachada;
       }   
     } else {
       echo "Erro interno do servidor";
     }
    } catch(PDOException $e){
     echo $e;
    }
    ?>


    <body>
      <div class="externo" style="padding-top: 10px; padding-bottom: 10px;">
     


        <div class="conteudo" style=" width: 950px;
    margin: auto;
    margin-bottom: 0px;
    
     border-radius: 15px;
    padding: 3% 0px;
    padding-top: 1px;

    padding-bottom: 0px;">
        

          <div class="resumo">


            <form action="" method="post" enctype="multipart/form-data" >
              <table cellpadding="4" width="98%" align="center">
                <tr> 
                 <th> <h3 id="idEpura">
                 <?php echo $idCompleto ?> </h3> </th>

                 <th> &emsp; </th>
                  <th> &emsp; </th>
                 <th rowspan="3" colspan="3"> <label for="tipofile" class="custom-file-upload">

                  
                  <input id="tipofile" type="file" name="img_perfil[]" value="" >
                  <img src="images/perfil/<?php echo $imagemPerfil ?>" width="200px" height="200px">
                  <input type="submit" name="atualiza_perfil" value="Trocar">

                 </label>  </th> 
            
                 <th> &emsp; </th>
                 <th rowspan="3" colspan="3"> <label for="tiposfile" class="custom-file-upload">
                  <input id="tiposfile" type="file" name="img_fachada[]" value="" >
                  <img src="images/fachada/<?php echo $imagemFachada ?>" width="200px" height="200px">
                  <input type="submit" name="atualiza_fachada" value="Trocar">

                 </label>




                 </th>
                 <th> &emsp; </th>
                
              
                 

               </tr>



               <tr>

                
                <td><h3 id="nomeBene"><?php echo $nome ?></h3>

    <label>Endereço</label><input type="text" id="teste" name="endereco" value="<?php echo $endereco ?>" required/> 

                </td>
                <td> &emsp; </td>
                <td> &emsp; </td>
                <td> &emsp; </td>
                <td> &emsp; </td>

               
             
              
                


                <!-- -->
              </tr>
              <tr>
               <td> <label>Telefone</label><input type="text" name="telefone" value="<?php echo $telefone ?>" required/> </td>
                <td> &emsp; </td>
                <td> &emsp; </td>
                <td> &emsp; </td>
                <td> &emsp; </td>
                
                
               
            

              </tr>
              <tr>
                 <td><label>Bairro</label><input type="text" name="bairro" value="<?php echo $bairro ?>"> 
  <label>Perfil</label><textarea name="perfil" rows="5" required><?php echo $perfil ?></textarea>
  <input id="buttonBene" type="submit" name="salvar" value="Salvar" />  
             <input id="buttonBene" type="submit" name="voltar"  value="Voltar" onclick="voltar()" />
                 </td>
                <td> &emsp; </td>
                <td> &emsp; </td>
                <td> &emsp; </td>
                <td align="center"> <a href="entrevista.php?cod=<?php echo $localizador ?>">  <img alt="Entrevista" src="images/entrevista.png" width="100px" height="100px"> </a></td>
                 <td> &emsp; </td>
               <td align="center"> <a href="etapas.php?cod=<?php echo $localizador ?>"> <img src="images/etapas.png" width="100px" height="100px"> </a></td>
                 <td> &emsp; </td>
               <td align="center"> <a href="fiscalizacao.php?cod=<?php echo $localizador ?>"><img src="images/acompanhamento.png" width="100px" height="100px"></a> </td>
                <td> &emsp; </td>
               
               
                <td> &emsp; </td>
                <td> &emsp; </td>
             
             

              </tr>

             
            

           
            

           
         </table>






     </div>

    </div>


    </div>

    </body>
</html>