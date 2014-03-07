<?php
$link = new mysqli('localhost', 'root@localhost', null) or die('errore connessione mysql');
$query = 'CREATE DATABASE if not exists pass;';
$result = mysqli_query($link, $query) or die('Impossibile creare db pass');
mysqli_select_db($link, 'pass') or die('errore selezione pass');

function creaDBUtenti() {
    global $link;

    $query = 'CREATE TABLE IF NOT EXISTS utenti (id INT NOT NULL AUTO_INCREMENT primary key, nome VARCHAR(32) NOT NULL, pswd VARCHAR(32) NOT NULL, superuser bool default false not null)';
    $result = mysqli_query($link, $query) or die('Impossibile creare tabella utenti' . mysqli_error($link));

    $query = "INSERT INTO utenti (nome, pswd, superuser) VALUES ('superuser', MD5('prova'), true);";
    $result = mysqli_query($link, $query) or die('Impossibile creare utente test'. mysqli_error($link));
    $query = "INSERT INTO utenti (nome, pswd) VALUES ('user', MD5('prova'));";
    $result = mysqli_query($link, $query) or die('Impossibile creare utente test'. mysqli_error($link));
    echo 'inizializzato';
}

if (isset($_GET["init"])) {
    creaDBUtenti();
}

if ($_POST) {
    controllo_login();
} else {
    mostra_form();
}

function mostra_form() {
    // mostro un eventuale messaggio
    if (isset($_GET['msg'])) {
        echo '<b>' . htmlentities($_GET['msg']) . '</b><br /><br />';
    }
}

function controllo_login() {
    global $link;
    // recupero il nome e la password inseriti dall'utente
    $nome = trim($_POST['nome']);
    $password = trim($_POST['password']);
    // verifico se devo eliminare gli slash inseriti automaticamente da PHP
    if (get_magic_quotes_gpc()) {
        $nome = stripslashes($nome);
        $password = stripslashes($password);
    }

    // verifico la presenza dei campi obbligatori
    if (!$nome || !$password) {
        $messaggio = urlencode("Non hai inserito il nome o la password");
        header("location: $_SERVER[PHP_SELF]?msg=$messaggio");
        exit;
    }
    // effettuo l'escape dei caratteri speciali per inserirli all'interno della query
    $nome = mysql_real_escape_string($nome);
    $password = mysql_real_escape_string($password);

    // preparo ed invio la query
    $query = "SELECT * FROM utenti WHERE nome = '$nome' AND pswd = MD5('$password')";
    $result = mysqli_query($link, $query) or die('errore nella query ' . mysqli_error($link));

    $record = mysqli_fetch_array($result);
    
    if (!$record) {
        $messaggio = urlencode('Nome utente o password errati');
        header("location: $_SERVER[PHP_SELF]?msg=$messaggio");
        return false;
    } else {
        //INIT SESSIONE
        session_start();
        $_SESSION['username'] = $record['nome'];
        $_SESSION['tipo'] = $record['superuser'];
        
        //
        $messaggio = urlencode('Login avvenuto con successo');
        mysqli_close($link) or die('problema chiusura connessione db');
        header('location: /dashboard/cruscotto.php');
        return true;
    }
}
?>
<html>
    <head>
       <link href="index.css" rel="stylesheet" type="text/css">
       <link href="dashboard/controlli.css" rel="stylesheet" type="text/css">
       <title> Dashboard Online Login</title>
    </head>
    <body>
        <div class="contenitore1">
            <form name="form_login" method="post" action="">
                <div class="contenitore2">
                    
                    <div class="input">
                        <p>
                            Username
                            <input name="nome" type="text" class="textbox" value="" />
                            Password
                            <input name="password" type="password" class="textbox" value="">
                        </p>
                        <input class="bottoneLogin" name="invia" type="submit" value="Invia"/>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>