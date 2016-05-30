<?php

/**
 * Classe que implementa a autorização nas actions
 *
 * @author Daniel Eduardo
 */
class AuthorizationAction extends AuthorizationBaseAction {

    function __construct() {
        parent::__construct();
        $this->config();
    }

    /**
     * Aki deve ficar as configurações de autorização
     */
    public function config(){
        
        /** CONFIGURANDO ACTION LIVRE DE AUTORIZAÇÃO **/
        parent::addActionLivre('LoginAction');
        parent::addActionLivre('IndexAction');

        /** CONFIGURANDO METODOS LIVRE DE AUTORIZAÇÃO **/
        parent::addMetodoLivre('AdministracaoAction', 'index');
        parent::addMetodoLivre('AdministracaoAction', 'acessoNegado');

        /** CONFIGURANDO METODOS LIVRES PARA ADMIN SIMPLES **/
        parent::addMetodoLivre('AdministracaoAction', 'principal',Constantes::$USUARIO_ADMIN_SIMPLES);
        parent::addMetodoLivre('UsuarioAction', 'buscaListaPaginada',Constantes::$USUARIO_ADMIN_SIMPLES);
        parent::addMetodoLivre('UsuarioAction', 'listar',Constantes::$USUARIO_ADMIN_SIMPLES);
        parent::addMetodoLivre('UsuarioAction', 'tabela',Constantes::$USUARIO_ADMIN_SIMPLES);
    }

    /**
     * Verifica se o usuário está autorizado a
     * usar o metodo daquela action
     * @param UsuarioBean $user Usuario
     * @param String $action Nome da Action
     * @param String $metodo Nome do Metodo
     * @return true|false
     */
    public function isAutorizado($user,$action,$metodo){
        //pode tudo
        if($user != null && $user->getTipo() == Constantes::$USUARIO_ADMIN_GERAL) return true;
        
        return parent::isAutorizado($user, $action, $metodo);
    }


}
?>
