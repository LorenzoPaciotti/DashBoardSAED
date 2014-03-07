<?php 
    session_start();
    session_destroy();
    header('Location: http://localhost');
    echo 'eseguito logout';
    die();
?>
script logout