<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoUsuarioBO
 *
 * @author Daniel Eduardo
 */
class TipoUsuarioBO {

    function __construct() {

    }

    public static function listar($incluirSelecione = false,$incluirAdmin = false){

        $tipos = array();

        if($incluirSelecione)
            $tipos[''] = " -- Selecione -- ";

        if($incluirAdmin)
            $tipos[Constantes::$USUARIO_ADMIN_GERAL] = "Administrador Geral";

        $tipos[Constantes::$USUARIO_ADMIN_SIMPLES] = "Administrador Simples";
        $tipos[Constantes::$USUARIO_SITE] = "Usuário Site";
        $tipos[Constantes::$USUARIO_CONCURSO] = "Usuário Concurso";

        return $tipos;
    }

    public static function buscarPorID($nivelID){
        switch ($nivelID){
            case Constantes::$USUARIO_ADMIN_GERAL : return "Administrador Geral";
            case Constantes::$USUARIO_ADMIN_SIMPLES : return "Administrador Simples";
            case Constantes::$USUARIO_SITE : return "Usuário Site";
            case Constantes::$USUARIO_CONCURSO : return "Usuário Concurso";
            default : return "";
        }
    }

    public static function statusUsuario($status){
        switch ($status){
            case Constantes::$USUARIO_CADASTRADO : return "Cadastrado";
            case Constantes::$USUARIO_EXCLUIDO : return "Excluído";
            default : return "";
        }
    }

}
?>
