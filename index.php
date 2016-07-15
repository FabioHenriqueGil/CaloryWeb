<?php
include './seguranca/seguranca.php';
include './funcoesGet.php';
if (!empty($_SESSION['usuarioNome'])) {
    $usuario = $_SESSION['usuarioNome'];
} else {
    $usuario = NULL;
}
logof($usuario);
getMAC();
?>
<html class="no-js" lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Calory Web</title>
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="icon" type="image/png" href="img/favicon.png" /> 
        <script src="js/vendor/modernizr.js"></script>
    </head>
    <body>
        <div class="row">
            <div class="large-12 columns">
                <div class="panel radius callout">
                    <center>
                        <button class="small radius">
                            <img src="img/Logo1.jpg" alt="imagem" width="100%" height="25%">
                        </button> 
                        <br>                        
                        <b>V:7B</b>
                        <br><br>
                        <form method="POST" action="seguranca/validarLogin.php">
                            <div class="row">
                                <div class="large-4 columns">                                    
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <label>Usuario</label>
                                            <select name="usuario">
                                                <?php
                                                for ($i = 0; !empty(getUsuarioAnexado($i)); $i++) {
                                                    echo "<option>" . getUsuarioAnexado($i) . "</option>";
                                                }
                                                ?>              
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-4 columns">
                                    <label>Senha</label>
                                    <input type="password" name="senha" placeholder="Senha" />
                                </div>
                            </div>
                            <input type="submit" value="Logar" class="small radius button">
                            <input type="reset" value="Limpar" class="small radius button"><br>
                            <input type="button" onClick="window.location = 'seguranca/config/configuracoes.php'" 
                                   name=Voltar value="Config. do Sistema" class="small radius button">
                        </form>
                    </center>

                </div> 
            </div>
        </div>
    </body>
</html>