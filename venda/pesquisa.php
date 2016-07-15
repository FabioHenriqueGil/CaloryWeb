<?php
include '../seguranca/seguranca.php';
protegePagina();
?>
<html>
    <head>
        <title>Calory Web</title>  
        <style type="text/css">
            #menu-horizontal{
                background-color: #00BFFF; 
                position:fixed;
                z-index:999;
                left:10%;
                right: 10%;
                top:0;
                overflow:hidden;
                border-radius: 10px;
                border-color: #000000;
            }
            #principal{
                margin:5px auto;
                border-color: #000000;
                width:790px;
            }


            .select-style {
                color: red;
                font-size: 20px;
                font-weight:bold;
                white-space: nowrap;
                padding: 5px 8px;
                width: 130%;
                border: none;
                box-shadow: none;
                background-color: transparent;
                background-image: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;                
                padding: 0;
                margin: 0;
                border: 1px solid #ccc;
                width: 100px;
                height: 30px;
                border-radius: 3px;
                overflow: hidden;
                background-color: #fff;
                background: #fff url("../img/selectQTD.gif") no-repeat 90% 50%;                
                outline: none;                
            }
        </style>
        <link rel="stylesheet" href="../css/btnCaloryWeb.css">
        <link href="../css/bootstrapAntigo.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" type="text/javascript" src="../js/MascaraValidacao.js"></script>
        <script language="JavaScript" type="text/javascript" src="../js/jquery-1.10.1.min.js"></script>
        <script language="JavaScript" type="text/javascript" src="../js/combo.js"></script>

    </head>
    <body>
        <form method="GET" action="confirmaPesquisa.php">
            <div id="menu-horizontal">
                <center>    
<!--                   <select class="select-style " name="QTD">                        
                        <option value="1" selected>Qtd: 1</option>
                        <option value="2">Qtd: 2</option>
                        <option value="3">Qtd: 3</option>
                        <option value="4">Qtd: 4</option>
                        <option value="5">Qtd: 5</option>
                        <option value="6">Qtd: 6</option>
                        <option value="7">Qtd: 7</option>
                        <option value="8">Qtd: 8</option>
                        <option value="9">Qtd: 9</option>
                        <option value="10">Qtd: 10</option>
                    </select>-->
                    <input id='addProdutoPesquisa'  type='submit' name='confirmaProduto' value="">
                    <a href="mesa.php">
                        <input id='mesaVoltarPesquisa' type='button' name='voltar'>
                    </a>
                    <input id='cleanPesquisa'  type='button' onclick="location.reload();">
                </center>
            </div>
            <br>
            <br><br>
            <br><br>
            <br>
            <!-- class que define o  container como fluido 100% -->
            <div class="container-fluid">
                <!-- classe para definir uma linha -->
                <div class="row-fluid">
                    <!-- coluna ocupa 2 espaços na gride -->
                    <div class="span4">
                        <ul class="nav nav-tabs nav-stacked">
                            <?php
                            $sql = "SELECT * FROM tbsubgrupo ORDER BY nome";
                            $res = mysql_query($sql);
                            for ($i = 0; $i < mysql_num_rows($res); $i++) {
                                $subgrupo = mysql_result($res, $i, "nome");
                                echo '<li>';
                                echo "<a href='?subgrupo=$subgrupo'>";
                                echo '<h2>' . $subgrupo . '</h2>';
                                echo '</a>';
                                echo '</li>';
                            }
                            ?>

                        </ul>
                    </div>
                    <!-- coluna ocupa 10 espacos na gride -->
                    <div class="span8">

                        <?php
                        //---  Conteúdo Dinâmico     -------------------
                        // verifica se a variavel $_GET['p'] foi criada... include ("conteudo.php");
                        if (!isset($_REQUEST['subgrupo'])) {//varial P nao existir vai para inicial      
                            echo "Inicial";
                        } else {//se nao
                            $p = $_REQUEST['subgrupo'];
                            // verifica se a variavel não está vazia e o arquivo .php existe (se a pagina existe fisicamente)
                            if ((!empty($p))) {//!empty verifica se e fazio  
                                include("pesquisaProduto.php");
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>";
                                echo "Página Incorreta!";
                                echo "</div>";
                            }
                        }

                        // ---  end ---
                        ?>  
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>


