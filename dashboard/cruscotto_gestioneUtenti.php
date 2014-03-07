<html>
    <head>
        <style>
            #divCONT{
                overflow-y: scroll;
                height: 300px;
                text-align: center;
                margin:0 auto;
                display: table;
            }

            table{
                border-style: 2px solid ;
                border-collapse: collapse;
                margin: 20px;
            }

            td,tr,th{
                padding:4px;

                border-color: black;
                border:2px solid;
            }
        </style>
    </head>
    <?php
    session_start();
    if (isset($_SESSION)) {
        if ($_SESSION['tipo'] == 1) {
            $link = new mysqli('localhost', 'root@localhost', null) or die(mysqli_error($link));
            mysqli_select_db($link, 'pass') or die(mysqli_error($link));

            $query = 'select * from utenti;';
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            mysqli_close($link);
            echo '<div id="divCONT">';
            echo '<table>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>';
                print_r($row['nome']);
                echo '</td>';
                echo '<td>';
                print_r($row['superuser']);
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
        }
    }
    ?>
</html>