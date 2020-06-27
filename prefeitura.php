<?php
include("conexao/conecta.php");
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}
else{
  if ($_SESSION['nivel_acesso'] == 'null'){

    header("Location: selecionaPainel.php?nao_autorizado");
  }
}


$exibe_programa = 0;
$exibe_valeCarumbe = 0;
$exibe_jardimUmuarama =0;
$exibe_planalto = 0;
$exibe_altosGloria = 0;
$exibe_tresBarras = 0;

if(isset($_REQUEST['seleciona'])){

  $seleciona = $_REQUEST['seleciona'];

  if ($seleciona == 'programa'){
    $exibe_programa = 1;
    $exibe_valeCarumbe = 0;
    $exibe_jardimUmuarama =0;
    $exibe_planalto = 0;
    $exibe_altosGloria = 0;
    $exibe_tresBarras = 0;
  }
  else if ($seleciona =='valeCarumbe'){
    $exibe_programa = 0;
    $exibe_valeCarumbe = 1;
    $exibe_jardimUmuarama =0;
    $exibe_planalto = 0;
    $exibe_altosGloria = 0;
    $exibe_tresBarras = 0;

  }
  else if($seleciona == 'planalto'){
    $exibe_programa = 0;
    $exibe_valeCarumbe = 0;
    $exibe_jardimUmuarama =0;
    $exibe_planalto = 1;
    $exibe_altosGloria = 0;
    $exibe_tresBarras = 0;
  }
  else if ($seleciona == 'jardimUmuarama'){
    $exibe_programa = 0;
    $exibe_valeCarumbe = 0;
    $exibe_jardimUmuarama =1;
    $exibe_planalto = 0;
    $exibe_altosGloria = 0;
    $exibe_tresBarras = 0;
  }
  else if($seleciona == 'altosGloria'){
    $exibe_programa = 0;
    $exibe_valeCarumbe = 0;
    $exibe_jardimUmuarama =0;
    $exibe_planalto = 0;
    $exibe_altosGloria = 1;
    $exibe_tresBarras = 0;
  }
  else if ($seleciona == 'tresBarras'){
    $exibe_programa = 0;
    $exibe_valeCarumbe = 0;
    $exibe_jardimUmuarama =0;
    $exibe_planalto = 0;
    $exibe_altosGloria = 0;
    $exibe_tresBarras = 1;
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
  <!-- stylesheets -->
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script> 
  <!-- google fonts  -->
  <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
</head>



<script type="text/javascript">

	function voltar(){
		window.location.href = "selecionaPainel.php";
	}

  function c_programa(){
    window.location.href = "prefeitura.php?seleciona=programa"
  }
  function c_vale(){
    window.location.href = "prefeitura.php?seleciona=valeCarumbe"
  }
  function c_altos(){
    window.location.href = "prefeitura.php?seleciona=altosGloria"
  }
  function c_jdUmu(){
    window.location.href = "prefeitura.php?seleciona=jardimUmuarama"
  }

  function c_tres(){
    window.location.href = "prefeitura.php?seleciona=tresBarras"
  }

  function c_planalto(){
    window.location.href = "prefeitura.php?seleciona=planalto"
  }



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




<?php 
            // PROGRAMA

try{
  $select = "SELECT levantamento, asbuilt, proposta, memorial, tabelaServ, quantitativo FROM etapas_beneficiario E
  INNER JOIN beneficiarios B ON B.id = E.cod_beneficiario";
  $stmt = $conexao->prepare($select);
  $stmt->execute();
  $contar = $stmt->rowCount();

  $PG_count_levantamento_sim =0;
  $PG_count_levantamento_nao = 0;

  $PG_count_asbuilt_sim = 0;
  $PG_count_asbuilt_nao = 0;

  $PG_count_proposta_sim = 0;
  $PG_count_proposta_nao = 0;

  $PG_count_quantitativo_sim = 0;
  $PG_count_quantitativo_nao = 0;


  if ($contar >0) { 
   while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações

    if ($mostra->levantamento == 1){
      $PG_count_levantamento_sim++;
    }
    else{
      $PG_count_levantamento_nao++;
    }

    if ($mostra->asbuilt == 1){
      $PG_count_asbuilt_sim++;
    }
    else{
      $PG_count_asbuilt_nao++;
    }

    if ($mostra->proposta == 1){
      $PG_count_proposta_sim++;
    }
    else{
      $PG_count_proposta_nao++;
    }

    if ($mostra->quantitativo == 1){
      $PG_count_quantitativo_sim++;
    }
    else{
      $PG_count_quantitativo_nao++;
    }


  }
} else {
 echo "Erro interno do servidor";
}

} catch(PDOException $e){
 echo $e;
}

?>











<?php

// PLANALTO
try{
  $select = "SELECT levantamento, asbuilt, proposta, memorial, tabelaServ, quantitativo FROM etapas_beneficiario E
  INNER JOIN beneficiarios B ON B.id = E.cod_beneficiario and B.bairro= 'PLANALTO'";
  $stmt = $conexao->prepare($select);
  $stmt->execute();
  $contar = $stmt->rowCount();

  $PL_count_levantamento_sim =0;
  $PL_count_levantamento_nao = 0;

  $PL_count_asbuilt_sim = 0;
  $PL_count_asbuilt_nao = 0;

  $PL_count_proposta_sim = 0;
  $PL_count_proposta_nao = 0;

  $PL_count_quantitativo_sim = 0;
  $PL_count_quantitativo_nao = 0;


  if ($contar >0) { 
   while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações

    if ($mostra->levantamento == 1){
      $PL_count_levantamento_sim++;
    }
    else{
      $PL_count_levantamento_nao++;
    }

    if ($mostra->asbuilt == 1){
      $PL_count_asbuilt_sim++;
    }
    else{
      $PL_count_asbuilt_nao++;
    }

    if ($mostra->proposta == 1){
      $PL_count_proposta_sim++;
    }
    else{
      $PL_count_proposta_nao++;
    }

    if ($mostra->quantitativo == 1){
      $PL_count_quantitativo_sim++;
    }
    else{
      $PL_count_quantitativo_nao++;
    }


  }
} else {
 echo "Erro interno do servidor";
}

} catch(PDOException $e){
 echo $e;
}

