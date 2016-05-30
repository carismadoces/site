<?php

require_once 'include/php/EnviarEmail.class.php';

/**
 * Description of UsuarioBO
 *
 * @author Daniel Eduardo
 */
class UsuarioBO {

    private $usuarioDAO;
    public function __construct() {
        
    	$this->usuarioDAO = new UsuarioDAO();
    }

	public function excluir($usuarioID) {

        try {
            if(!isset ($usuarioID) || $usuarioID <= 0)
                throw new Exception("Usuário não encontrado!!!");

            $this->usuarioDAO->excluir($usuarioID);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
    public function listar($pagina = 1, $usuario = null) {
        try {
            return $this->usuarioDAO->listar($pagina, $usuario);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
    public function listarUsuarioPerfil($perfilID = null) {
    	try {
            return $this->usuarioDAO->listarUsuarioPerfil($perfilID);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function total($usuario = null) {
        try {
            return $this->usuarioDAO->total($usuario);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
    
    public function salvar($usuario){
    	
    	try {
    		
    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();
            
        	$usuarioAux = new UsuarioBean();
        	$usuarioAux->setUsuarioID($usuario->getUsuarioID());
        	$usuarioAux = $this->usuarioDAO->buscarUsuario($usuarioAux);
        	
        	if ( $usuarioAux == null ){
        		
        		$senhaAux = $usuario->getSenha();
        		
        		$this->validaCamposObrigatoriosIncluir($usuario);
        		
        		$usuarioRegra = new UsuarioBean();
        		$usuarioRegra->setEmail($usuario->getEmail());
        		$this->validaRegrasIncluir($usuarioRegra);
        		
        		$usuario->setDataCriacao(Util::stringFusoHorario(Constantes::$FUSO_BRASILIA));
	        	$usuario->setSenha(Seguranca::criptografaSenha($usuario->getSenha()));
	        	$this->usuarioDAO->salvar($usuario);
	        	
	        	$usuario->setSenha($senhaAux);

	        	$this->enviarEmailCadastro($usuario);
	        		        		        	
        	}else{
        		$this->usuarioDAO->alterar($usuario);
        	}     	
        	
            $conexao->commit();
            
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

	public function buscarUsuario($usuario) {
    	return $this->usuarioDAO->buscarUsuario($usuario);	
    }
    
    public function buscarPorLogin($login) {
    	return $this->usuarioDAO->buscarPorLogin($login);
    }
    
	public function consultarTodos() {
    	return $this->usuarioDAO->consultarTodos();	
    }
    
	private function validaCamposObrigatoriosIncluir($usuario){
    	
    	if ( Util::isBlank($usuario->getNome()) ){
    		throw new Exception("Nome: Campo Obrigatório");
    	}
    	
 		if ( Util::isBlank($usuario->getEmail()) ){
    		throw new Exception("Email: Campo Obrigatório");
    	}
    	
		if ( Util::isBlank($usuario->getLogin()) ){
    		throw new Exception("Login: Campo Obrigatório");
    	}
    }
    
	private function validaRegrasIncluir($usuario){
    	$usuario = $this->usuarioDAO->buscarUsuario($usuario);
    	if ( $usuario != null ){
    		throw new Exception("Já existe um Usuário cadastrado com este Email.");
    	}
    }
    
	public function enviarEmailCadastro($usuario){
    	
		try{
	    	$enviarEmail = new EnviarEmail();    	
	    	$message = '<html><body>' .
						'Olá <b>' . $usuario->getNome() . '</b>,<br/>' .
	    				'Seu cadastro foi realizado com sucesso no sistema Leitor IOE/PA. <br/><br/>' .
	    				'Para acessar o sistema, entre em: <a href="' . Constantes::$URL_SISTEMA . '">' . Constantes::$URL_SISTEMA . '</a> <br/><br/>' .
						'Login: ' . $usuario->getLogin() . '<br/>' .
	    				'Senha: ' . $usuario->getSenha() . '<br/><br/>' .
				'</body></html>';
	    	
	    	$enviarEmail->enviar($usuario->getEmail(), 'Cadastro Usuário Leitor IOE/PA', $message);
		}catch (Exception $err){
	   	}
	    	
    }
}
?>
