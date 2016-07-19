<?php

//recebe o numero da mesa e a informação(coluna) que deseja do banco de dados, e retorna o dado
function getDadosMesa($cartao, $informacao) {
    $select = "SELECT * FROM mesas where mesa='" . $cartao . "'";
    $selectbd = mysql_query($select);
    $resultado = mysql_fetch_array($selectbd);
    return $resultado[$informacao];
}

//recebe o apelido e o nome da coluna que deseja trazer do banco de dados e returna o dado
function getDadosUsuario($apelido, $informacao) {
    $select = "SELECT * FROM tbvendedor where apel='" . $apelido . "'";
    $apelbd = mysql_query($select);
    $resultado = mysql_fetch_assoc($apelbd);
    return $resultado[$informacao];
}

//recebe o numero da mesa e retorna o numero DE itens QUE estao confirmados naquela mesa
function getNumItensNaMesa($cartao) {
    $select = "SELECT * FROM mesas_itens where link='" . $cartao . "'";
    $selectbd = mysql_query($select);
    $resultado = mysql_num_rows($selectbd);
    return $resultado;
}

//devolve os produtos que ja foram confirmados para aquela mesa, um a um,
//onde, $cartao é a mesa $i é a linha de retorno na consulta
//ideal para se usada com FOR
function getDescItensNaMesa($cartao, $i) {
    $select = "SELECT nome FROM mesas_itens where link='" . $cartao . "'";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, $i, "nome");
    return $resultado;
}

function getLogImp($vendedor) {
    $select = "SELECT mesa FROM logs_cozinha where vendedor='" . $vendedor . "'";
    $bd = mysql_query($select);
    $resultado = mysql_fetch_array($bd);
    return $resultado['mesa'];
}

function getQTDItensNaMesa($cartao, $i) {
    $select = "SELECT qtd FROM mesas_itens where link='" . $cartao . "'";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, $i, "qtd");
    return $resultado;
}

function getVRTotalItensNaMesa($cartao, $i) {
    $select = "SELECT total FROM mesas_itens where link='" . $cartao . "'";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, $i, "total");
    $temp = "R$" . number_format($resultado, 2);
    return implode(",", explode(".", $temp));
}

function getVRTotalNaMesa($cartao) {
    $select = "SELECT sum(total) as soma FROM mesas_itens where link='" . $cartao . "'";
    $bd = mysql_query($select);
    $resultado = mysql_fetch_array($bd);
    $temp = "R$" . number_format($resultado["soma"], 2);
    return implode(",", explode(".", $temp));
    
}

function getTempoItensNaMesa($cartao, $i) {
    date_default_timezone_set('America/Sao_Paulo');
    $select = "SELECT data FROM mesas_itens where link='" . $cartao . "'";
    $bd = mysql_query($select);
    $inicio = mysql_result($bd, $i, "data");
    $fim = date('Y-m-d H:i:s');
    $intervalo = strtotime($fim) - strtotime($inicio);

    $restoSegundos = $intervalo % 86400;
    $dias = ($intervalo - $restoSegundos) / 86400;
    $intervalo = $restoSegundos;

    $restoSegundos = $restoSegundos % 3600;
    $horas = ($intervalo - $restoSegundos) / 3600;
    $intervalo = $restoSegundos;

    $restoSegundos = $restoSegundos % 60;
    $minutos = ($intervalo - $restoSegundos) / 60;

    $segundos = $restoSegundos;

    $tempo = $horas . ":" . $minutos . ":" . $segundos;

    return $tempo;
}

//recebe o numero da mesa e retorna o numero DE itens QUE AINDA NAO estao  FORAM CONFIRMADOS naquela mesa
function getNumItensNaoConfirmadosNaMesa($cartao, $vendedor) {
    $select = "SELECT * FROM tbpedidotablet where link='" . $cartao . "' and codvendedor='" . $vendedor . "'";
    $selectbd = mysql_query($select);
    $resultado = mysql_num_rows($selectbd);
    return $resultado;
}



//devolve os  produtos que ainda nao foram confirmados para aquela mesa, um a um,
//oonde, $cartao é a mesa $i é a linha de retorno na consulta
//ideal para ser usada com FOR
function getCodItensNaoConfirmadosNaMesa($cartao,$vendedor, $i) {
    $select = "SELECT codigoproduto FROM tbpedidotablet where link='" . $cartao . "' and codvendedor='" . $vendedor . "'";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, $i, "codigoproduto");
    return $resultado;
}
//devolve os  produtos que ainda nao foram confirmados para aquela mesa, um a um,
//oonde, $cartao é a mesa $i é a linha de retorno na consulta
//ideal para ser usada com FOR
function getDescItensNaoConfirmadosNaMesa($cartao,$vendedor, $i) {
    $select = "SELECT descricaoproduto FROM tbpedidotablet where link='" . $cartao . "' and codvendedor='" . $vendedor . "'";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, $i, "descricaoproduto");
    return $resultado;
}
function getIncremento($cartao, $vendedor , $i) {   
    $select = "SELECT incremento FROM tbpedidotablet where link='" . $cartao . "' and codvendedor='" . $vendedor . "'";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, $i, "incremento");
    return $resultado;
}

function getQTDItensNaoConfirmadosNaMesa($cartao,$vendedor, $i) {
    $select = "SELECT quantidade FROM tbpedidotablet where link='" . $cartao . "' and codvendedor='" . $vendedor . "'";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, $i, "quantidade");
    return $resultado;
}

