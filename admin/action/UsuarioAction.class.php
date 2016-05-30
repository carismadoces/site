<?php

class UsuarioAction extends ActionDefault {

	private $usuarioBO;
	
    public static $VIEW_USUARIO = "view/usuario/";

    function UsuarioAction() {
        parent::__construct();
        $this->usuarioBO = new UsuarioBO();
    }

    public function buscar() {
    }

    public function cadastro() {
    	
    	$this->setValueOutput('cadastro', true);
    	$this->setValueOutput("usuarioSubmenu", "current");
        $this->show(UsuarioAction::$VIEW_USUARIO . "cadastro.tpl");
    }

    public function detalhes($conviteID) {
        
    }

    public function editar($usuarioID) {
        $usuario = new UsuarioBean();
    	$usuario->setUsuarioID($usuarioID);
    	
    	$usuario = $this->usuarioBO->buscarUsuario($usuario, true);
    	
    	parent::setObjectOutput($usuario);
		    	
        $this->show(UsuarioAction::$VIEW_USUARIO . "cadastro.tpl");
    	$this->setValueOutput('cadastro', false);
    }

    public function excluir($usuarioID) {
    	
    	try{

            $this->usuarioBO->excluir($usuarioID);

            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
            parent::chain('UsuarioAction.listar');

        }catch(Exception $ex){
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    	
    }

    public function listar() {
    	
    	$this->buscaListaPaginada();
    	
    }
    
	private function buscaListaPaginada($pagina = 1, $login = null){
		
		$usuario = new UsuarioBean();
		$usuario->setLogin($login);
		$usuarios = $this->usuarioBO->listar($pagina, $usuario);
		
        $total = $this->usuarioBO->total($usuario);
        parent::setValueOutput('usuarios', $usuarios);
        parent::setValueOutput('pagina', $pagina);
        parent::setValueOutput('numPaginas', Util::calculaNumPaginas($total));
		
	}
    
	public function tabela($pagina = 1, $login = null) {
        $this->buscaListaPaginada($pagina, $login);
        parent::show(UsuarioAction::$VIEW_USUARIO.'tabela.tpl');
        
    }
    
	public function salvar($mensagem) {
    	
    	try{
	    	$usuario = $this->montaBean();
	    	$this->usuarioBO->salvar($usuario);
	    	
	    	parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
	    	
	        parent::chain('UsuarioAction.listar');
    	}catch (Exception $ex) {
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    }
    
	public function alterar($mensagem) {
    	
    	try{
	    	$usuario = $this->montaBean();
	    	$this->usuarioBO->salvar($usuario);
	    	
	    	parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
	    	
	        parent::chain('UsuarioAction.listar');
    	}catch (Exception $ex) {
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    }
    
	private function montaBean(){
    	
    	$usuario = parent::getObjectInput('UsuarioBean', '', '');
    	
    	
    	return $usuario;
    }
    
    public function getView() {
        return UsuarioAction::$VIEW_USUARIO;
    }
    
}

?>