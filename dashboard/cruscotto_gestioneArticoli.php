<?php
session_start();
if (isset($_SESSION)) {
    if ($_SESSION['tipo'] == 1) {
        
    } else if ($_SESSION['tipo'] == 0) {
        
    }
    ?>


    <html>
        <head>
            <link href="controlli.css" rel="stylesheet" type="text/css">

            <script type="text/javascript" src="jquery-1.11.0.js"></script>
            <style>
                #formSceltaAzienda{
                    visibility:hidden;
                }
                #main{
                    margin-top: 3px;
                }
                #risp{
                    overflow-y: scroll;
                    height: 300px;
                }
            </style>
        </head>
        <body>
            <script>



                $(document).ready(function() {
                    $("#apri_ins").click(function() {
                        var optionSelected = $('#select_sede').find("option:selected");
                        var valueSelected = optionSelected.val();
                        var textSelected = optionSelected.text();
                        $.post('cruscotto_aggiungiArticolo.php', {sede: textSelected},
                        function(msg) {
                            $("#risp").html(msg);
                        });

                    });
                });

                $(document).ready(function() {

                    $("#recupera").click(function() {
                        var optionSelected = $('#select_sede').find("option:selected");
                        var valueSelected = optionSelected.val();
                        var textSelected = optionSelected.text();
                        $.post('SOAP_recupera_articoli.php', {sede: textSelected}, function(msg) {
                            $("#risp").html(msg);
                        });
                    });
                });



            </script>


            <div id="main">
                Seleziona una sede <br/> <?php include 'cruscotto_gestioneSedi_select.php'; ?>
                <div style="margin:8px;">
                    <input id="recupera" type="button" class="textbox" value="recupera articoli"/>
                    <?php if ($_SESSION['tipo'] == 1) {
                        echo '<input id="apri_ins" type="button" class="textbox" value="inserisci articolo"/>';
                    } ?>
                </div>


                <div id="risp">
                </div>
            </div>



        </body>
    </html>
    <?php
}
?>