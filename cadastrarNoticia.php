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

    <script src="https://cdn.tiny.cloud/1/4i81kzyom8upsvismvqmy030hew7fzi3mz7a55sou71u7avp/tinymce/5/tinymce.min.js"></script>

    <script>
    	tinymce.init({
    		selector: '#editor'
    	});
    </script>



<script type="text/javascript">

function redirecionaPainel(){
	window.location.href = "selecionaPainel.php";
	}

	function erroCadastrar(){
		alert("Ocorreu um erro ao cadastrar, tente novamente");
	}
	function slideLotado(){
	    alert("Já existem três notícias sendo exibidas no slideshow");
	}
	function voltar(){
	   window.history.back();
	}

	
</script>

</head>

<?php

if (isset($_POST['voltar'])){
	header("Location: gerenciarNoticias.php");
}


if(isset($_POST['finaliza'])){
		// RECUPERAR DADOS FORM 
		$titulo = $_POST['titulo'];
		$subtitulo = $_POST['subtitulo'];
		$conteudo	 = $_POST['conteudo'];
		$usuarioPostou = $_SESSION['idUsuario'];



        $checklist = $_POST['exibeSlide'];
		

        $exibeSlide = 0;
		
		for ($i=0; $i<count($checklist); $i++){

			if ($checklist[$i] == 'slide'){
				$exibeSlide = 1;
			}
		}
		
		
			$select = "SELECT * FROM noticias where apareceSlideShow = 1";
		


		try{
			$result = $conexao->prepare($select);
			$result->execute();
			$contar = $result->rowCount();
		} catch (PDOException $e){
		    echo $e;
		}
		
        if ($contar <= 3){


// SCRIPT DE UPLOAD DE IMAGENS

		if(!empty($_FILES['img_noticia']['name'])){
        $file     = $_FILES['img_noticia'];


        $numFile  = count(array_filter($file['name']));
        
        //PASTA
        $folder   = 'images/noticias';
        
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
      




		
		$insert = "INSERT into noticias (titulo, subtitulo, conteudo, imagem, usuarioPostou, apareceSlideShow) VALUES (:tituloT, :subtitulo, :conteudo, :imagem, :usuarioPostou, :exibeSlide)";
		


		try{
			$result = $conexao->prepare($insert);
			$result->bindParam(':tituloT', $titulo, PDO::PARAM_STR);
			$result->bindParam(':subtitulo', $subtitulo, PDO::PARAM_STR);
			$result->bindParam(':conteudo', $conteudo, PDO::PARAM_STR);
			$result->bindParam(':imagem', $novoNome, PDO::PARAM_STR);
			$result->bindParam(':usuarioPostou', $usuarioPostou, PDO::PARAM_INT);
			$result->bindParam(':exibeSlide', $exibeSlide, PDO::PARAM_INT);
			$result->execute();
			$contar = $result->rowCount();
			if($contar>0){
	
				echo '<script> redirecionaPainel() </script>';
				
			}else{
				
    				echo '<script> erroCadastrar() </script>';
				
				
			}
			
		}catch(PDOException $e){
			echo $e;
		}
		
}

 else {
    echo '<script> slideLotado() </script>';
}
}
	
?>


<body>
    <div class="externo">
        
        <div class="conteudo">
                <h2 id="h2Epura">Cadastrar nova notícia</h2>
                <div class="formulario">
                    <form action="" method="post" enctype="multipart/form-data">
    
                        <label>Título</label>
                        <input type="text" name="titulo" placeholder="Título" required />
                        <label>Subtítulo</label>
                        <input type="text" name="subtitulo" placeholder="Subtítulo" required />

                        <label>Conteúdo</label>
                        <textarea id="editor" name="conteudo" rows="30" cols="100"></textarea>


<br>
                        <label>Imagem</label>
                        <input type="file" name="img_noticia[]" required />
                        
                        <br> <br>
                    	<label><input type="checkbox" name="exibeSlide[]" value="slide">Aparecer no slideShow</label><br>


                        <input type="submit" id="salvar" name="finaliza" value="Salvar" />                     
                    </form>
                   <input type="button" name="voltar" value="Voltar" onclick="voltar()" /> 
                </div>
            </div>
        </div>
     
        	
       
      
</body>