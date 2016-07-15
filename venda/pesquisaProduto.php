<?php
//include '../seguranca/seguranca.php';
include '../funcoesGet.php';
//protegePagina();
if (!empty($_GET['subgrupo'])) {
    $subgrupo = $_GET['subgrupo'];
} else {
    $subgrupo = null;
}
$_SESSION['subgrupo'] = $subgrupo;
?>
<html class="no-js" lang="pt" >
    <head>
        <title>Calory Web</title>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <link href="../css/bootstrapAntigo.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../css/checkboxProduto.css" /> 


        <link rel="stylesheet" href="../css/styleQTD.css">

        <script src='../js/jquery.js'></script>
        <script src="../js/incrementing.js"></script>

<!--        <script type="text/javascript" language="javascript" src="../js/jquery-1.2.2.pack.js"></script>-->
    </head>
    <body>
        <div class="row">
            <div class="large-12 columns">
                <div class="panel radius callout">
                    <center>                      
                        <div class='table-responsive'>
                            <table class='table table-striped'>                                
                                <tbody> 
                                    <?php
                                    $sql = "SELECT * FROM tbproduto where subgrupo = '$subgrupo' ORDER BY produto";
                                    $res = mysql_query($sql);
                                    $_SESSION['quantidadeSubGrupo'] = mysql_num_rows($res);

                                    if (!empty($subgrupo) && $res) {
                                        for ($i = 0; $i < mysql_num_rows($res); $i++) {
                                            if (isset($_POST[".$i."])) {
                                                echo '<div style="border:1px solid #fc0; padding:10px;margin-top:25px;">';
                                                echo 'The values returned were:  ' . implode(', ', array_values($_POST));
                                                echo '</div>';
                                            }


                                            $produto = mysql_result($res, $i, "produto");
                                            $codigo = mysql_result($res, $i, "codigo");
                                            $idBotao = "botaoChek";
                                            echo '<tr>';
                                            echo "<td>"
                                            . "<input  id=$i name=$i type='checkbox' class='css-checkbox lrg' value='$codigo'/>"
                                            . "<div class='numbers-row'>
                                                <input type='text' name=$codigo id=$i value='0'>
                                                    <div class='inc button'><h3> $produto</h3></div>
                                                </div>"
                                            . "</label>";
                                            $idDiv = $i . "div";
//                                            
                                            ?>
                                        <div id="//<?php echo "$idDiv"; ?>" style="display: none;">
                                            //<?php
//                                                $sqlVariedade = "SELECT DESCRICAO FROM TBPRODUTO_VARIEDADES WHERE CODIGO = $codigo ORDER BY DESCRICAO";
//                                                $resVariedade = mysql_query($sqlVariedade);
//                                                echo '<br>';
//                                                for ($a = 0; $a < mysql_num_rows($resVariedade); $a++) {
//                                                    $idAdicional = $idDiv . $a;
//                                                    $descricaoVariedade = mysql_result($resVariedade, $a, "descricao");
//                                                    //$_SESSION['contAdicional'] = $idAdicional;
//                                                    
                                            ?>
                                            <input  id=//<?php echo $idAdicional; ?> name=<?php echo $idAdicional; ?> 
                                                    type="checkbox" class="css-checkboxADD lrgADD" 
                                                    value='//<?php echo $descricaoVariedade; ?>'/>
                                                    <label for=//<?php echo $idAdicional; ?> name=<?php echo $idAdicional; ?> 
                                                    class="css-labelADD lrgADD vladADD">//<?php echo $descricaoVariedade; ?>
                                        </label>
                                        //<?php
//                                                }
//                                                echo '<br>';
//                                                
                                        ?>
                                        adicional:<input type="text">
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            $("//<?php echo "#" . $i; ?>").click(function (evento) {
                                                if ($("//<?php echo "#" . $i; ?>").attr("checked")) {
                                                    $("//<?php echo "#" . $idDiv; ?>").css("display", "block");
                                                } else {
                                                    $("//<?php echo "#" . $idDiv; ?>").css("display", "none");
                                                }
                                            });
                                        });
                                    </script>
                                    <?php
                                    echo "</td>";
                                    echo '</tr>';
                                }
                            }
                            ?>
                            <tbody>
                        </table>
                    </div>
                    <br>
                </center>
            </div> 
        </div>
    </div>
</body>
</html>