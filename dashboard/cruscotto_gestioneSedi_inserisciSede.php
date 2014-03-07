<?php
if (isset($_POST['nome_sede'])) {
    //$var = ($_POST['nome_sede']);
    $link = new mysqli('localhost', 'root@localhost', null) or die(mysqli_error($link));
    mysqli_select_db($link, 'sedi') or die(mysqli_error($link));
    $query = "INSERT INTO sedi (nome_sede) VALUES ('$_POST[nome_sede]')";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_close($link);
    echo 'Sede inserita con successo';
} else {
    ?>

    <html>
        <head>
            <script type="text/javascript" src="jquery-1.11.0.js"></script>
            <style>
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

                //listener click
                $(document).ready(function() {
                    $("#inserisci_button").click(function() {
                        var x = $("#nome").val();
                        $.post('cruscotto_gestioneSedi_inserisciSede.php', {nome_sede: x}, function(msg) {
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
                </table>
            </div>

            <input id="inserisci_button" class="textbox" type="button" value="inserisci"/> 
            <div id="risposta"></div>


        </body>
    </html>
    <?php
}?>