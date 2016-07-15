<?php
include '../seguranca/seguranca.php';
include '../funcoesGet.php';
protegePagina();
protegeCartao();
$cartao = $_SESSION['cartaoNumero'];
$ativoNoBanco = getDadosUsuario($_SESSION['usuarioNome'], "ativo");
if ($ativoNoBanco != 'S') {
    expulsaVisitante();
}
?>
<html class="no-js" lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Calory Web</title>
        <link rel="icon" type="image/png" href="../img/favicon.png" />
        <link rel="stylesheet" href="../css/foundation.css" />

        <link rel="stylesheet" href="../css/btnCaloryWeb.css">
        <script src="../js/vendor/modernizr.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/jfuncoes.js"></script>

        <script type="text/javascript">
            function cancelar() {
                if (confirm("CONFIRMA CANCELAMENTO DO PEDIDO?")) {
                    window.location = "cancelarPedido.php";
                }
            }
        </script>

    </head>
    <body> 
        <?PHP
        if (getLogImp($_SESSION['usuarioNome'])) {  
            $mesa = getLogImp($_SESSION['usuarioNome']);
            echo "<script>            
                    alert('ATENCAO: o pedido da mesa $mesa nao foi impresso favor dirija-se ao caixa para reimprimir!')
                </script>";
        }
        ?>

        <div class="row">
            <div class="large-12 columns">
                <div class="panel radius callout">
                    <center>
                        <button class="small radius">
                            <img src="../img/Logo1.jpg" alt="imagem" width="100%" height="25%">
                        </button><br> 

                        <form method="GET" action="perguntaMesa.php">
                            .:Mesa  <b><?php echo $cartao; ?></b>:.
                            <a href="cartao.php">
                                <input id='mesaVoltar' type='button' name='voltar'>
                            </a> 
                            .:Total  <b><?php echo getVRTotalNaMesa($cartao); ?></b>:.

                            <div class='table-responsive'>
                                <table class='table table-striped'>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Qtd</th>
                                            <th>Descricao</th>
                                            <th>Vlr total R$</th>
                                            <th>Tempo</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php
                                        $codVendedor = $_SESSION['usuarioID'];
                                        for ($i = 0; getNumItensNaoConfirmadosNaMesa($cartao, $_SESSION['usuarioID']) > $i; $i++) {
                                            echo '<tr>';
                                            echo "<td><IMG SRC='../img/itenNaoEnviado.png'></td>";
                                            echo "<td>" . getQTDItensNaoConfirmadosNaMesa($cartao, $_SESSION['usuarioID'], $i) . "</td>";
                                            echo "<td><a href = 'adicional.php?posicaovetor=1&"
                                            . "0=".  getCodItensNaoConfirmadosNaMesa($cartao, $_SESSION['usuarioID'], $i).""
                                                    . "&inc=".getIncremento($cartao,$codVendedor, $i)."'>"
                                                    . "" . getDescItensNaoConfirmadosNaMesa($cartao, $_SESSION['usuarioID'], $i) . ""
                                                    . "</a></td>";
                                            echo "<td>" . getVRTotalItensNaoConfirmadosNaMesa($cartao, $_SESSION['usuarioID'], $i) . "</td>";
                                            echo "<td>"
                                            . "<a href='apagarItem.php?numerocartao=$cartao&incremento=" . getIncremento($cartao,$codVendedor, $i) . "'>"
                                            . "<input id='cancelaItem' type='button' name='cancelaItem'>"
                                            . "</a>"
                                            . "</td>";
                                            echo '</tr>';
                                        }
                                        for ($i = 0; getNumItensNaMesa($cartao) > $i; $i++) {
                                            echo '<tr>';
                                            echo "<td><IMG SRC='../img/itemEnviado.png'></td>";
                                            echo "<td>" . getQTDItensNaMesa($cartao, $i) . "</td>";
                                            echo "<td>" . getDescItensNaMesa($cartao, $i) . "</td>";
                                            echo "<td>" . getVRTotalItensNaMesa($cartao, $i) . "</td>";
                                            echo "<td>" . getTempoItensNaMesa($cartao, $i) . "</td>";
                                            echo '</tr>';
                                        }
                                        ?>
                                    <tbody>
                                </table>
                            </div>
                            <BR><BR>                           

                            <a href="pesquisa.php">
                                <input id='mesaAdd' type='button' name='pesquisa'>
                            </a> 
                            <input id='mesaOk' type='submit' name='ok' value=" ">
                            <input id='mesaCancela' type='button' name='cancela' value=" " onclick="cancelar();">                             
                        </form>
                    </center>
                </div> 
            </div>
        </div>
    </body>
</html>