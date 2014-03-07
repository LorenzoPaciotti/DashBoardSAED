<?php
$sede=trim($_POST['sede']);

$wsdl='http://localhost/sede/cache/'.$sede.'.wsdl';
$soap= new SoapClient($wsdl);
$_POST['nome']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['nome'] );
$_POST['marca']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['marca'] );
$_POST['prezzo_di_acquisto']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['prezzo_di_acquisto'] );
$_POST['prezzo_di_vendita']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['prezzo_di_vendita']);
$_POST['descrizione']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['descrizione'] );
$_POST['fornitore']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['fornitore']);
$array_invio=array(	1=>NULL,
				2=>$_POST['nome'],
				3=>$_POST['marca'],
				4=>$_POST['prezzo_di_acquisto'],
				5=>$_POST['prezzo_di_vendita'],
				6=>$_POST['descrizione'],
				7=>$_POST['fornitore'],
				);
print_r($soap->inserisci_articolo($array_invio));
?>