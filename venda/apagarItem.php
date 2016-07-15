<?php
include '../seguranca/seguranca.php';
protegePagina();
protegeCartao();

$numerocartao = $_GET['numerocartao'];
$incremento = $_GET['incremento'];

$sql = "DELETE FROM tbpedidotablet WHERE link=" . $numerocartao . " and incremento=".$incremento."";

mysql_query($sql);

header('location: mesa.php');