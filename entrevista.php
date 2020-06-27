<?php
include("conexao/conecta.php");
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
  header("Location: index.php");exit;
}


    if(isset($_REQUEST['cod'])){
      $localizador = $_REQUEST['cod'];
    }

    if (isset($_POST['exportarPDF'])){
      header("Location: exportaEntrevista.php?codigo=$localizador");
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
       echo "Erro interno do servidor";
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
  <!-- stylesheets -->
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/style.css">
  <!-- google fonts  -->
  <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">

</head>

<script type="text/javascript">

    var largura = screen.width;
    //Versão PC
  if( largura >= 800 ) {

      function voltar(){
        window.location.href = "visualizaBeneficiario.php?cod=<?php echo $localizador ?>";
      }
  }else{
      function voltar(){
        window.location.href = "mobile/visualizaBeneficiario.php?cod=<?php echo $localizador ?>";
      }
  }

  function erroInsereBanco(){
    alert("Erro ao atualizar os dados.");
  }

  function erroVisitaDorme(){
    alert("Revise o campo onde pergunta se a visita dorme ou não.");
  }
  function erroRecebeVisita(){
    alert("Revise o campo onde pergunta se recebe visita ou não.");
  }
  function erroAgradavel(){
    alert("Revise o campo onde pergunta se é agradável ou não.")
  } 
  function erroBF(){
    alert("Revise o campo onde pergunta sobre o bolsa família.")
  }
 




</script>

<?php

if(isset($_POST['voltar'])){
  echo '<script> voltar() </script>';
}

?>


<?php
if(isset($_POST['salvar'])){

  $dataEntrevista = NULL;
  $dataEntrevista = trim(strip_tags($_POST['dataEntrevista']));

  $grupoTrabalho = NULL;
  $grupoTrabalho = trim(strip_tags($_POST['grupoTrabalho']));

  $nomeEntrevistado = NULL;
  $nomeEntrevistado = trim(strip_tags($_POST['nomeEntrevistado']));

  $endereco = NULL;
  $endereco = trim(strip_tags($_POST['endereco']));

  $bolsaFamilia = NULL;
  $bolsaFamilia = $_POST['bolsafamilia'];

  $BF_sim =0; $BF_nao =0;

  for ($i=0; $i<count($bolsaFamilia); $i++){

      if ($bolsaFamilia[$i] == 'sim'){
        $BF_sim = 1;
      }
      else if ($bolsaFamilia[$i] == 'nao'){
        $BF_nao = 1;
      }
    }


    if (!($BF_sim == $BF_nao)){


$tempoMorando = NULL;
  $tempoMorando = trim(strip_tags($_POST['tempoCasa']));

  $qtdPessoasMorando = NULL;
  $qtdPessoasMorando = trim(strip_tags($_POST['qtdTotalCasa']));

$qtdCriancas = NULL;
  $qtdCriancas = trim(strip_tags($_POST['criancas']));

 $qtdAdolescentes = NULL;
  $qtdAdolescentes = trim(strip_tags($_POST['adolescentes']));

$qtdAdultos = NULL;
  $qtdAdultos = trim(strip_tags($_POST['adultos']));

 $qtdIdosos = NULL;
  $qtdIdosos = trim(strip_tags($_POST['idosos']));

$qtdDeficientes = NULL;
  $qtdDeficientes = trim(strip_tags($_POST['deficientes']));

$familiasNoLote = NULL;
  $familiasNoLote = trim(strip_tags($_POST['QtdFamilia']));

 $habComp = NULL;
  $habComp =  $_POST['habitacao'];



   $habComp_edicula =0; $habComp_loteComp =0; $habComp_nao=0; $habComp_outro = 0;

  for ($i=0; $i<count($habComp); $i++){

      if ($habComp[$i] == 'ediculaPuchadinho'){
        $habComp_edicula = 1;
      }
      else if ($habComp[$i] == 'loteCompartilhado'){
        $habComp_loteComp = 1;
      }
      else if ($habComp[$i] == 'naoHa'){
        $habComp_nao = 1;
      }
      else if ($habComp[$i] == 'outro'){
        $habComp_outro = 1;
      }
    }

    if ($habComp_outro==1){
      $habComp_outroV = trim(strip_tags($_POST['outroHab']));
    }
    else{
      $habComp_outroV = NULL;
    }

 $atividadeComercial = NULL;
    $atividadeComercial = trim(strip_tags($_POST['atividadeComercial']));

$horarioMoradores = NULL;
    $horarioMoradores = trim(strip_tags($_POST['horarioMor']));

$Re = NULL;
    $Re = $_POST['reunem'];


    $Re_sala =0; $Re_cozinha =0; $Re_area=0; $Re_quintal = 0; $Re_outro = 0;

  for ($i=0; $i<count($Re); $i++){

      if ($Re[$i] == 'sala'){
        $Re_sala = 1;
      }
      else if ($Re[$i] == 'cozinha'){
        $Re_cozinha = 1;
      }
      else if ($Re[$i] == 'areaVaranda'){
        $Re_area = 1;
      }
      else if ($Re[$i] == 'quintal'){
        $Re_quintal = 1;
      }
      else if ($Re[$i] == 'outro'){
        $Re_outro = 1;
      }

    }


    if ($Re_outro == 1){
      $Re_outroV = trim(strip_tags($_POST['outroReunem']));
    }
    else{
      $Re_outroV = NULL;
    }

$agra = NULL;
    $agra = $_POST['agradavel'];


      $agra_sim =0; $agra_nao =0;

  for ($i=0; $i<count($agra); $i++){

      if ($agra[$i] == 'sim'){
        $agra_sim = 1;
      }
      else if ($agra[$i] == 'nao'){
        $agra_nao = 1;
      }
    }


if (!($agra_sim == $agra_nao)){


$recebeVisita = NULL;
  $recebeVisita = $_POST['recebeVisita'];


     $recebeVisita_sim =0; $recebeVisita_nao =0;

  for ($i=0; $i<count($recebeVisita); $i++){

      if ($recebeVisita[$i] == 'sim'){
        $recebeVisita_sim = 1;
      }
      else if ($recebeVisita[$i] == 'nao'){
        $recebeVisita_nao = 1;
      }
    }


    if (!($recebeVisita_sim == $recebeVisita_nao)){

 $visitaDorme = NULL;
      $visitaDorme = $_POST['dormeVisita'];


      $visitaDorme_sim =0; $visitaDorme_nao =0;

  for ($i=0; $i<count($visitaDorme); $i++){

      if ($visitaDorme[$i] == 'sim'){
        $visitaDorme_sim = 1;
      }
      else if ($visitaDorme[$i] == 'nao'){
        $visitaDorme_nao = 1;
      }
    }

    if(!($visitaDorme_sim == $visitaDorme_nao)){

$dormem = NULL;
      $dormem = $_POST['dormem'];



      $dorme_sala =0; $dorme_compartilhaQuarto =0; $dorme_quarto= 0; $dorme_outro=0;

  for ($i=0; $i<count($dormem); $i++){

      if ($dormem[$i] == 'sala'){
        $dorme_sala = 1;
      }
      else if ($dormem[$i] == 'compartilhaQuarto'){
        $dorme_compartilhaQuarto = 1;
      }
      else if ($dormem[$i] == 'quartoVisita'){
        $dorme_quarto = 1;
      }
      else if ($dormem[$i] == 'outroDor'){
        $dorme_outro = 1;
      }
    }


    if ($dorme_outro == 1){
      $dorme_outroV = trim(strip_tags($_POST['outroDormem']));
    }
    else{
      $dorme_outroV = NULL;
    }

$construida = NULL;
    $construida = $_POST['construida'];

      $construida_construtora =0; $construida_autoC =0; $construida_maoCont= 0; $construida_ambos=0; $construida_outro=0;

  for ($i=0; $i<count($construida); $i++){

      if ($construida[$i] == 'construtora'){
        $construida_construtora = 1;
      }
      else if ($construida[$i] == 'autoconstrucao'){
        $construida_autoC = 1;
      }
      else if ($construida[$i] == 'maoContratada'){
        $construida_maoCont = 1;
      }
      else if ($construida[$i] == 'outroC'){
        $construida_outro = 1;
      }
    }

    if ($construida_outro == 1){
      $construida_outroV = trim(strip_tags($_POST['outroConstruida']));
    }
    else{
      $construida_outroV = NULL;
    }


 $ampliacao = NULL;
    $ampliacao = trim(strip_tags($_POST['ampliacao']));

$ampliacaoDesejada = NULL;
    $ampliacaoDesejada = trim(strip_tags($_POST['ampliacaoDesejada']));

 $agua = NULL;
    $agua = $_POST['agua'];

      $agua_encanada =0; $agua_poco =0; $agua_rio= 0; $agua_caminhao=0; $agua_outro=0;

  for ($i=0; $i<count($agua); $i++){

      if ($agua[$i] == 'aguaEncanada'){
        $agua_encanada = 1;
      }
      else if ($agua[$i] == 'poco'){
        $agua_poco = 1;
      }
      else if ($agua[$i] == 'rioNascente'){
        $agua_rio = 1;
      }
      else if ($agua[$i] == 'caminhaoPipa'){
        $agua_caminhao = 1;
      }
      else if ($agua[$i] == 'outro'){
        $agua_outro = 1;
      }
    }

    if ($agua_outro == 1){
     $agua_outroV =  trim(strip_tags($_POST['outroAgua']));
    }
    else{
      $agua_outroV = NULL;
    }


 $reservatorio = NULL;
    $reservatorio = $_POST['reservatorio'];

      $reservatorio_caixaAlta =0; $reservatorio_caixaBaixa =0; $reservatorio_poco = 0; $reservatorio_subterraneo=0; $reservatorio_outro=0;

  for ($i=0; $i<count($reservatorio); $i++){

      if ($reservatorio[$i] == 'caixaAlta'){
        $reservatorio_caixaAlta = 1;
      }
      else if ($reservatorio[$i] == 'caixaBaixa'){
        $reservatorio_caixaBaixa = 1;
      }
      else if ($reservatorio[$i] == 'poco'){
        $reservatorio_poco = 1;
      }
      else if ($reservatorio[$i] == 'subterraneo'){
        $reservatorio_subterraneo = 1;
      }
      else if ($reservatorio[$i] == 'outro'){
        $agua_outro = 1;
      }
    }

    if ($reservatorio_outro == 1){
      $reservatorio_outroV = trim(strip_tags($_POST['outroRe']));
    }
    else{
      $reservatorio_outroV = NULL;
    }


$esg = NULL;
    $esg = $_POST['esgSanitario'];


       $esgSan_septica =0; $esgSan_negra =0; $esgSan_agua = 0; $esgSan_corrego=0; $esgSan_outro=0;

  for ($i=0; $i<count($esg); $i++){

      if ($esg[$i] == 'septica'){
        $esgSan_septica = 1;
      }
      else if ($esg[$i] == 'negra'){
        $esgSan_negra = 1;
      }
      else if ($esg[$i] == 'agua'){
        $esgSan_agua = 1;
      }
      else if ($esg[$i] == 'corrego'){
        $esgSan_corrego = 1;
      }
      else if ($esg[$i] == 'outro'){
        $esgSan_outro = 1;
      }
    }

    if ($esgSan_outro == 1){
      $esgSan_outroV = trim(strip_tags($_POST['outroEsgSan']));
    }
    else{
      $esgSan_outroV = NULL;
    }


$problemas = NULL;
    $problemas = $_POST['problemas'];

    $problemas_nao =0; $problemas_inundacao =0; $problemas_deslizamento = 0; $problemas_animais=0; $problemas_odores=0; $problemas_outro=0;

  for ($i=0; $i<count($problemas); $i++){

      if ($problemas[$i] == 'nao'){
        $problemas_nao = 1;
      }
      else if ($problemas[$i] == 'inundacao'){
        $problemas_inundacao = 1;
      }
      else if ($problemas[$i] == 'deslizamento'){
        $problemas_deslizamento = 1;
      }
      else if ($problemas[$i] == 'animais'){
        $problemas_animais = 1;
      }
      else if ($problemas[$i] == 'odores'){
        $problemas_odores = 1;
      }
      else if ($problemas[$i] == 'outro'){
        $problemas_outro = 1;
      }
    }

      if ($problemas_outro == 1){
        $problemas_outroV = trim(strip_tags($_POST['outroProblemas']));
      }
      else{
        $problemas_outroV = NULL;
      }


      $update = "UPDATE entrevista set dataEntrevista=:dataEntrevista, grupoTrabalho=:grupoTrabalho, nomeEntrevistado=:nomeEntrevistado, endereco=:endereco, BF_sim =:BF_sim, BF_nao=:BF_nao, tempoMorando =:tempoMorando, qtdPessoasMorando=:qtdPessoasMorando, qtdCriancas=:qtdCriancas, qtdAdolescentes=:qtdAdolescentes, qtdAdultos=:qtdAdultos, qtdIdosos=:qtdIdosos, qtdDeficientes=:qtdDeficientes, familiasNoLote=:familiasNoLote, habComp_edicula=:habComp_edicula, habComp_loteComp=:habComp_loteComp, habComp_nao=:habComp_nao, habComp_outro=:habComp_outro, habComp_outroV=:habComp_outroV, atividadeComercial=:atividadeComercial, horarioMoradores=:horarioMoradores, Re_sala=:Re_sala, Re_cozinha=:Re_cozinha, Re_area=:Re_area, Re_quintal=:Re_quintal, Re_outro=:Re_outro, Re_outroV=:Re_outroV, agra_sim=:agra_sim, agra_nao=:agra_nao, recebeVisita_sim=:recebeVisita_sim, recebeVisita_nao=:recebeVisita_nao, visitaDorme_sim=:visitaDorme_sim, visitaDorme_nao=:visitaDorme_nao, dorme_sala=:dorme_sala,
      dorme_compartilhaQuarto=:dorme_compartilhaQuarto, dorme_Quarto=:dorme_quarto, dorme_outro=:dorme_outro, dorme_outroV=:dorme_outroV, construida_Construtora=:construida_construtora, construida_autoC=:construida_autoC,
      construida_maoCont=:construida_maoCont, construida_ambos=:construida_ambos, construida_outro=:construida_outro,
      construida_outroV=:construida_outroV, ampliacao=:ampliacao, ampliacaoDesejada=:ampliacaoDesejada, agua_encanada=:agua_encanada, agua_poco=:agua_poco, agua_rio=:agua_rio, agua_caminhao=:agua_caminhao,agua_outro=:agua_outro, agua_outroV=:agua_outroV, reservatorio_caixaAlta=:reservatorio_caixaAlta, reservatorio_caixaBaixa=:reservatorio_caixaBaixa, reservatorio_poco=:reservatorio_poco, reservatorio_subterraneo=:reservatorio_subterraneo, reservatorio_outro=:reservatorio_outro, reservatorio_outroV=:reservatorio_outroV, esgSan_septica=:esgSan_septica, esgSan_negra=:esgSan_negra, esgSan_agua=:esgSan_agua, esgSan_corrego=:esgSan_corrego, esgSan_outro=:esgSan_outro, esgSan_outroV=:esgSan_outroV, problemas_nao=:problemas_nao, problemas_inundacao=:problemas_inundacao, problemas_deslizamento=:problemas_deslizamento, problemas_animais=:problemas_animais, problemas_odores=:problemas_odores, problemas_outro=:problemas_outro, problemas_outroV=:problemas_outroV where cod_beneficiario=:idB";


      try{

$result = $conexao->prepare($update);
$result->bindParam(':idB', $idB, PDO::PARAM_INT);
$result->bindParam(':dataEntrevista', $dataEntrevista, PDO::PARAM_STR);
        $result->bindParam(':grupoTrabalho', $grupoTrabalho, PDO::PARAM_STR);
         $result->bindParam(':nomeEntrevistado', $nomeEntrevistado, PDO::PARAM_STR);
          $result->bindParam(':endereco', $endereco, PDO::PARAM_STR);
           $result->bindParam(':BF_sim', $BF_sim, PDO::PARAM_INT);
            $result->bindParam(':BF_nao', $BF_nao, PDO::PARAM_INT);
 $result->bindParam(':tempoMorando', $tempoMorando, PDO::PARAM_STR);
 $result->bindParam(':qtdPessoasMorando', $qtdPessoasMorando, PDO::PARAM_STR);
  $result->bindParam(':qtdCriancas', $qtdCriancas, PDO::PARAM_STR);
   $result->bindParam(':qtdAdolescentes', $qtdAdolescentes, PDO::PARAM_STR);
    $result->bindParam(':qtdAdultos', $qtdAdultos, PDO::PARAM_STR);
     $result->bindParam(':qtdIdosos', $qtdIdosos, PDO::PARAM_STR);
      $result->bindParam(':qtdDeficientes', $qtdDeficientes, PDO::PARAM_STR);
       $result->bindParam(':familiasNoLote', $familiasNoLote, PDO::PARAM_STR);
 $result->bindParam(':habComp_edicula', $habComp_edicula, PDO::PARAM_INT);
  $result->bindParam(':habComp_loteComp', $habComp_loteComp, PDO::PARAM_INT);
   $result->bindParam(':habComp_nao', $habComp_nao, PDO::PARAM_INT);
 $result->bindParam(':habComp_outro', $habComp_outro, PDO::PARAM_INT);
$result->bindParam(':habComp_outroV', $habComp_outroV, PDO::PARAM_STR);
$result->bindParam(':atividadeComercial', $atividadeComercial, PDO::PARAM_STR);
$result->bindParam(':horarioMoradores', $horarioMoradores, PDO::PARAM_STR);
$result->bindParam(':Re_sala', $Re_sala, PDO::PARAM_INT);
$result->bindParam(':Re_cozinha', $Re_cozinha, PDO::PARAM_INT);
$result->bindParam(':Re_area', $Re_area, PDO::PARAM_INT);
$result->bindParam(':Re_quintal', $Re_quintal, PDO::PARAM_INT);
$result->bindParam(':Re_outro', $Re_outro, PDO::PARAM_INT);
$result->bindParam(':Re_outroV', $Re_outroV, PDO::PARAM_STR);
$result->bindParam(':agra_sim', $agra_sim, PDO::PARAM_INT);
$result->bindParam(':agra_nao', $agra_nao, PDO::PARAM_INT);
$result->bindParam(':recebeVisita_sim', $recebeVisita_sim, PDO::PARAM_INT);
$result->bindParam(':recebeVisita_nao', $recebeVisita_nao, PDO::PARAM_INT);
$result->bindParam(':visitaDorme_sim', $visitaDorme_sim, PDO::PARAM_INT);
$result->bindParam(':visitaDorme_nao', $visitaDorme_nao, PDO::PARAM_INT);
$result->bindParam(':dorme_sala', $dorme_sala, PDO::PARAM_INT);
$result->bindParam(':dorme_compartilhaQuarto', $dorme_compartilhaQuarto, PDO::PARAM_INT);
$result->bindParam(':dorme_quarto', $dorme_quarto, PDO::PARAM_INT);
$result->bindParam(':dorme_outro', $dorme_outro, PDO::PARAM_INT);
$result->bindParam(':dorme_outroV', $dorme_outroV, PDO::PARAM_STR);
$result->bindParam(':construida_construtora', $construida_construtora, PDO::PARAM_INT);
$result->bindParam(':construida_autoC', $construida_autoC, PDO::PARAM_INT);
$result->bindParam(':construida_maoCont', $construida_maoCont, PDO::PARAM_INT);
$result->bindParam(':construida_ambos', $construida_ambos, PDO::PARAM_INT);
$result->bindParam(':construida_outro', $construida_outro, PDO::PARAM_INT);
$result->bindParam(':construida_outroV', $construida_outroV, PDO::PARAM_STR);
$result->bindParam(':ampliacao', $ampliacao, PDO::PARAM_STR);
$result->bindParam(':ampliacaoDesejada', $ampliacaoDesejada, PDO::PARAM_STR);
$result->bindParam(':agua_encanada', $agua_encanada, PDO::PARAM_INT);
$result->bindParam(':agua_poco', $agua_poco, PDO::PARAM_INT);
$result->bindParam(':agua_rio', $agua_rio, PDO::PARAM_INT);
$result->bindParam(':agua_caminhao', $agua_caminhao, PDO::PARAM_INT);
$result->bindParam(':agua_outro', $agua_outro, PDO::PARAM_INT);
$result->bindParam(':agua_outroV', $agua_outroV, PDO::PARAM_STR);
$result->bindParam(':reservatorio_caixaAlta', $reservatorio_caixaAlta, PDO::PARAM_INT);
$result->bindParam(':reservatorio_caixaBaixa', $reservatorio_caixaBaixa, PDO::PARAM_INT);
$result->bindParam(':reservatorio_poco', $reservatorio_poco, PDO::PARAM_INT);
$result->bindParam(':reservatorio_subterraneo', $reservatorio_subterraneo, PDO::PARAM_INT);
$result->bindParam(':reservatorio_outro', $reservatorio_outro, PDO::PARAM_INT);
$result->bindParam(':reservatorio_outroV', $reservatorio_outroV, PDO::PARAM_STR);
$result->bindParam(':esgSan_septica', $esgSan_septica, PDO::PARAM_INT);
$result->bindParam(':esgSan_negra', $esgSan_negra, PDO::PARAM_INT);
$result->bindParam(':esgSan_agua', $esgSan_agua, PDO::PARAM_INT);
$result->bindParam(':esgSan_corrego', $esgSan_corrego, PDO::PARAM_INT);
$result->bindParam(':esgSan_outro', $esgSan_outro, PDO::PARAM_INT);
$result->bindParam(':esgSan_outroV', $esgSan_outroV, PDO::PARAM_STR);
$result->bindParam(':problemas_nao', $problemas_nao, PDO::PARAM_INT);
$result->bindParam(':problemas_inundacao', $problemas_inundacao, PDO::PARAM_INT);
$result->bindParam(':problemas_deslizamento', $problemas_deslizamento, PDO::PARAM_INT);
$result->bindParam(':problemas_animais', $problemas_animais, PDO::PARAM_INT);
$result->bindParam(':problemas_odores', $problemas_odores, PDO::PARAM_INT);
$result->bindParam(':problemas_outro', $problemas_outro, PDO::PARAM_INT);
$result->bindParam(':problemas_outroV', $problemas_outroV, PDO::PARAM_STR);
        $result->execute();
        $contar = $result->rowCount();


if ($contar > 0 ){

    // ARMAZENA QUEM EDITOU

 try {
     $stmt = $conexao->prepare('SELECT * FROM entrevista WHERE cod_beneficiario = :idB');
     $stmt-> bindParam(':idB', $idB, PDO::PARAM_INT);
     $stmt->execute();
     $contar = $stmt->rowCount();

     if ($contar >0) {
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $idEntrevista = $mostra->id_entrevista;
       }
     } else {
       echo "Erro interno do servidor";
     }
    } catch(PDOException $e){
     echo $e;
    }

    $idUsuarioAtivo = $_SESSION['idUsuario'];

    $insert = "INSERT into alterou_entrevista (usuarioEditor, entrevistaEditada) VALUES (:idUsuarioAtivo, :idEntrevista)";
    


    try{
      $result = $conexao->prepare($insert);
      $result->bindParam(':idUsuarioAtivo', $idUsuarioAtivo, PDO::PARAM_INT);
      $result->bindParam(':idEntrevista', $idEntrevista, PDO::PARAM_INT);
 
      $result->execute();
      $contar = $result->rowCount();
  
      
    }catch(PDOException $e){
      echo $e;
    }




}
 else{
          echo '<script> erroInsereBanco() </script>';
        }




      } catch(PDOException $e){
       echo $e;
     }


    } else {
      echo '<script> erroVisitaDorme() </script>';
    }



    } else {

      echo '<script> erroRecebeVisita() </script>';
    }






}
else {
  echo '<script> erroAgradavel() </script>';
}




} else{
  echo '<script> erroBF() </script>';
}



}




