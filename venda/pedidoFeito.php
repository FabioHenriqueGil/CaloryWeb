<?php

include '../seguranca/seguranca.php';
protegePagina();
protegeCartao();

$quantidade = $_GET["quantidadeProduto"];
$codproduto = $_GET["codigoProduto"];

$selectproduto = "SELECT produto, vrvenda, ativo FROM tbproduto where codigo='" . $codproduto . "'";
$selectprodutobd = mysql_query($selectproduto);
$resultadoproduto = mysql_fetch_assoc($selectprodutobd);

$valortotal = $resultadoproduto['vrvenda'] * $quantidade;
$descricao = $resultadoproduto['produto'];
$valorunit = $resultadoproduto['vrvenda'];
$vendedornome = $_SESSION['usuarioNome'];
$vendedorcodigo = $_SESSION['usuarioID'];
$numcartao = $_SESSION['cartaoNumero'];
$acrescimo = 0;
$desconto = 0;
$produtoativo = $resultadoproduto['ativo'];

date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d G:i:s');

$selectincremento = "SELECT * FROM tbpedidotablet where link='" . $numcartao . "'";
$selectincrementobd = mysql_query($selectincremento);

function selectincremento($nc) {
    $selectincrementomesas = "SELECT incremento FROM tbpedidotablet where link='" . $nc . "'";
    $selectincrementomesasbd = mysql_query($selectincrementomesas);
    return $selectincrementomesasbd;
}

function geraincremento($nc) {
    for ($i = 0; $i < mysql_num_rows(selectincremento($nc)); $i++) {
        $incrementogerado = mysql_result(selectincremento($nc), $i, 0);
    }
    return $incrementogerado + 1;
}
$grava = null;
if ($produtoativo == 'S' && !empty($quantidade) && !empty($codproduto)) {
    $incremento = geraincremento($numcartao);
    $grava = mysql_query("INSERT INTO tbpedidotablet (`incremento`, `link`, `codigoproduto`,
    `descricaoproduto`, `quantidade`, `valorunit`, `valortotal`, `codvendedor`, 
    `nomevendedor`, `acrescimo`, `desconto`, `data`) 
    VALUES('$incremento', '$numcartao','$codproduto','$descricao','$quantidade',"
            . "'$valorunit','$valortotal','$vendedorcodigo','$vendedornome','$acrescimo',"
            . "'$desconto','$data')");
}
if (!$grava) {
    echo "<script>
            alert('verifique se os dados do pedido estao corretos')
         </script>
         <script>
            window.location.assign('../venda/pedido.php')
         </script>";
} else {
    header('location: pedido.php');
}













