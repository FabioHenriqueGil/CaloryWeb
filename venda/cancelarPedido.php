<?php
include '../seguranca/seguranca.php';
protegePagina();
protegeCartao();

$numerocartao = $_SESSION['cartaoNumero'];
$vendedor = $_SESSION['usuarioID'];
mysql_query("DELETE FROM tbpedidotablet WHERE link='" . $numerocartao . "' and codvendedor='".$vendedor."'");

header('location: mesa.php');