<?php
$sede = trim($_POST['sede']);

$wsdl = 'http://localhost/sede/cache/' . $sede . '.wsdl';
$soap = new SoapClient($wsdl);
$response = $soap->articoli_disponibili();
?>
<html>
    <head>
        <link href="css/soap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="divCONT">
            <?php
            $max = count($response);

            echo '<table>';
            echo '<th>nome</th><th>marca</th><th>prezzo acquisto</th><th>prezzo vendita</th><th>descrizione</th><th>fornitore</th>';
            for ($i = 0; $i < $max; $i++) {
                echo '<tr>';
                echo "<td>{$response[$i]['nome']}</td>";
                echo "<td>{$response[$i]['marca']}</td>";
                echo "<td>{$response[$i]['prezzo_acquisto']}</td>";
                echo "<td>{$response[$i]['prezzo_vendita']}</td>";
                echo "<td>{$response[$i]['descrizione']}</td>";
                echo "<td>{$response[$i]['fornitore']}</td>";
                echo '</tr>';
            }
            echo '</table>';
            ?>
        </div>
    </body>
</html>