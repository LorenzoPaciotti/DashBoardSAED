<html>
    <head>
        <script type="text/javascript" src="jquery-1.11.0.js"></script>
        <style>
            #formSceltaAzienda{
                visibility:hidden;
            }
            #divCENT{
                margin:0 auto;
                display: table;
            }
            table{
                border:  1px solid;
                padding: 8px;
                margin: 8px;
            }
            #spanButton{
                text-align: right;
                padding-right: 8px;
                padding-bottom: 8px;
                height: 33px;
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





        </script>
        <div id="divCENT">
            <table>
                <tr>
                    <td>
                        nome
                    </td>
                    <td>
                        <input id="nome" class="textbox" type="text" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>
                        partita iva
                    </td>
                    <td>
                        <input id="partita_iva" class="textbox" type="text" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>
                        indirizzo sede
                    </td>
                    <td>
                        <input id="indirizzo_sede" class="textbox" type="text" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>
                        recapito
                    </td>
                    <td>
                        <input id="recapito" class="textbox" type="tel" value=""/>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="spanButton">
            <input id="inserisci" type="button" class="textbox" value="inserisci fornitore"/>
        </div>

        






    </body>
</html>
