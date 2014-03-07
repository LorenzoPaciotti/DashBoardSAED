<!-- PHP -->
<?php
#namespace test;
include 'cruscotto_dbmanager.php';
session_start();
/* if (isset($_SESSION['tipo'])) {
  if ($_SESSION['tipo'] == 1) {//superuser
  echo 'account superutente';
  } else if ($_SESSION['tipo'] == 0) {//user
  echo 'account utente normale';
  } else {
  echo 'accesso non effettuato';
  }
  } else {
  echo 'accesso non effettuato';
  } */

if (isset($_GET['init'])) {
    #print_r();
    //$dbman = new DBManager_centroServ();
    print_r(CreaDB());
    //print_r(DBManager_centroServ::CreaDB());
}
?>

<!--HTML-->
<!doctype html>
<html>
    <head>
        <script type="text/javascript" src="jquery-1.11.0.js"></script>
        <script type="text/javascript" src="chart.js"></script>
        <link href="controlli.css" rel="stylesheet" type="text/css">
        <link href="css/cruscotto.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title>Dashboard Online</title>
        <style>
        </style>
    </head>

    <body>
        <!-- JAVASCRIPT/JQUERY -->
        <script>

            //listener click
            $(document).ready(function() {
                $("#Fornitori").click(function() {
                    vistaFornitori();
                });
            });
            $(document).ready(function() {
                $("#Articoli").click(function() {
                    vistaArticolo();
                });
            });
            $(document).ready(function() {
                $("#reporting_button").click(function() {
                    vistaReport();
                });
            });

            $(document).ready(function() {
                $("#gestione_sedi_button").click(function() {
                    vistaSedi();
                });
            });

            $(document).ready(function() {
                $("#logout").click(function() {
                    logout();
                });
            });
            
            $(document).ready(function() {
                $("#utenti_button").click(function() {
                    vistaUtenti();
                });
            });

            //FUNZIONI
            function apriContenitoreDinamico() {

                $("#contenitore_dinamico").toggleClass("contenitore_dinamico_espanso");
                var className = $('#contenitore_dinamico').attr('class');
                if (className === "contenitore_dinamico_base") {
                    //alert('asd');
                    $("#contenitore_dinamico").empty();
                }
                //alert("apri cont din");
            }
            function vistaReport() {
                apriContenitoreDinamico();
                var className = $('#contenitore_dinamico').attr('class');
                if (className !== "contenitore_dinamico_base") {
                    $("#contenitore_dinamico").load("cruscotto_vistaStatistiche.php");
                }
                return true;
            }
            function vistaSedi() {
                apriContenitoreDinamico();
                var className = $('#contenitore_dinamico').attr('class');
                if (className !== "contenitore_dinamico_base") {
                    $("#contenitore_dinamico").load("cruscotto_gestioneSedi.php");
                }
                return true;
            }
            function vistaUtenti() {
                apriContenitoreDinamico();
                var className = $('#contenitore_dinamico').attr('class');
                if (className !== "contenitore_dinamico_base") {
                    $("#contenitore_dinamico").load("cruscotto_gestioneUtenti.php");
                }
                return true;
            }
            function vistaFornitori() {
                apriContenitoreDinamico();
                var className = $('#contenitore_dinamico').attr('class');
                if (className !== "contenitore_dinamico_base") {
                    $("#contenitore_dinamico").load("cruscotto_gestioneFornitori.php");
                }
                return true;
            }
            function vistaArticolo() {
                apriContenitoreDinamico();
                var className = $('#contenitore_dinamico').attr('class');
                if (className !== "contenitore_dinamico_base") {
                    $("#contenitore_dinamico").load("cruscotto_gestioneArticoli.php");
                }
                return true;
            }
            function logout() {
                //alert('logout');
                //$.get("logout.php");
                //$('body').load("logout.php");
                window.location.replace('logout.php');
            }



        </script>


        <?php
        if (isset($_SESSION['tipo'])) {
            /* echo 'username: ' . $_SESSION['username']; */
            if ($_SESSION['tipo'] == 1) {//superuser
                /* echo 'account superutente'; */
                ?>
                <div class="container">
                    <div class="container2">
                        <header id="header">
                            <img src="logo.png" alt="torna a INDEX" id="logo" />
                        </header>
                        <!--
                        <div class="sidebar1">
                                <ul class="nav">
                                        <li><a href="#">Collegamento uno</a></li>
                                        <li><a href="#">Collegamento due</a></li>
                                        <li><a href="#">Collegamento tre</a></li>
                                        <li><a href="#">Collegamento quattro</a></li>
                                </ul>
                                <aside>
                                  <p>***</p>
                                </aside>
                        </div>
                        -->
                        <article class="content">
                            <section>
                                
                                <div id="barra">
                                    <div>
                                        <input name="Articoli" class="bottoneLogin" type="button" id="Articoli" value="Articoli"/>
                                        <input name="Fornitori" class="bottoneLogin" type="button" id="Fornitori" value="Fornitori"/>
                                        <input name="reporting" class="bottoneLogin" type="button" id="reporting_button" value="Reporting"/>
                                        <input name="riempi_lista_aziende" class="bottoneLogin" type="button" id="gestione_sedi_button" value="Gestione Sedi"/>
                                        <input name="Utenti" class="bottoneLogin" type="button" id="utenti_button" value="Lista Utenti"/>
                                        <input name="logout" type="button" class="bottoneLogin" id="logout" value="logout"/>
                                    </div>
                                </div>
                            </section>
                            <section>   
                                <div id="contenitore_dinamico" class="contenitore_dinamico_base">

                                </div>
                            </section>
                        </article>
                        <article>
                            <address>
                                Benvenuto nella Dashboard, <?php print_r($_SESSION['username']);  ?>, sei un Amministratore
                            </address>
                        </article>
                        <footer id="footer">
                            <address>
                                Madotto Andrea, Paciotti Lorenzo
                            </address>
                        </footer>
                    </div><!-- fine container secondario -->
                </div><!-- end .container principale-->

                <?php
            } else if ($_SESSION['tipo'] == 0) {//user
                /* echo 'account utente normale'; */
                ?><!-- inizio html utente normale -->
                <div class="container">
                    <div class="container2">
                        <header id="header">
                            <img src="logo.png" alt="torna a INDEX" id="logo" />
                        </header>
                        <!--
                        <div class="sidebar1">
                                <ul class="nav">
                                        <li><a href="#">Collegamento uno</a></li>
                                        <li><a href="#">Collegamento due</a></li>
                                        <li><a href="#">Collegamento tre</a></li>
                                        <li><a href="#">Collegamento quattro</a></li>
                                </ul>
                                <aside>
                                  <p>***</p>
                                </aside>
                        </div>
                        -->
                        <article class="content">
                            <section>
                               
                                <div id="barra">
                                    <div>
                                        <input name="Articoli" class="bottoneLogin" type="button" id="Articoli" value="Articoli"/>
                                        <input name="Fornitori" class="bottoneLogin" type="button" id="Fornitori" value="Fornitori"/>
                                        <input name="reporting" class="bottoneLogin" type="button" id="reporting_button" value="Reporting"/>
                                        <input name="logout" type="button" class="bottoneLogin" id="logout" value="logout"/>
                                    </div>
                                </div>
                            </section>
                            <section>   
                                <div id="contenitore_dinamico" class="contenitore_dinamico_base">

                                </div>
                            </section>
                        </article>
                        <article>
                            <address>
                                Benvenuto nella Dashboard, <?php print_r($_SESSION['username']);  ?>, sei un Utente normale
                            </address>
                        </article>
                        <footer id="footer">
                            <address>
                                Madotto Andrea, Paciotti Lorenzo
                            </address>
                        </footer>
                    </div><!-- fine container secondario -->
                </div><!-- end .container principale-->
            </body>
        </html>
        <?php
    }
} else {
    echo 'non fare il furbo!';
}
?>