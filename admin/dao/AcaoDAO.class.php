<?php

class AcaoDAO {

	public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

	public function salvar($acao) {

        try {
            	
        	$statment = $this->conexao->prepare("INSERT INTO 
            		acao(
	                nome,
	                path,
	                id_acao_pai
	            )
                VALUES (
	                :nome,
	                :path,
	                :acaoPaiID
	                );");
        	
        	$nome = $acao->getNome();
        	$path = $acao->getPath();
        	
        	$acaoPaiID = null;
        	if ( $acao->getAcaoPai() != null && $acao->getAcaoPai()->getAcaoID() != null ){
        		$acaoPaiID = $acao->getAcaoPai()->getAcaoID();
        	}
        	$statment->bindParam(':nome', $nome);
        	$statment->bindParam(':path', $path);
        	$statment->bindParam(':acaoPaiID', $acaoPaiID);
        	
            if ($statment->execute()) {
                return $acao;
            } else {
                $erros = $statment->errorInfo();
                throw new Exception("Erro AcaoDAO(salvar): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO(salvar):" . $err->getMessage());
        }
    }
    
	public function alterar($acao) {

        try {
			
            if ( isset($acao) && $acao != null) {
            	
                $statment = $this->conexao->prepare("UPDATE acao SET
                        nome = :nome,
                        path  = :path,
                        id_acao_pai = :acaoPaiID
                        WHERE id_acao = " . $acao->getAcaoID() );

            	$acaoPaiID = null;
                if ( $acao->getAcaoPai() != null && $acao->getAcaoPai()->getAcaoID() > 0){
                	$acaoPaiID = $acao->getAcaoPai()->getAcaoID();		
                }
                
                $statment->bindParam(':nome', $acao->getNome());
                $statment->bindParam(':path', $acao->getPath());
                $statment->bindParam(':acaoPaiID', $acaoPaiID);
            }
			
            if ($statment->execute()) {
                return $acao;
            } else {
                $erros = $statment->errorInfo();
                throw new Exception("Erro AcaoDAO(alterar): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO(alterar):" . $err->getMessage());
        }
    }
    
	public function buscarPorId($acaoID) {
        try {
            $row = $this->conexao->query("SELECT a.id_acao, a.nome, a.path, ap.id_acao id_acao_pai, ap.nome nome_pai, ap.path path_pai FROM acao a
            	inner join acao ap ON (ap.id_acao = a.id_acao_pai) 
            	WHERE a.id_acao = '$acaoID' ")->fetch(PDO::FETCH_SERIALIZE);

            if (isset ($row['id_acao']) && $row['id_acao'] > 0) {
            	$acaoPai = new AcaoBean($row['id_acao_pai'], $row['nome_pai'], $row['path_pai']);
                $acao = new AcaoBean($row['id_acao'], $row['nome'], $row['path'], $acaoPai);
                return $acao;
            } else {
                return null;
            }
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO(buscarPorId):" . $err->getMessage());
        }
    }
    
	public function consultarTodos($acao = null) {
        try {
			
        	$acoes = array();
        	$where = $this->getWhere($acao);
        	
            $statment = $this->conexao->query("SELECT * FROM acao a $where");
        	foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $acao = new AcaoBean($row['id_acao'], $row['nome'], $row['path']);
                $acoes[] = $acao;
            }
            
            return $acoes;
            
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO(consultarTodos):" . $err->getMessage());
        }
    }
    
	public function consultarFilhos($acaoPaiID = null) {
        try {
			
        	$acoes = array();
        	
            $statment = $this->conexao->query("SELECT * FROM acao a WHERE id_acao_pai = $acaoPaiID");
        	foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $acao = new AcaoBean($row['id_acao'], $row['nome'], $row['path'], $row['id_acao_pai']);
                $acoes[] = $acao;
            }
            
            return $acoes;
            
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO(consultarFilhos):" . $err->getMessage());
        }
    }
    
    public function buscarAcao($acao) {
        try {

        	$where = $this->getWhere($acao);
        	
            $row = $this->conexao->query("SELECT * FROM acao a $where")->fetch(PDO::FETCH_SERIALIZE);

            if (isset ($row['id_acao'])) {
                $acao = new AcaoBean($row['id_acao'], $row['nome'], $row['path'], new AcaoBean($row['id_acao_pai']));
                return $acao;
            } else {
                return null;
            }
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO(buscarAcao):" . $err->getMessage());
        }
    }

	public function listar($pagina = 1, $acao = null) {
        try {
			
            $limite = Util::getPaginacao($pagina);
            $where = $this->getWhere($acao);
			
            $acoes = array();
            $statment = $this->conexao->query("SELECT * FROM acao a $where AND id_acao_pai is null $limite ");

            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $acao = new AcaoBean($row['id_acao'], $row['nome'], $row['path']);
                
                $acao->setFilhos($this->consultarFilhos($row['id_acao']));              
                $acoes[] = $acao;
            }
            
            return $acoes;
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO(listar):" . $err->getMessage());
        }
    }
    
	public function listarAcaoPerfil($perfilID = null) {
        try {
			
            $acaoPerfilArray = array();
            
            $columns = " a.id_acao, a.nome, a.path, a.id_acao_pai, p.id_perfil, p.nome nome_perfil, p.ds_perfil ";
            $statment = $this->conexao->query("SELECT $columns FROM acao a
            	INNER JOIN acao_perfil ap ON (ap.id_acao = a.id_acao)
            	INNER JOIN perfil p ON (p.id_perfil = ap.id_perfil)
            	WHERE ap.id_perfil = $perfilID");

            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
            	
            	$acao = new AcaoBean($row['id_acao'], $row['nome'], $row['path'], new AcaoBean($row['id_acao_pai']));
            	$perfil = new PerfilBean($row['id_perfil'], $row['nome_perfil'], $row['ds_perfil']);
            	$acaoPerfil = new AcaoPerfilBean($acao, $perfil);
            	
                $acaoPerfilArray[] = $acaoPerfil;
            }
            
            return $acaoPerfilArray;
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO:" . $err->getMessage());
        }
    }
    
	public function listarAcoesUsuario($usuarioID = null) {
        try {
			
            $acaoArray = array();
            
            $columns = " a.id_acao, a.nome, a.path, a.id_acao_pai";
            $statment = $this->conexao->query("SELECT $columns FROM acao a
            	INNER JOIN acao_perfil ap ON (ap.id_acao = a.id_acao)
            	INNER JOIN usuario_perfil up ON (up.id_perfil = ap.id_perfil)
            	WHERE up.id_usuario = $usuarioID");

            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $acaoArray[] = new AcaoBean($row['id_acao'], $row['nome'], $row['path'], new AcaoBean($row['id_acao_pai']));
            }
            
            return $acaoArray;
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO:" . $err->getMessage());
        }
    }
    
	public function excluir($acaoID) {

		try {
			
            $statment = $this->conexao->prepare("DELETE FROM acao WHERE id_acao = :acaoID");
            $statment->bindParam(':acaoID', $acaoID);

            if(!$statment->execute()) {
                $erros = $statment->errorInfo();
                throw new Exception("Erro AcaoDAO (excluir): ".$erros[2]);
            }

        }catch(PDOException $err) {
            throw new Exception("Erro AcaoDAO: (excluir)".$err->getMessage());
        }

    }
    
    public function total($acao) {
        try {
            $where = $this->getWhere($acao);
            $total = $this->conexao->query("SELECT COUNT(a.id_acao) total FROM acao a $where")->fetch(PDO::FETCH_COLUMN);

            return $total;
        } catch (PDOException $err) {
            throw new Exception("Erro AcaoDAO(total):" . $err->getMessage());
        }
    }
    
	private function getWhere($acao) {

        $where = " WHERE 1 = 1 ";

        if ( isset($acao) && $acao != null ){
			if ( $acao->getAcaoID() != null ) {
	            $where = $where . " AND a.id_acao = " . $acao->getAcaoID();
	        }
	        
        	if ( $acao->getAcaoPai() != null && $acao->getAcaoPai()->getAcaoID() != null ) {
	            $where = $where . " AND a.id_acao_pai = " . $acao->getAcaoPai()->getAcaoID();
	        }
	        
			$path = $acao->getPath();
        	if ( $path != null ) {
	            $where = $where . " AND a.path like '%" . $path . "%'";
	        }
	        
       	 	$nome = $acao->getNome();
        	if ( $nome != null ) {
	            $where = $where . " AND a.nome like '%" . $nome . "%'";
	        }
        }
        
        return $where;
    }
}

?>