?>


<?php 
// VALE DO CARUMBÉ




try{
  $select = "SELECT * FROM etapas_beneficiario E
  INNER JOIN beneficiarios B ON B.id = E.cod_beneficiario and B.bairro= 'CARUMBE'";
  $stmt = $conexao->prepare($select);
  $stmt->execute();
  $contar = $stmt->rowCount();

  $VC_count_levantamento_sim =0;
  $VC_count_levantamento_nao = 0;

  $VC_count_asbuilt_sim = 0;
  $VC_count_asbuilt_nao = 0;

  $VC_count_proposta_sim = 0;
  $VC_count_proposta_nao = 0;

  $VC_count_quantitativo_sim = 0;
  $VC_count_quantitativo_nao = 0;


  if ($contar >0) { 
   while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações

    if ($mostra->levantamento == 1){
      $VC_count_levantamento_sim++;
    }
    else{
      $VC_count_levantamento_nao++;
    }

    if ($mostra->asbuilt == 1){
      $VC_count_asbuilt_sim++;
    }
    else{
      $VC_count_asbuilt_nao++;
    }

    if ($mostra->proposta == 1){
      $VC_count_proposta_sim++;
    }
    else{
      $VC_count_proposta_nao++;
    }

    if ($mostra->quantitativo == 1){
      $VC_count_quantitativo_sim++;
    }
    else{
      $VC_count_quantitativo_nao++;
    }


  }






} else {
 echo "Erro interno do servidor";
}

} catch(PDOException $e){
 echo $e;
}

?>

<?php 
// JARDIM UMUARAMA
try{
  $select = "SELECT levantamento, asbuilt, proposta, memorial, tabelaServ, quantitativo FROM etapas_beneficiario E
  INNER JOIN beneficiarios B ON B.id = E.cod_beneficiario and B.bairro= 'UMUARAMA'";
  $stmt = $conexao->prepare($select);
  $stmt->execute();
  $contar = $stmt->rowCount();

  $JU_count_levantamento_sim =0;
  $JU_count_levantamento_nao = 0;

  $JU_count_asbuilt_sim = 0;
  $JU_count_asbuilt_nao = 0;

  $JU_count_proposta_sim = 0;
  $JU_count_proposta_nao = 0;

  $JU_count_quantitativo_sim = 0;
  $JU_count_quantitativo_nao = 0;


  if ($contar >0) { 
   while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações

    if ($mostra->levantamento == 1){
      $JU_count_levantamento_sim++;
    }
    else{
      $JU_count_levantamento_nao++;
    }

    if ($mostra->asbuilt == 1){
      $JU_count_asbuilt_sim++;
    }
    else{
      $JU_count_asbuilt_nao++;
    }

    if ($mostra->proposta == 1){
      $JU_count_proposta_sim++;
    }
    else{
      $JU_count_proposta_nao++;
    }

    if ($mostra->quantitativo == 1){
      $JU_count_quantitativo_sim++;
    }
    else{
      $JU_count_quantitativo_nao++;
    }


  }
} else {
 echo "Erro interno do servidor";
}

} catch(PDOException $e){
 echo $e;
}

