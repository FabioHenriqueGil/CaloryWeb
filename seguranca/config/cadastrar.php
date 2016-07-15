<?php
include '../seguranca.php';
include '../../funcoesGet.php';
$mac = getMAC();

//carrega todos os select nescessarios para verificaçao
$select = "SELECT MAC FROM tbmactablet where MAC='" . $mac . "'";

//pega o select e coloca em uma array return
$apelbd = mysql_query($select);
$resultado = mysql_fetch_assoc($apelbd);

// Verifica se a variável $_POST não é vazia...
// ou seja: houve um submit no formulário
if (!empty($_POST)) {
    if (isset($_POST['cadastrar'])) {
        if (empty($resultado['MAC'])) {
            mysql_query("INSERT INTO tbmactablet (codigo,MAC) VALUES(null, '$mac')");
        }
        header('location: configuracoes.php ');
    } else if (isset($_POST['deletar'])) {
        mysql_query("DELETE FROM tbmactablet WHERE MAC='" . $mac . "'");
        mysql_query("update tbvendedor set MAC = null WHERE MAC='" . $mac . "'");
        header('location: ../../index.php ');
    } else if (isset($_POST['cancelar'])) {
        header('location: ../../index.php ');
    }
} else {
    header('location: ../../index.php ');
}
?>



