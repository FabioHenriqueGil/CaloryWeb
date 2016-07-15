<?php

include './seguranca.php';

//pega o usuario e senha da pagna index.html
$senhaDigitada = $_POST["senha"];
$usuario = $_POST["usuario"];

validaUsuario($usuario, $senhaDigitada);

header('Location: ../venda/cartao.php');
