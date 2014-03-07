<?php

$sede1 = new SoapClient('http://localhost/sede/cache/server_sede1.wsdl');
$sede2 = new SoapClient('http://localhost/sede/cache/server_sede2.wsdl');
$sedi = array($sede1, $sede2);

//connessione e creazione db
$db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql');
//$errore = mysqli_errno($db_connect);
echo 'connesso a MySql';
$query = 'CREATE DATABASE if not exists statistiche;';
$result = mysqli_query($db_connect, $query) or die('Impossibile creare db locale');
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
?>