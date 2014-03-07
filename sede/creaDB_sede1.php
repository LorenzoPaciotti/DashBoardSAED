<?php

//	#prevedere un login speciale (superAdmin) per eseguire questo script solo con le credenziali giuste!


$db_connect = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql');
//$errore = mysqli_errno($db_connect);
echo 'connesso a MySql';
#CREAZIONE DB
$query = 'CREATE DATABASE if not exists magazzino1;';
$result = mysqli_query($db_connect, $query) or die('Impossibile creare db locale');

mysqli_select_db($db_connect, 'magazzino1') or die('Could not select database');
// Cancello la tabelle se gia esistoto SOLO PER COMODITA
$query = 'SET FOREIGN_KEY_CHECKS = 0';
$result = mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));
$query = 'drop table if exists fornitore cascade';
$result = mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));
$query = 'drop table if exists prodotto cascade';
$result = mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));
$query = 'drop table if exists vendita cascade';
$result = mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));
$query = 'SET FOREIGN_KEY_CHECKS = 1';
$result = mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));
// Creo la tabella FORNITORE
$query = 'CREATE TABLE fornitore(id_fornitore INT AUTO_INCREMENT PRIMARY KEY,' .
        'nome VARCHAR(40) NOT NULL ,' .
        'partita_iva INT NOT NULL,' .
        'indirizzo_sede VARCHAR(40) NOT NULL,' .
        'recapito INT NOT NULL)';
$result = mysqli_query($db_connect, $query) or die('CREAZIONE FORNITORE ' . mysqli_error($db_connect));

// Creo la tabella PRODOTTO
$query = 'CREATE TABLE prodotto (id_prodotto INT AUTO_INCREMENT PRIMARY KEY,' .
        'nome VARCHAR(40) NOT NULL ,' .
        'marca VARCHAR(40),' .
        'prezzo_acquisto DOUBLE NOT NULL,' .
        'prezzo_vendita DOUBLE NOT NULL,' .
        'descrizione VARCHAR(40),' .
        'fornitore INT NOT NULL,FOREIGN KEY (fornitore) REFERENCES fornitore(id_fornitore))';
$result = mysqli_query($db_connect, $query) or die('CREAZIONE PRODOTTO ' . mysqli_error($db_connect));


// Creo la tabella VENDITE
$query = 'CREATE TABLE vendita(id_vendita INT AUTO_INCREMENT,
									prodotto INT REFERENCES prodotto(id_prodotto),
									FOREIGN KEY (prodotto) REFERENCES prodotto(id_prodotto),
									quantita INT,
									data VARCHAR(100),
									PRIMARY KEY (id_vendita,prodotto))';
$result = mysqli_query($db_connect, $query) or die('CREAZIONE VENDITE ' . mysqli_error($db_connect));

// popolo la tabella
$query = "INSERT INTO `fornitore` (`id_fornitore`, `nome`, `partita_iva`, `indirizzo_sede`, `recapito`) VALUES (NULL, 'lenovo', '123456', 'via giommetti', '075459345');";
$result = mysqli_query($db_connect, $query) or die('inserimento ' . mysqli_error($db_connect));
$query = "INSERT INTO `fornitore` (`id_fornitore`, `nome`, `partita_iva`, `indirizzo_sede`, `recapito`) VALUES (NULL, 'google', '53843', 'paloalto', '0453445');";
$result = mysqli_query($db_connect, $query) or die('inserimento ' . mysqli_error($db_connect));
$query = "INSERT INTO `fornitore` (`id_fornitore`, `nome`, `partita_iva`, `indirizzo_sede`, `recapito`) VALUES (NULL, 'apple', '454553', 'paloalto', '6552342');";
$result = mysqli_query($db_connect, $query) or die('inserimento ' . mysqli_error($db_connect));
$query = "INSERT INTO `fornitore` (`id_fornitore`, `nome`, `partita_iva`, `indirizzo_sede`, `recapito`) VALUES (NULL, 'acer', '432345', 'via flavia 18', '071235');";
$result = mysqli_query($db_connect, $query) or die('inserimento ' . mysqli_error($db_connect));
$query = "INSERT INTO `prodotto`(`id_prodotto`, `nome`, `marca`, `prezzo_acquisto`, `prezzo_vendita`, `descrizione`, `fornitore`) VALUES (NULL,'serie T430','IBM',700.00,900.00,'professionale',1)";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO `prodotto`(`id_prodotto`, `nome`, `marca`, `prezzo_acquisto`, `prezzo_vendita`, `descrizione`, `fornitore`) VALUES (NULL,'serie E349','IBM',400.00,500.00,'entry level',1)";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO `prodotto`(`id_prodotto`, `nome`, `marca`, `prezzo_acquisto`, `prezzo_vendita`, `descrizione`, `fornitore`) VALUES (NULL,'Ipad','apple',400.00,500.00,'tablet',3)";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO `prodotto`(`id_prodotto`, `nome`, `marca`, `prezzo_acquisto`, `prezzo_vendita`, `descrizione`, `fornitore`) VALUES (NULL,'IPHONE5','apple',700.00,729.00,'smartphone',3)";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO `prodotto`(`id_prodotto`, `nome`, `marca`, `prezzo_acquisto`, `prezzo_vendita`, `descrizione`, `fornitore`) VALUES (NULL,'nexus5','google',300.00,350.00,'smartphone',2)";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO `prodotto`(`id_prodotto`, `nome`, `marca`, `prezzo_acquisto`, `prezzo_vendita`, `descrizione`, `fornitore`) VALUES (NULL,'nexus7','google',500.00,550.00,'tablet',2)";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO `prodotto`(`id_prodotto`, `nome`, `marca`, `prezzo_acquisto`, `prezzo_vendita`, `descrizione`, `fornitore`) VALUES (NULL,'seriex','acer',600.00,1000.00,'Un bel PC',4)";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));

$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '1', '2', 'marzo');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '1', '4', 'aprile');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '2', '6', 'giugno');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '3', '1', 'febbraio');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '3', '5', 'luglio');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '5', '6', 'ottobre');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '2', '4', 'gennaio');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '4', '3', 'giugno');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '4', '12', 'agosto');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '6', '32', 'dicembre');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '7', '6', 'novembre');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '2', '11', 'settembre');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '4', '9', 'novembre');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));
$query = "INSERT INTO vendita (`id_vendita`, `prodotto`, `quantita`, `data`) VALUES (NULL, '1', '7', 'marzo');";
$result = mysqli_query($db_connect, $query) or die('inserimento2 ' . mysqli_error($db_connect));

#CHIUSURA CONNESSIONE SERVER DB
mysqli_close($db_connect) or die('problema chiusura connessione db');
?>