?>

<?php 
// ALTOS DA GLÓRIA
try{
  $select = "SELECT levantamento, asbuilt, proposta, memorial, tabelaServ, quantitativo FROM etapas_beneficiario E
  INNER JOIN beneficiarios B ON B.id = E.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'";
  $stmt = $conexao->prepare($select);
  $stmt->execute();
  $contar = $stmt->rowCount();

  $AG_count_levantamento_sim =0;
  $AG_count_levantamento_nao = 0;

  $AG_count_asbuilt_sim = 0;
  $AG_count_asbuilt_nao = 0;

  $AG_count_proposta_sim = 0;
  $AG_count_proposta_nao = 0;

  $AG_count_quantitativo_sim = 0;
  $AG_count_quantitativo_nao = 0;


  if ($contar >0) { 
   while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações

    if ($mostra->levantamento == 1){
      $AG_count_levantamento_sim++;
    }
    else{
      $AG_count_levantamento_nao++;
    }

    if ($mostra->asbuilt == 1){
      $AG_count_asbuilt_sim++;
    }
    else{
      $AG_count_asbuilt_nao++;
    }

    if ($mostra->proposta == 1){
      $AG_count_proposta_sim++;
    }
    else{
      $AG_count_proposta_nao++;
    }

    if ($mostra->quantitativo == 1){
      $AG_count_quantitativo_sim++;
    }
    else{
      $AG_count_quantitativo_nao++;
    }


  }
} else {
 echo "Erro interno do servidor";
}

} catch(PDOException $e){
 echo $e;
}

?>



<?php 
// TRÊS BARRAS
try{
  $select = "SELECT levantamento, asbuilt, proposta, memorial, tabelaServ, quantitativo FROM etapas_beneficiario E
  INNER JOIN beneficiarios B ON B.id = E.cod_beneficiario and B.bairro= 'TRESBARRAS'";
  $stmt = $conexao->prepare($select);
  $stmt->execute();
  $contar = $stmt->rowCount();

  $TB_count_levantamento_sim =0;
  $TB_count_levantamento_nao = 0;

  $TB_count_asbuilt_sim = 0;
  $TB_count_asbuilt_nao = 0;

  $TB_count_proposta_sim = 0;
  $TB_count_proposta_nao = 0;

  $TB_count_quantitativo_sim = 0;
  $TB_count_quantitativo_nao = 0;


  if ($contar >0) { 
   while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações

    if ($mostra->levantamento == 1){
      $TB_count_levantamento_sim++;
    }
    else{
      $TB_count_levantamento_nao++;
    }

    if ($mostra->asbuilt == 1){
      $TB_count_asbuilt_sim++;
    }
    else{
      $TB_count_asbuilt_nao++;
    }

    if ($mostra->proposta == 1){
      $TB_count_proposta_sim++;
    }
    else{
      $TB_count_proposta_nao++;
    }

    if ($mostra->quantitativo == 1){
      $TB_count_quantitativo_sim++;
    }
    else{
      $TB_count_quantitativo_nao++;
    }


  }
} else {
 echo "Erro interno do servidor";
}

} catch(PDOException $e){
 echo $e;
}

?>













