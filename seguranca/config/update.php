<?php
include '../../funcoesGet.php';
include '../seguranca.php';
$MAC = getMAC();

$MACselect = "SELECT MAC FROM tbmactablet where MAC='" . $MAC . "'";

//pega o select e coloca em uma array return
$MACbd = mysql_query($MACselect);
$dadosMAC = mysql_fetch_row($MACbd);


if ($_GET) {

    if ($dadosMAC['0'] == $MAC) {
        $apelido = $_GET['apel'];
        $sql = "update tbvendedor set MAC ='" . $MAC . "' WHERE APEL='" . $apelido . "';";
        $atualiza = mysql_query($sql);
        echo "<script>
            alert('Usuario anexado com sucesso!')
         </script>
         <script>
            window.location.assign('../../index.php')
         </script>";
    } else {
        echo "<script>
            alert('Disp. nao cadastrado!')
         </script>
         <script>
            window.location.assign('../../index.php')
         </script>";
    }
}
?>