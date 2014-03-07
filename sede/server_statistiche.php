<?php

$db_connect;

/**
 * 
 * @service servizio
 */
class servizio {

    /**
     * calcola_quantita
     * 
     * @param string $articolo Some name (or an empty string)
     * @return Array Response array
     */
    public function calcola_quantita($articolo) {

        $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql');
        //$errore = mysqli_errno($db_connect);
        echo 'connesso a MySql';
        #CREAZIONE DB
        mysqli_select_db($db_connect, 'statistiche') or die('Could not select database');
        $query = 'select nome,sum(quantita) as quantita from cache group by (nome) order by quantita desc limit 10';   //creazione query
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
     * calcola_quantita
     * 
     * @param string $articolo Some name (or an empty string)
     * @return Array Response array
     */
    public function calcola_guadagni($articolo) {

        $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql');
        //$errore = mysqli_errno($db_connect);
        echo 'connesso a MySql';

        mysqli_select_db($db_connect, 'statistiche') or die('Could not select database');

        $query = 'select nome,sum(guadagno) as guadagno from guadagni group by (nome) order by guadagno desc limit 10';   //creazione query
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
     * aggiorna_statistiche
     * 
     * @param string $articolo Some name (or an empty string)
     * @return string Response array
     */
    public function aggiorna_statistiche($articolo) {
        $sede1 = new SoapClient('http://localhost/sede/cache/server_sede1.wsdl');
        $sede2 = new SoapClient('http://localhost/sede/cache/server_sede2.wsdl');
        $sedi = array($sede1, $sede2);

        $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql');
        //$errore = mysqli_errno($db_connect);
        echo 'connesso a MySql';

        mysqli_select_db($db_connect, 'statistiche') or die('Could not select database');

        // Cancello la tabelle se gia esistoto SOLO PER COMODITA
        $query = 'drop table if exists guadagni cascade';
        $result = mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));
        $query = 'CREATE TABLE guadagni(id_prodotto INT AUTO_INCREMENT PRIMARY KEY,' .
                'nome VARCHAR(40) NOT NULL ,' .
                'guadagno DOUBLE NOT NULL)';
        $result = mysqli_query($db_connect, $query) or die('CREAZIONE guadagni ' . mysqli_error($db_connect));
        foreach ($sedi as $sed) {
            foreach ($sed->articoli_disponibili() as $val) {
                $nome = $val['nome'];
                $acquisto = $val['prezzo_acquisto'];
                $vendita = $val['prezzo_vendita'];
                $guad = $vendita - $acquisto;
                $query = "INSERT INTO `guadagni` (`id_prodotto`, `nome`, `guadagno`) VALUES (NULL,'$nome','$guad')";
                $result = mysqli_query($db_connect, $query) or die('inserimento ' . mysqli_error($db_connect));
            }
        }

        // Cancello la tabelle se gia esistoto SOLO PER COMODITA
        $query = 'drop table if exists cache cascade';
        $result = mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));
        $query = 'CREATE TABLE cache(id_prodotto INT AUTO_INCREMENT PRIMARY KEY,' .
                'nome VARCHAR(40) NOT NULL ,' .
                'quantita INT NOT NULL)';
        $result = mysqli_query($db_connect, $query) or die('CREAZIONE cache ' . mysqli_error($db_connect));
        foreach ($sedi as $sed) {
            foreach ($sed->statistiche_mese() as $val) {
                $primo = $val['nome'];
                $secondo = $val['quantita'];
                $query = "INSERT INTO `cache` (`id_prodotto`, `nome`, `quantita`) VALUES (NULL,'$primo','$secondo')";
                $result = mysqli_query($db_connect, $query) or die('inserimento ' . mysqli_error($db_connect));
            }
        }
        mysqli_close($db_connect) or die('problema chiusura connessione db'); // chiudo la connessione con sql

        return 'Data base aggiornato';
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
rename($wsdl, "./cache/server_statistiche.wsdl");
$server = new SoapServer("http://localhost/sede/cache/server_statistiche.wsdl");
$server->setClass("servizio");
$server->handle();
?>