<body>





  <div class="externo">
    <!--<h1>Prefeitura</h1>		-->
    <div class="conteudo" style=" width: 950px;
    height: auto;
    margin: auto;
    margin-bottom: 0px;
    border-radius: 15px;
    padding: 3% 0px;
    padding-top: 1px;
    padding-bottom: 0px;">



      <div align="center" class="prefeitura">
        <table cellpadding="18" align="center">

          <tr>
            <td><a onclick="c_programa()"> <img src="images/prefeitura/programa.png" width="110px" height="110px"></a></td>
            <td><a onclick="c_vale()"><img src="images/prefeitura/vale.png" width="110px" height="110px"></a></td>
            <td><a onclick="c_jdUmu()"><img src="images/prefeitura/jdumu.png" width="110px" height="110px"></a></td>
            <td><a onclick="c_planalto()"><img src="images/prefeitura/planalto.png" width="110px" height="110px"></a></td>
            <td><a onclick="c_altos()"><img src="images/prefeitura/altos.png" width="110px" height="110px"></a></td>
            <td><a onclick="c_tres()"><img src="images/prefeitura/tresbarras.png" width="110px" height="110px"></a></td>


          </tr>


        </table>


        <div align="center" <?php 

        if (!(($exibe_planalto==0)&&($exibe_tresBarras==0)&&($exibe_altosGloria==0)
          &&($exibe_jardimUmuarama==0)&&($exibe_valeCarumbe==0)&&($exibe_programa==0))){
          echo "style='display:none'";
      }

      ?> >


    <br> <br> <br> <br> <br> <br> <br>
        
      <label>Selecione um bairro para exibir os gráficos de acompanhamento  </label>    

<br> <br> <br> <br> <br> <br> <br> 

      </div>

      <div align="center" <?php if ($exibe_programa==0){ echo "style='display:none'"; } ?> >

        <table align="center" cellpadding="25" cellspacing="0">
          <tr>
            <td align="center"><div id="levantamento_programa" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#levantamentoProgramaOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#levantamentoProgramaN" name="modal">Mais detalhes (em andamento)</a></td>
            <td align="center"><div id="asbuilt_programa" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#asBuiltProgramaOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#asBuiltProgramaN" name="modal">Mais detalhes (em andamento)</a></td>
          </tr>



          <tr>

            <td align="center"><div id="proposta_programa" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#propostaProgramaOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#propostaProgramaN" name="modal">Mais detalhes (em andamento)</a></td>
            <td align="center"><div id="quantitativo_programa" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#quantitativoProgramaOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#quantitativoProgramaN" name="modal">Mais detalhes (em andamento)</a></td>

          </tr>


        </table> 

      </div>


      <div align="center" <?php if ($exibe_valeCarumbe==0){ echo "style='display:none'"; } ?> >

        <table align="center" cellpadding="25" cellspacing="0">
          <tr>
            <td align="center"><div id="levantamento_carumbe" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#levantamentoCarumbeOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#levantamentoCarumbeN" name="modal">Mais detalhes (em andamento)</a></td>
            <td align="center"><div id="asbuilt_carumbe" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#asBuiltCarumbeOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#asBuiltCarumbeN" name="modal"> Mais detalhes (em andamento)</a></td>
          </tr>
          <tr>
            <td align="center"><div id="proposta_carumbe" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#propostaCarumbeOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#propostaCarumbeN" name="modal">Mais detalhes (em andamento)</a></td>
            <td align="center"><div id="quantitativo_carumbe" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#quantitativoCarumbeOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#quantitativoCarumbeN" name="modal">Mais detalhes (em andamento)</a></td>

          </tr>


        </table>

      </div>


      <div align="center" <?php if ($exibe_jardimUmuarama==0){ echo "style='display:none'"; } ?> >

       <table align="center" cellpadding="25" cellspacing="0">
        <tr>
          <td align="center"><div id="levantamento_umuarama" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#levantamentoUmuaramaOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#levantamentoUmuaramaN" name="modal">Mais detalhes (em andamento)</a></td>
          <td align="center"><div id="asbuilt_umuarama" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#asBuiltUmuaramaOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#asBuiltUmuaramaN" name="modal"> Mais detalhes (em andamento)</a></td>
        </tr>
        <tr>
          <td align="center"><div id="proposta_umuarama" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#propostaUmuaramaOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#propostaUmuaramaN" name="modal">Mais detalhes (em andamento)</a></td>
          <td align="center"><div id="quantitativo_umuarama" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#quantitativoUmuaramaOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#quantitativoUmuaramaN" name="modal">Mais detalhes (em andamento)</a></td>

        </tr>


      </table> 


    </div>

    <div align="center" <?php if ($exibe_altosGloria==0){ echo "style='display:none'"; } ?> >

           <table align="center" cellpadding="25" cellspacing="0">
        <tr>
          <td align="center"><div id="levantamento_ag" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#levantamentoAGOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#levantamentoAGN" name="modal">Mais detalhes (em andamento)</a></td>
          <td align="center"><div id="asbuilt_ag" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#asBuiltAGOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#asBuiltAGN" name="modal"> Mais detalhes (em andamento)</a></td>
        </tr>
        <tr>
          <td align="center"><div id="proposta_ag" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#propostaAGOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#propostaAGN" name="modal">Mais detalhes (em andamento)</a></td>
          <td align="center"><div id="quantitativo_ag" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#quantitativoAGOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#quantitativoAGN" name="modal">Mais detalhes (em andamento)</a></td>

        </tr>


      </table> 

      </div>

      <div align="center" <?php if ($exibe_tresBarras==0){ echo "style='display:none'"; } ?> >

           <table align="center" cellpadding="25" cellspacing="0">
        <tr>
          <td align="center"><div id="levantamento_tb" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#levantamentoTBOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#levantamentoTBN" name="modal">Mais detalhes (em andamento)</a></td>
          <td align="center"><div id="asbuilt_tb" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#asBuiltTBOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#asBuiltTBN" name="modal"> Mais detalhes (em andamento)</a></td>
        </tr>
        <tr>
          <td align="center"><div id="proposta_tb" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#propostaTBOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#propostaTBN" name="modal">Mais detalhes (em andamento)</a></td>
          <td align="center"><div id="quantitativo_tb" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#quantitativoTBOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#quantitativoTBN" name="modal">Mais detalhes (em andamento)</a></td>

        </tr>


      </table> 


        </div>


        <div <?php if($exibe_planalto==0){
          echo "style='display:none'";
        } ?> > 

        <br> <br> 

        <table align="center" cellpadding="25" cellspacing="0">
          <tr>
            <td align="center"><div id="levantamento_planalto" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#levantamentoPlanaltoOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#levantamentoPlanaltoN" name="modal">Mais detalhes (em andamento)</a></td>
            <td align="center"><div id="asbuilt_planalto" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#asBuiltPlanaltoOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#asBuiltPlanaltoN" name="modal">Mais detalhes (em andamento)</a></td>
          </tr>
          <tr>
            <td align="center"><div id="proposta_planalto" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#propostaPlanaltoOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#propostaPlanaltoN" name="modal">Mais detalhes(em andamento)</a></td>
            <td align="center"><div id="quantitativo_planalto" style="width: 400px; height: 250px;"></div><a id="labelGraficos" href="#quantitativoPlanaltoOk" name="modal">Mais detalhes (concluídas)</a><br><br><a id="labelGraficos" href="#quantitativoPlanaltoN" name="modal">Mais detalhes (em andamento)</a></td>

          </tr>


        </table>


      </div>

      <input type="submit" name="voltar" value="Voltar" onclick="voltar()" />
    </div>


    <!-- DIVISÓRIAS FLUTUANTES !-->

