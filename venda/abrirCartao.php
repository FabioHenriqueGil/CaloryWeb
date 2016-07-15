<?php

include '../seguranca/seguranca.php';
protegePagina();

$mesa = $_GET['cartao'];
$parcelas = 1;
$parc1 = 30;
$intervaloParc = 30;
$tipoConta = "DINHEIRO";
$loja = 1;
$lancarContas = "S";
$condicional = "N";
$tranferido = "N";
$enviadoCaixa = "S";
$locado = "N";
$codVendedor = $_SESSION['usuarioID'];
$nomeVendedor = $_SESSION['usuarioNome'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');
$dataEntrega = $data;
$horaEntrega = date('G:i');

$selectCliente = "SELECT Nome, codigo FROM tbcliente where automatico = 'S'";
$selectClientebd = mysql_query($selectCliente);
$clientePadrao = mysql_fetch_assoc($selectClientebd);

$nomeCliente = $clientePadrao['Nome'];
$idCliente = $clientePadrao['codigo'];

$selectMesa = "SELECT mesa FROM mesas where mesa= '" . $mesa . "'";
$selectMesabd = mysql_query($selectMesa);
$resMesaJaExiste = mysql_fetch_assoc($selectMesabd);
$mesaJaExiste = $resMesaJaExiste['mesa'];

if (!empty($mesa) &&  $mesaJaExiste == null ) {
    $abreCartao = mysql_query("INSERT INTO mesas (mesa,data,parcelas,parc1,intervaloparc,tipoconta,
    vendedor,codigo,nome,data_entrega,hora_entrega,loja,lancar_contas,
    condicional,transferido,enviado_caixa,locacao) 
    VALUES('$mesa', '$data','$parcelas','$parc1','$intervaloParc',"
 . "'$tipoConta','$nomeVendedor','$idCliente','$nomeCliente',"
 . "'$dataEntrega','$horaEntrega','$loja','$lancarContas',"
 . "'$condicional','$tranferido','$enviadoCaixa','$locado')");
    if ($abreCartao){
         echo "<script>
            alert('Cartao abeto com sucesso!')
         </script>
         <script>
            window.location.assign('cartao.php')
         </script>";
    }
} else {
    echo "<script>
            alert('verifique se os campos estao em branco, ou se o cartao ja foi aberto!')
         </script>
         <script>
            window.location.assign('novoCartao.php')
         </script>";
}