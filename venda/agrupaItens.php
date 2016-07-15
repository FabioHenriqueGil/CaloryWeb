<?php
include '../seguranca/seguranca.php';
include '../funcoesGet.php';
protegePagina();
protegeCartao();

$QTDAgrupa = 3;
$posicaoVetor = 0;
$vetorDeProdutos = array();

//for ($i = 0; $i < $_SESSION['quantidadeProdutos']; $i++) {
//    if (!empty($_GET[$i])) {
//        $vetorDeProdutos = (array($posicaoVetor => $_GET[$i]) + $vetorDeProdutos);
//        $posicaoVetor++;
//    }
//}
foreach ($_REQUEST as $codigoproduto => $QTD) {
    if ($QTD > 0) {
        
        $vetorDeProdutos = (array($posicaoVetor => $codigoproduto) + $vetorDeProdutos);
        $posicaoVetor++;
    }
}


if (empty($vetorDeProdutos)) {
    echo 'vetor vazio';
    die();
    //header('location: pesquisa.php');
}
if (!getProdutoAgrupa($vetorDeProdutos[$posicaoVetor - 1])) {
    $QTDAgrupa = 1;
}

if ($QTDAgrupa > $posicaoVetor) {
    $QTDAgrupa = $posicaoVetor;
}


$descricaoProduto = GetDadosProduto($vetorDeProdutos[0], "produto");
$precoTotal = GetDadosProduto($vetorDeProdutos[0], "vrvenda");


if ($QTDAgrupa != 1) {
    $descricaoProduto = "1/$QTDAgrupa" . $descricaoProduto;
    for ($i = 1; $i < $QTDAgrupa; $i++) {
        $descricaoProduto = $descricaoProduto . " *[+]1/$QTDAgrupa" . GetDadosProduto($vetorDeProdutos[$i], "produto");
        $precoTotal = $precoTotal + GetDadosProduto($vetorDeProdutos[$i], "vrvenda");
    }
    $precoTotal = $precoTotal / $QTDAgrupa;
}
 


$quantidade = $_SESSION['quantidadeProdutos'];
$codproduto = $vetorDeProdutos[0];

$valortotal = $precoTotal * $quantidade;
$descricao = $descricaoProduto;
$valorunit = $precoTotal;
$vendedornome = $_SESSION['usuarioNome'];
$vendedorcodigo = $_SESSION['usuarioID'];
$numcartao = $_SESSION['cartaoNumero'];
$acrescimo = 0;
$desconto = 0;

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
    $incrementogerado = 0;
    for ($i = 0; $i < mysql_num_rows(selectincremento($nc)); $i++) {
        $incrementogerado = mysql_result(selectincremento($nc), $i, 0);
    }
    return $incrementogerado + 1;
}


$grava = null;
if (!empty($quantidade) && !empty($codproduto)) {
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
    $_SESSION['incremento'] = $incremento;
    header('location: pesquisa.php');
}