?>








<?php
       // SELECT SEMPRE APÓS O UPDATE/INSERT

    try {
     $stmt = $conexao->prepare('SELECT * FROM entrevista WHERE cod_beneficiario = :idB');
     $stmt-> bindParam(':idB', $idB, PDO::PARAM_INT);
     $stmt->execute();
     $contar = $stmt->rowCount();

     if ($contar >0) {
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $dataEntrevistaAtt = $mostra->dataEntrevista;
         $grupoTrabalhoAtt = $mostra->grupoTrabalho;
         $nomeEntrevistadoAtt = $mostra->nomeEntrevistado;
         $enderecoAtt = $mostra->endereco;
         $BF_simAtt = $mostra->BF_sim;
         $BF_naoAtt = $mostra->BF_nao;
         $tempoMorandoAtt = $mostra->tempoMorando;
         $qtdPessoasMorandoAtt = $mostra->qtdPessoasMorando;
         $qtdCriancasAtt = $mostra->qtdCriancas;
         $qtdAdolescentesAtt = $mostra->qtdAdolescentes;
         $qtdAdultosAtt = $mostra->qtdAdultos;
         $qtdIdososAtt = $mostra->qtdIdosos;
         $qtdDeficientesAtt = $mostra->qtdDeficientes;
         $familiasNoLoteAtt = $mostra->familiasNoLote;
         $habComp_ediculaAtt = $mostra->habComp_edicula;
         $habComp_loteCompAtt = $mostra->habComp_loteComp;
         $habComp_naoAtt = $mostra->habComp_nao;
         $habComp_outroAtt = $mostra->habComp_outro;
         $habComp_outroVAtt = $mostra->habComp_outroV;
         $atividadeComercialAtt = $mostra->atividadeComercial;
         $horarioMoradoresAtt = $mostra->horarioMoradores;
         $Re_salaAtt = $mostra->Re_sala;
         $Re_cozinhaAtt = $mostra->Re_cozinha;
         $Re_areaAtt = $mostra->Re_area;
         $Re_quintalAtt = $mostra->Re_quintal;
         $Re_outroAtt = $mostra->Re_outro;
         $Re_outroVAtt = $mostra->Re_outroV;
         $agra_simAtt = $mostra->agra_sim;
         $agra_naoAtt = $mostra->agra_nao;
         $recebeVisita_simAtt = $mostra->recebeVisita_sim;
         $recebeVisita_naoAtt = $mostra->recebeVisita_nao;
         $visitaDorme_simAtt = $mostra->visitaDorme_sim;
         $visitaDorme_naoAtt = $mostra->visitaDorme_nao;
         $dorme_salaAtt = $mostra->dorme_sala;
         $dorme_compartilhaQuartoAtt = $mostra->dorme_compartilhaQuarto;
         $dorme_quartoAtt = $mostra->dorme_Quarto;
         $dorme_outroAtt = $mostra->dorme_outro;
         $dorme_outroVAtt = $mostra->dorme_outroV;
         $construida_construtoraAtt = $mostra->construida_Construtora;
         $construida_autoCAtt = $mostra->construida_autoC;
         $construida_maoContAtt = $mostra->construida_maoCont;
         $construida_ambosAtt = $mostra->construida_ambos;
         $construida_outroAtt = $mostra->construida_outro;
         $construida_outroVAtt = $mostra->construida_outroV;
         $ampliacaoAtt = $mostra->ampliacao;
         $ampliacaoDesejadaAtt = $mostra->ampliacaoDesejada;
         $agua_encanadaAtt = $mostra->agua_encanada;
         $agua_pocoAtt = $mostra->agua_poco;
         $agua_rioAtt = $mostra->agua_rio;
         $agua_caminhaoAtt = $mostra->agua_caminhao;
         $agua_outroAtt = $mostra->agua_outro;
         $agua_outroVAtt = $mostra->agua_outroV;
         $reservatorio_caixaAltaAtt = $mostra->reservatorio_caixaAlta;
         $reservatorio_caixaBaixaAtt = $mostra->reservatorio_caixaBaixa;
         $reservatorio_pocoAtt = $mostra->reservatorio_poco;
         $reservatorio_subterraneoAtt = $mostra->reservatorio_subterraneo;
         $reservatorio_outroAtt = $mostra->reservatorio_outro;
         $reservatorio_outroVAtt = $mostra->reservatorio_outroV;
         $esgSan_septicaAtt = $mostra->esgSan_septica;
         $esgSan_negraAtt = $mostra->esgSan_negra;
         $esgSan_aguaAtt = $mostra->esgSan_agua;
         $esgSan_corregoAtt = $mostra->esgSan_corrego;
         $esgSan_outroAtt = $mostra->esgSan_outro;
         $esgSan_outroVAtt = $mostra->esgSan_outroV;
         $problemas_naoAtt = $mostra->problemas_nao;
         $problemas_inundacaoAtt = $mostra->problemas_inundacao;
         $problemas_deslizamentoAtt = $mostra->problemas_deslizamento;
         $problemas_animaisAtt = $mostra->problemas_animais;
         $problemas_odoresAtt = $mostra->problemas_odores;
         $problemas_outroAtt = $mostra->problemas_outro;
         $problemas_outroVAtt = $mostra->problemas_outroV;

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



    <div class="conteudo">

      <h2>Entrevista</h2>
      <div class="formulario">

         <form action="" method="post" enctype="multipart/form-data">

  <?php
    try {
     $stmt = $conexao->prepare('SELECT * FROM alterou_entrevista AE, entrevista E where AE.entrevistaEditada = E.id_entrevista and E.cod_beneficiario = :idB');
     $stmt-> bindParam(':idB', $idB, PDO::PARAM_INT);
     $stmt->execute();
     $contar = $stmt->rowCount();

     if ($contar >0) { ?>
      <center><form action="" method="post"><input type="submit" name="exportarPDF" value="Exportar PDF"></form></center>
  <?php  
    
   } else {
       echo "Entrevista não disponível em PDF";
     }
    } catch(PDOException $e){
     echo $e;
    }

    ?>






<label>Data da entrevista</label>
                        <input type="text" id="idData" name="dataEntrevista" value="<?php echo $dataEntrevistaAtt ?>" placeholder="Data da entrevista" />

<label>Grupo de trabalho</label>
                         <input list="idGrupo" name="grupoTrabalho" id="tipoGrupo" value="<?php echo $grupoTrabalhoAtt ?>" placeholder="Selecione..."/>
                                  <datalist id="idGrupo">
                                    <option value="Grupo 1">
                                    <option value="Grupo 2">
                                    <option value="Grupo 3">
                                      <option value="Grupo 4">
                                        <option value="Grupo 5">
                                          <option value="Grupo 6">
                                            <option value="Grupo 7">
                                              <option value="Grupo 8">
                                                <option value="Grupo 9">
                                  </datalist>
<br> <br>
                                  <hr width="200px">

<label>Nome do entrevistado</label>
                        <input type="text" id="idNome" name="nomeEntrevistado" value="<?php echo $nomeEntrevistadoAtt ?>" placeholder="Nome do entrevistado" />

     <label>Endereço</label>
                        <input type="text" id="idEndereco" name="endereco" value="<?php echo $enderecoAtt ?>" placeholder="Endereço" />

<label>Alguém da sua família é beneficiário do Bolsa Família? </label>

<div align="center" class="entrevista">
  <br>
 <label id="entrevista"><input type="checkbox" name="bolsafamilia[]" value="sim" <?php if ($BF_simAtt == 1){ echo "checked";} ?>> Sim</label> &emsp; &emsp; &emsp;<label id="entrevista"><input type="checkbox" name="bolsafamilia[]" value="nao" <?php if ($BF_naoAtt == 1){ echo "checked";} ?>> Não</label>

</div> <br>


  <hr width="200px">

<label>Há quanto tempo mora na casa? </label>
                        <input type="text" id="idTempo" name="tempoCasa" value="<?php echo $tempoMorandoAtt ?>" placeholder="Há quanto tempo mora na casa?" />


<label>Quantas pessoas moram na casa? </label>
                        <input type="text" id="idQtdTotal" name="qtdTotalCasa" value="<?php echo $qtdPessoasMorandoAtt ?>" placeholder="Quantas pessoas moram na casa?" />

<label>Qual a faixa etária dos moradores? </label>

  <datalist id="idQtdPessoas">
      <option value="0">
      <option value="1">
      <option value="2">
      <option value="3">
      <option value="4">
      <option value="5">
      <option value="6">
      <option value="7">
      <option value="8">
      <option value="9">
      <option value="10">
  </datalist>




<table align="center" cellpadding="2">
  <div class="prefeitura">
  <tr>

    <td><label>Crianças 0 a 11 anos</label></td>
    <td><input list="idQtdPessoas" name="criancas" id="idCr" value="<?php echo $qtdCriancasAtt ?>" placeholder="Selecione..."/></td>


  </tr>


  <tr>

    <td><label>Adolescentes 12 a 18 anos</label></td>
    <td><input list="idQtdPessoas" name="adolescentes" id="idAd" value="<?php echo $qtdAdolescentesAtt ?>" placeholder="Selecione..."/></td>



  </tr>
    <td><label>Adultos 19 a 59 anos</label></td>
    <td><input list="idQtdPessoas" name="adultos" id="idAdu" value="<?php echo $qtdAdultosAtt ?>" placeholder="Selecione..."/></td>

  <tr>

    <tr>

      <td><label>Idosos 60+</label></td>
      <td><input list="idQtdPessoas" name="idosos" id="idI" value="<?php echo $qtdIdososAtt ?>" placeholder="Selecione..."/></td>


    </tr>

    <tr>

        <td><label>Pessoas com deficiência</label></td>
        <td><input list="idQtdPessoas" name="deficientes" value="<?php echo $qtdDeficientesAtt ?>" id="idDef" placeholder="Selecione..."/></td>


    </tr>



  </tr>

</div>
</table>




<label>Quantas famílias moram na casa/lote? </label>
                        <input type="text" id="idQtdFamilia" value="<?php echo $familiasNoLoteAtt ?>" name="QtdFamilia" placeholder="Quantas famílias moram na casa/lote? " /> <br>


<label>Como a habitação é compartilhada? </label>
<div class="entrevista">
<label><input type="checkbox" name="habitacao[]" value="ediculaPuchadinho" <?php if ($habComp_ediculaAtt == 1){ echo "checked";} ?>> Edícula ou "puchadinho"</label> <br>

<label><input type="checkbox" name="habitacao[]" value="loteCompartilhado" <?php if ($habComp_loteCompAtt == 1){ echo "checked";} ?> > Lote compartilhado </label><br>

<label><input type="checkbox" name="habitacao[]" value="naoHa" <?php if ($habComp_naoAtt == 1){ echo "checked";} ?> > Não há divisão por família </label> <br>

<label><input type="checkbox" name="habitacao[]" value="outro" <?php if ($habComp_outroAtt == 1){ echo "checked";} ?> > Outro: </label><input type="text" id="outroHabitacao" name="outroHab" value="<?php if ($habComp_outroAtt == 1){ echo $habComp_outroVAtt;} ?>" placeholder="Outro..." />
</div>
<label align="justify">Alguém exerce alguma atividade comercial ou de serviços na casa? Se a resposta for "sim", indicar o tipo da atividade e local. </label>
          <input type="text" id="idAtividade" name="atividadeComercial" value="<?php echo $atividadeComercialAtt ?>" placeholder="Alguém exerce alguma atividade comercial ou de serviços na casa? " /> <br>


<label>Qual é o horário em que a maioria dos moradores estão em casa? </label>

  <datalist id="horarioMoradores">
      <option value="Manhã">
      <option value="Tarde">
      <option value="Noite">
      <option value="Durante a semana">
      <option value="Finais de semana">
  </datalist>

<input list="horarioMoradores" name="horarioMor" value="<?php echo $horarioMoradoresAtt ?>" id="idHorarioMor" placeholder="Selecione..."/>


<label>E onde se reúnem? </label>
<div class="entrevista">
<label><input type="checkbox" name="reunem[]" value="sala" <?php if ($Re_salaAtt == 1){ echo "checked";} ?> > Sala </label> <br>

<label><input type="checkbox" name="reunem[]" value="cozinha" <?php if ($Re_cozinhaAtt == 1){ echo "checked";} ?>> Cozinha </label> <br>

<label><input type="checkbox" name="reunem[]" value="areaVaranda" <?php if ($Re_areaAtt == 1){ echo "checked";} ?> > Área/Varanda </label> <br>

<label><input type="checkbox" name="reunem[]" value="quintal" <?php if ($Re_quintalAtt == 1){ echo "checked";} ?> > Quintal </label> <br>

<label><input type="checkbox" name="reunem[]" value="outro" <?php if ($Re_outroAtt == 1){ echo "checked";} ?> > Outro: </label> <input type="text" id="outroRe" name="outroReunem" value="<?php if ($Re_outroAtt == 1){ echo $Re_outroVAtt;} ?>" placeholder="Outro..." /> </div>

<label>E é agradável? </label>

<div align="center" class="entrevista">
 <label><input type="checkbox" name="agradavel[]" value="sim" <?php if ($agra_simAtt == 1){ echo "checked";} ?> > Sim </label>&emsp; &emsp; &emsp;<label><input type="checkbox" name="agradavel[]" value="nao" <?php if ($agra_naoAtt == 1){ echo "checked";} ?> > Não </label><br>

</div> <br>


<label>Recebem muitas visitas? </label>

<div align="center" class="entrevista">
<label><input type="checkbox" name="recebeVisita[]" value="sim" <?php if ($recebeVisita_simAtt == 1){ echo "checked";} ?> > Sim </label> &emsp; &emsp; &emsp;<label><input type="checkbox" name="recebeVisita[]" value="nao" <?php if ($recebeVisita_naoAtt == 1){ echo "checked";} ?> > Não</label> <br>

</div> <br>

<label>As visitas dormem com frequência na sua casa? </label>

<div align="center" class="entrevista">
 <label><input type="checkbox" name="dormeVisita[]" value="sim" <?php if ($visitaDorme_simAtt == 1){ echo "checked";} ?> > Sim </label>&emsp; &emsp; &emsp;<label><input type="checkbox" name="dormeVisita[]" value="nao" <?php if ($visitaDorme_naoAtt == 1){ echo "checked";} ?> > Não</label><br>

</div> <br>

<label>Se dormem, onde dormem? </label>
<div class="entrevista">
<label><input type="checkbox" name="dormem[]" value="sala" <?php if ($dorme_salaAtt == 1){ echo "checked";} ?> > Sala</label> <br>

<label><input type="checkbox" name="dormem[]" value="compartilhaQuarto" <?php if ($dorme_compartilhaQuartoAtt == 1){ echo "checked";} ?> > Compartilha quarto com algum dos moradores</label> <br>

<label><input type="checkbox" name="dormem[]" value="quartoVisita" <?php if ($dorme_quartoAtt == 1){ echo "checked";} ?> > Quarto de visita </label><br>

<label><input type="checkbox" name="dormem[]" value="outroDor" <?php if ($dorme_outroAtt == 1){ echo "checked";} ?> > Outro: </label> <input type="text" id="outroRe" name="outroDormem" value="<?php if ($dorme_outroAtt == 1){ echo $dorme_outroVAtt ;} ?>" placeholder="Outro..." />

</div>
<label>Como a casa foi construída? </label>
<div class="entrevista">
<label><input type="checkbox" name="construida[]" value="construtora" <?php if ($construida_construtoraAtt == 1){ echo "checked";} ?>> Construtora </label><br>

<label><input type="checkbox" name="construida[]" value="autoconstrucao" <?php if ($construida_autoCAtt == 1){ echo "checked";} ?>> Autoconstrução</label> <br>

<label><input type="checkbox" name="construida[]" value="maoContratada" <?php if ($construida_maoContAtt == 1){ echo "checked";} ?>> Mão de obra contratada </label><br>

<label><input type="checkbox" name="construida[]" value="ambos" <?php if ($construida_ambosAtt == 1){ echo "checked";} ?>> Ambos</label> <br>


<label><input type="checkbox" name="construida[]" value="outroC" <?php if ($construida_outroAtt == 1){ echo "checked";} ?>> Outro:</label> <input type="text" id="outroCt" value="<?php if ($construida_outroAtt == 1){ echo $construida_outroVAtt;} ?>" name="outroConstruida" placeholder="Outro..." />
</div>

 <label align="justify"> Houve ampliação? Se a resposta for "sim", descrever o que e quando </label>


<input type="text" id="amp" name="ampliacao" value="<?php echo $ampliacaoAtt ?>" placeholder="Houve ampliação? " /> <br>

 <label align="justify"> Se a família pudesse ampliar ou modificar algo da casa, o que faria? </label>


<input type="text" id="ampD" name="ampliacaoDesejada" value="<?php echo $ampliacaoDesejadaAtt ?>" placeholder="O que ampliaria ou modificaria? " /> <br>



<label>Como é o abastecimento de água? </label>
<div class="entrevista">
<label><input type="checkbox" name="agua[]" value="aguaEncanada"  <?php if ($agua_encanadaAtt == 1){ echo "checked";} ?>> Água encanada </label> <br>

<label><input type="checkbox" name="agua[]" value="poco"  <?php if ($agua_pocoAtt == 1){ echo "checked";} ?>> Poço </label> <br>

<label><input type="checkbox" name="agua[]" value="rioNascente"  <?php if ($agua_rioAtt == 1){ echo "checked";} ?> > Rio/Nascente </label><br>

<label><input type="checkbox" name="agua[]" value="caminhaoPipa"  <?php if ($agua_caminhaoAtt == 1){ echo "checked";} ?> > Caminhão pipa</label> <br>


<label><input type="checkbox" name="agua[]" value="outro"  <?php if ($agua_outroAtt == 1){ echo "checked";} ?> > Outro: </label><input type="text" id="outroAg" name="outroAgua" value="<?php if ($agua_outroAtt == 1){ echo $agua_outroVAtt;} ?>" placeholder="Outro..." />

</div>
<label>Quais são os tipos de reservatórios de água existentes? (localização marcar em planta) </label>
<div class="entrevista">
<label><input type="checkbox" name="reservatorio[]" value="caixaAlta" <?php if ($reservatorio_caixaAltaAtt == 1){ echo "checked";} ?> > Caixa d'água alta </label> <br>

<label><input type="checkbox" name="reservatorio[]" value="caixaBaixa" <?php if ($reservatorio_caixaBaixaAtt == 1){ echo "checked";} ?> > Caixa d'água baixa</label> <br>

<label><input type="checkbox" name="reservatorio[]" value="poco" <?php if ($reservatorio_pocoAtt == 1){ echo "checked";} ?> > Poço</label> <br>

<label><input type="checkbox" name="reservatorio[]" value="subterraneo" <?php if ($reservatorio_subterraneoAtt == 1){ echo "checked";} ?> > Reservatório subterrâneo</label><br>


<label><input type="checkbox" name="reservatorio[]" value="outro" <?php if ($reservatorio_outroAtt == 1){ echo "checked";} ?>> Outro: </label> <input type="text" id="outroRe" value="<?php if ($reservatorio_outroAtt == 1){ echo $reservatorio_outroVAtt;} ?>" name="outroReservatorio" placeholder="Outro..." />
</div>


<label>Como é o esgotamento sanitário? </label>
<div class="entrevista">
<label><input type="checkbox" name="esgSanitario[]" value="septica" <?php if ($esgSan_septicaAtt == 1){ echo "checked";} ?> > Fossa séptica</label> <br>

<label><input type="checkbox" name="esgSanitario[]" value="negra" <?php if ($esgSan_negraAtt == 1){ echo "checked";} ?>> Fossa negra </label> <br>

<label><input type="checkbox" name="esgSanitario[]" value="agua" <?php if ($esgSan_aguaAtt == 1){ echo "checked";} ?>> Lançado na água</label> <br>

<label><input type="checkbox" name="esgSanitario[]" value="corrego" <?php if ($esgSan_corregoAtt == 1){ echo "checked";} ?> > Lançado no córrego</label><br>


<label><input type="checkbox" name="esgSanitario[]" value="outro" <?php if ($esgSan_outroAtt == 1){ echo "checked";} ?> > Outro:</label> <input type="text" id="outroE" value="<?php if ($esgSan_outroAtt == 1){ echo $esgSan_outroVAtt;} ?>" name="outroEsgSan" placeholder="Outro..." />
</div>
<label>Exitem alguns desses problemas na sua casa? </label>
<div class="entrevista">
<label><input type="checkbox" name="problemas[]" value="nao" <?php if ($problemas_naoAtt == 1){ echo "checked";} ?>> Não</label> <br>

<label><input type="checkbox" name="problemas[]" value="inundacao" <?php if ($problemas_inundacaoAtt == 1){ echo "checked";} ?>> Inundação</label> <br>

<label><input type="checkbox" name="problemas[]" value="deslizamento" <?php if ($problemas_deslizamentoAtt == 1){ echo "checked";} ?> > Deslizamento/desmoronamento</label> <br>

<label><input type="checkbox" name="problemas[]" value="animais" <?php if ($problemas_animaisAtt == 1){ echo "checked";} ?>> Animais peçonhentos </label><br>

<label><input type="checkbox" name="problemas[]" value="odores" <?php if ($problemas_odoresAtt == 1){ echo "checked";} ?> > Odores indesejados </label><br>


<label><input type="checkbox" name="problemas[]" value="outro" <?php if ($problemas_outroAtt == 1){ echo "checked";} ?> > Outro: </label><input type="text" id="outroP" value="<?php if ($problemas_outroAtt == 1){ echo $problemas_outroVAtt;} ?>" name="outroProblemas" placeholder="Outro..." />
</div>

  <input type="submit" name="salvar" value="Salvar">
  <input type="button" name="voltar" value="Voltar" onclick="voltar()"  />



         </form>




      </div>

    </div>
    <br>


  </div>
  </div>

</body>




</html>
