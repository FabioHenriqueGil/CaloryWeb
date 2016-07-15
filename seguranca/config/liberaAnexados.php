<?php

include '../seguranca.php';
include '../../funcoesGet.php';
$mac = getMAC();

mysql_query("update tbvendedor set MAC = null WHERE MAC='" . $mac . "'");
header('location: ../../index.php ');


