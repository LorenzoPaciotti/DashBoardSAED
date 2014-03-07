<?php

$db_connect;

/**
 * 
 * @service servizio
 */
class servizio {

    /**
     * inserisci_fornitore
     * 
     * @param Array $articolo 
     * @return string Response string
     */
    public function inserisci_fornitore($articolo) {
        global $db_connect;
        $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql'); //$errore = mysqli_errno($db_connect);
        echo 'connesso a MySql'; //parte di connessione sql
        mysqli_select_db($db_connect, 'magazzino2') or die('Could not select database'); //seleziona database
        $query = "INSERT INTO fornitore(`id_fornitore`, `nome`, `partita_iva`, `indirizzo_sede`, `recapito`) VALUES(
																						'$articolo[1]',
																						'$articolo[2]',
																						'$articolo[3]',
																						'$articolo[4]',
																						'$articolo[5]')"; //creazione query
        $result = mysqli_query($db_connect, $query) or die('Query failed: ' . myisql_error($db_connect)); //effettivo inivio e risposta da sql
        mysqli_close($db_connect) or die('problema chiusura connessione db'); // chiudo la connessione con sql
        return 'Fornitore inserito con successo';
    }

    /**
     * fornitori_disponibili
     * 
     * @param string $articolo 
     * @return Array Response string
     */
    public function fornitori_disponibili($articolo) {

        global $db_connect;
        $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql'); //$errore = mysqli_errno($db_connect);
        echo 'connesso a MySql'; //parte di connessione sql
        mysqli_select_db($db_connect, 'magazzino2') or die('Could not select database'); //seleziona database

        $query = 'SELECT * FROM fornitore';   //creazione query
        $result = mysqli_query($db_connect, $query) or die('Query failed: ' . myisql_error($db_connect)); //effettivo invio e risposta da sql
        // istanzio array di risposta 
        $t = 0;
        while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {  // scorro tutte le tuple di risposta
            foreach ($line as $i => $col_value) {       // scorro le colonne di ogni tupla
                $tupla[$i] = $col_value;    // inserisco valore nell'array
            }
            $array[$t] = $tupla; // inserisco un carattere vuoto per riconoscere una nuova tupla
            $t++;
        }

        mysqli_close($db_connect) or die('problema chiusura connessione db'); // chiudo la connessione con sql
        return $array;
    }

    /**
     * recupera_articoli
     * 
     * @param string $articolo Some name (or an empty string)
     * @return Array Response array
     */
    public function recupera_articolo($articolo) {
        global $db_connect;
        $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql'); //$errore = mysqli_errno($db_connect);
        echo 'connesso a MySql'; //parte di connessione sql
        mysqli_select_db($db_connect, 'magazzino2') or die('Could not select database'); //seleziona database
        $query = 'SELECT * FROM prodotto where nome=' . "'$articolo'";   //creazione query
        $result = mysqli_query($db_connect, $query) or die('Query failed: ' . myisql_error($db_connect)); //effettivo inivio e risposta da sql
        // istanzio array di risposta 
        $t = 0;
        while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {  // scorro tutte le tuple di risposta
            foreach ($line as $i => $col_value) {       // scorro le colonne di ogni tupla
                $tupla[$i] = $col_value;    // inserisco valore nell'array
            }
            $array[$t] = $tupla; // inserisco un carattere vuoto per riconoscere una nuova tupla
            $t++;
        }
        mysqli_close($db_connect) or die('problema chiusura connessione db'); // chiudo la connessione con sql
        return $array;
    }

    /**
     * inserisci_articoli
     * 
     * @param Array $articolo 
     * @return string Response string
     */
    public function inserisci_articolo($articolo) {
        $aggiornaDB = new SoapClient('http://localhost/sede/cache/server_statistiche.wsdl');
        global $db_connect;
        $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql'); //$errore = mysqli_errno($db_connect);
        echo 'connesso a MySql'; //parte di connessione sql
        mysqli_select_db($db_connect, 'magazzino2') or die('Could not select database'); //seleziona database
        $query = "INSERT INTO prodotto (`id_prodotto`, `nome`, `marca`, `prezzo_acquisto`, `prezzo_vendita`, `descrizione`, `fornitore`) VALUES (
																						'$articolo[1]',
																						'$articolo[2]',
																						'$articolo[3]',
																						'$articolo[4]',
																						'$articolo[5]',
																						'$articolo[6]',
																						'$articolo[7]')"; //creazione query
        $result = mysqli_query($db_connect, $query) or die('Query failed: ' . myisql_error($db_connect)); //effettivo inivio e risposta da sql
        mysqli_close($db_connect) or die('problema chiusura connessione db'); // chiudo la connessione con sql
        $risultato = $aggiornaDB->aggiorna_statistiche('');
        return 'Articolo inserito con successo';
    }

    /**
     * articoli_disponibili
     * 
     * @param string $articolo 
     * @return Array Response string
     */
    public function articoli_disponibili($articolo) {

        global $db_connect;
        $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql'); //$errore = mysqli_errno($db_connect);
        echo 'connesso a MySql'; //parte di connessione sql
        mysqli_select_db($db_connect, 'magazzino2') or die('Could not select database'); //seleziona database

        $query = 'SELECT prodotto.nome,marca,prezzo_acquisto,prezzo_vendita,descrizione,fornitore.nome as fornitore FROM prodotto join fornitore on fornitore=id_fornitore';   //creazione query
        $result = mysqli_query($db_connect, $query) or die('Query failed: ' . myisql_error($db_connect)); //effettivo inivio e risposta da sql
        // istanzio array di risposta 
        $t = 0;
        while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {  // scorro tutte le tuple di risposta
            foreach ($line as $i => $col_value) {       // scorro le colonne di ogni tupla
                $tupla[$i] = $col_value;    // inserisco valore nell'array
            }
            $array[$t] = $tupla; // inserisco un carattere vuoto per riconoscere una nuova tupla
            $t++;
        }

        mysqli_close($db_connect) or die('problema chiusura connessione db'); // chiudo la connessione con sql


        return $array;
    }

    /**
     * statistiche_mese
     * 
     * @param string $articolo 
     * @return Array Response string
     */
    public function statistiche_mese($articolo) {

        global $db_connect;
        $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql'); //$errore = mysqli_errno($db_connect);
        echo 'connesso a MySql'; //parte di connessione sql
        mysqli_select_db($db_connect, 'magazzino2') or die('Could not select database'); //seleziona database
        $query = 'select nome,sum(quantita) as quantita from prodotto join vendita on prodotto=id_prodotto group by (nome) order by quantita desc ';   //creazione query
        $result = mysqli_query($db_connect, $query) or die('Query failed: ' . myisql_error($db_connect)); //effettivo inivio e risposta da sql
        // istanzio array di risposta 
        $t = 0;
        while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {  // scorro tutte le tuple di risposta
            foreach ($line as $i => $col_value) {       // scorro le colonne di ogni tupla
                $tupla[$i] = $col_value;    // inserisco valore nell'array
            }
            $array[$t] = $tupla; // inserisco un carattere vuoto per riconoscere una nuova tupla
            $t++;
        }
        mysqli_close($db_connect) or die('problema chiusura connessione db'); // chiudo la connessione con sql


        return $array;
    }

}

require_once('../lib/class.phpwsdl.php');
$soap = PhpWsdl::CreateInstance(
                null, // Set this to your namespace or let PhpWsdl find one
                null, // Set this to your SOAP endpoint or let PhpWsdl determine it
                null, // Set this to a writeable folder to enable caching
                null, // Set this to the filename or an array of filenames of your 
                null, // webservice handler class(es) (be sure to add the file that 
                // contains the handler class as first class definition at 
                // first)
                null, // Set this to the webservice handler class name or let 
                // PhpWsdl determine it
                null, // If you want to define some methods from code, give an array 
                // of PhpWsdlMethod here
                null, // If you want to define some types from code, give an array of 
                // PhpWsdlComplex here
                false, // Set this to TRUE to output WSDL on request and exit after 
                // WSDL has been sent
                false   // Set this to TRUE to run the SOAP server and exit
);
$wsdl = $soap->CreateWsdl();
$wsdl = $soap->GetCacheFileName();
rename($wsdl, "./cache/server_sede2.wsdl");
$server = new SoapServer("http://localhost/sede/cache/server_sede2.wsdl");
$server->setClass("servizio");
$server->handle();
?>