<?php

class GaleriaDAO {

	public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

	public function salvar($galeria) {

        try {

        	$statment = $this->conexao->prepare("INSERT INTO
            		galeria(
            		nome,
	                ds_galeria,
	                path
	            )
                VALUES (
                	:nome,
	                :dsGaleria,
	                :path
	                );");

        	$nome = $galeria->getNome();
        	$dsGaleria = $galeria->getDsGaleria();
        	$path = $galeria->getPath();

        	$statment->bindParam(':nome', $nome);
        	$statment->bindParam(':dsGaleria', $dsGaleria);
        	$statment->bindParam(':path', $path);

            if ($statment->execute()) {
                return $galeria;
            } else {
                $erros = $statment->errorInfo();
                throw new Exception("Erro GaleriaDAO(salvar): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(salvar):" . $err->getMessage());
        }
    }

	public function salvarArquivoGaleria($file, $galeriaID) {

        try {

        	$statment = $this->conexao->prepare("INSERT INTO
            		arquivo_galeria(
            		file,
	                id_galeria
	            )
                VALUES (
                	:file,
	                :galeriaID
	                );");

        	$statment->bindParam(':file', $file);
        	$statment->bindParam(':galeriaID', $galeriaID);

            if ($statment->execute()) {
                return $galeria;
            } else {
                $erros = $statment->errorInfo();
                throw new Exception("Erro GaleriaDAO(salvarArquivoGaleria): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(salvarArquivoGaleria):" . $err->getMessage());
        }
    }

	public function alterar($galeria) {

        try {

            if ( isset($galeria) && $galeria != null) {

                $statment = $this->conexao->prepare("UPDATE galeria SET
                        nome = :nome,
                        ds_galeria  = :dsGaleria,
                        path = :path
                        WHERE id_galeria = " . $galeria->getGaleriaID() );

                $statment->bindParam(':nome', $galeria->getNome());
                $statment->bindParam(':dsGaleria', $galeria->getDsGaleria());
                $statment->bindParam(':path', $galeria->getPath());
            }

            if ($statment->execute()) {
                return $galeria;
            } else {
                $erros = $statment->errorInfo();
                throw new Exception("Erro GaleriaDAO(alterar): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(alterar):" . $err->getMessage());
        }
    }

	public function alterarDescricaoArquivoGaleria($arquivoGaleria) {

        try {

            if ( isset($arquivoGaleria) && $arquivoGaleria != null) {

                $statment = $this->conexao->prepare("UPDATE arquivo_galeria SET
                        ds_arquivo_galeria = :dsArquivoGaleria, tags = :tags
                        WHERE id_arquivo_galeria = " . $arquivoGaleria->getArquivoGaleriaID());

                $statment->bindParam(':dsArquivoGaleria', $arquivoGaleria->getDsArquivoGaleria());
								$statment->bindParam(':tags', $arquivoGaleria->getTags());
            }

            if ($statment->execute()) {
                return $arquivoGaleria;
            } else {
                $erros = $statment->errorInfo();
                throw new Exception("Erro GaleriaDAO(alterarDescricaoArquivoGaleria): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(alterarDescricaoArquivoGaleria):" . $err->getMessage());
        }
    }

	public function buscarPorId($galeriaID) {
        try {
            $row = $this->conexao->query("SELECT * FROM galeria g WHERE id_galeria = '$galeriaID' ")->fetch(PDO::FETCH_SERIALIZE);

            if (isset ($row['id_galeria']) && $row['id_galeria'] > 0) {
                return new GaleriaBean($row['id_galeria'], $row['nome'], $row['ds_galeria'], $row['path']);
            } else {
                return null;
            }
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(buscarPorId):" . $err->getMessage());
        }
    }

	public function consultarTodos($galeria) {
        try {

        	$galerias = array();
        	$where = $this->getWhere($galeria);

            $statment = $this->conexao->query("SELECT * FROM galeria g $where");
        	foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $galerias[] = new GaleriaBean($row['id_galeria'], $row['nome'], $row['ds_galeria'], $row['path']);
            }

            return $galerias;

        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(consultarTodos):" . $err->getMessage());
        }
    }

    public function buscarGaleria($galeria) {
        try {

        	$where = $this->getWhere($galeria);

            $row = $this->conexao->query("SELECT * FROM galeria g $where")->fetch(PDO::FETCH_SERIALIZE);

            if (isset ($row['id_galeria'])) {
                return new GaleriaBean($row['id_galeria'], $row['nome'], $row['ds_galeria'], $row['path']);
            } else {
                return null;
            }
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(buscarGaleria):" . $err->getMessage());
        }
    }

	public function listar($pagina = 1, $galeria = null) {
        try {

            $limite = Util::getPaginacao($pagina);
            $where = $this->getWhere($galeria);

            $galerias = array();
            $statment = $this->conexao->query("SELECT * FROM galeria g $where $limite ");

            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $galerias[] = new GaleriaBean($row['id_galeria'], $row['nome'], $row['ds_galeria'], $row['path']);
            }

            return $galerias;
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(listar):" . $err->getMessage());
        }
    }

	public function excluir($galeriaID) {

        try {

            $statment = $this->conexao->prepare("DELETE FROM galeria WHERE id_galeria = :galeriaID");
            $statment->bindParam(':galeriaID', $galeriaID);

            if(!$statment->execute()) {
                $erros = $statment->errorInfo();
                throw new Exception("Erro GaleriaDAO(excluir): ".$erros[2]);
            }

        }catch(PDOException $err) {
            throw new Exception("Erro GaleriaDAO(excluir):".$err->getMessage());
        }
    }

    public function total($galeria) {
        try {
            $where = $this->getWhere($galeria);
            $total = $this->conexao->query("SELECT COUNT(g.id_galeria) total FROM galeria g $where")->fetch(PDO::FETCH_COLUMN);

            return $total;
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(total):" . $err->getMessage());
        }
    }

	private function getWhere($galeria) {

        $where = " WHERE 1 = 1 ";

        if ( isset($galeria) && $galeria != null ){
			if ( $galeria->getGaleriaID() != null ) {
	            $where = $where . " AND g.id_galeria = " . $galeria->getGaleriaID();
	        }

	    	if ( $galeria->getNome() != null ) {
	            $where = $where . " AND g.nome like '%" . $galeria->getNome() . "%'";
	        }

	 		if ( $galeria->getDsGaleria() != null ) {
	 			$where = $where . " AND g.ds_galeria like '%" . $galeria->getDsGaleria() . "%'";
	        }

        	if ( $galeria->getPath() != null ) {
	 			$where = $where . " AND g.path like '%" . $galeria->getPath() . "%'";
	        }
        }

        return $where;
    }

	public function listarArquivosGaleria($galeriaID = -1) {
        try {

            $arquivoGaleriaArray = array();
            $statment = $this->conexao->query("SELECT * FROM arquivo_galeria WHERE id_galeria = $galeriaID");

            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $ag = new ArquivoGaleriaBean($row['id_arquivo_galeria'], $row['file'], new GaleriaBean($row['id_galeria']));
								// $ag->setTags($this->arquivoGaleriaDAO->consultarTags($ag->getArquivoGaleriaID()));
								$arquivoGaleriaArray[] = $ag;
            }

            return $arquivoGaleriaArray;
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(listarArquivosGaleria):" . $err->getMessage());
        }
    }

		public function consultaTodasTags($galeriaID = -1) {
        try {

            $tags = array();
            $statment = $this->conexao->query("SELECT tags FROM arquivo_galeria
							WHERE id_galeria = $galeriaID
							and tags <> ''");

            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
								$tags = array_merge($tags, explode(',', $row['tags']));
            }

            return array_unique($tags);
        } catch (PDOException $err) {
            throw new Exception("Erro GaleriaDAO(listarArquivosGaleria):" . $err->getMessage());
        }
    }

	public function excluirArquivoGaleria($arquivoGaleriaID) {

        try {

            $statment = $this->conexao->prepare("DELETE FROM arquivo_galeria WHERE id_arquivo_galeria = :arquivoGaleriaID");
            $statment->bindParam(':arquivoGaleriaID', $arquivoGaleriaID);

            if(!$statment->execute()) {
                $erros = $statment->errorInfo();
                throw new Exception("Erro GaleriaDAO(excluirArquivoGaleria): ".$erros[2]);
            }

        }catch(PDOException $err) {
            throw new Exception("Erro GaleriaDAO(excluirArquivoGaleria):".$err->getMessage());
        }

    }
}

?>
