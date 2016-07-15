<?php

    //Arquivo para efetuar conex�o ao banco de dados
    $host = "localhost:3306"; //Servidor do mysql
    $user = "root"; //Usuario do banco de dados
    $senha = "root"; //senha do banco de dados
    $db = "Oforneto"; //banco de dados

    $dbh = mysql_connect($host, $user, $senha) or die (mysql_error());
    mysql_select_db($db) or die (mysql_error());


?>
