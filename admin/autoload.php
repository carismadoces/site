<?php

#if (!function_exists('__autoload')) {
    function loadClass($class) {
        if (strpos($class,'DAO')) {
            require_once("dao/".$class.".class.php");
        }else if (strpos($class,'BO')) {
            require_once("service/".$class.".class.php");
        }else if (strpos($class,'Bean')) {
            require_once("model/".$class.".class.php");
        }else if (strpos($class,'ction')) {
            require_once("action/".$class.".class.php");
        }else if (strpos($class,'Meta')) {
            require_once("meta/".$class.".class.php");        
        }else if (strpos($class,'REL')) {
            require_once("relatorio/".$class.".class.php");
        }else if (strpos($class,'Validator')) {
            require_once("include/php/validator/".$class.".class.php");
        }
    }
#}

    spl_autoload_register('loadClass');

?>
