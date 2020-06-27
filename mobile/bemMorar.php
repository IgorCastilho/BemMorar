<?php



include("conexao/conecta.php");
include("logout.php");
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <!-- Meta tags -->
        <title>ÉpurainCampo - Projeto Bem Morar</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- stylesheets -->
        <link rel="stylesheet" href="../css/font-awesome.css">
       
        <link rel="stylesheet" href="../css/menu2.css">
         <link rel="stylesheet" href="../css/style.css">
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
	
			<div class="conteudo">
				<div class="formulario">
			
				<center><div id="logo"><a href="index.php"><img src="../images/indexEpura.png" width="260px" height="75px"></a></div> </center>
               <nav>
   

        <label for="drop" class="toggle">Menu</label>
        <input type="checkbox" id="drop" />
            <ul class="menu">
                <li><a href="noticias.php" style="color: #FFF;">Notícias</a></li>
                <li>
                    <!-- First Tier Drop Down -->
                    <label for="drop-1" class="toggle">Projetos ▼</label>
                    
                    <input type="checkbox" id="drop-1"/>
                    <ul>
                        <li><a style="font-size: 15px;" href="bemMorar.php">Bem morar</a></li>
                   
                    </ul> 

                </li>
    

                <li><a href="#" style="color: #FFF;">Galeria de fotos</a></li>
                <li><a href="login.php" style="color: #FFF;">Login</a></li>
              
            
            </ul>
        </nav>

              <br>
<div class="conteudoBemMorarMobile">
<br>
<br>


<h3 style="margin: auto; color: white; text-align: center">Conteúdo do programa Bem Morar</h3>


</div>

<br>
    <div class="equipeMobile">
      <label>Equipe pesquisadora</label>
<br>
      <table align="center">
      	
      	<tr align="center">
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td><a href="#pesq" name="modal" style="color: black;">Nome completo 1</a></td>
      			<td>Nome completo 2</td>

      	</tr>


      </table>

<br> <br>
       <table align="center">
      	
      	<tr align="center">
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td>Nome completo 3</td>
      			<td>Nome completo 4</td>

      	</tr>


      </table>


<br> <br>
       <table align="center">
      	
      	<tr align="center">
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td>Nome completo 5</td>
      			<td>Nome completo 6</td>

      	</tr>
	</table>
      	 <br> <br>
       <table align="center">
      	
      	<tr align="center">
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td>Nome completo 7</td>
      			<td>Nome completo 8</td>

      	</tr>
      </table>

          	 <br> <br>
       <table align="center">
      	
      	<tr align="center">
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      			<td><img src="../images/equipe.png" width="50%" height="37%"></td>
      	</tr>
      	<tr align="center">
      			<td>Nome completo 9</td>
      			<td>Nome completo 10</td>

      	</tr>
      </table>


        </div>



 


    
</div>
</div>

</div>



<!-- BOXES DA EQUIPE PESQUISADORA !-->

<div id="boxes">
<div id="pesq" class="window" style="color: black;">

        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br/>

        <br>
    

        <center><b>NOME COMPLETO PESQUISADOR(A)</b></center>

        <br> <br> <br>

        <table cellpadding="2" align="center" style="font-size: 16px;">
          
                <tr>
                 <td align="center"><img src="../images/equipe.png" ></td>
               </tr>

               <tr>
                <td align="center"><b><i>Lattes: </i></b></td>
               </tr>

               <tr>
                 <td align="center"><b><i>Telefone:</i></b> (xx) xxxxx-xxxx</td>
               </tr>
              
     </table> 


     <br> 
     <div class="descricaoPesquisador" style="text-align: justify;">
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