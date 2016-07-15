<?php

include '../seguranca.php';

function validaCalory($senhaDigitada) {
    date_default_timezone_set('America/Sao_Paulo');
    $ano = date('Y');
    $mes = date('m');
    $dia = date('d');
    $soma = $ano + $mes + $dia;
    $senhaCalory = $soma * $mes;

    if ($senhaCalory == $senhaDigitada) {
        $_SESSION['senhaCalory'] = $senhaDigitada;
        return TRUE;
        header('location: configuracoes.php');
    } else {
        return FALSE;
        protegeCalory();
    }
}

function protegeCalory() {
    global $_SG;

    if (!isset($_SESSION['senhaCalory'])) {
        header('location: senhaCalory.php');
    }
}
