<?php

$link = new mysqli('localhost', 'root@localhost', null) or die(mysqli_error($link));
mysqli_select_db($link, 'sedi') or die( init());

function init() {
global $link;
    $query = 'CREATE DATABASE if not exists sedi;';
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_select_db($link, 'sedi') or die(mysqli_error($link));
    $query = 'CREATE TABLE if not exists sedi(id_sede int auto_increment primary key, nome_sede varchar(100) unique not null );';
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
}

$query = 'select * from sedi;';
$result = mysqli_query($link, $query) or die(mysqli_error($link));
//$record = mysqli_fetch_array($result);
mysqli_close($link);
/*while ($row = mysqli_fetch_array($result)) {
    print_r($row);
}*/

//CREAZIONE RUNTIME SELECT SEDE
echo '<select name="select" id="select_sede">';
while ($row = mysqli_fetch_array($result)) {
    echo '<option id="' . htmlspecialchars($row['nome_sede']) . '" value="' . htmlspecialchars($row['nome_sede']) . '">'
    . htmlspecialchars($row['nome_sede'])
    . '</option>';
}
echo '</select>';

//var x = document.getElementById("select");
//var strUser = x.options[x.selectedIndex].text;
?>
