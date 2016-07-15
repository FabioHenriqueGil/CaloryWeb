<?php

include '../seguranca/seguranca.php';
include '../funcoesGet.php';
protegePagina();
protegeCartao();


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
$vendedornome = $_SESSION['usuarioNome'];
$vendedorcodigo = $_SESSION['usuarioID'];
$numcartao = $_SESSION['cartaoNumero'];
$acrescimo = 0;
$desconto = 0;
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d G:i:s');
//$subgrupo = $_SESSION['subgrupo'];
$grava = null;

foreach ($_REQUEST as $codigoproduto => $QTD) {
    if ($QTD > 0) {
        //$descricaoProduto = GetDadosProduto($codigoproduto, "produto");
        $precoTotal = GetDadosProduto($codigoproduto, "vrvenda");
        $valortotal = $precoTotal * $QTD;
        $descricao = GetDadosProduto($codigoproduto, "produto");
        $valorunit = $precoTotal;

        $selectincremento = "SELECT * FROM tbpedidotablet where link='" . $numcartao . "'";
        $selectincrementobd = mysql_query($selectincremento);

        $incremento = geraincremento($numcartao);
        $grava = mysql_query("INSERT INTO tbpedidotablet (`incremento`, `link`, `codigoproduto`,
                        `descricaoproduto`, `quantidade`, `valorunit`, `valortotal`, `codvendedor`, 
                        `nomevendedor`, `acrescimo`, `desconto`, `data`) 
                        VALUES('$incremento', '$numcartao','$codigoproduto','$descricao','$QTD',"
                . "'$valorunit','$valortotal','$vendedorcodigo','$vendedornome','$acrescimo',"
                . "'$desconto','$data')");
        if (!$grava) {
            echo "<script>
        alert('verifique se os dados do pedido estao corretos')
     </script>
     <script>
        window.location.assign('../venda/pesquisa.php')
     </script>";
        }
        
    }
    
}
header('location: pesquisa.php');
