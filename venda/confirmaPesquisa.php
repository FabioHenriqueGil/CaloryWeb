<?php

include '../seguranca/seguranca.php';
include '../funcoesGet.php';
protegePagina();
protegeCartao();

//for ($i = 0; $i < $_SESSION['quantidadeSubGrupo']; $i++) {
//    
//}


//function selectincremento($nc) {
//    $selectincrementomesas = "SELECT incremento FROM tbpedidotablet where link='" . $nc . "'";
//    $selectincrementomesasbd = mysql_query($selectincrementomesas);
//    return $selectincrementomesasbd;
//}
//
//function geraincremento($nc) {
//    $incrementogerado = 0;
//    for ($i = 0; $i < mysql_num_rows(selectincremento($nc)); $i++) {
//        $incrementogerado = mysql_result(selectincremento($nc), $i, 0);
//    }
//    return $incrementogerado + 1;
//}

$vendedornome = $_SESSION['usuarioNome'];
$vendedorcodigo = $_SESSION['usuarioID'];
$numcartao = $_SESSION['cartaoNumero'];
$acrescimo = 0;
$desconto = 0;
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d G:i:s');
//$subgrupo = $_SESSION['subgrupo'];
$grava = null;


//if (!getProdutoAgrupa($vetorDeProdutos[$posicaoVetor - 1])) {
$qtdAgrupa = NULL;
$fracaoAgp = 0;
foreach ($_REQUEST as $codigoproduto => $QTD) {
    if ($QTD > 0) {
        if (($qtdAgrupa != $QTD && $qtdAgrupa != NULL) || !getProdutoAgrupa($codigoproduto)) {
            $qtdAgrupa = NULL;
            $fracaoAgp = 1;
            break;
        }
        $fracaoAgp = $fracaoAgp + 1;
        $qtdAgrupa = $QTD;
    }
}

//}


$link = $url = $_SERVER['QUERY_STRING'];
if ($fracaoAgp > 1 && $qtdAgrupa != NULL) {
    $_SESSION['quantidadeProdutos'] = $qtdAgrupa;
    
    echo "<script>
            if (window.confirm('Produtos agrupaveis com a mesma quantidade... DESEJA AGRUPAR?')) { 
                    window.location='agrupaItens.php?$link';   
                }else{
                    window.location='insereNaMesa.php?$link'; 
                 }      
        </script>";
} else {
    header("location: insereNaMesa.php?$link");
}





