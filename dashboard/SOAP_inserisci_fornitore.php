<?php
$sede=trim($_POST['sede']);

$wsdl='http://localhost/sede/cache/'.$sede.'.wsdl';
$soap= new SoapClient($wsdl);
$_POST['nome']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['nome'] );
$_POST['partita_iva']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['partita_iva']);
$_POST['indirizzo_sede']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['indirizzo_sede'] );
$_POST['recapito']= ereg_replace("[^A-Za-z0-9 ]", "", $_POST['recapito']);

$array_invio=array(	1=>NULL,
				2=>$_POST['nome'],
				3=>$_POST['partita_iva'],
				4=>$_POST['indirizzo_sede'],
				5=>$_POST['recapito'],
				);
print_r($soap->inserisci_fornitore($array_invio));
?>