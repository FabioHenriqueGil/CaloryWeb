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
                        <p>
                            <b>
                                <H3>
                                    Anexar um usuario neste dispositivo
                                </H3>
                            </b>
                        </p>
                        <p>
                            <?php
                            include './segurancaCalory.php';
                            include '../../funcoesGet.php';
                            $MAC = getMAC();

                            $sql = "SELECT APEL FROM TBVENDEDOR ORDER BY APEL";
                            $res = mysql_query($sql);

                            $sqlativo = "SELECT ATIVO FROM TBVENDEDOR ORDER BY APEL";
                            $resAtivo = mysql_query($sqlativo);

                            $sqllogado = "SELECT MAC FROM TBVENDEDOR ORDER BY APEL";
                            $reslogado = mysql_query($sqllogado);

                            for ($i = 0; $i < mysql_num_rows($res); $i++) {
                                $apel = mysql_result($res, $i, "apel");

                                $ativo = mysql_result($resAtivo, $i, "ativo");
                                $logado = mysql_result($reslogado, $i, "MAC");
                                if ($ativo == "S" && $logado == null) {
                                    ?>
                                    <input type="hidden"  name="<?php echo $apel
                                    ?>" value="<?php echo $apel ?>" />
                                    <button class="small radius button" onclick="window.location = 'update.php?apel=<?php echo $apel ?>'" >
                                        <?php echo $apel ?>
                                    </button>
                                    <br>
                                    <?php
                                }
                            }
                            ?>
                        </p>
                        <form method="GET" action="update.php">
                            <p>
                                <b>
                                    <H5>Outras config.</H5>
                                </b>
                            </p>                            
                            <input type="button" onClick="window.location = 'senhaCalory.php'" 
                                   name=Voltar value="Cadast. de Disp" class="medium success button"><br>
                            <input type="button" onClick="window.location = 'liberaAnexados.php'" 
                                   name=Voltar value="Liberar usuarios anexados" class="medium alert button"><br>
                            <input type="button" onClick="window.location = '../../index.php'" 
                                   name=Voltar value="Voltar" class="small round button"><br>
                        </form>
                    </center>
                </div> 
            </div>
        </div>
    </BODY>
</html>
















