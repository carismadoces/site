<?php

class PerfilDAO {

	public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

	public function salvar($perfil) {

        try {
            	
        	$statment = $this->conexao->prepare("INSERT INTO 
            		perfil(
            		nome,
	                ds_perfil
	            )
                VALUES (
                	:nome,
	                :dsPerfil
	                );");
        	
        	$nome = $perfil->getNome();
        	$dsPerfil = $perfil->getDsPerfil();
        	$statment->bindParam(':nome', $nome);
        	$statment->bindParam(':dsPerfil', $dsPerfil);
        	
            if ($statment->execute()) {
                return $perfil;
            } else {
                $erros = $statment->errorInfo();
                throw new Exception("Erro PerfilDAO(salvar): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(salvar):" . $err->getMessage());
        }
    }
    
	public function alterar($perfil) {

        try {
			
            if ( isset($perfil) && $perfil != null) {
            	
                $statment = $this->conexao->prepare("UPDATE perfil SET
                        nome = :nome,
                        ds_perfil  = :dsPerfil
                        WHERE id_perfil = " . $perfil->getPerfilID() );
                
                $statment->bindParam(':nome', $perfil->getNome());
                $statment->bindParam(':dsPerfil', $perfil->getDsPerfil());
            }
			
            if ($statment->execute()) {
                return $perfil;
            } else {
                $erros = $statment->errorInfo();
                throw new Exception("Erro PerfilDAO(alterar): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(alterar):" . $err->getMessage());
        }
    }
    
	public function buscarPorId($perfilID) {
        try {
            $row = $this->conexao->query("SELECT * FROM perfil p WHERE id_perfil = '$perfilID' ")->fetch(PDO::FETCH_SERIALIZE);

            if (isset ($row['id_perfil']) && $row['id_perfil'] > 0) {
                $perfil = new PerfilBean($row['id_perfil'], $row['nome'], $row['ds_perfil']);
                return $perfil;
            } else {
                return null;
            }
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(buscarPorId):" . $err->getMessage());
        }
    }
    
	public function consultarPorUsuario($usuarioID) {
        try {
			
        	$perfis = array();
        	
            $statment = $this->conexao->query("SELECT p.* FROM usuario_perfil up inner join perfil p ON (p.id_perfil = up.id_perfil)
            	WHERE up.id_usuario = $usuarioID");
            
        	foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $perfil = new PerfilBean($row['id_perfil'], $row['nome'], $row['ds_perfil']);
                $perfis[] = $perfis;
            }
            
            return $perfils;
            
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(consultarPorUsuario):" . $err->getMessage());
        }
    }
    
	public function consultarUsuarioPerfil($usuarioID = null, $perfilID = null) {
        try {
			
        	$usuarioPerfilArray = array();
        	
            $statment = $this->conexao->query("SELECT * FROM usuario_perfil WHERE id_usuario = $usuarioID 
            	AND id_perfil = $perfilID");
            
        	foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $usuarioPerfilArray[] = new UsuarioPerfilBean(new UsuarioBean($row['id_usuario']), new PerfilBean($row['id_perfil']));
            }
            
            return $usuarioPerfilArray;
            
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(consultarPorUsuario):" . $err->getMessage());
        }
    }
    
	public function consultarTodos($perfil) {
        try {
			
        	$perfils = array();
        	$where = $this->getWhere($perfil);
        	
            $statment = $this->conexao->query("SELECT * FROM perfil p $where");
        	foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $perfil = new PerfilBean($row['id_perfil'], $row['nome'], $row['ds_perfil']);
                $perfils[] = $perfil;
            }
            
            return $perfils;
            
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(consultarTodos):" . $err->getMessage());
        }
    }
    
    public function buscarPerfil($perfil) {
        try {

        	$where = $this->getWhere($perfil);
        	
            $row = $this->conexao->query("SELECT * FROM perfil p $where")->fetch(PDO::FETCH_SERIALIZE);

            if (isset ($row['id_perfil'])) {
                $perfil = new PerfilBean($row['id_perfil'], $row['nome'], $row['ds_perfil']);
                return $perfil;
            } else {
                return null;
            }
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(buscarPerfil):" . $err->getMessage());
        }
    }

	public function listar($pagina = 1, $perfil = null) {
        try {
			
            $limite = Util::getPaginacao($pagina);
            $where = $this->getWhere($perfil);
			
            $perfils = array();
            $statment = $this->conexao->query("SELECT * FROM perfil p $where $limite ");

            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $perfil = new PerfilBean($row['id_perfil'], $row['nome'], $row['ds_perfil']);
                $perfils[] = $perfil;
            }
            
            return $perfils;
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(listar):" . $err->getMessage());
        }
    }
    
	public function excluir($perfilID) {

		try {
			
            $statment = $this->conexao->prepare("DELETE FROM perfil WHERE id_perfil = :perfilID");
            $statment->bindParam(':perfilID', $perfilID);

            if(!$statment->execute()) {
                $erros = $statment->errorInfo();
                throw new Exception("Erro PerfilDAO (excluir): ".$erros[2]);
            }

        }catch(PDOException $err) {
            throw new Exception("Erro PerfilDAO: (excluir)".$err->getMessage());
        }

    }
    
    public function total($perfil) {
        try {
            $where = $this->getWhere($perfil);
            $total = $this->conexao->query("SELECT COUNT(p.id_perfil) total FROM perfil p $where")->fetch(PDO::FETCH_COLUMN);

            return $total;
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(total):" . $err->getMessage());
        }
    }
    
	private function getWhere($perfil) {

        $where = " WHERE 1 = 1 ";

        if ( isset($perfil) && $perfil != null ){
			if ( $perfil->getPerfilID() != null ) {
	            $where = $where . " AND p.id_perfil = " . $perfil->getPerfilID();
	        }
	        
	    	if ( $perfil->getNome() != null ) {
	            $where = $where . " AND p.nome like '%" . $perfil->getNome() . "%'";
	        }
	        
	 		if ( $perfil->getDsPerfil() != null ) {
	 			$where = $where . " AND p.ds_perfil like '%" . $perfil->getDsPerfil() . "%'";
	        }
        }
        
        return $where;
    }
    
    // -- Vinculo Usuário 
    
	public function vincularUsuario($usuarioID = null, $perfilID = null){
    	
    	try {
        	$statment = $this->conexao->prepare("INSERT INTO 
            		usuario_perfil(
            		id_usuario,
	                id_perfil
	            )
                VALUES (
                	:usuarioID,
	                :perfilID
	                );");
        	
        	$statment->bindParam(':usuarioID', $usuarioID);
        	$statment->bindParam(':perfilID', $perfilID);
        	
        	$sucesso = $statment->execute();
            if (!$sucesso) {
                $erros = $statment->errorInfo();
                throw new Exception("Erro PerfilDAO(vincularUsuario): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(vincularUsuario):" . $err->getMessage());
        }
    }
    
	public function excluirUsuarioPefil($usuarioID = null , $perfilID = null) {

		try {
			
			$andUsuario = "";
			if ( isset($usuarioID) && $usuarioID != null ){
				$andUsuario = " AND id_usuario = $usuarioID";
			}
			
            $statment = $this->conexao->prepare("DELETE FROM usuario_perfil WHERE id_perfil = :perfilID $andUsuario");
            $statment->bindParam(':perfilID', $perfilID);

            if(!$statment->execute()) {
                $erros = $statment->errorInfo();
                throw new Exception("Erro PerfilDAO (excluirUsuarioPefil): ".$erros[2]);
            }

        }catch(PDOException $err) {
            throw new Exception("Erro PerfilDAO: (excluirUsuarioPefil)".$err->getMessage());
        }

    }
    
	// -- Vinculo Ação 
    
	public function vincularAcao($acaoID = null, $perfilID = null){
    	
    	try {
        	$statment = $this->conexao->prepare("INSERT INTO 
            		acao_perfil(
            		id_acao,
	                id_perfil
	            )
                VALUES (
                	:acaoID,
	                :perfilID
	                );");
        	
        	$statment->bindParam(':acaoID', $acaoID);
        	$statment->bindParam(':perfilID', $perfilID);
        	
        	$sucesso = $statment->execute();
            if (!$sucesso) {
                $erros = $statment->errorInfo();
                throw new Exception("Erro PerfilDAO(vincularAcao): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro PerfilDAO(vincularAcao):" . $err->getMessage());
        }
    }
    
	public function excluirAcaoPefil($acaoID = null , $perfilID = null) {

		try {
			
			$andUsuario = "";
			if ( isset($acaoID) && $acaoID != null ){
				$andAcao = " AND id_acao = $acaoID";
			}
			
            $statment = $this->conexao->prepare("DELETE FROM acao_perfil WHERE id_perfil = :perfilID $andAcao");
            $statment->bindParam(':perfilID', $perfilID);

            if(!$statment->execute()) {
                $erros = $statment->errorInfo();
                throw new Exception("Erro PerfilDAO (excluirAcaoPefil): ".$erros[2]);
            }

        }catch(PDOException $err) {
            throw new Exception("Erro PerfilDAO: (excluirAcaoPefil)".$err->getMessage());
        }

    }
}

?>