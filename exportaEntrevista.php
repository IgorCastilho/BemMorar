<?php

include("conexao/conecta.php");

if (isset($_REQUEST['codigo'])){
	$localizador = $_REQUEST['codigo'];
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
         $codigoEpura = $mostra->codigoEpura;
         $imagemBene = $mostra->imagemBene;
         $imagemFachada = $mostra->imagemFachada;

       }
     } else {
       echo "Erro interno do servidor";
     }
    } catch(PDOException $e){
     echo $e;
    }

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




use Dompdf\Dompdf;

// incluindo o autoloader
require_once 'dompdf/autoload.inc.php';

// criando a instância
$dompdf = new DOMPDF();

$dompdf->load_html('
	<head><link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"></head
	<center><img src="images/cabecalho.png"></center>
	<br>
	<div style="font-family: Open Sans, sans-serif;">
	<center><h2 style="text-transform: uppercase;">'.$nomeEntrevistadoAtt.'</h2></center>
	<center><h2 style="text-transform: uppercase;">'.$codigoEpura.'</h2></center>
	<br>
	<table align=center cellpadding=3>
	    <tr>
	           <td align=center><img src="images/perfil/'.$imagemBene.'" width="23%" height="25%"></td>
	           <td align=center><img src="images/fachada/'.$imagemFachada.'" width="23%" height="25%"></td>
	          
	    </tr>
	      <tr>
	            <td align=center>Imagem do beneficiário</td>
	           <td align=center>Fachada da casa</td>
	    </tr>
	</table>
	<br> <br>
	<h3>RESUMO DA ENTREVISTA</h3>
	<table align=left>
	    <tr>    
	        <td align=left><h4 style="font-weight: normal;"><b>Data que foi realizada:</b> <br>'.$dataEntrevistaAtt.'</h4> </td>
	        <td align=left></h4> </td>
	        <td align=left></h4> </td>
	        <td align=left></h4> </td>
	        <td align=left></h4> </td>
	         <td align=left></h4> </td>
	        <td align=left><h4 style="font-weight: normal;"><b>Grupo responsável:</b> <br>'.$grupoTrabalhoAtt.'</h4></td>
	    </tr>
	    
	    <tr>
	        <td align=left><h4 style="font-weight: normal;"><b>Endereço:</b> <br>'.$enderecoAtt.'</h4></td>
	        <td align=left></h4> </td>
	        <td align=left></h4> </td>
	        <td align=left></h4> </td>
	        <td align=left></h4> </td>
	         <td align=left></h4> </td>
	        <td align=left><h4 style="font-weight: normal;"><b>Há quanto tempo mora na casa?</b> <br>'.$tempoMorandoAtt.'</h4>
	    </tr>
	    
	     <tr>
	        <td align=left><h4 style="font-weight: normal;"><b>Quantas pessoas moram na casa?</b><br>'.$qtdPessoasMorandoAtt.'</h4></td>
	        <td align=left></h4> </td>
	        <td align=left></h4> </td>
	        <td align=left></h4> </td>
	        <td align=left></h4> </td>
	         <td align=left></h4> </td>
	        <td align=left><h4 style="font-weight: normal;"><b>Reforma/ampliação desejada:</b> <br>'.$ampliacaoDesejadaAtt.'</h4>
	    </tr>

</table>

	


');

$dompdf->setPaper('A4', 'portrait');

// renderizar o html
$dompdf->render();


$dompdf->stream("relatorio_entrevista", array ("Attachment" => false));

?>