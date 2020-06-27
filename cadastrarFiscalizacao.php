<?php

include("conexao/conecta.php");

if (isset($_REQUEST['cod'])){
	$localizador = $_REQUEST['cod'];
}

try{
      $select = "SELECT * from beneficiarios where codigoEpura=:localizador";
      $stmt = $conexao->prepare($select);
      $stmt-> bindParam(':localizador', $localizador, PDO::PARAM_STR);
     $stmt->execute();
     $contar = $stmt->rowCount();

     if ($contar >0) {
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $idB = $mostra->id; // ID do Beneficiário
       }
     } else {
       echo "<script>javascript:history.back()</script>";
     }
    } catch(PDOException $e){
     echo $e;
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

function redirecionaPainel(){
	window.location.href = "fiscalizacao.php";
	}

	function erroCadastrar(){
		alert("Ocorreu um erro ao cadastrar, tente novamente");
	}


	
</script>

</head>

<?php

if (isset($_POST['voltar'])){
	header("Location: gerenciarNoticias.php");
}


if(isset($_POST['finaliza'])){
		// RECUPERAR DADOS FORM 
		$data = $_POST['data'];
		$parecer = $_POST['parecerTecnico'];
	
		$usuarioPostou = $_SESSION['idUsuario'];

// SCRIPT DE UPLOAD DE IMAGENS

		if(!empty($_FILES['img_fiscalizacao']['name'])){
        $file     = $_FILES['img_fiscalizacao'];


        $numFile  = count(array_filter($file['name']));
        
        //PASTA
        $folder   = 'images/fiscalizacao';
        
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
              echo $msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 10MB";
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
        $novoNome = "imagemPadrao.jpg";
      }
      




		
		$insert = "INSERT into fiscalizacao (dataFiscalizacao, parecerTecnico, idUsuario, idBeneficiario) VALUES (:data, :parecer, :usuarioPostou, :idB)";
		


		try{
			$result = $conexao->prepare($insert);
			$result->bindParam(':data', $data, PDO::PARAM_STR);
			$result->bindParam(':parecer', $parecer, PDO::PARAM_STR);
			$result->bindParam(':usuarioPostou', $usuarioPostou, PDO::PARAM_INT);
			$result->bindParam(':idB', $idB, PDO::PARAM_INT);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
	
				echo '<script> redireciona() </script>';
				
			}else{
				
    				echo '<script> erroCadastrar() </script>';
				
				
			}
			
		}catch(PDOException $e){
			echo $e;
		}
		

}
	
?>


<body>
    <div class="externo">
        
        <div class="conteudo">
                <h2 id="h2Epura">Cadastrar nova fiscalização</h2>
                <div class="formulario">
                    <form action="" method="post" enctype="multipart/form-data">
    
                        <label>Data</label>
                        <input type="date" name="data" required />

                        <label>Parecer técnico</label>
                        <textarea name="parecerTecnico" rows="15" cols="50"></textarea>
                        
                        <label>Imagem</label>
                        <input type="file" name="img_fiscalizao[]" required />


<br><br>


                        <input type="submit" id="salvar" name="finaliza" value="Salvar" />                     
                    </form>
                  <form method="post" action="">  <input type="submit" name="voltar" value="Voltar" onclick="voltar()" /> </form>
                </div>
            </div>
        </div>
     
        	
       
      
</body>