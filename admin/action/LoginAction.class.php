<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginAction
 *
 * @author Daniel Eduardo
 */
class LoginAction extends BaseAction{

	public static $VIEW_LOGIN = "view/login/";

    function __construct() {
        parent::__construct();
    }

    public function login(){
    	$ok = false;

        $usuarioBO = new UsuarioBO();
        $acaoBO = new AcaoBO();

        $login = parent::getValueInput('login');
        $senha = parent::getValueInput('senha');

        $usuario = $usuarioBO->buscarPorLogin($login);

        if(!empty($usuario) && Seguranca::testaSenha($senha, $usuario->getSenha()) === TRUE){
            $ok = true;

            $acoes = $acaoBO->listarAcoesUsuario($usuario->getUsuarioID());
            $usuario->setAcoes($acoes);

            parent::setUserSession($usuario);
        }

        if($ok){
            $url = parent::getValueInput('urlAnterior');

            if( empty($url) ){
            	parent::redirect(basename($_SERVER['PHP_SELF']));
            }else{
				parent::redirect ($url);
            }
        }else{
           parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, ('Usuário ou Senha Inválidos!!!!')));
           parent::voltar();
        }

     }

    public function logout(){
    	parent::setValueOutput('urlAnterior', '');
        parent::setUserSession(null);
        parent::show(LoginAction::$VIEW_LOGIN."login.tpl");
    }

	public function getView() {
        return LoginAction::$VIEW_LOGIN;
    }
}
?>