<div id="boxes">

      <div id="levantamentoProgramaOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario 
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="levantamentoProgramaN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario 
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">

      <div id="asBuiltProgramaOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario 
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="asBuiltProgramaN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario 
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">

      <div id="propostaProgramaOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario 
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="propostaProgramaN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario 
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">

      <div id="quantitativoProgramaOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario 
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="quantitativoProgramaN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario 
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>



    <div id="boxes">

      <div id="levantamentoCarumbeOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'CARUMBE'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagemCarumbe=0;
              if($mostra->asbuilt == 1){
                $porcentagemCarumbe += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagemCarumbe +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagemCarumbe += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagemCarumbe +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagemCarumbe ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="levantamentoCarumbeN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'CARUMBE'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


 <div id="boxes">

      <div id="asBuiltCarumbeOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'CARUMBE'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagemCarumbe=0;
              if($mostra->levantamento == 1){
                $porcentagemCarumbe += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagemCarumbe +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagemCarumbe += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagemCarumbe +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagemCarumbe ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="asBuiltCarumbeN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'CARUMBE'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


 <div id="boxes">

      <div id="propostaCarumbeOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'CARUMBE'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagemCarumbe=0;
              if($mostra->levantamento == 1){
                $porcentagemCarumbe += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagemCarumbe +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagemCarumbe += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagemCarumbe +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagemCarumbe ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="propostaCarumbeN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'CARUMBE'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


 <div id="boxes">

      <div id="quantitativoCarumbeOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'CARUMBE'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagemCarumbe=0;
              if($mostra->levantamento == 1){
                $porcentagemCarumbe += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagemCarumbe +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagemCarumbe += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagemCarumbe +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagemCarumbe ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="quantitativoCarumbeN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'CARUMBE'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>



    <div id="boxes">

      <div id="levantamentoUmuaramaOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'UMUARAMA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="levantamentoUmuaramaN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'UMUARAMA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

 <div id="boxes">

      <div id="asBuiltUmuaramaOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'UMUARAMA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="asBuiltUmuaramaN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'UMUARAMA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">

      <div id="propostaUmuaramaOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'UMUARAMA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="propostaUmuaramaN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'UMUARAMA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">

      <div id="quantitativoUmuaramaOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'UMUARAMA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="quantitativoUmuaramaN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'UMUARAMA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>




<div id="boxes">
<div id="levantamentoPlanaltoOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'PLANALTO'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="levantamentoPlanaltoN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'PLANALTO'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>



<div id="boxes">
<div id="asBuiltPlanaltoOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'PLANALTO'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="asBuiltPlanaltoN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'PLANALTO'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="propostaPlanaltoOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'PLANALTO'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="propostaPlanaltoN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'PLANALTO'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>



<div id="boxes">
<div id="quantitativoPlanaltoOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'PLANALTO'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="quantitativoPlanaltoN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'PLANALTO'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<!-- Altos da glória !-->


<div id="boxes">
<div id="levantamentoAGOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="levantamentoAGN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>



<div id="boxes">
<div id="asBuiltAGOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="asBuiltAGN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="propostaAGOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="propostaAGN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>



<div id="boxes">
<div id="quantitativoAGOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="quantitativoAGN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>











<!-- Três barras !-->


<div id="boxes">
<div id="levantamentoTBOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'TRESBARRAS'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="levantamentoTBN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'TRESBARRAS'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->asbuilt == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->levantamento == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>



<div id="boxes">
<div id="asBuiltTBOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'ALTOS DA GLORIA'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="asBuiltTBN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'TRESBARRAS'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->proposta == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->asbuilt == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="propostaTBOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'TRESBARRAS'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>

<div id="boxes">
<div id="propostaTBN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'TRESBARRAS'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->quantitativo == 1){
                $porcentagem += 25;
              }

              if ($mostra->proposta == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>



<div id="boxes">
<div id="quantitativoTBOk" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'TRESBARRAS'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>


<div id="boxes">
<div id="quantitativoTBN" class="window">
        <a href="#" class="close"><label id="labelFechar">Fechar [X]</a></label><br />


        <table cellpadding="20" align="center">
          <tr>
            <th align="center">Código do beneficiário</th>
            <th align="center">Andamento em %</th>
            <th align="center">Grupo responsável</th>

          </tr>



          <?php


          try{
            $select = "SELECT * FROM etapas_beneficiario I
            INNER JOIN beneficiarios B ON B.id = I.cod_beneficiario and B.bairro= 'TRESBARRAS'
            INNER JOIN entrevista E ON B.id = E.cod_beneficiario";
            $stmt = $conexao->prepare($select);
            $stmt->execute();
            $contar = $stmt->rowCount();


            if ($contar >0) { 
             while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
              $porcentagem=0;
              if($mostra->levantamento == 1){
                $porcentagem += 25;
              }
              if ($mostra->asbuilt == 1){
                $porcentagem +=25;
              }
              if ($mostra->proposta == 1){
                $porcentagem += 25;
              }

              if ($mostra->quantitativo == 1){
                $porcentagem +=25; 
              } else{ ?>
                <tr>
                 <td align="center"> <?php echo $mostra->codigoCompleto ?> </td>
                 <td align="center"> <?php echo $porcentagem ?>% </td>
                 <td align="center"> <?php echo $mostra->grupoTrabalho ?></td>
               </tr>
               <?php
             }

           }
         }



       } catch(PDOException $e){
         echo $e;
       }
       ?>
     </table> 
   </a>
 </div>
</div>











<div id="mask"></div>


</body>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(levantamento_planalto);
  function levantamento_planalto() {
    var data = google.visualization.arrayToDataTable([
      ['Fase', 'Casas concluídas'],
      ['Concluídas',     <?php echo $PL_count_levantamento_sim ?>],
      ['Em andamento',      <?php echo $PL_count_levantamento_nao ?>]

      ]);

    var options = {
      title: 'Levantamento',
      colors: ['#0e38e0', '#e0440e'],
      is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('levantamento_planalto'));
    chart.draw(data, options);
  }


  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(asbuilt_planalto);


  function asbuilt_planalto() {
    var data = google.visualization.arrayToDataTable([
      ['Fase', 'Casas concluídas'],
      ['Concluídas',     <?php echo $PL_count_asbuilt_sim ?>],
      ['Em andamento',      <?php echo $PL_count_asbuilt_nao ?>]

      ]);

    var options = {
      title: 'As built',
      colors: ['#0e38e0', '#e0440e'],
      is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('asbuilt_planalto'));
    chart.draw(data, options);
  }


  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(proposta_planalto);


  function proposta_planalto() {
    var data = google.visualization.arrayToDataTable([
      ['Fase', 'Casas concluídas'],
      ['Concluídas',     <?php echo $PL_count_proposta_sim ?>],
      ['Em andamento',      <?php echo $PL_count_proposta_nao ?>]

      ]);

    var options = {
      title: 'Proposta',
      colors: ['#0e38e0', '#e0440e'],
      is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('proposta_planalto'));
    chart.draw(data, options);
  }

  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(quantitativo_planalto);


  function quantitativo_planalto() {
    var data = google.visualization.arrayToDataTable([
      ['Fase', 'Casas concluídas'],
      ['Concluídas',     <?php echo $PL_count_quantitativo_sim ?>],
      ['Em andamento',      <?php echo $PL_count_quantitativo_nao ?>]

      ]);

    var options = {
      title: 'Quantitativo',
      colors: ['#0e38e0', '#e0440e'],
      is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('quantitativo_planalto'));
    chart.draw(data, options);
  }


  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(levantamento_carumbe);


  function levantamento_carumbe() {
    var data = google.visualization.arrayToDataTable([
      ['Fase', 'Casas concluídas'],
      ['Concluídas',     <?php echo $VC_count_levantamento_sim ?>],
      ['Em andamento',      <?php echo $VC_count_levantamento_nao ?>]

      ]);

    var options = {
      title: 'Levantamento',
      colors: ['#0e38e0', '#e0440e'],
      is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('levantamento_carumbe'));
    chart.draw(data, options);
  }


  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(asbuilt_carumbe);


  function asbuilt_carumbe() {
    var data = google.visualization.arrayToDataTable([
      ['Fase', 'Casas concluídas'],
      ['Concluídas',     <?php echo $VC_count_asbuilt_sim ?>],
      ['Em andamento',      <?php echo $VC_count_asbuilt_nao ?>]

      ]);

    var options = {
      title: 'As built',
      colors: ['#0e38e0', '#e0440e'],
      is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('asbuilt_carumbe'));
    chart.draw(data, options);
  }


  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(proposta_carumbe);


  function proposta_carumbe() {
    var data = google.visualization.arrayToDataTable([
      ['Fase', 'Casas concluídas'],
      ['Concluídas',     <?php echo $VC_count_proposta_sim ?>],
      ['Em andamento',      <?php echo $VC_count_proposta_nao ?>]

      ]);

    var options = {
      title: 'Proposta',
      colors: ['#0e38e0', '#e0440e'],
      is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('proposta_carumbe'));
    chart.draw(data, options);
  }

  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(quantitativo_carumbe);


  function quantitativo_carumbe() {
    var data = google.visualization.arrayToDataTable([
      ['Fase', 'Casas concluídas'],
      ['Concluídas',     <?php echo $VC_count_quantitativo_sim ?>],
      ['Em andamento',      <?php echo $VC_count_quantitativo_nao ?>]

      ]);

    var options = {
      title: 'Quantitativo',
      colors: ['#0e38e0', '#e0440e'],
      is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('quantitativo_carumbe'));
    chart.draw(data, options);
  }

// Jardim Umuarama



google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(levantamento_umuarama);


function levantamento_umuarama() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $JU_count_levantamento_sim ?>],
    ['Em andamento',      <?php echo $JU_count_levantamento_nao ?>]
    
    ]);

  var options = {
    title: 'Levantamento',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('levantamento_umuarama'));
  chart.draw(data, options);
}


