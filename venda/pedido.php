<?php
include '../seguranca/seguranca.php';
protegePagina();
protegeCartao();
?>
<html class="no-js" lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Calory Web</title>
        <link rel="icon" type="image/png" href="../img/favicon.png" />
        <link rel="stylesheet" href="../css/bootstrap.css" />
        <link rel="stylesheet" href="../css/foundation.css" />
        <link rel="stylesheet" href="../css/btnCaloryWeb.css">
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
                        <form method="GET" id="pedido" name="pedido" action="pedidoFeito.php">
                            <div class="row">
                                <div class="large-1 ">
                                    <a href="mesa.php">
                                        <input id='mesaVoltar' type='button' name='voltar'>
                                    </a> 
                                    <label>Quantidade</label>
                                    <input type="text" name="quantidadeProduto" placeholder="qtd" autocomplete="off"/>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="large-4 columns">
                                    <label>Codigo do produto</label>    
                                    <input type="text" name="codigoProduto" placeholder="Codigo" autocomplete="off"/>
                                </div>
                            </div>
                            <input id='addProduto' type='submit' name='addProduto' value=" ">
                            
                            <input id='clean' type='reset' name='clean' value=" ">
                        </form>
                    </center>
                </div> 
            </div>
        </div>
    </body>
</html>



