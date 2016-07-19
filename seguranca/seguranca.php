<?php

$_SG['conectaServidor'] = true;    // Abre uma conexao com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessao com um session_start()?

$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' � diferente de 'THIAGO'

$_SG['validaSempre'] = true;       // Deseja validar o usu�rio e a senha a cada carregamento de p�gina?
// Evita que, ao mudar os dados do usu�rio no banco de dado o mesmo contiue logado.

//pega o banco que esta logado no C:\windows\calory.ini
$arquivo = fopen('C:\windows\calory.ini', 'r');
$string = file_get_contents('C:\windows\calory.ini');
fclose($arquivo);
preg_match_all("/Database=(.*)/", $string, $resultadosBanco);
foreach ($resultadosBanco[1] as $resultadoBanco) {
   $banco = $resultadoBanco;
}
$banco = substr($banco,0,-1);
trim($banco);

$_SG['servidor'] = $_SERVER['SERVER_ADDR'];    // Servidor MySQL
$_SG['usuario'] = 'root';          // Usu�rio MySQL
$_SG['senha'] = 'root';               // Senha MySQL
$_SG['banco'] = $banco;

$_SG['paginaLogin'] = '../index.php'; // P�gina de login
$login = $_SG['paginaLogin'];

$_SG['tabela'] = 'tbvendedor';       // Nome da tabela onde os usu�rios s�o salvos
// Verifica se precisa fazer a conex�o com o MySQL
if ($_SG['conectaServidor'] == true) {
    $_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: N�o foi poss�vel conectar-se ao servidor [" . $_SG['servidor'] . "].");
    mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: N�o foi poss�vel conectar-se ao banco de dados [" . $_SG['banco'] . "].");
}

// Verifica se precisa iniciar a sess�o
if ($_SG['abreSessao'] == true) {
    session_start();
}

/**
 * gera a criptografia da senha do usuario
 * * */
function cripsenha($st, $chave = 256) {
    $res = "";
    $len = strlen($st);
    for ($i = 0; $i < $len; $i++) {
        $res = $res . chr(~(ord(substr($st, $i, 1)) - $chave));
    }
    return $res;
}

/**
 * Fun��o para expulsar um visitante
 */
function expulsaVisitante() {
    global $_SG; //variavel global que pode ser usada em qualquer lugar do sistema
// Remove as vari�veis da sess�o (caso elas existam)
    unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
// Manda pra tela de login
    echo "<script>
            alert('Por favor faça seu login!')
         </script>
         <script>
            window.location.assign('../index.php')
         </script>";
}

function logof() {
    session_destroy();
}

function pegarMAC() {
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $macAddr = false;
    $arp = `arp -a $ipAddress`;
    $lines = explode("\n", $arp);
    foreach ($lines as $line) {
        $cols = preg_split('/\s+/', trim($line));
        if ($cols[0] == $ipAddress) {
            $macAddr = $cols[1];
            return $macAddr;
        }
    }
}

function protegeCartao() {  //nao deixa entrar na mesa sem ter escolhido cartão
    if (empty($_SESSION['cartaoNumero'])) {
        echo "<script>
            alert('informe o numero do cartao!')
         </script>
         <script>
            window.location.assign('cartao.php')
         </script>";
    }
}

/**
 * Fun��o que protege uma p�gina
 */
function protegePagina() {
    global $_SG;

    if (!isset($_SESSION['usuarioID']) OR ! isset($_SESSION['usuarioNome'])) {
// N�o h� usu�rio logado, manda pra p�gina de login
        expulsaVisitante();
    } else if (!isset($_SESSION['usuarioID']) OR ! isset($_SESSION['usuarioNome'])) {
// H� usu�rio logado, verifica se precisa validar o login novamente
        if ($_SG['validaSempre'] == true) {
// Verifica se os dados salvos na sess�o batem com os dados do banco de dados
            if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
// Os dados n�o batem, manda pra tela de login
                expulsaVisitante();
            }
        }
    }
}

function tempoInativo() {
    if (isset($_SESSION['ultimoClick']) AND ! empty($_SESSION['ultimoClick'])) {
        $tempoAtual = time();
        if (($tempoAtual - $_SESSION['ultimoClick']) > '60') {
            if (!empty($_SESSION['usuarioNome'])) {
                $usuario = $_SESSION['usuarioNome'];
            } else {
                $usuario = NULL;
            }
            logof($usuario);
            exit();
        } else {
            $_SESSION['ultimoClick'] = time();
        }
    } else {
        $_SESSION['ultimoClick'] = time();
    }
}

function validaUsuario($usuario, $senha) {
    global $_SG;
    include '../funcoesGet.php';
    $senhaBanco = cripsenha(getDadosUsuario($usuario, "senha"));
    if (empty(getDadosUsuario($usuario, "Apel")) || getDadosUsuario($usuario, "MAC") != getMAC() ||
            getDadosUsuario($usuario, "ativo") == 'N' || $senhaBanco != $senha) {
// o usu�rio � inv�lido
        return false;
    } else {
// O registro foi encontrado => o usu�rio � valido
// Definimos dois valores na sess�o com os dados do usu�rio
        $_SESSION['usuarioID'] = getDadosUsuario($usuario, "codigo"); // Pega o valor da coluna 'id do registro encontrado no MySQL
        $_SESSION['usuarioNome'] = getDadosUsuario($usuario, "Apel"); // Pega o valor da coluna 'nome' do registro encontrado no MySQL
// Verifica a op��o se sempre validar o login
        if ($_SG['validaSempre'] == true) {
// Definimos dois valores na sess�o com os dados do login
            $_SESSION['usuarioLogin'] = $usuario;
            $_SESSION['usuarioSenha'] = $senha;
        }
        return true;
    }
}