google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(asbuilt_umuarama);


function asbuilt_umuarama() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $JU_count_asbuilt_sim ?>],
    ['Em andamento',      <?php echo $JU_count_asbuilt_nao ?>]
    
    ]);

  var options = {
    title: 'As built',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('asbuilt_umuarama'));
  chart.draw(data, options);
}


google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(proposta_umuarama);


function proposta_umuarama() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $JU_count_proposta_sim ?>],
    ['Em andamento',      <?php echo $JU_count_proposta_nao ?>]
    
    ]);

  var options = {
    title: 'Proposta',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('proposta_umuarama'));
  chart.draw(data, options);
}

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(quantitativo_umuarama);


function quantitativo_umuarama() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $JU_count_quantitativo_sim ?>],
    ['Em andamento',      <?php echo $JU_count_quantitativo_nao ?>]
    
    ]);

  var options = {
    title: 'Quantitativo',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('quantitativo_umuarama'));
  chart.draw(data, options);
}



// PROGRAMA


google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(levantamento_programa);


function levantamento_programa() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $PG_count_levantamento_sim ?>],
    ['Em andamento',      <?php echo $PG_count_levantamento_nao ?>]
    
    ]);

  var options = {
    title: 'Levantamento',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('levantamento_programa'));
  chart.draw(data, options);
}


