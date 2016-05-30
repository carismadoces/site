<?php

/**
 * Description of PerfilBO
 *
 * @author Daniel Eduardo
 */
class PerfilBO {

    private $perfilDAO;
    public function __construct() {
    	$this->perfilDAO = new PerfilDAO();
    }

	public function excluir($perfilID) {

        try {
        	
        	$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
        	
            if(!isset ($perfilID) || $perfilID <= 0)
                throw new Exception("Perfil não encontrado!!!");

            $this->perfilDAO->excluirUsuarioPefil(null, $perfilID);
            $this->perfilDAO->excluir($perfilID);
            
            $conexao->commit();
        }catch(Exception $err) {
        	$conexao->rollback();
            throw new Exception($err->getMessage());
        }
    }
    
    public function listar($pagina = 1, $perfil = null) {
        try {
            return $this->perfilDAO->listar($pagina, $perfil);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function total($perfil = null) {
        try {
            return $this->perfilDAO->total($perfil);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
    public function salvar($perfil){
    	
    	try {
    		
    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
            
        	$this->validaCamposObrigatoriosIncluir($perfil);
        	$this->validaRegrasIncluir($perfil);
	        $this->perfilDAO->salvar($perfil);	
        	
            $conexao->commit();
            
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
	public function alterar($perfil){
    	
    	try {
    		
    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
            
        	$perfilAux = new PerfilBean();
        	$perfilAux->setPerfilID($perfil->getPerfilID());
        	$perfilAux = $this->perfilDAO->buscarPerfil($perfilAux);
        	
        	if ( $perfilAux != null ){
				$this->perfilDAO->alterar($perfil);
        	}else{
        		throw new Exception("Perfil não encontrado");
        	}     	
        	
            $conexao->commit();
            
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function consultarTodos($perfil) {
    	return $this->perfilDAO->consultarTodos($perfil);	
    }
    
    public function buscarPerfil($perfil) {
    	return $this->perfilDAO->buscarPerfil($perfil);	
    }
    
    public function consultarPorUsuario($usuarioID) {
    	return $this->consultarPorUsuario($usuarioID);
    }
    
	private function validaCamposObrigatoriosIncluir($perfil){

		if ( Util::isBlank($perfil->getNome()) ){
    		throw new Exception("Nome: Campo Obrigatório");
    	}
    	
    }
    
	private function validaRegrasIncluir($perfil){
    	$perfil = $this->perfilDAO->buscarPerfil(new PerfilBean(null, $perfil->getNome()));
    	if ( $perfil != null ){
    		throw new Exception("Já existe um Perfil cadastrado com este nome.");
    	}
    }
    
	private function validaRegrasVincularUsuario($usuarioID = null, $perfilID = null){
		
		if ( Util::isBlank($usuarioID) ){
    		throw new Exception("Selecione um Usuário.");
    	}
    	
    	$usuarioPerfil = $this->perfilDAO->consultarUsuarioPerfil($usuarioID, $perfilID);
    	if ( $usuarioPerfil != null ){
    		throw new Exception("Este usuário já está vinculado a este perfil.");
    	}
    }
    
    // -- Vinculo Usuário --
    
	public function vincularUsuario($usuarioID = null, $perfilID = null){
    	
    	try {
    		
    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
            
        	$this->validaRegrasVincularUsuario($usuarioID, $perfilID);
	        $this->perfilDAO->vincularUsuario($usuarioID, $perfilID);	
        	
            $conexao->commit();
            
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
	public function excluirUsuarioPefil($usuarioID = null, $perfilID = null){
    	
    	try {
    		
    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
            
	        $this->perfilDAO->excluirUsuarioPefil($usuarioID, $perfilID);	
        	
            $conexao->commit();
            
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
    // -- Vincular Ação -- 
    
	public function vincularAcao($acaoID = null, $perfilID = null){
    	
    	try {
    		
    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
            
        	//$this->validaRegrasVincularAcao($usuarioID, $perfilID);
	        $this->perfilDAO->vincularAcao($acaoID, $perfilID);	
        	
            $conexao->commit();
            
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
	public function excluirAcaoPefil($acaoID = null, $perfilID = null){
    	
    	try {
    		
    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
            
	        $this->perfilDAO->excluirAcaoPefil($acaoID, $perfilID);	
        	
            $conexao->commit();
            
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
	private function validaRegrasVincularAcao($acaoID = null, $perfilID = null){
		
		if ( Util::isBlank($acaoID) ){
    		throw new Exception("Selecione um Usuário.");
    	}
    	
    	$usuarioPerfil = $this->perfilDAO->consultarUsuarioPerfil($usuarioID, $perfilID);
    	if ( $usuarioPerfil != null ){
    		throw new Exception("Esta ação já está vinculado a este perfil.");
    	}
    }
}
?>
