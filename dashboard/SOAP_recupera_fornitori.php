<?php
$sede=trim($_POST['sede']);

$wsdl='http://localhost/sede/cache/'.$sede.'.wsdl';
$soap= new SoapClient($wsdl);
$response = $soap->fornitori_disponibili();
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
            echo '<th>nome</th><th>partita iva</th><th>indirizzo sede</th><th>recapito</th>';
            for ($i = 0; $i < $max; $i++) {
                echo '<tr>';
                echo "<td>{$response[$i]['nome']}</td>";
                echo "<td>{$response[$i]['partita_iva']}</td>";
                echo "<td>{$response[$i]['indirizzo_sede']}</td>";
                echo "<td>{$response[$i]['recapito']}</td>";
                echo '</tr>';
            }
            echo '</table>';
            ?>
        </div>
    </body>
</html>