google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(asbuilt_programa);


function asbuilt_programa() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $PG_count_asbuilt_sim ?>],
    ['Em andamento',      <?php echo $PG_count_asbuilt_nao ?>]
    
    ]);

  var options = {
    title: 'As built',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('asbuilt_programa'));
  chart.draw(data, options);
}


google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(proposta_programa);


function proposta_programa() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $PG_count_proposta_sim ?>],
    ['Em andamento',      <?php echo $PG_count_proposta_nao ?>]
    
    ]);

  var options = {
    title: 'Proposta',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('proposta_programa'));
  chart.draw(data, options);
}

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(quantitativo_programa);


function quantitativo_programa() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $PG_count_quantitativo_sim ?>],
    ['Em andamento',      <?php echo $PG_count_quantitativo_nao ?>]

    
    ]);

  var options = {
    title: 'Quantitativo',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('quantitativo_programa'));
  chart.draw(data, options);
}


// ALTOS DA GLÓRIA

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(levantamento_ag);


function levantamento_ag() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $AG_count_levantamento_sim ?>],
    ['Em andamento',      <?php echo $AG_count_levantamento_nao ?>]
    
    ]);

  var options = {
    title: 'Levantamento',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('levantamento_ag'));
  chart.draw(data, options);
}


google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(asbuilt_ag);


