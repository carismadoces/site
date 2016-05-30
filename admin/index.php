<?php

header('Content-type: text/html; charset=utf-8');

include_once 'autoload.php';
include_once 'include/php/Conexao.class.php';
include_once 'include/php/Constantes.class.php';
include_once 'include/php/Util.class.php';
include_once 'include/php/Seguranca.class.php';
include_once 'include/php/function.resize.php';

date_default_timezone_set('America/Sao_Paulo');

ini_set('display_errors', 1);
ini_set('log_errors', 1);

$action = new SystemAction();

$action->run();

?>