function getQTDItensNaoConfirmadosNaMesaInc($cartao,$incremento) {
    $select = "SELECT quantidade FROM tbpedidotablet where link='" . $cartao . "' and incremento='" . $incremento . "'";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, 0, "quantidade");
    return $resultado;
}


function getVRTotalItensNaoConfirmadosNaMesa($cartao,$vendedor, $i) {
    $select = "SELECT valortotal FROM tbpedidotablet where link='" . $cartao . "' and codvendedor='" . $vendedor . "'";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, $i, "valortotal");
    $temp = "R$" . number_format($resultado, 2);
    return implode(",", explode(".", $temp));
}

function getTempoItensNaoConfirmadosNaMesa($cartao, $i) {
    date_default_timezone_set('America/Sao_Paulo');
    $select = "SELECT data FROM tbpedidotablet where link='" . $cartao . "'";
    $bd = mysql_query($select);
    $inicio = mysql_result($bd, $i, "data");
    $fim = date('Y-m-d H:i:s');
    $intervalo = strtotime($fim) - strtotime($inicio);

    $restoSegundos = $intervalo % 86400;
    $dias = ($intervalo - $restoSegundos) / 86400;
    $intervalo = $restoSegundos;

    $restoSegundos = $restoSegundos % 3600;
    $horas = ($intervalo - $restoSegundos) / 3600;
    $intervalo = $restoSegundos;

    $restoSegundos = $restoSegundos % 60;
    $minutos = ($intervalo - $restoSegundos) / 60;

    $segundos = $restoSegundos;

    $tempo = $horas . ":" . $minutos . ":" . $segundos;

    return $tempo;
}

//retorna o endereço de MAC do aparelho que esta conectado ao servidor
function getMAC() {
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $macAddr = false;
    $arp = `arp -a $ipAddress`;
    $lines = explode("\n", $arp);
    foreach ($lines as $line) {
        $cols = preg_split('/\s+/', trim($line));
        if ($cols[0] == $ipAddress) {
            $macAddr = $cols[1];
            return $macAddr;
        }
    }
}

//pega o valor do campo chassi referente a este cartao
function GetMesa($cartao) {
    $sql = "SELECT chassi FROM mesas where mesa='" . $cartao . "'";
    $atualiza = mysql_query($sql);
    $retorno = mysql_result($atualiza, 0, 0);
    return $retorno;
}

//recebe o codigo do cliente e returna o nome dele
function getNomeCliente($codCliente) {
    $selectACliente = "SELECT nome FROM tbcliente where codigo='" . $codCliente . "'";
    $clientebd = mysql_query($selectACliente);
    $resultadoCliente = mysql_fetch_assoc($clientebd);
    $cliente = $resultadoCliente['nome'];
    return $cliente;
}

//recebe o codigo do cliente e returna a soma de suas duplicatas vencidas
function getSomaContasClienteVencidas($codCliente) {
    $selectVencidas = "select sum(saldo)vencidos FROM tbreceber1 where codigo = $codCliente and datavencimento <= CURDATE()";
    $vencidasbd = mysql_query($selectVencidas);
    $resultadovc = mysql_fetch_assoc($vencidasbd);
    $vencidas = $resultadovc['vencidos'];
    return $vencidas;
}

//recebe o codigo do cliente e returna a soma de suas duplicatas que ainda nao estao vencidas
function getSomaContaClienteAVencer($codCliente) {
    $selectAVencer = "select sum(saldo)avencer FROM tbreceber1 where codigo = $codCliente and datavencimento > CURDATE()";
    $aVencerbd = mysql_query($selectAVencer);
    $resultadovc = mysql_fetch_assoc($aVencerbd);
    $aVencer = $resultadovc['avencer'];
    return $aVencer;
}

//recebe o codigo do produto e retorna o subgrupo do produto
function getSubgrupo($codproduto) {
    $selectsg = "SELECT subgrupo FROM tbproduto where codigo='" . $codproduto . "'";
    $subgrupobd = mysql_query($selectsg);
    $resultado = mysql_fetch_assoc($subgrupobd);
    $subgrupo = $resultado['subgrupo'];
    return $subgrupo;
}

//recebe o codigo de um produto e retorna true se ele for agrupavel se nao false 
function getProdutoAgrupa($codproduto) {
    $selectagrupa = "SELECT agrupa FROM tbsubgrupo where nome='" . getSubgrupo($codproduto) . "'";
    $agrupabd = mysql_query($selectagrupa);
    $resultadoag = mysql_fetch_assoc($agrupabd);
    $agrupa = $resultadoag['agrupa'];
    if ($agrupa == "S") {
        return TRUE;
    } else {
        return FALSE;
    }
}

//devolve os usuarios anexados ao dispositivo que esta sendo usado, um a um,
//onde $i é a linha de retorno na consulta
//ideal para se usada com FOR
function getUsuarioAnexado($i) {
    $selectUsuario = "SELECT apel FROM tbvendedor where MAC='" . getMAC() . "' and ativo='S'";
    $usuariobd = mysql_query($selectUsuario);
    $resultadoUsuario = mysql_result($usuariobd, $i, "apel");
    return $resultadoUsuario;
}

//recebe o codigo do produto e a coluna do banco 
//devolve o dado contido
function GetDadosProduto($codigo, $coluna) {
    $select = "SELECT $coluna FROM tbproduto where codigo= $codigo ";
    $bd = mysql_query($select);
    $resultado = mysql_result($bd, 0);
    return $resultado;
}
?>

