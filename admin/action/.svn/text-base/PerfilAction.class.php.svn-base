<?php

class PerfilAction extends ActionDefault {

	private $perfilBO;
	private $usuarioBO;
	private $acaoBO;
	
    public static $VIEW_PERFIL = "view/perfil/";

    function PerfilAction() {
        parent::__construct();
        $this->perfilBO = new PerfilBO();
        $this->usuarioBO = new UsuarioBO();
        $this->acaoBO = new AcaoBO();
    }

	public function buscar() {
    }

    public function detalhes($conviteID) {
        
    }
    
    public function cadastro() {
    	
    	$this->setValueOutput('cadastro', "true");
    	$this->setValueOutput("perfilSubmenu", "current");
        $this->show(PerfilAction::$VIEW_PERFIL . "cadastro.tpl");
    }

    public function editar($perfilID) {
        $perfil = new PerfilBean();
    	$perfil->setPerfilID($perfilID);
    	
    	$perfil = $this->perfilBO->buscarPerfil($perfil);
    	parent::setObjectOutput($perfil);
    	
    	$this->consultarUsuariosPerfil($perfilID);
    	$this->consultarAcaoPerfil($perfilID);
    	
    	$this->montarComboUsuario();
    	$this->montarComboAcao();
    	
    	$this->setValueOutput('cadastro', "false");
        $this->show(PerfilAction::$VIEW_PERFIL . "cadastro.tpl");
    	
    }

    public function excluir($perfilID) {
    	
    	try{

            $this->perfilBO->excluir($perfilID);

            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
            parent::chain('PerfilAction.listar');

        }catch(Exception $ex){
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    	
    }

    public function listar() {
    	$this->buscaListaPaginada();
    }
    
	private function buscaListaPaginada($pagina = 1, $nome = null){
		
		$perfil = new PerfilBean();
		$perfil->setNome($nome);
		$perfis = $this->perfilBO->listar($pagina, $perfil);
		
        $total = $this->perfilBO->total($perfil);
        parent::setValueOutput('perfis', $perfis);
        parent::setValueOutput('pagina', $pagina);
        parent::setValueOutput('numPaginas', Util::calculaNumPaginas($total));
		
	}
    
	public function tabela($pagina = 1, $nome = null) {
        $this->buscaListaPaginada($pagina, $nome);
        parent::show(PerfilAction::$VIEW_PERFIL.'tabela.tpl');
    }
    
	public function salvar($mensagem) {
    	
    	try{
	    	$perfil = $this->montaBean();
	    	
	    	$cadastro = $this->getValueInput("cadastro");
	    	if ( Util::isBoolean($cadastro) ){
	    		$this->perfilBO->salvar($perfil);
	    	}else{
	    		$this->perfilBO->alterar($perfil);
	    	}
	    	
	    	parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
	    	
	        parent::chain('PerfilAction.listar');
    	}catch (Exception $ex) {
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    }
    
	public function alterar($mensagem) {
    	
    	try{
	    	$perfil = $this->montaBean();
	    	$this->perfilBO->alterar($perfil);
	    	
	    	parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
	    	
	        parent::chain('PerfilAction.listar');
    	}catch (Exception $ex) {
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    }
    
	private function montaBean(){
    	return parent::getObjectInput('PerfilBean', '', '');
    }
    
    public function getView() {
        return PerfilAction::$VIEW_PERFIL;
    }
    
    // -- Usuário --
    
	public function vincularUsuario($usuarioID = null, $perfilID = null){
    	try{
	    	
	    	$this->perfilBO->vincularUsuario($usuarioID, $perfilID);
	    	$this->listarUsuarioPerfil($perfilID);
    	}catch (Exception $ex){
    		parent::setValueOutput("msgVinculoUsuario", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
    		$this->listarUsuarioPerfil($perfilID);
		} 	
    }
    
    public function removerVinculoUsuario($usuarioID = null, $perfilID = null){
    	try{
	    	$this->perfilBO->excluirUsuarioPefil($usuarioID, $perfilID);
	    	$this->listarUsuarioPerfil($perfilID);
    	}catch (Exception $ex){
    		parent::setValueOutput("msgVinculoUsuario", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
    		$this->listarUsuarioPerfil($perfilID);
		}
    }
    
	public function listarUsuarioPerfil($perfilID = null){
    	$this->consultarUsuariosPerfil($perfilID);        
        parent::show(PerfilAction::$VIEW_PERFIL.'tabelaUsuarioVinculado.tpl');
    }
    
    public function consultarUsuariosPerfil($perfilID = null){
    	$usuarioPerfilArray = $this->usuarioBO->listarUsuarioPerfil($perfilID);
        parent::setValueOutput('usuariosPerfilArray', $usuarioPerfilArray);
    }
    
 	private function montarComboUsuario(){
    	$usuarios = $this->usuarioBO->consultarTodos();
    	
    	if ( count($usuarios) > 0 ){
    		parent::setValueOutput('usuariosArray', Util::arrayCombo($usuarios, "usuarioID", "nome"));
    	}
    }
    
    // -- Ações --
    
	public function vincularAcao($acaoID = null, $perfilID = null){
    	try{
	    	
	    	$this->perfilBO->vincularAcao($acaoID, $perfilID);
	    	$this->listarAcaoPerfil($perfilID);
    	}catch (Exception $ex){
    		parent::setValueOutput("msgVinculoAcao", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
    		$this->listarAcaoPerfil($perfilID);
		} 	
    }
    
    public function removerVinculoAcao($acaoID = null, $perfilID = null){
    	try{
	    	$this->perfilBO->excluirAcaoPefil($acaoID, $perfilID);
	    	$this->listarAcaoPerfil($perfilID);
    	}catch (Exception $ex){
    		parent::setValueOutput("msgVinculoAcao", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
    		$this->listarAcaoPerfil($perfilID);
		}
    }
    
	public function listarAcaoPerfil($perfilID = null){
    	$this->consultarAcaoPerfil($perfilID);        
        parent::show(PerfilAction::$VIEW_PERFIL.'tabelaAcaoVinculada.tpl');
    }
    
    public function consultarAcaoPerfil($perfilID = null){
    	$acaoPerfilArray = $this->acaoBO->listarAcaoPerfil($perfilID);
        parent::setValueOutput('acaoPerfilArray', $acaoPerfilArray);
    }
    
 	private function montarComboAcao(){
    	$acoes = $this->acaoBO->consultarTodos();
    	
    	if ( count($acoes) > 0 ){
    		parent::setValueOutput('acoesArray', Util::arrayCombo($acoes, "acaoID", "nome"));
    	}
    }
}

?>