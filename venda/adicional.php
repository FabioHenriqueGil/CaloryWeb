<?PHP
include '../seguranca/seguranca.php';
include '../funcoesGet.php';
protegePagina();
protegeCartao();

$posicaoVetor = $_REQUEST['posicaovetor'];
$_SESSION['incremento'] = $_REQUEST['inc'];


if ($posicaoVetor > 0) {
    $CondicaoSQL = "WHERE (codigo = " . $_REQUEST[0] . ")";
    for ($i = 1; $i < $posicaoVetor; $i++) {
        $CondicaoSQL = $CondicaoSQL . " OR (codigo = " . $_REQUEST[$i] . ")";
    }
    $sqlVariedade = "SELECT distinct id_variedade,descricao,valor,tipo_valor FROM tbproduto_variedades " . $CondicaoSQL . ";";
    $resVariedade = mysql_query($sqlVariedade);
//    if (mysql_num_rows($resVariedade) == 0) {
//        header('location: pesquisa.php');
//    }
    $_SESSION['sqlvariedade'] = $sqlVariedade;
    ?>


    <html class="no-js" lang="pt">
        <head>
            <meta encoding="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Calory Web</title>
            <link rel="icon" type="image/png" href="../img/favicon.png" />
            <link rel="stylesheet" href="../css/foundation.css" />
            <script src="../js/vendor/modernizr.js"></script>
            <script language='JavaScript'>
                function SomenteNumero(e) {
                    var tecla = (window.event) ? event.keyCode : e.which;
                    if ((tecla > 47 && tecla < 58))
                        return true;
                    else {
                        if (tecla == 8 || tecla == 0 || tecla == 44)
                            return true;
                        else
                            return false;
                    }
                }
                //                function SemEspaco(e) {
                //                    var tecla = (window.event) ? event.keyCode : e.which;
                //                    if ((tecla > 32 && tecla < 32))
                //                        return true;
                //                        else
                //                            return false;
                //                    }
                //                }
            </script>
        </head>
        <body>
            <div class="row">
                <div class="large-12 columns">
                    <div class="panel radius callout">

                        <center>
                            <button class="small radius">
                                <img src="../img/Logo1.jpg" alt="imagem" width="100%" height="25%">
                            </button><br> 

                            <form method="GET" action="adicionandoVariedade.php">
                                <br><br><br>
                                <div class="row">
                                    <div class="large-4 columns ">
                                        <label>QTD a ser alterado!</label>
                                        <select name="QTD">
                                            <option value="1" selected="">1</option> 
                                            <?PHP
                                            for ($i = 2; $i <= getQTDItensNaoConfirmadosNaMesaInc($_SESSION['cartaoNumero'], $_SESSION['incremento']); $i++) {
                                                echo "<option value=$i>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-4 columns ">
                                        <label>Adicional Livre:</label>
                                        <input type="text" name="addLivre" placeholder="Campo livre" autocomplete="off" />                                                 
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="large-4 columns ">
                                        <label>Acrecimo:</label>
                                        <input type="text" name="acrecimo" placeholder="Valor em Reais" autocomplete="off"  onkeypress='return SomenteNumero(event)' />                                                 
                                    </div>
                                </div>
                                <?php
                                for ($i = 0; $i < mysql_num_rows($resVariedade); $i++) {
                                    $descricaoVariedade = mysql_result($resVariedade, $i, "descricao");
                                    $_SESSION['contAdicional'] = $i;
                                    ?><input  id=<?php echo $i; ?> name = <?php echo $i; ?> type="checkbox" class="css-checkbox lrg" value='<?php echo $descricaoVariedade; ?>'/>
                                    <label for=<?php echo $i; ?> name=<?php echo $i; ?> class="css-label lrg vlad"><?php echo $descricaoVariedade; ?></label>
                                    <?php
                                    echo "<br><br>";
                                }
                                ?>
                                <input type="submit" value="Avancar" class="small radius button">
                                <input type="reset" value="Limpar" class="small radius button">
                            </form>
                        </center>
                    </div> 
                </div>
            </div>
        </body>
    </html>
    <?php
}
?>