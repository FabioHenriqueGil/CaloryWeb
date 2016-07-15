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
                        <form method="POST" action="cadastroDisp.php">

                            <div class="row">
                                <div class="large-4 columns">
                                    <label>.:Senha Calory:.</label>
                                    <input type="password" name="senha" placeholder="Senha" />
                                </div>
                            </div>
                            <input type="submit" value="Logar" class="small radius button">
                            <input type="reset" value="Limpar" class="small radius button">
                            <input type="button" onClick="window.location = './configuracoes.php'" 
                                   name=Voltar value="Cancelar" class="small radius button">
                        </form>
                    </center>
                </div> 
            </div>
        </div>
    </body>
</html>




