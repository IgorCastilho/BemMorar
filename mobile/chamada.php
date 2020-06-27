<?php
ob_start();
session_start();
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
	header("Location: index.php");exit;
}
else{
    if (($_SESSION['nivel_acesso'] == 'prefeitura')||($_SESSION['nivel_acesso'] == 'null')||($_SESSION['nivel_acesso'] == 'bolsista')){
        
        header("Location: selecionaPainel.php?nao_autorizado");
    }
}
include("../conexao/conecta.php");
include("../logout.php");
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <!-- Meta tags -->
                <title>ÉpurainCampo - Projeto Bem Morar</title>
                <meta name="keywords" content="Apps Login Form Responsive widget, Flat Web Templates, Android Compatible web template, 
                Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <!-- stylesheets -->
                <link rel="stylesheet" href="../css/font-awesome.css">
                <link rel="stylesheet" href="../css/style.css">
                
                <!-- google fonts  -->
                <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
                <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
                
            </head>
            <script>

                function dataHoje(){ 
                    var momentoAtual = new Date();
                    
                    
                    var vdia = momentoAtual.getDate();
                    var vmes = momentoAtual.getMonth() + 1;
                    var vano = momentoAtual.getFullYear();
                    
                    if (vdia < 10){ vdia = "0" + vdia;}
                    if (vmes < 10){ vmes = "0" + vmes;}

        
                    dataFormat = vdia + " / " + vmes + " / " + vano;
        
                    var divPresenca = document.getElementById("diaPresenca");
                    divPresenca.innerHTML = "<h3> Presença no Neau dia "+dataFormat+"</h3>";
        
                    
                }
                
            
            </script>
<body>
<style>
    canvas {
        display: none;
    }
    hr {
        margin-top: 32px;
    }
    input[type="file"] {
        display: block;
        margin-bottom: 16px;
    }
    div {
        margin-bottom: 16px;
    }
    .telaVideo {
        width: 400 px;
        
    }
</style>

    <div class="externo">
            <div class="conteudo">
                <div class="resumo" align="center">
        
                <div id="diaPresenca"></div>
                        
                  <div>
                    <video height="200px" muted playsinline id="qr-video"></video>
                 </div> 
                 <div>
                    <select id="inversion-mode-select">
                        <option value="original">Scan original</option>
                    </select>
                    <br>
                                

                <script type="module">
                    
                    
                       import QrScanner from "../js/qr-scanner.min.js";
                        QrScanner.WORKER_PATH = '../js/qr-scanner-worker.min.js';
                        const video = document.getElementById('qr-video');
                        const camHasCamera = document.getElementById('cam-has-camera');
                        const camQrResult = document.getElementById('cam-qr-result');
                        const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
                        const fileSelector = document.getElementById('file-selector');
                        const fileQrResult = document.getElementById('file-qr-result');
                        function setResult(label, result) {
                            label.textContent = result;
                            camQrResultTimestamp.textContent = new Date().toString();
                            label.style.color = 'teal';
                            clearTimeout(label.highlightTimeout);
                            label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
                        }
                        // ####### Web Cam Scanning #######
                        QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);
                        const scanner = new QrScanner(video, result => setResult(camQrResult, result));
                        scanner.start();
                        document.getElementById('inversion-mode-select').addEventListener('change', event => {
                            scanner.setInversionMode(event.target.value);
                        });

                </script>
                <script>
                    function voltar(){
                        window.location.href = "../selecionaPainel.php.php";
                    }
                    var presenca = true;
                    function addPresenca(){
                        if(presenca){
                            presenca = false;
                            alert("Presença registrada!");
                            voltar();
                        }
                    }    
                    
                </script>
                

            </div>
            </div>
            </div>
</body>
</html>