function asbuilt_ag() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $AG_count_asbuilt_sim ?>],
    ['Em andamento',      <?php echo $AG_count_asbuilt_nao ?>]
    
    ]);

  var options = {
    title: 'As built',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('asbuilt_ag'));
  chart.draw(data, options);
}


google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(proposta_ag);


function proposta_ag() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $AG_count_proposta_sim ?>],
    ['Em andamento',      <?php echo $AG_count_proposta_nao ?>]
    
    ]);

  var options = {
    title: 'Proposta',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('proposta_ag'));
  chart.draw(data, options);
}

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(quantitativo_ag);


function quantitativo_ag() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $AG_count_quantitativo_sim ?>],
    ['Em andamento',      <?php echo $AG_count_quantitativo_nao ?>]
    
    ]);

  var options = {
    title: 'Quantitativo',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('quantitativo_ag'));
  chart.draw(data, options);
}








// TRÊS BARRAS

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(levantamento_tb);


function levantamento_tb() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $TB_count_levantamento_sim ?>],
    ['Em andamento',      <?php echo $TB_count_levantamento_nao ?>]
    
    ]);

  var options = {
    title: 'Levantamento',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('levantamento_tb'));
  chart.draw(data, options);
}


google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(asbuilt_tb);


function asbuilt_tb() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $TB_count_asbuilt_sim ?>],
    ['Em andamento',      <?php echo $TB_count_asbuilt_nao ?>]
    
    ]);

  var options = {
    title: 'As built',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('asbuilt_tb'));
  chart.draw(data, options);
}


google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(proposta_tb);


function proposta_tb() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $TB_count_proposta_sim ?>],
    ['Em andamento',      <?php echo $TB_count_proposta_nao ?>]
    
    ]);

  var options = {
    title: 'Proposta',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('proposta_tb'));
  chart.draw(data, options);
}

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(quantitativo_tb);


function quantitativo_tb() {
  var data = google.visualization.arrayToDataTable([
    ['Fase', 'Casas concluídas'],
    ['Concluídas',     <?php echo $TB_count_quantitativo_sim ?>],
    ['Em andamento',      <?php echo $TB_count_quantitativo_nao ?>]
    
    ]);

  var options = {
    title: 'Quantitativo',
    colors: ['#0e38e0', '#e0440e'],
    is3D: true
  };

  var chart = new google.visualization.PieChart(document.getElementById('quantitativo_tb'));
  chart.draw(data, options);
}







</script>









</html>