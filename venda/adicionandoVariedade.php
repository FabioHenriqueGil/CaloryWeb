<?php

include '../seguranca/seguranca.php';
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


$descricaoAdicional = null;
$valorAgregado = null;
$sqlVariedade = $_SESSION['sqlvariedade'];
$resVariedade = mysql_query($sqlVariedade);
//$valorVariedade = mysql_fetch_array($resVariedade);


for ($i = 0; $i < mysql_num_rows($resVariedade); $i++) {
    if (!empty($_REQUEST[$i])) {
        $valorAgregado = $valorAgregado + mysql_result($resVariedade, $i, "valor");
        $descricaoAdicional = $descricaoAdicional . '*[+]' . $_REQUEST[$i];
    }
}


if (!empty($_REQUEST['addLivre'])) {
    $adicionalLivre = $_REQUEST['addLivre'];
    $descricaoAdicional = $descricaoAdicional . '*[+]' . $adicionalLivre;
    $descricaoAdicional = strtoupper($descricaoAdicional);
}

if (!empty($_REQUEST['acrecimo'])) {
    $acrecimoLivre = implode(".", explode(",", $_REQUEST['acrecimo']));
    $valorAgregado = $valorAgregado + $acrecimoLivre;
}




$incremento = $_SESSION['incremento'];
$link = $_SESSION['cartaoNumero'];

$selectp = "SELECT codigoproduto, agrupado, descricaoproduto, valorunit, quantidade, valortotal FROM tbpedidotablet "
        . "where link='" . $link . "' and incremento='" . $incremento . "'";


$p1bd = mysql_query($selectp);
$resultadop = mysql_fetch_assoc($p1bd);
$agrupado = $resultadop['agrupado'];
$descricaoproduto = $resultadop['descricaoproduto'];
$valorunitp = $resultadop['valorunit'];
$quantidade = $resultadop['quantidade'];
$valortotal = $resultadop['valortotal'];

$codigoproduto = $resultadop['codigoproduto'];

if ($descricaoAdicional == null) {

    header('location: mesa.php');
} else {
    $agrupado = "S";
    $descricaoproduto = $descricaoproduto . $descricaoAdicional;
    $valorunitpNovo = $valorunitp + $valorAgregado;
    $valortotalNovo = $valorunitpNovo * $quantidade;
    $sql = null;
    if ($_REQUEST['QTD'] == $quantidade) {
        $sql = "update tbpedidotablet set agrupado ='" . $agrupado . "', "
                . "descricaoproduto ='" . $descricaoproduto . "', "
                . "valorunit ='" . $valorunitpNovo . "', "
                . "valortotal ='" . $valortotalNovo . "' "
                . "WHERE link='" . $link . "' and "
                . "incremento='" . $incremento . "';";
               
        
        $atualiza = mysql_query($sql);
        if ($atualiza) {
            header('location: mesa.php');
        } else {
            //esse erro pode ocorrer caso eceder o nr de caracteres por exempo
            echo error();
        }
    } else {
        $QTDSelecionado = $_REQUEST['QTD'];
        $QTDRestante = $quantidade - $QTDSelecionado;
        $valorTotalRestante = $valorunitp * $QTDRestante;
        $valorTotalNovo = $valorunitpNovo * $QTDSelecionado;
        $sqlQTD = "update tbpedidotablet set quantidade =" .$QTDRestante . ", valortotal = ".$valorTotalRestante."
             WHERE link='" . $link . "' and incremento='" . $incremento . "';";
        $atualizaQTD = mysql_query($sqlQTD);

        if ($atualizaQTD) {
            
            $vendedorcodigo = $_SESSION['usuarioID'];
            $vendedornome = $_SESSION['usuarioNome'];
            $acrescimo = 0;
            $desconto = 0;
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('Y-m-d G:i:s');
            $novoIncremento = geraincremento($link);
            $sqlInsere = "INSERT INTO tbpedidotablet (`incremento`, `link`, `codigoproduto`,
                            `descricaoproduto`, `quantidade`, `valorunit`, `valortotal`, `codvendedor`, 
                            `nomevendedor`, `acrescimo`, `desconto`, `data`) 
                            VALUES('$novoIncremento', '$link','$codigoproduto','$descricaoproduto','$QTDSelecionado',"
                    . "'$valorunitpNovo','$valorTotalNovo','$vendedorcodigo','$vendedornome','$acrescimo',"
                    . "'$desconto','$data')";
            $insere = mysql_query($sqlInsere);
            
            echo $sqlInsere;

            if ($insere) {
                header('location: mesa.php');
            } else {
                echo error();
                $sqlQTD = "update tbpedidotablet set quantidade =" . $quantidade + $_REQUEST['QTD'] . "
                        WHERE link='" . $link . "' and incremento='" . $incremento . "';";
                $atualizaQTD = mysql_query($sqlQTD);
            }
        } else {
            echo error();
        }
    }
}