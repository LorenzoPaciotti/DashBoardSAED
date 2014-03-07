<?php
//require 'interroga_azienda.php';

$wsdl = "http://localhost/sede/cache/server_statistiche.wsdl";
$params = array('cache_wsdl' => WSDL_CACHE_NONE);
$client = new SoapClient($wsdl, $params);

$response1 = $client->calcola_guadagni();
$i = 0;
foreach ($response1 as $value) {
    $arrayRinominato[$i]['label'] = $value['nome'];
    $arrayRinominato[$i]['y'] = $value['guadagno'];
    $i++;
}
$test1 = json_encode($arrayRinominato);

$arrayRinominato = array();
$response = $client->calcola_quantita();
$i = 0;
foreach ($response as $value) {
    $arrayRinominato[$i]['label'] = $value['nome'];
    $arrayRinominato[$i]['y'] = $value['quantita'];
    $i++;
}
$test = json_encode($arrayRinominato);
?>

<html>
    <head>
        <title>Bar Chart</title>
        <script src="Chart.js"></script>
        <script src="canvasjs.js"></script>
        <meta name="viewport" content="initial-scale = 1, user-scalable = no">
        <style>
            #DIVDX{
                height:400px;
            }
            #DIVSX{
                height:400px;
                margin-left: 50px;
            }
            #titolo_dx{
                text-align:right}
            #titolo_sx{
                text-align:left}
            #containerSTATS{
                overflow-y: scroll;
    height: 400px;
    /*display: table;*/
            }
            </style>
        </head>
        <body>
            <div id="containerSTATS">
                <div id="DIVSX"></div>

            <div id="DIVDX"></div>
            </div>
            







        <!-- script creazione grafici -->
        <script>

            /*//GRAFICO QUANTITA'
             var barChartData = {
             labels: <?php print_r($json_nomi) ?>,
             datasets: [
             {
             fillColor: "rgba(220,220,220,0.5)",
             strokeColor: "rgba(220,220,220,1)",
             data: <?php print_r($json_vendite) ?>
             },
             {
             fillColor: "rgba(220,220,220,0.5)",
             strokeColor: "rgba(220,220,220,1)",
             data: <?php print_r($json_vendite) ?>
             }
             ]
             
             };
             
             var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(barChartData);*/




            //GRAFICO GUADAGNI
            var graf =<?php print_r($test); ?>;
            for (key in graf) {
                graf[key]["y"] = parseInt(graf[key]["y"]);
            }
            var chart = new CanvasJS.Chart("DIVSX", {
                title: {
                    text: "Oggetti piu' venduti"
                },
                data: [//array of dataSeries              
                    { //dataSeries object

                        /*** Change type "column" to "bar", "area", "line" or "pie"***/
                        type: "pie",
                        dataPoints: graf
                    }
                ]
            });


            $(document).ready(function() {
                chart.render();

            });

            //GRAFICO GUADAGNI
            var graf =<?php print_r($test1); ?>;
            for (key in graf) {
                graf[key]["y"] = parseInt(graf[key]["y"]);
            }
            var chart = new CanvasJS.Chart("DIVDX", {
                title: {
                    text: "Oggetti con ricavo maggiore"
                },
                data: [//array of dataSeries              
                    { //dataSeries object

                        /*** Change type "column" to "bar", "area", "line" or "pie"***/
                        type: "column",
                        dataPoints: graf
                    }
                ]
            });

            //$('.canvasjs-chart-container').attr('width','450px');
            //$('.canvasjs-chart-canvas').css('padding-left','-200px');


            $(document).ready(function() {
                chart.render();

            });



        </script>


    </body>
</html>