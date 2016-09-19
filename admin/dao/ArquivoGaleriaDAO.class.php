<?php

class ArquivoGaleriaDAO {

	private $galeriaDAO;

	public function __construct() {
        $this->conexao = Conexao::getConexao();
        $this->galeriaDAO = new GaleriaDAO();
    }

	public function buscarArquivoGaleria($arquivoGaleria) {
        try {

        	$where = $this->getWhere($arquivoGaleria);

            $row = $this->conexao->query("SELECT * FROM arquivo_galeria al $where")->fetch(PDO::FETCH_SERIALIZE);

            if (isset ($row['id_arquivo_galeria'])) {
                $arquivoGaleria = new ArquivoGaleriaBean($row['id_arquivo_galeria'], $row['file'], new GaleriaBean($row['id_galeria']), $row['ds_arquivo_galeria']);

                if ( $arquivoGaleria->getGaleria() != null ){
                	$galeria = $this->galeriaDAO->buscarGaleria($arquivoGaleria->getGaleria());
                	$arquivoGaleria->setGaleria($galeria);
                }

                return $arquivoGaleria;
            } else {
                return null;
            }
        } catch (PDOException $err) {
            throw new Exception("Erro ArquivoGaleriaDAO(buscarArquivoGaleria):" . $err->getMessage());
        }
    }

	private function getWhere($arquivoGaleria) {

        $where = " WHERE 1 = 1 ";

        if ( isset($arquivoGaleria) && $arquivoGaleria != null ){

			if ( $arquivoGaleria->getArquivoGaleriaID() != null ) {
	            $where = $where . " AND al.id_arquivo_galeria = " . $arquivoGaleria->getArquivoGaleriaID();
	        }

	    	if ( $arquivoGaleria->getFile() != null ) {
	            $where = $where . " AND al.file like '%" . $arquivoGaleria->getFile() . "%'";
	        }

	 		if ( $arquivoGaleria->getGaleria() != null && $galeria->getGaleria()->getGaleriaID() != null ) {
	 			$where = $where . " AND al.id_galeria like '%" . $galeria->getGaleria()->getGaleriaID() . "%'";
	        }

        	if ( $arquivoGaleria->getDsArquivoGaleria() != null ) {
	 			$where = $where . " AND al.ds_arquivo_galeria like '%" . $arquivoGaleria->getDsArquivoGaleria() . "%'";
	        }
        }

        return $where;
    }

	public function salvarArquivoGaleria($file, $galeriaID, $dsArquivoGaleria = "", $tags = "") {

        try {

        	$statment = $this->conexao->prepare("INSERT INTO
            		arquivo_galeria(
            		file,
	                id_galeria,
	                ds_arquivo_galeria,
					tags
	            )
                VALUES (
                	:file,
	                :galeriaID,
	                :dsArquivoGaleria,
					:tags
	                );");

        	$statment->bindParam(':file', $file);
        	$statment->bindParam(':galeriaID', $galeriaID);
        	$statment->bindParam(':dsArquivoGaleria', $dsArquivoGaleria);
			$statment->bindParam(':tags', $tags);

            if ($statment->execute()) {
                return $galeriaID;
            } else {
                $erros = $statment->errorInfo();
                throw new Exception("Erro ArquivoGaleriaDAO(salvarArquivoGaleria): " . $erros[2]);
            }
        } catch (PDOException $err) {
            throw new Exception("Erro ArquivoGaleriaDAO(salvarArquivoGaleria):" . $err->getMessage());
        }
    }

	public function listarArquivosGaleria($galeriaID = -1, $order = 'ASC') {
        try {

            $arquivoGaleriaArray = array();
            $statment = $this->conexao->query("SELECT * FROM arquivo_galeria WHERE id_galeria = $galeriaID ORDER BY id_arquivo_galeria $order");

            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $arquivoGaleria = new ArquivoGaleriaBean($row['id_arquivo_galeria'], $row['file'], new GaleriaBean($row['id_galeria']), $row['ds_arquivo_galeria'], $row['tags']);

                if ( $arquivoGaleria->getGaleria() != null ){
                	$arquivoGaleria->setGaleria($this->galeriaDAO->buscarGaleria($arquivoGaleria->getGaleria()));
                }

								// $arquivoGaleria->setTags($this->consultarTags($arquivoGaleria->getArquivoGaleriaID()));

                $arquivoGaleriaArray[] = $arquivoGaleria;
            }

            return $arquivoGaleriaArray;
        } catch (PDOException $err) {
            throw new Exception("Erro ArquivoGaleriaDAO(listarArquivosGaleria):" . $err->getMessage());
        }
    }

		public function listarArquivosGaleriaPaginada($pagina = 1, $galeriaID = -1, $order = 'ASC') {
	        try {

	            $arquivoGaleriaArray = array();

							$limite = Util::getPaginacao($pagina, 4);

	            $statment = $this->conexao->query("SELECT * FROM arquivo_galeria WHERE id_galeria = $galeriaID ORDER BY id_arquivo_galeria $order $limite");

	            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
	                $arquivoGaleria = new ArquivoGaleriaBean($row['id_arquivo_galeria'], $row['file'], new GaleriaBean($row['id_galeria']), $row['ds_arquivo_galeria'], $row['tags']);

	                if ( $arquivoGaleria->getGaleria() != null ){
	                	$arquivoGaleria->setGaleria($this->galeriaDAO->buscarGaleria($arquivoGaleria->getGaleria()));
	                }

									// $arquivoGaleria->setTags($this->consultarTags($arquivoGaleria->getArquivoGaleriaID()));

	                $arquivoGaleriaArray[] = $arquivoGaleria;
	            }

	            return $arquivoGaleriaArray;
	        } catch (PDOException $err) {
	            throw new Exception("Erro ArquivoGaleriaDAO(listarArquivosGaleria):" . $err->getMessage());
	        }
	    }

	public function consultarTags($arquivogaleriaID = -1) {
        try {

            $tagArray = array();
            $statment = $this->conexao->query("SELECT tag.* FROM tag
							INNER JOIN arquivo_galeria_tag agt ON (agt.id_tag = tag.id_tag)
							WHERE id_arquivo_galeria = $arquivogaleriaID");

            foreach ($statment->fetchAll(PDO::FETCH_SERIALIZE) as $row){
                $tagArray[] = new TagBean($row['id_tag'], $row['tag']);
            }

            return $tagArray;
        } catch (PDOException $err) {
            throw new Exception("Erro ArquivoGaleriaDAO(consultarTags):" . $err->getMessage());
        }
  }

	public function excluirArquivoGaleria($arquivoGaleriaID) {

        try {

            $statment = $this->conexao->prepare("DELETE FROM arquivo_galeria WHERE id_arquivo_galeria = :arquivoGaleriaID");
            $statment->bindParam(':arquivoGaleriaID', $arquivoGaleriaID);

            if(!$statment->execute()) {
                $erros = $statment->errorInfo();
                throw new Exception("Erro ArquivoGaleriaDAO(excluirArquivoGaleria): ".$erros[2]);
            }

        }catch(PDOException $err) {
            throw new Exception("Erro ArquivoGaleriaDAO(excluirArquivoGaleria):".$err->getMessage());
        }

    }
}

?>
