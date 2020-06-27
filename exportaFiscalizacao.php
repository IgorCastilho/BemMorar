<?php

include("conexao/conecta.php");

if (isset($_REQUEST['codigoBeneficiario'])){
	$codigoBeneficiario = $_REQUEST['codigoBeneficiario'];
}

if (isset($_REQUEST['codigoFiscalizacao'])){
	$codigoFiscalizacao = $_REQUEST['codigoFiscalizacao'];
}

try{
      $select = "SELECT * from beneficiarios where id=:codigoBeneficiario";
      $stmt = $conexao->prepare($select);
      $stmt-> bindParam(':codigoBeneficiario', $codigoBeneficiario, PDO::PARAM_INT);
     $stmt->execute();
     $contar = $stmt->rowCount();

     if ($contar >0) {
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $codigoEpura = $mostra->codigoEpura;
         $imagemBene = $mostra->imagemBene;
         $imagemFachada = $mostra->imagemFachada;
         $nomeCompleto = $mostra->nome;

       }
     } else {
       echo "Sem informações";
     }
    } catch(PDOException $e){
     echo $e;
    }

try {
     $stmt = $conexao->prepare('SELECT * FROM fiscalizacao F WHERE F.id = :codigoFiscalizacao');
     $stmt-> bindParam(':codigoFiscalizacao', $codigoFiscalizacao, PDO::PARAM_INT);
     $stmt->execute();
     $contar = $stmt->rowCount();

     if ($contar >0) {
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $dataFiscalizacao = $mostra->dataFiscalizacao;
         $parecerTecnico = $mostra->parecerTecnico;
         $idUser = $mostra->idUsuario;
    
       }
     } else {
       echo "Sem informações";
     }
    } catch(PDOException $e){
     echo $e;
    }
    
   $dataFormatada= date('d/m/Y', strtotime($dataFiscalizacao));
    
    try {
     $stmt = $conexao->prepare('SELECT * FROM usuariosExternos E WHERE E.id = :idUser');
     $stmt-> bindParam(':idUser', $idUser, PDO::PARAM_INT);
     $stmt->execute();
     $contar = $stmt->rowCount();

     if ($contar >0) {
       while($mostra = $stmt->FETCH(PDO::FETCH_OBJ)){
             //Coleta as informações
         $nome = $mostra->nomeCompleto;

    
       }
     } else {
       echo "Sem informações";
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
	<center><h2 style="text-transform: uppercase;">'.$nomeCompleto.'</h2></center>
	<center><h2 style="text-transform: uppercase;">'.$codigoEpura.'</h2></center>
	<br>
	
	<br> 
	<h3>DADOS DA FISCALIZAÇÃO</h3>
	<table align=left>
	    <tr>    
	        <td align=left><h4 style="font-weight: normal;"><b>Data que foi realizada:</b> <br>'.$dataFormatada.'</h4> </td>
	        <td> </td>
	        <td> </td>
	        <td> </td>
	        	        <td> </td>
	        <td> </td>
	        <td> </td>
	        <td> </td>
	        	        <td> </td>
	        <td> </td>
	        <td> </td>
	         	        <td> </td>
	        <td> </td>
	        <td> </td>
	        <td align=left><h4 style="font-weight: normal;"><b>Vistoriado por:</b> <br>'.$nome.'</h4> </td>
	      
	    </tr>

	   

</table>
<br> <br> <br> <br> <br> <br>
		<table align=left>
 <tr>
	        <td align=left><h4 style="font-weight: normal;"><b>Parecer técnico</b> <br><p>'.$parecerTecnico.'</p></h4></td>

	      
	    </tr>
	    </table>

');

$dompdf->setPaper('A4', 'portrait');

// renderizar o html
$dompdf->render();


$dompdf->stream("relatorio_fiscalizacao", array ("Attachment" => false));

?>