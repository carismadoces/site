<?php

include_once 'autoload.php';
include_once '../include/php/Util.class.php';
include_once '../include/php/Conexao.class.php';
include_once '../model/GenericBean.class.php';
include_once '../include/php/Constantes.class.php';
include_once '../include/php/addendum/annotations.php';
include_once '../include/php/ObjectToXml.class.php';
include_once 'ErrorMessage.class.php';
include_once 'SystemActionWS.class.php';
include_once 'annotation/PathParam.class.php';
include_once 'annotation/RequestMethod.class.php';
include_once '../include/php/Seguranca.class.php';
include_once '../include/php/function.resize.php';

ini_set('display_errors', 1);
ini_set('log_errors', 1); 

ob_start();

$action = new SystemActionWS();
$action->run();

?>
