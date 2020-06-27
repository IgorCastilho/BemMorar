<?php


$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

header('Location: mobile/');






include("conexao/conecta.php");

?>

<!DOCTYPE html> <html lang="pt"> <head> <!-- Meta tags --> 
<title>ÉpurainCampo - Projeto Bem Morar</title>  
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width,
initial-scale=1">
 <meta name="keywords" content="Projeto Bem Morar, projeto, bem morar, projeto bem morar, prefeitura de Cuiabá, Cuiabá, a prefeitura reforma sua casa, epura, EPURA, UFMT, epura ufmt, EIT" />
<!-- stylesheets --> 
<link rel="stylesheet" href="css/font-awesome.css"> 
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/menu.css">
     
        <link rel="stylesheet" href="css/gallery.prefixed.css">
        <link rel="stylesheet" href="css/gallery.theme.css">
        
        <!-- google fonts  -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
  
         <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
       
    </head>
    


    <body>
        
     
        
        <div class="externo">
  	
            <div class="conteudo" style="width: 1000px; height: 570px; margin: auto; border-radius: 15px; padding: 0px;">
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
                        <li><a style="font-size: 15px" href="bemMorar.php">Bem morar</a></li>
                   
                    </ul> 

                </li>
    

                <li><a href="#">Galeria de fotos</a></li>
                <li style="margin-right: 4px;"><a href="login.php">Login</a></li>
              
            
            </ul>
        </nav>

            	


<br> <br>
 <div class="slide">
              	<?php

$select = "SELECT * FROM noticias where apareceSlideShow = 1 limit 3";

 try {

 	
     $stmt = $conexao->prepare($select);
     $stmt->execute();
     $contar = $stmt->rowCount();
     
     if($contar == 0){

	echo '<b>Sem informações para exibir </b>';
} else {
     
     echo '<div class="gallery autoplay items-';
     echo $contar;
     echo '">';

     if ($contar == 1){
       echo '<div id="item-1" class="control-operator"></div>';
     }

     else if ($contar == 2){
      echo '<div id="item-1" class="control-operator"></div>
    <div id="item-2" class="control-operator"></div>';
     }

     else if ($contar == 3){
      echo '<div id="item-1" class="control-operator"></div>
    <div id="item-2" class="control-operator"></div>
      <div id="item-3" class="control-operator"></div>';
     }


       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações

  


echo '<figure class="item"';

echo ' style="background: url(images/noticias/';

echo $mostra->imagem;

echo '); background-size: cover; background-repeat:no-repeat; background-position:center center;">';
     
      echo '<div class="tituloNoticias">
      <br>';
      echo  '<a  id="linkMenu" href="exibeNoticia.php?codigo=';
       echo $mostra->id;
      echo '">';
      echo '<b style="background-color: rgba(255,255,255, 0.4);">';
        echo $mostra->titulo; 

        echo '</b>  <br> <br>';
        echo '<i style="background-color: rgba(255,255,255, 0.4);">';

        echo $mostra->subtitulo; 

        echo '</i>
     </a> </div>
    </figure>';



}

  }
  if ($contar == 1){
     echo '<div class="controls">
      <a href="#item-1" class="control-button">•</a>
    </div>';
    echo '</div>'; // div gallery autoplay
  }
  else if ($contar == 2){
    echo '<div class="controls">
      <a href="#item-1" class="control-button">•</a>
      <a href="#item-2" class="control-button">•</a>
    </div>';
    echo '</div>'; // div gallery autoplay
  }
  else if ($contar == 3){
    echo '<div class="controls">
      <a href="#item-1" class="control-button">•</a>
      <a href="#item-2" class="control-button">•</a>
      <a href="#item-3" class="control-button">•</a>
    </div>';
    echo '</div>'; // div gallery autoplay
  }
  
     
 } catch (PDOException $e){
 	echo $e;
 }



 ?>


</div>



   <div class="exibeUltimas" style="text-align: left;">
      <table cellpadding="5" align="left">
          <tr> 
           <td><label style="font-size: 15px;" >Últimas notícias</label></td>

</tr>


   

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



    <tr>
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
    

  



<br>









    <div class="quemSomos">
     <center> <label>Quem somos</label> </center>
<br>
     
    <p>Nossa história teve início em 2010, quando foi criado o Programa de Extensão ÉPURAinQUADRANTES, composto por quatro projetos que buscavam expandir e articular o ensino e a pesquisa em ações de reflexão sobre a produção social do espaço, do território e da paisagem. Sendo eles:</p>

 <p>O ÉPURAinCURSO, que busca a capacitação de alunos e formação continuada dos profissionais, sendo essa a forma como foi introduzida tecnologias de georreferenciamento nas práticas do projeto;</p>

 <p>O ÉPURAinCAMPO, que é realizado de forma integrada às disciplinas de projeto e às pesquisas, em articulação com o NEAU e outras instituições, prestando assistência técnica à população de baixa renda;</p>

<p>O ÉPURAinCONTEXTURAS, promovendo ciclo de palestras, encontros transdisciplinares sobre temas levantados nas disciplinas, nas pesquisas universitárias e na própria extensão;</p>

<p>E o ÉPURAinMOSTRA, que se comporta como uma forma de divulgação dos trabalhos desenvolvidos pelo Grupo de Pesquisa, expondo os resultados das atividades em eventos próprios ou de instituições parceiras.</p>

<p>Com as ações desenvolvidas nesses projetos, houve o amadurecimento de relações cada vez mais horizontais entre professores e alunos, consolidando parcerias comprometidas com o trabalho.</p>

<p>Dessa forma, a quase uma década, o Grupo de Pesquisa e Extensão – Estudos de Planejamento Urbano e Regional (ÉPURA), integrado ao Núcleo de Estudos de Escritório Modelo de Arquitetura e Urbanismo – NEAU, demonstra expertise técnica e operacional por meio da atuação de seus professores-pesquisadores, aliado à formação de seus alunos-bolsistas (monitores, de pesquisa e extensão),e egressos – pesquisadores associados, por meio dos esforços que se voltam à promoção de discussões pautadas na análise crítica e propositiva de políticas territoriais, entre elas, as de habitação.</p>

<p>Ao longo dos anos, o ÉPURA propôs diversas ações que evidenciam a constante busca e aplicação de metodologias de caráter inovador, aliada à preocupação com a abrangência dos resultados sociais almejados em seus projetos.</p>
        </div>






    
</div>
</div>




   
    </body>
</html>