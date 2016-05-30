<?php

class Conexao {

    private static $conexao = null;

    public static function getConexao() {
        if (Conexao::$conexao == null){
            Conexao::$conexao = new PDO(Constantes::$DRIVER_DB, Constantes::$USER_DB, Constantes::$PASS_DB, array(PDO::MYSQL_ATTR_INIT_COMMAND =>  'SET NAMES utf8'));
            Conexao::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return Conexao::$conexao;
    }

}
?>