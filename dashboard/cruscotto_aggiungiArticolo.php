<html>
    <head>
        <script type="text/javascript" src="jquery-1.11.0.js"></script>
        <link href="controlli.css" rel="stylesheet" type="text/css">
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

                $("#inse").click(function() {
                    var optionSelected = $('#select_fornitore').find("option:selected");
                    var valueSelected = optionSelected.val();
                    var textSelected = optionSelected.text();
                    var nome = $("#nome").val();
                    var marca = $("#marca").val();
                    var prezzo_di_acquisto = $("#prezzo_di_acquisto").val();
                    var prezzo_di_vendita = $("#prezzo_di_vendita").val();
                    var descrizione = $("#descrizione").val();

                    var sede = $("#select_sede").val();
                    $.post('SOAP_inserisci_articolo.php', {sede: sede, nome: nome, marca: marca, prezzo_di_acquisto: prezzo_di_acquisto, prezzo_di_vendita: prezzo_di_vendita, descrizione: descrizione, fornitore: valueSelected},
                    function(msg) {
                        $("#risp").html(msg);
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
                        marca
                    </td>
                    <td>
                        <input id="marca" class="textbox" type="text" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>
                        prezzo di acquisto
                    </td>
                    <td>
                        <input id="prezzo_di_acquisto" class="textbox" type="number" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>
                        prezzo di vendita
                    </td>
                    <td>
                        <input id="prezzo_di_vendita" class="textbox" type="number" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>
                        descrizione
                    </td>
                    <td>
                        <input id="descrizione" class="textbox" type="text" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>
                        fornitore
                    </td>
                    <td>
                        <?php
                        $sede = trim($_POST['sede']);

                        $wsdl = 'http://localhost/sede/cache/' . $sede . '.wsdl';
                        $soap = new SoapClient($wsdl);
                        $array_fornitore = $soap->fornitori_disponibili('');
                        echo '<select name="select" id="select_fornitore">';
                        foreach ($array_fornitore as $val) {

                            echo '<option id="' . htmlspecialchars($val['id_fornitore']) . '" value="' . htmlspecialchars($val['id_fornitore']) . '">'
                            . htmlspecialchars($val['nome'])
                            . '</option>';
                        }
                        echo '</select>';
                        ?>
                    </td>
                </tr>
            </table>
        </div>

        <div id="spanButton">
            <input id="inse" class="textbox" type="button" value="inserisci"/> 
        </div>
    </body>
</html>