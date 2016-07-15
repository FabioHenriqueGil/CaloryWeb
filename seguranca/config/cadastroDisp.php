<?php
include './segurancaCalory.php';

$senhaDigitada = $_POST["senha"];
validaCalory($senhaDigitada);
protegeCalory();
?>
<html class="no-js" lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Calory Web</title>
        <link rel="icon" type="image/png" href="../../img/favicon.png" />
        <link rel="stylesheet" href="../../css/foundation.css" />
        <script src="../../js/vendor/modernizr.js"></script>
    </head>
    <body>
        <div class="row">
            <div class="large-12 columns">
                <div class="panel radius callout">
                    <center>
                        <button class="small radius">
                            <img src="../../img/Logo1.jpg" alt="imagem" width="100%" height="25%">
                        </button><br> 
                        <form method="POST" action="cadastrar.php">
                            <br>
                            <center>
                                <input type="submit" name='cadastrar' value="Habilitar Dispositivo" class="small radius button">
                                <br><br>
                                <input type="submit" name='deletar' value="Desabilitar dispositivo" class="small radius button">
                                <br><br>
                                <input type="submit" name='cancelar' value="Cancelar Operacao" class="small radius button">                
                            </center>
                        </form>
                    </center>
                </div> 
            </div>
        </div>
    </body>
</html>
