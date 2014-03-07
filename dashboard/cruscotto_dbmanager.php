<?php
	#prevedere un login speciale (superAdmin) per eseguire questo script solo con le credenziali giuste!
$db_connect;
function connettiDBManager(){
    #CONNESSIONE SERVER DB
    global $db_connect;
    $db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql');
    //$errore = mysqli_errno($db_connect);
    echo 'connesso a MySql';
}

function CreaDB(){
    connettiDBManager();
    global $db_connect;
    #CREAZIONE DB
    $query = 'CREATE DATABASE if not exists centro_serv_db;';
    $result = mysqli_query($db_connect, $query) or die('Impossibile creare db locale');
    
    #CREAZIONE TABELLE
    mysqli_select_db($db_connect,'centro_serv_db') or die('Could not select database');

    $query = 'CREATE TABLE if not exists SEDI (id_sede INT NOT NULL AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(40) NOT NULL, indirizzo VARCHAR(100), wsdl VARCHAR(1000) NOT NULL)';


    $result = mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error());


    #CHIUSURA CONNESSIONE SERVER DB
    mysqli_close($db_connect) or die ('problema chiusura connessione db');
    echo 'chiusa connessione db';
    return $result;
    
}

function recuperaAziende(){
    #RITORNA LISTA AZIENDE PER STAMPARLE A SCHERMO
    #while ($row=mysql_fetch_row($result)){

    #}
}

?>