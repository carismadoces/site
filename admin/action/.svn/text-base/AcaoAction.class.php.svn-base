<?php

class AcaoAction extends ActionDefault {

	private $acaoBO;
	
    public static $VIEW_ACAO = "view/acao/";

    function AcaoAction() {
        parent::__construct();
        $this->acaoBO = new AcaoBO();
    }

    public function cadastro() {
    	
    	$this->montaComboAcaoPai();
    	$this->setValueOutput('cadastro', "true");
    	$this->setValueOutput("acaoSubmenu", "current");
        $this->show(AcaoAction::$VIEW_ACAO . "cadastro.tpl");
    }

    public function editar($acaoID) {
        $acao = new AcaoBean();
    	$acao->setAcaoID($acaoID);
    	
    	$acao = $this->acaoBO->buscarAcao($acao);
    	
    	parent::setObjectOutput($acao);
		$this->montaComboAcaoPai();
		
		if ( $acao->getAcaoPai() != null ){
			$this->setValueOutput('acaoPaiID', $acao->getAcaoPai()->getAcaoID());
		}
		
    	$this->setValueOutput('cadastro', "false");
        $this->show(AcaoAction::$VIEW_ACAO . "cadastro.tpl");
    	
    }

    public function excluir($acaoID) {
    	
    	try{

            $this->acaoBO->excluir($acaoID);

            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
            parent::chain('AcaoAction.listar');

        }catch(Exception $ex){
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    	
    }

    public function listar() {
    	
    	$this->buscaListaPaginada();
    	
    }
    
	private function buscaListaPaginada($pagina = 1, $nome = null, $path = null){
		
		$acao = new AcaoBean();
		$acao->setNome($nome);
		$acao->setPath($path);
		$acoes = $this->acaoBO->listar($pagina, $acao);
		
        $total = $this->acaoBO->total($acao);
        parent::setValueOutput('acoes', $acoes);
        parent::setValueOutput('pagina', $pagina);
        parent::setValueOutput('numPaginas', Util::calculaNumPaginas($total));
		
	}
    
	public function tabela($pagina = 1, $identificador = null, $nome = null) {
        $this->buscaListaPaginada($pagina, $identificador, $nome);
        parent::show(AcaoAction::$VIEW_ACAO.'tabela.tpl');
    }
    
	public function salvar($mensagem) {
    	
    	try{
	    	$acao = $this->montaBean();
	    	
	    	$cadastro = $this->getValueInput("cadastro");
	    	$acao->setAcaoPai(new AcaoBean($this->getValueInput("acaoPaiID")));
	    	if ( Util::isBoolean($cadastro) ){
	    		$this->acaoBO->salvar($acao);
	    	}else{
	    		$this->acaoBO->alterar($acao);
	    	}
	    	
	    	parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
	    	
	        parent::chain('AcaoAction.listar');
    	}catch (Exception $ex) {
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    }
    
	public function alterar($mensagem) {
    	
    	try{
	    	$acao = $this->montaBean();
	    	$this->acaoBO->alterar($acao);
	    	
	    	parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
	    	
	        parent::chain('AcaoAction.listar');
    	}catch (Exception $ex) {
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    }
    
	private function montaBean(){
    	$acao = parent::getObjectInput('AcaoBean', '', '');
    	$acaoPai = new AcaoBean();
    	$acaoPai->setAcaoID($this->getValueInput("acaoPaiID"));
    	$acao->setAcaoPai($acaoPai);
    	return $acao;
    }
    
    private function montaComboAcaoPai(){
    	
    	$acoes = $this->acaoBO->consultarTodos();
    	if ( count($acoes) > 0 ){
    		parent::setValueOutput('acaoArray', Util::arrayCombo($acoes, "acaoID", "nome"));
    	}
    }
    
    public function getView() {
        return AcaoAction::$VIEW_ACAO;
    }
    
	public function buscar() {
    }

    public function detalhes($conviteID) {
        
    }    
}

?>