<?php

include '../seguranca/seguranca.php';
protegePagina();
protegeCartao();

$numcartao = $_SESSION['cartaoNumero'];
if (isset($_POST['mesa'])) {
    $mesaOpcional = $_POST['mesa'];
}
$vendedor = $_SESSION['usuarioID'];

function selectincremento($nc) {
    $selectincrementomesas = "SELECT incremento FROM mesas_itens where link='" . $nc . "'";
    $selectincrementomesasbd = mysql_query($selectincrementomesas);
//$cartoesmesas = mysql_fetch_assoc($selectincrementomesasbd);
//return $cartoesmesas['incremento'];
    return $selectincrementomesasbd;
}

function geraincremento($nc) {
    $incrementogerado = 0;
    for ($i = 0; $i < mysql_num_rows(selectincremento($nc)); $i++) {
        $incrementogerado = mysql_result(selectincremento($nc), $i, 0);
    }
    return $incrementogerado + 1;
}

function registraMesa($mesa, $cartao) {
    $sql = "update mesas set chassi ='" . $mesa . "' WHERE mesa=" . $cartao . ";";
    mysql_query($sql);
}

function pegaMesa($cartao) {
    $sql = "SELECT chassi FROM mesas where mesa='" . $cartao . "'";
    $atualiza = mysql_query($sql);
    $retorno = mysql_result($atualiza, 0, 0);
    return $retorno;
}

if (isset($mesaOpcional)) {
    if (!empty($mesaOpcional)) {
        registraMesa($mesaOpcional, $numcartao);
    }
}
$selectpedidotablet = "SELECT * FROM tbpedidotablet where link='" . $numcartao . "' and codvendedor='" . $vendedor . "'";
$selecttbpedidotabletbd = mysql_query($selectpedidotablet);
$grava = NULL;
$cont = 0;
while ($cont < mysql_num_rows($selecttbpedidotabletbd)) {    //sizeof retorna quantas linhas tem a variavel valores
    $valores = mysql_fetch_assoc($selecttbpedidotabletbd);  //monta as linhas com o resultado do banco de dados                    

    $incremento = $valores['incremento'];
    $link = $valores['link'];
    $codigoproduto = $valores['codigoproduto'];
    $descicao = $valores['descricaoproduto'];
    $quantidade = $valores['quantidade'];
    $valorunit = $valores['valorunit'];
    $valortotal = $valores['valortotal'];
    $codvendedor = $valores['codvendedor'];
    $nomevendedor = $valores['nomevendedor'];
    $acrescimo = $valores['acrescimo'];
    $desconto = $valores['desconto'];
    $data = $valores['data'];
    $unidade = $valores['un'];

    $cont++;
    $sqlGrava = "INSERT INTO mesas_itens (`incremento`,`link`,`data`,`codigo`,`nome`,`qtd`,`vrunit`,`total`,`vendedor`,`acrescimo`,`desconto`,`un`) 
            VALUES('" . geraincremento($numcartao) . "','$numcartao','$data','$codigoproduto','$descicao','$quantidade',"
            . "'$valorunit','$valortotal','$nomevendedor','$acrescimo',"
            . "'$desconto','$unidade');";
    $grava = mysql_query($sqlGrava);
}

$sqlGravaImp ="INSERT INTO tbpedido_tablet_imp (id, link, codigoproduto, descricaoproduto, quantidade, valorunit, valortotal, 
                            codvendedor, nomevendedor, acrescimo, desconto, data, agrupado)
                            SELECT null, link, codigoproduto, descricaoproduto, quantidade, valorunit, 
                                valortotal, codvendedor, nomevendedor, acrescimo, desconto, data, agrupado 
                            FROM tbpedidotablet WHERE link='" . $numcartao . "' and codvendedor='" . $vendedor . "'";
$gravaImp= mysql_query($sqlGravaImp);

if (!$grava) {
    echo "<script>
            alert('Pedido negado!')
         </script>
         <script>
            window.location.assign('mesa.php')
         </script>";
} else if (!$gravaImp) {
     echo "<script>
            alert('ATENCAO: o pedido nao foi enviado para a cozinha!')
         </script>
         <script>
            window.location.assign('erroImpressao.php')
         </script>";
     
} else {
    $executavel = "C:\Calory\ImpressaoCozinha.exe";
    $imprime = $executavel . ' ' . $codvendedor . ' ' . $link . ' ' . pegaMesa($numcartao);
    shell_exec($imprime);
    header('location: mesa.php');
    
}
mysql_query("DELETE FROM tbpedidotablet WHERE link='" . $numcartao . "' and codvendedor='" . $vendedor . "'");