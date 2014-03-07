<?php
session_start();
if ($_SESSION['tipo'] == 1) {
    
} else if ($_SESSION['tipo'] == 0) {
    
}
?>

<html>
    <head>
        <script type="text/javascript" src="jquery-1.11.0.js"></script>
        <style>
            #formSceltaAzienda{
                visibility:hidden;
            }
        </style>
    </head>
    <body>
        <script>
            $(document).ready(function() {

                $("#inserisci").click(function() {
                    var optionSelected = $('#select_sede').find("option:selected");
                    var valueSelected = optionSelected.val();
                    var textSelected = optionSelected.text();
                    var nome = $("#nome").val();
                    var partita_iva = $("#partita_iva").val();
                    var indirizzo_sede = $("#indirizzo_sede").val();
                    var recapito = $("#recapito").val();
                    $.post('SOAP_inserisci_fornitore.php', {sede: textSelected, nome: nome, partita_iva: partita_iva, indirizzo_sede: indirizzo_sede, recapito: recapito},
                    function(msg) {
                        $("#risposta").html(msg);
                    });

                });
            });

            $(document).ready(function() {

                $("#recupera").click(function() {
                    var optionSelected = $('#select_sede').find("option:selected");
                    var valueSelected = optionSelected.val();
                    var textSelected = optionSelected.text();
                    $.post('SOAP_recupera_fornitori.php', {sede: textSelected}, function(msg) {
                        $("#risposta").html(msg);
                    });
                });
            });

            $(document).ready(function() {

                $("#inserisci_fornitore").click(function() {
                    $("#risposta").load("cruscotto_gestioneInserimentoFornitori.php");
                });
            });


        </script>

        Seleziona un sede:<?php include 'cruscotto_gestioneSedi_select.php'; ?>
        <div style="margin:8px;">
            <input id="recupera" type="button" class="textbox" value="recupera fornitori"/>
            <?php if($_SESSION['tipo']==1){echo '<input id="inserisci_fornitore" class="textbox" type="button" value="inserisci fornitori"/>';} ?>
        </div>



        <div id="risposta">
        </div>



    </body>
</html>
