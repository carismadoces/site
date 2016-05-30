<?php

/**
 * Description of GaleriaBO
 *
 * @author Daniel Eduardo
 */
class GaleriaBO {

    private $galeriaDAO;
    private $arquivoGaleriaDAO;

    public function __construct() {
    	$this->galeriaDAO = new GaleriaDAO();
    	$this->arquivoGaleriaDAO = new ArquivoGaleriaDAO();
    }

	public function excluir($galeriaID) {
        try {
            if(!isset ($galeriaID) || $galeriaID <= 0)
                throw new Exception("Galeria não encontrada!!!");

            $this->galeriaDAO->excluir($galeriaID);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function listar($pagina = 1, $galeria = null) {
        try {
            return $this->galeriaDAO->listar($pagina, $galeria);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function total($galeria = null) {
        try {
            return $this->galeriaDAO->total($galeria);
        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function salvar($galeria){

    	try {

    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();

        	$this->validaCamposObrigatoriosIncluir($galeria);
        	$this->validaRegrasIncluir($galeria);
	        $this->galeriaDAO->salvar($galeria);

            $conexao->commit();

        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

	public function alterar($galeria, $imagens){

    	try {

    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();

        	$galeriaAux = new GaleriaBean();
        	$galeriaAux->setGaleriaID($galeria->getGaleriaID());
        	$galeriaAux = $this->galeriaDAO->buscarGaleria($galeriaAux);

        	if ( $galeriaAux != null ){
				$this->galeriaDAO->alterar($galeria);
        	}else{
        		throw new Exception("Galeria não encontrada");
        	}

            $conexao->commit();

        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function alterarDescricaoArquivoGaleria($arquivoGaleria){

    	try {

    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();

			$this->galeriaDAO->alterarDescricaoArquivoGaleria($arquivoGaleria);

            $conexao->commit();

        }catch(Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function consultarTodos($galeria) {
    	return $this->galeriaDAO->consultarTodos($galeria);
    }

    public function buscarGaleria($galeria) {
    	return $this->galeriaDAO->buscarGaleria($galeria);
    }

	private function validaCamposObrigatoriosIncluir($galeria){

		if ( Util::isBlank($galeria->getNome()) ){
    		throw new Exception("Nome: Campo Obrigat�rio");
    	}

    	if ( Util::isBlank($galeria->getDsGaleria()) ){
    		throw new Exception("Descri��o: Campo Obrigat�rio");
    	}

    }

	private function validaRegrasIncluir($galeria){
    	$galeria = $this->galeriaDAO->buscarGaleria($galeria);
    	if ( $galeria != null ){
    		throw new Exception("Já existe um Galeria cadastrada com estas informações.");
    	}
    }

  	public function salvarArquivoGaleria($imagem, $galeriaID, $dsArquivoGaleria = "", $tags = ""){
    	$this->arquivoGaleriaDAO->salvarArquivoGaleria($imagem, $galeriaID, $dsArquivoGaleria, $tags);
    }

	public function listarArquivosGaleria($galeriaID = -1, $order = '') {
    	return $this->arquivoGaleriaDAO->listarArquivosGaleria($galeriaID, $order);
    }

    public function consultaTodasTags($galeriaID = -1) {
      	return $this->galeriaDAO->consultaTodasTags($galeriaID);
      }

    public function excluirArquivoGaleria($arquivoGaleriaID) {
    	try {

    		$conexao = Conexao::getConexao();
        	$conexao->beginTransaction();

    		$arquivoGaleria = $this->arquivoGaleriaDAO->buscarArquivoGaleria(new ArquivoGaleriaBean($arquivoGaleriaID));
    		$this->arquivoGaleriaDAO->excluirArquivoGaleria($arquivoGaleriaID);

    		// Excluir arquivos
    		$path = $arquivoGaleria->getGaleria()->getPath();
    		$file = $arquivoGaleria->getFile();

    		unlink(Constantes::$DIR_CONTEXT . $path . $file);
    		unlink(Constantes::$DIR_CONTEXT . $path . 'thumbs/' . $file);

    		$conexao->commit();

        }catch(Exception $err) {
        	$conexao->rollback();
            throw new Exception($err->getMessage());
        }
    }

	public function buscarArquivoGaleria($arquivoGaleria) {
    	return $this->arquivoGaleriaDAO->buscarArquivoGaleria($arquivoGaleria);
    }
}
?>
