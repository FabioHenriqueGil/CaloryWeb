<?php
include '../funcoesGet.php';
include '../seguranca/seguranca.php';
protegePagina();
protegeCartao();
$numcartao = $_SESSION['cartaoNumero'];
if (GetMesa($numcartao) == $numcartao) {
    header('location: pedidoConfirmado.php');
}
?>
<html class="no-js" lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Calory Web</title>
        <link rel="icon" type="image/png" href="../img/favicon.png" />
        <link rel="stylesheet" href="../css/foundation.css" />
        <script src="../js/vendor/modernizr.js"></script>
    </head>
    <body>
        <div class="row">
            <div class="large-12 columns">
                <div class="panel radius callout">
                    <center>
                        <button class="small radius">
                            <img src="../img/Logo1.jpg" alt="imagem" width="100%" height="25%">
                        </button><br> 
                        <form method="POST" action="pedidoConfirmado.php">
                            <H4>
                                <U>
                                    <font="tahoma" color="886622" >
                                    .:Cartao aberto =  <?php echo $_SESSION['cartaoNumero']; ?>:.
                                    </font>
                                </u>
                                <div class="row">
                                    <div class="large-4 columns">
                                        <br>
                                        <label>Mesa para entrega do pedido</label>
                                        <input type="text" name="mesa" placeholder="Mesa (Opcional)" value="<?php echo GetMesa($numcartao);?>"  autocomplete="off"/>
                                    </div>

                                </div>
                                <tr width="80" heigth="50">
                                    <td colspan="2" align="center" >
                                        <input type="submit" value="Fechar" class="small radius button">
                                    </td>
                                </tr>
                        </form>
                    </center>
                </div> 
            </div>
        </div>
    </BODY>
</html>