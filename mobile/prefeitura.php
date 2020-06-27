<?php
ob_start();
session_start();
if(!isset($_SESSION['usuario_epura']) && (!isset($_SESSION['senha_epura']))){
  header("Location: index.php");exit;
}
else{
  if ($_SESSION['nivel_acesso'] == 'null'){

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
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <!-- stylesheets -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

        <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="../css/swiper.min.css">

        <!-- Demo styles -->
        <style>
            html,
            body {
                position: relative;
                height: 100%;
            }
            
            .swiper-container {
                width: 70%;
                height: 70%;
            }
            
            .swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                /* Center slide text vertically */
                display: -webkit-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                -webkit-align-items: center;
                align-items: center;
            }
            
            .swiper-container-v {
                background: #eee;
            }
            
            .agile-login {
                padding-bottom: 50px;
            }
            
            .wrapper {
                
                height: 350px;

                  width: 330px;
    margin: auto;
    margin-top: 20%;
    text-align: center;
    padding: 3% 0px;
    border-radius: 15px;
    background-color: #fff;
            }
            
            .graficos {
                width: 100%;
                height: 100%;
            }
        </style>
    </head>

    <!-- PROGRAMA -->
    <?php 
try{
  $select = "SELECT COUNT(cod_beneficiario)as 'total', SUM(tabelaServ)as 'tabelaServ', SUM(quantitativo)as 'quantitativo', SUM(memorial) as 'memorial',SUM(entrevista) as 'entrevista',SUM(proposta) as 'proposta',SUM(levantamento) as 'levantamento', SUM(asbuilt) as 'asbuilt' FROM etapas_beneficiario WHERE cod_beneficiario IN ( SELECT id FROM beneficiarios where 1)";
  $stmt = $conexao->prepare($select);
  $stmt -> execute();
  $mostra = $stmt->FETCH(PDO::FETCH_OBJ);

  $PG_total = $mostra->total;

  $PG_count_levantamento_sim =$mostra->levantamento;
  $PG_count_levantamento_nao = $PG_total - $PG_count_levantamento_sim;

  $PG_count_asbuilt_sim = $mostra->asbuilt;
  $PG_count_asbuilt_nao = $PG_total - $PG_count_asbuilt_sim;

  $PG_count_proposta_sim = $mostra->proposta;
  $PG_count_proposta_nao = $PG_total - $PG_count_proposta_sim;

  $PG_count_quantitativo_sim = $mostra->quantitativo;
  $PG_count_quantitativo_nao = $PG_total - $PG_count_quantitativo_sim;

} catch(PDOException $e){
  echo $e;
}

?>
        <!-- PLANALTO -->
        <?php
try{
  $select = "SELECT COUNT(cod_beneficiario)as 'total', SUM(tabelaServ)as 'tabelaServ', SUM(quantitativo)as 'quantitativo', SUM(memorial) as 'memorial',SUM(entrevista) as 'entrevista',SUM(proposta) as 'proposta',SUM(levantamento) as 'levantamento', SUM(asbuilt) as 'asbuilt' FROM etapas_beneficiario WHERE cod_beneficiario IN ( SELECT id FROM beneficiarios WHERE bairro = 'PLANALTO')";
  $stmt = $conexao->prepare($select);
  $stmt -> execute();
  $mostra = $stmt->FETCH(PDO::FETCH_OBJ);

  $PL_total = $mostra->total;

  $PL_count_levantamento_sim =$mostra->levantamento;
  $PL_count_levantamento_nao = $mostra->total - $PL_count_levantamento_sim;

  $PL_count_asbuilt_sim = $mostra->asbuilt;
  $PL_count_asbuilt_nao = $mostra->total - $PL_count_asbuilt_sim;

  $PL_count_proposta_sim = $mostra->proposta;
  $PL_count_proposta_nao = $mostra->total - $PL_count_proposta_sim;

  $PL_count_quantitativo_sim = $mostra->quantitativo;
  $PL_count_quantitativo_nao = $mostra->total - $PL_count_quantitativo_sim;

} catch(PDOException $e){
  echo $e;
}

?>
            <!-- VALE DO CARUMBÉ -->
            <?php 
try{
  $select = "SELECT COUNT(cod_beneficiario)as 'total', SUM(tabelaServ)as 'tabelaServ', SUM(quantitativo)as 'quantitativo', SUM(memorial) as 'memorial',SUM(entrevista) as 'entrevista',SUM(proposta) as 'proposta',SUM(levantamento) as 'levantamento', SUM(asbuilt) as 'asbuilt' FROM etapas_beneficiario WHERE cod_beneficiario IN ( SELECT id FROM beneficiarios WHERE bairro = 'CARUMBE')";
  $stmt = $conexao->prepare($select);
  $stmt -> execute();
  $mostra = $stmt->FETCH(PDO::FETCH_OBJ);

  $VC_total = $mostra->total;

  $VC_count_levantamento_sim =$mostra->levantamento;
  $VC_count_levantamento_nao = $mostra->total - $VC_count_levantamento_sim;

  $VC_count_asbuilt_sim = $mostra->asbuilt;
  $VC_count_asbuilt_nao = $mostra->total - $VC_count_asbuilt_sim;

  $VC_count_proposta_sim = $mostra->proposta;
  $VC_count_proposta_nao = $mostra->total - $VC_count_proposta_sim;

  $VC_count_quantitativo_sim = $mostra->quantitativo;
  $VC_count_quantitativo_nao = $mostra->total - $VC_count_quantitativo_sim;

} catch(PDOException $e){
  echo $e;
}

?>
                <!-- JARDIM UMUARAMA -->
                <?php
try{
  $select = "SELECT COUNT(cod_beneficiario)as 'total', SUM(tabelaServ)as 'tabelaServ', SUM(quantitativo)as 'quantitativo', SUM(memorial) as 'memorial',SUM(entrevista) as 'entrevista',SUM(proposta) as 'proposta',SUM(levantamento) as 'levantamento', SUM(asbuilt) as 'asbuilt' FROM etapas_beneficiario WHERE cod_beneficiario IN ( SELECT id FROM beneficiarios WHERE bairro = 'UMUARAMA')";
  $stmt = $conexao->prepare($select);
  $stmt -> execute();
  $mostra = $stmt->FETCH(PDO::FETCH_OBJ);

  $JU_total = $mostra->total;

  $JU_count_levantamento_sim =$mostra->levantamento;
  $JU_count_levantamento_nao = $mostra->total - $JU_count_levantamento_sim;

  $JU_count_asbuilt_sim = $mostra->asbuilt;
  $JU_count_asbuilt_nao = $mostra->total - $JU_count_asbuilt_sim;

  $JU_count_proposta_sim = $mostra->proposta;
  $JU_count_proposta_nao = $mostra->total - $JU_count_proposta_sim;

  $JU_count_quantitativo_sim = $mostra->quantitativo;
  $JU_count_quantitativo_nao = $mostra->total - $JU_count_quantitativo_sim;

} catch(PDOException $e){
  echo $e;
}
?>

                    <script type="text/javascript">
                        function voltar() {
                            window.location.href = "../selecionaPainel.php";
                        }
                    </script>

                    <body>
                        <div class="externo">
                            <div class="conteudo">
                                <div class="swiper-container swiper-container-h">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <h5>Estado do Programa</h5>
                                            <table>
                                                <!-- Slides Vertical -->
                                                <div class="swiper-container swiper-container-v">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div id="levantamento_programa" class="graficos"></div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div id="asbuilt_programa" class="graficos"></div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div id="proposta_programa" class="graficos"></div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div id="quantitativo_programa" class="graficos"></div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-pagination swiper-pagination-v"></div>
                                                </div>
                                            </table>
                                        </div>
                                        <div class="swiper-slide">
                                            <h3>Vale do Carumbé</h3>
                                            <!-- Slides Vertical -->
                                            <table>
                                                <tr>
                                                    <div class="swiper-container swiper-container-v">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <div id="levantamento_carumbe" class="graficos"></div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div id="asbuilt_carumbe" class="graficos"></div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div id="proposta_carumbe" class="graficos"></div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div id="quantitativo_carumbe" class="graficos"></div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-pagination swiper-pagination-v"></div>
                                                    </div>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="swiper-slide">

                                            <h3>Jardim Umuarama</h3>
                                            <!-- Slides Vertical -->
                                            <table>
                                                <tr>
                                                    <div class="swiper-container swiper-container-v">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <div id="levantamento_umuarama" class="graficos"></div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div id="asbuilt_umuarama" class="graficos"></div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div id="proposta_umuarama" class="graficos"></div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div id="quantitativo_umuarama" class="graficos"></div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-pagination swiper-pagination-v"></div>
                                                    </div>
                                                </tr>
                                            </table>

                                        </div>
                                        <div class="swiper-slide">
                                            <h3>Planalto</h3>
                                            <!-- Slides Vertical -->
                                            <table>
                                                <tr>
                                                    <div class="swiper-container swiper-container-v">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <div id="levantamento_planalto" class="graficos"></div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div id="asbuilt_planalto" class="graficos"></div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div id="proposta_planalto" class="graficos"></div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div id="quantitativo_planalto" class="graficos"></div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-pagination swiper-pagination-v"></div>
                                                    </div>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="swiper-slide">
                                            <h3>Altos da Gloria</h3>
                                            <!-- Slides Vertical -->
                                            <table>
                                                <tr>
                                                    <div class="swiper-container swiper-container-v">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">Em breve!</div>
                                                            <!-- <div class="swiper-slide">Vertical Slide 2</div>
<div class="swiper-slide">Vertical Slide 3</div>
<div class="swiper-slide">Vertical Slide 4</div>       -->
                                                        </div>
                                                        <div class="swiper-pagination swiper-pagination-v"></div>
                                                    </div>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="swiper-slide">
                                            <h3>Tres Barras</h3>
                                            <!-- Slides Vertical -->
                                            <table>
                                                <tr>
                                                    <div class="swiper-container swiper-container-v">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">Em breve!</div>
                                                            <!-- <div class="swiper-slide">Vertical Slide 2</div>
<div class="swiper-slide">Vertical Slide 3</div>
<div class="swiper-slide">Vertical Slide 4</div>       -->
                                                        </div>
                                                        <div class="swiper-pagination swiper-pagination-v"></div>
                                                    </div>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination swiper-pagination-h"></div>
                                </div>
                                <!-- Swiper JS -->
                                <script src="../js/swiper.min.js"></script>
                                <!-- Initialize Swiper -->
                                <script>
                                    var swiperH = new Swiper('.swiper-container-h', {
                                        slidesPerView: 1,
                                        spaceBetween: 30,
                                        loop: true,
                                        pagination: {
                                            el: '.swiper-pagination',
                                            clickable: true,
                                        },
                                        keyboard: {
                                            enabled: true,
                                        },
                                        navigation: {
                                            nextEl: '.swiper-button-next',
                                            prevEl: '.swiper-button-prev',
                                        },
                                    });
                                    var swiperV = new Swiper('.swiper-container-v', {
                                        direction: 'vertical',
                                        loop: true,
                                        pagination: {
                                            el: '.swiper-pagination',
                                            clickable: true,
                                        },
                                        keyboard: {
                                            enabled: true,
                                        },
                                        navigation: {
                                            nextEl: '.swiper-button-next',
                                            prevEl: '.swiper-button-prev',
                                        },
                                    });
                                </script>
                                <div class="resumo">
                                    <input type="submit" name="voltar" value="Voltar" onclick="voltar()">
                                </div>
                            </div>
                        </div>
                    </body>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        // Planalto
                        //Levantamento
                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(levantamento_planalto);

                        function levantamento_planalto() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $PL_count_levantamento_sim ?>],
                                ['Em andamento', <?php echo $PL_count_levantamento_nao ?>]
                            ]);
                            var options = {
                                title: 'Levantamento',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };
                            var chart = new google.visualization.PieChart(document.getElementById('levantamento_planalto'));
                            chart.draw(data, options);
                        }
                        //AsBuilt
                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(asbuilt_planalto);

                        function asbuilt_planalto() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $PL_count_asbuilt_sim ?>],
                                ['Em andamento', <?php echo $PL_count_asbuilt_nao ?>]
                            ]);
                            var options = {
                                title: 'As built',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('asbuilt_planalto'));
                            chart.draw(data, options);
                        }
                        //Proposta
                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(proposta_planalto);

                        function proposta_planalto() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $PL_count_proposta_sim ?>],
                                ['Em andamento', <?php echo $PL_count_proposta_nao ?>]
                            ]);

                            var options = {
                                title: 'Proposta',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('proposta_planalto'));
                            chart.draw(data, options);
                        }
                        //Quantitativo
                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(quantitativo_planalto);

                        function quantitativo_planalto() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $PL_count_quantitativo_sim ?>],
                                ['Em andamento', <?php echo $PL_count_quantitativo_nao ?>]
                            ]);

                            var options = {
                                title: 'Quantitativo',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('quantitativo_planalto'));
                            chart.draw(data, options);
                        }
                        //Carumbé
                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(levantamento_carumbe);

                        function levantamento_carumbe() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $VC_count_levantamento_sim ?>],
                                ['Em andamento', <?php echo $VC_count_levantamento_nao ?>]

                            ]);

                            var options = {
                                title: 'Levantamento',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('levantamento_carumbe'));
                            chart.draw(data, options);
                        }

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(asbuilt_carumbe);

                        function asbuilt_carumbe() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $VC_count_asbuilt_sim ?>],
                                ['Em andamento', <?php echo $VC_count_asbuilt_nao ?>]

                            ]);

                            var options = {
                                title: 'As built',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('asbuilt_carumbe'));
                            chart.draw(data, options);
                        }

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(proposta_carumbe);

                        function proposta_carumbe() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $VC_count_proposta_sim ?>],
                                ['Em andamento', <?php echo $VC_count_proposta_nao ?>]

                            ]);

                            var options = {
                                title: 'Proposta',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('proposta_carumbe'));
                            chart.draw(data, options);
                        }

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(quantitativo_carumbe);

                        function quantitativo_carumbe() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $VC_count_quantitativo_sim ?>],
                                ['Em andamento', <?php echo $VC_count_quantitativo_nao ?>]

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

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(levantamento_umuarama);

                        function levantamento_umuarama() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $JU_count_levantamento_sim ?>],
                                ['Em andamento', <?php echo $JU_count_levantamento_nao ?>]

                            ]);

                            var options = {
                                title: 'Levantamento',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('levantamento_umuarama'));
                            chart.draw(data, options);
                        }

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(asbuilt_umuarama);

                        function asbuilt_umuarama() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $JU_count_asbuilt_sim ?>],
                                ['Em andamento', <?php echo $JU_count_asbuilt_nao ?>]

                            ]);

                            var options = {
                                title: 'As built',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('asbuilt_umuarama'));
                            chart.draw(data, options);
                        }

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(proposta_umuarama);

                        function proposta_umuarama() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $JU_count_proposta_sim ?>],
                                ['Em andamento', <?php echo $JU_count_proposta_nao ?>]

                            ]);

                            var options = {
                                title: 'Proposta',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('proposta_umuarama'));
                            chart.draw(data, options);
                        }

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(quantitativo_umuarama);

                        function quantitativo_umuarama() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $JU_count_quantitativo_sim ?>],
                                ['Em andamento', <?php echo $JU_count_quantitativo_nao ?>]

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

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(levantamento_programa);

                        function levantamento_programa() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $PG_count_levantamento_sim ?>],
                                ['Em andamento', <?php echo $PG_count_levantamento_nao ?>]

                            ]);

                            var options = {
                                title: 'Levantamento',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('levantamento_programa'));
                            chart.draw(data, options);
                        }

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(asbuilt_programa);

                        function asbuilt_programa() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $PG_count_asbuilt_sim ?>],
                                ['Em andamento', <?php echo $PG_count_asbuilt_nao ?>]

                            ]);

                            var options = {
                                title: 'As built',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('asbuilt_programa'));
                            chart.draw(data, options);
                        }

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(proposta_programa);

                        function proposta_programa() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $PG_count_proposta_sim ?>],
                                ['Em andamento', <?php echo $PG_count_proposta_nao ?>]

                            ]);

                            var options = {
                                title: 'Proposta',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('proposta_programa'));
                            chart.draw(data, options);
                        }

                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(quantitativo_programa);

                        function quantitativo_programa() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fase', 'Casas concluídas'],
                                ['Concluídas', <?php echo $PG_count_quantitativo_sim ?>],
                                ['Em andamento', <?php echo $PG_count_quantitativo_nao ?>]

                            ]);

                            var options = {
                                title: 'Quantitativo',
                                colors: ['#0e38e0', '#e0440e'],
                                is3D: true
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('quantitativo_programa'));
                            chart.draw(data, options);
                        }
                    </script>

    </html>