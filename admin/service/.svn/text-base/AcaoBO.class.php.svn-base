<?php

/**
 * Description of AcaoBO
 *
 * @author Daniel Eduardo
 */
class AcaoBO {

    private $acaoDAO;
    public function __construct() {
    	$this->acaoDAO = new AcaoDAO();
    }

	public function excluir($acaoID) {

        try {
            if(!isset ($acaoID) || $acaoID <= 0)
                throw new Exception("Acao não encontrada!!!");

            $this->acaoDAO->excluir($acaoID);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
    public function listar($pagina = 1, $acao = null) {
        try {
            return $this->acaoDAO->listar($pagina, $acao);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
	public function listarAcoesUsuario($usuarioID = null) {
        try {
            return $this->acaoDAO->listarAcoesUsuario($usuarioID);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

	public function listarAcaoPerfil($perfilID = null) {
    	try {
            return $this->acaoDAO->listarAcaoPerfil($perfilID);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
    public function total($acao = null) {
        try {
            return $this->acaoDAO->total($acao);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
    public function salvar($acao){
    	
    	try {
    		
    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
            
        	$this->validaCamposObrigatoriosIncluir($acao);
        	$this->validaRegrasIncluir($acao);
	        $this->acaoDAO->salvar($acao);	
        	
            $conexao->commit();
            
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
	public function alterar($acao){
    	
    	try {
    		
    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
            
        	$acaoAux = new AcaoBean();
        	$acaoAux->setAcaoID($acao->getAcaoID());
        	$acaoAux = $this->acaoDAO->buscarAcao($acaoAux);
        	
        	if ( $acaoAux != null ){
				$this->acaoDAO->alterar($acao);
        	}else{
        		throw new Exception("Acao não encontrada");
        	}     	
        	
            $conexao->commit();
            
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function consultarTodos($acao = null) {
    	return $this->acaoDAO->consultarTodos($acao);	
    }
    
    public function buscarAcao($acao) {
    	return $this->acaoDAO->buscarAcao($acao);	
    }
    
	private function validaCamposObrigatoriosIncluir($acao){
    	
    	if ( Util::isBlank($acao->getNome()) ){
    		throw new Exception("Nome: Campo Obrigatório");
    	}
    	
    }
    
	private function validaRegrasIncluir($acao){
		$acaoAux = new AcaoBean(null, $acao->getNome(), $acao->getPath());
    	$acao = $this->acaoDAO->buscarAcao($acaoAux);
    	if ( $acao != null ){
    		throw new Exception("Já existe uma Ação cadastrada com estas informações.");
    	}
    }
}
?>
