<?php
include '../funcoesGet.php';
include './seguranca.php';
protegePagina();
$cartao = $_GET['cartao'];
$_SESSION['cartaoNumero'] = null;



// nesta verssao nao é permitida a abertura de cartoes pelo tablet
if (empty(getDadosMesa($cartao, "mesa")) || empty($_GET['cartao'])) {
   
    //$_SESSION['cartaoNumero'] = $cartao;
    //header("location: ../venda/abrirCartao.php?cartao=$cartao");
//    echo "<script>
//            alert('Este cartao nao foi aberto!')
//         </script>
//         <script>
//            window.location.assign('../venda/cartao.php')
//         </script>";
} else {
    $_SESSION['cartaoNumero'] = $cartao;
    header('location: ../venda/mesa.php');
}
