<?php


$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

header('Location: login.php');



?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <!-- Meta tags -->
        <title>ÉpurainCampo - Projeto Bem Morar</title>
        
        <meta charset="utf-8">
         <meta name="keywords" content="Projeto Bem Morar, projeto, bem morar, projeto bem morar, prefeitura de Cuiabá, Cuiabá, a prefeitura reforma sua casa, epura, EPURA, UFMT, epura ufmt, EIT" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- stylesheets -->
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/menu.css">
         <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
  
        <!-- google fonts  -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
       
    </head>
    

    <script type="text/javascript">
    	

  $(document).ready(function() {  

    $('a[name=modal]').click(function(e) {
      e.preventDefault();

      var id = $(this).attr('href');


      var maskHeight = $(document).height();
      var maskWidth = $(window).width();

      $('#mask').css({'width':maskWidth,'height':maskHeight});

      $('#mask').fadeIn(1000);  
      $('#mask').fadeTo("slow",0.8);  

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();

    $(id).css('top',  winH/2-$(id).height()/2);
    $(id).css('left', winW/2-$(id).width()/2);

    $(id).fadeIn(2000); 

  });

    $('.window .close').click(function (e) {
      e.preventDefault();

      $('#mask').hide();
      $('.window').hide();
    });   

    $('#mask').click(function () {
      $(this).hide();
      $('.window').hide();
    });     

  });

    </script>




    <body>
        
     
        
        <div class="externo">
  	
            <div class="conteudo" style="width: 1000px; height: auto; margin: auto; padding: 0;">
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

<br>


    <div class="equipe">
      <label>Equipe pesquisadora</label>
<br>
      <table align="center">
      	
      	<tr align="center">
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td><a href="#pesq" name="modal">Nome completo 1</a></td>
      			<td>Nome completo 2</td>

      	</tr>


      </table>

<br> <br>
       <table align="center">
      	
      	<tr align="center">
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td>Nome completo 3</td>
      			<td>Nome completo 4</td>

      	</tr>


      </table>


<br> <br>
       <table align="center">
      	
      	<tr align="center">
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td>Nome completo 5</td>
      			<td>Nome completo 6</td>

      	</tr>
	</table>
      	 <br> <br>
       <table align="center">
      	
      	<tr align="center">
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td>Nome completo 7</td>
      			<td>Nome completo 8</td>

      	</tr>
      </table>

          	 <br> <br>
       <table align="center">
      	
      	<tr align="center">
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td>Nome completo 9</td>
      			<td>Nome completo 10</td>

      	</tr>
      </table>


        </div>

<div class="conteudoBemMorar">
    
<p>O Bem Morar é um programa que tem por objetivo reduzir o déficit qualitativo habitacional do município de Cuiabá ao ofertar os serviços de reforma, ampliação e melhorias de unidades habitacionais. Nele, moradores de cinco bairros da capital, com regularização fundiária em dia e que se encontram dentro de Zonas Especiais de Interesse Social (ZEIS) estão sendo contemplados, sendo eles o Vale do Carumbé, Planalto, Altos da Glória, Jardim Umuarama e Três Barras. Seu projeto de Lei de nº 6.380 de 18 de abril de 2019, foi aprovado por unanimidade pela Câmara Municipal de Cuiabá. </p>

<p>O ÉpuraInCAMPO é o projeto responsável pela avaliação da situação dos imóveis. Através de levantamentos semanais, os grupos compostos por pesquisadores e estudantes-bolsistas percorrem as residências identificando as necessidades de obras e elaborando projetos de melhorias individuais para cada uma delas. A parceria entre Prefeitura e UFMT foi firmada por meio de um convênio de cooperação técnica entre a Secretaria de Habitação e Regularização Fundiária e Fundação Uniselva, sendo uma oportunidade de aprendizado para alunos da instituição que participam ativamente de todas as atividades desse processo.</p>

<p>No Bem Morar, cada família beneficiada recebe um cartão reforma com até R$ 12 mil para ser investido em melhorias no lar sem necessitar devolver o valor ao Município. O valor é calculado a partir das necessidades do imóvel. Sendo 25% para serem usados para pagar mão de obra e os 75% restantes para aquisição de material de construção.</p>



