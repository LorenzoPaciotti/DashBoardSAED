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
                $("#aggiorna_button").click(function() {
                    riempiListaAziende();
                });
                $("#invia").click(function() {
                    var optionSelected = $('#select_sede').find("option:selected");
                    var valueSelected = optionSelected.val();
                    var textSelected = optionSelected.text();
                    $('#risp_invia').load('cruscotto_aggiorna_session.php');
                });
            });

            /*$("#select_sede").click()(function() {
             var x = document.getElementById("select_sede");
             var strUser = x.options[x.selectedIndex].text;
             alert(strUser);
             });*/





            function caricaInfoAzienda() {

                $('#risp_invia').load('cruscotto_inserisci_sede.php');
            }

            function riempiListaAziende() {
                // var x = document.getElementById("select_aziende");
                // var option = document.createElement("azienda1");
                // option.text = "azienda 1";
                // x.add(option);
                // alert('riempilista');
                $('#div_cont').load('cruscotto_gestioneSedi_select.php');
                //document.getElementById("select_sede").style.visibility = "visible";

            }

        </script>
        
        <div style="margin-bottom: 8px;margin-top: 8px;">
            <input id="aggiorna_button" type="button" class="textbox" value="Sedi disponibili"/>
        </div>
        

        <div id="div_cont">
        </div>
		Inserisci nuova sede
			
        <div id="risp_invia">
            <?php include './cruscotto_gestioneSedi_inserisciSede.php' ?>
        </div>



    </body>
</html>