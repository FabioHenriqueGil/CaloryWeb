<?php
include '../seguranca/seguranca.php';
include '../funcoesGet.php';
protegePagina();
protegeCartao();
?>
<html class="no-js" lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Calory Web</title>
        <link rel="stylesheet" href="../css/foundation.css" />
        <link rel="icon" type="../image/png" href="img/favicon.png" /> 
        <script src="../js/vendor/modernizr.js"></script>
    </head>
    <body>
        <div class="row">
            <div class="large-12 columns">
                <div class="panel radius callout">
                    <center>
                        <button class="small radius">
                            <img src="../img/Logo1.jpg" alt="imagem" width="100%" height="25%">
                        </button> 
                        
                        <br><br>
                        <b>Um erro aconteceu! O pedido foi aceito, mas não foi enviado para a cozinha!!!
                        <br>
                        <font size ="5" color = "red">Vá ate o caixa para retirar uma impressão do pedido e levar à cozinha!</font>
                        
                        <br><br>
                        SE ESTE ERRO VOLTAR A ACONTECER,<br> COMUNIQUE-SE COM A CALORY SISTEMAS (44)3649-4444
                        </b><br><br>
                        <input type="button" onClick="window.location = 'mesa.php'" 
                                   name=Voltar value="VOLTAR" class="small radius button">
                        
                    </center>

                </div> 
            </div>
        </div>
    </body>
</html>