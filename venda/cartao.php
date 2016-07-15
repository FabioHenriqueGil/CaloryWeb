<?php
include '../seguranca/seguranca.php';
include '../funcoesGet.php';
protegePagina();
?>
<html class="no-js" lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Calory Web</title>
         <link rel="stylesheet" href="../css/btnCaloryWeb.css">
        <link rel="icon" type="image/png" href="../img/favicon.png" />
        <link rel="stylesheet" href="../css/bootstrap.css" />
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
                        <input type="button" class="small radius button" onClick="window.location = '../index.php'" 
                               name=Voltar value="Sair" size=50>
                               <?php
                               echo $_SESSION['usuarioNome'];
                               echo "<br><br><br>";

                               $sql = "SELECT * FROM MESAS ORDER BY (MESA*1)";
                               $res = mysql_query($sql);


                               for ($i = 0; $i < mysql_num_rows($res); $i++) {
                                   $mesa = mysql_result($res, $i, "mesa");
                                   if (($i % 4) == 0) {
                                       echo '<br>';
                                   }
                                   $idBotao;
                                   if (!empty(getNumItensNaMesa($mesa))) {
                                       $idBotao = "mesaOcupada";
                                   } else {
                                       $idBotao = "mesaLivre";
                                   }
                                   echo "<a href='../seguranca/validaCartao.php?cartao=$mesa'>"
                                   . "<input id='$idBotao' type='button' name='$mesa' value='$mesa'>"
                                   . "</a>";
                               }
                               ?>
                        <br>
                    </center>
                </div> 
            </div>
        </div>
    </body>
</html>