</div>
<br>
 


    
</div>
</div>





<!-- BOXES DA EQUIPE PESQUISADORA !-->

<div id="boxes">
<div id="pesq" class="window">
	<div style="margin-left: 50px;">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br/>

 
    

        <center><b>NOME COMPLETO PESQUISADOR(A)</b></center>

        <br> <br> <br>

        <table cellpadding="5" align="left">
          
                <tr>
                 <td align="center" rowspan="3"><img src="images/equipe.png" ></td>
                 <td align="left"><b><i>Lattes: </i></b></td>
              
               </tr>

               <tr>
                 <td align="left"><b><i>Telefone:</i></b> (xx) xxxxx-xxxx</td>
                 
               </tr>

           
              
     </table> 


     <br> <br> 
     <div class="descricaoPesquisador">
     <h4>DESCRIÇÃO</h4>

     <p>
     	Descrever histórico profissional, ligação com o NEAU etc 
     	<br>
     	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id purus ullamcorper, cursus neque eu, consequat leo. Integer vehicula molestie efficitur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi vitae pharetra nisi. Nunc in erat eget risus luctus suscipit at in quam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas posuere in velit eu posuere. Nunc et aliquam orci. Maecenas facilisis elementum convallis. Donec magna elit, vestibulum et risus vitae, malesuada lacinia elit. Sed venenatis risus blandit diam hendrerit, quis porta purus elementum. Cras sollicitudin ipsum vel mauris vulputate gravida. Donec nec lorem fringilla, accumsan lectus a, aliquam lorem. Vestibulum placerat fermentum turpis, sed sollicitudin ipsum.

Suspendisse quis augue vitae odio porttitor viverra. Morbi sollicitudin turpis pretium leo sodales cursus. Nullam id porttitor enim, at tincidunt urna. Etiam semper orci odio, ac venenatis risus luctus non. Aliquam id lectus ex. Sed eget justo gravida purus commodo laoreet a ac augue. Duis sem dui, malesuada et turpis id, scelerisque ultricies dolor. Praesent eget sollicitudin magna, sit amet ullamcorper eros. Vivamus lacinia lorem a venenatis consectetur.

Nullam quis erat nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam nec enim eu nibh congue varius. Fusce sagittis commodo rutrum. Proin tristique tincidunt justo, placerat maximus nulla volutpat egestas. Nulla accumsan lorem magna, vitae consectetur sem dictum accumsan. Integer consectetur eros quis leo semper, in vulputate ligula suscipit. Nullam mi arcu, malesuada vitae vestibulum sed, ornare sit amet nisi. Morbi risus arcu, efficitur quis tempor in, convallis at massa. Morbi dictum leo sit amet diam convallis imperdiet. Aliquam ultrices sollicitudin libero, ac egestas eros luctus a. In sed odio et nibh interdum finibus. Integer consectetur nulla id est interdum, ac pretium ex lacinia. Etiam id dolor porttitor, ullamcorper sapien sit amet, euismod lectus. In cursus nec ex at posuere. Duis iaculis arcu eu lorem fringilla fermentum.

Aliquam ac erat tincidunt, accumsan dolor non, maximus tellus. Sed at dapibus sem, sed faucibus odio. Vivamus quis consequat nibh. Fusce a nulla dolor. Suspendisse eu velit quis erat bibendum convallis nec at quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum vel sem quis sodales.

Integer dapibus malesuada lorem. Quisque magna lorem, porta imperdiet mauris quis, fermentum posuere mauris. Quisque eget nibh eleifend, accumsan augue nec, fermentum mi. Donec dapibus, leo vel pulvinar malesuada, orci nisl lobortis lectus, ac semper mauris est ac enim. Suspendisse cursus magna a venenatis gravida. Praesent vitae mollis nunc. Maecenas eget lacinia dui. Pellentesque sollicitudin volutpat lacus, sit amet auctor mauris rhoncus et. Quisque vestibulum nibh elit, in vestibulum velit iaculis a. Etiam vel nulla dictum, placerat justo vel, vehicula magna. Duis vulputate lorem fringilla tortor volutpat dapibus.

     </p>
<br>
<br>
   </div>

   </div>
 </div>
</div>

<div id="mask"></div>


   
    </body>
</html>