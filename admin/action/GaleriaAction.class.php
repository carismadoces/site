<?php

class GaleriaAction extends ActionDefault {

	private $galeriaBO;

    public static $VIEW_GALERIA = "view/galeria/";

    function GaleriaAction() {
        parent::__construct();
        $this->galeriaBO = new GaleriaBO();
    }

	public function buscar() {
    }

    public function detalhes($conviteID) {

    }

    public function cadastro() {

    	$this->setValueOutput("timestamp", time());
    	$this->setValueOutput("arquivos", "");

    	$this->setValueOutput('cadastro', "true");
    	$this->setValueOutput("galeriaSubmenu", "current");
        $this->show(GaleriaAction::$VIEW_GALERIA . "cadastro.tpl");
    }

    public function editar($galeriaID) {

    	$this->setValueOutput("timestamp", time());

    	$this->setValueOutput("arquivos", ""); // Alterar

        $galeria = new GaleriaBean();
    	$galeria->setGaleriaID($galeriaID);

    	$galeria = $this->galeriaBO->buscarGaleria($galeria);
    	parent::setObjectOutput($galeria);

    	$arquivoGaleriaArray = $this->galeriaBO->listarArquivosGaleria($galeriaID);
    	$this->setValueOutput('arquivoGaleriaArray', $arquivoGaleriaArray);

    	$this->setValueOutput('cadastro', "false");
        $this->show(GaleriaAction::$VIEW_GALERIA . "cadastro.tpl");

    }

    public function excluir($galeriaID) {

    	try{

    		$galeria = $this->galeriaBO->buscarGaleria(new GaleriaBean($galeriaID));
            $this->galeriaBO->excluir($galeriaID);

            Util::rrmdir(Constantes::$DIR_CONTEXT . $galeria->getPath());

            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
            parent::chain('GaleriaAction.listar');

        }catch(Exception $ex){
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }

    }

	public function excluirArquivoGaleria($arquivoGaleriaID = -1, $galeriaID = -1) {

    	try{
            $this->galeriaBO->excluirArquivoGaleria($arquivoGaleriaID);
    		$this->listarArquivosGaleria($galeriaID);

        }catch(Exception $ex){
            parent::setValueOutput("msgArquivoVinculado", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }

    }

	public function listarArquivosGaleria($galeriaID = -1) {

    	try{

    		$arquivoGaleriaArray = $this->galeriaBO->listarArquivosGaleria($galeriaID);
    		$this->setValueOutput('arquivoGaleriaArray', $arquivoGaleriaArray);

        parent::setValueOutput("msgArquivoVinculado", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));
        parent::show(GaleriaAction::$VIEW_GALERIA.'tabelaArquivoGaleria.tpl');

      }catch(Exception $ex){
          parent::setValueOutput("msgArquivoVinculado", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
          parent::voltar();
      }

    }

    public function listar() {

    	$this->buscaListaPaginada();

    }

	private function buscaListaPaginada($pagina = 1, $nome = null){

		$galeria = new GaleriaBean();
		$galeria->setNome($nome);
		$galerias = $this->galeriaBO->listar($pagina, $galeria);

        $total = $this->galeriaBO->total($galeria);
        parent::setValueOutput('galerias', $galerias);
        parent::setValueOutput('pagina', $pagina);
        parent::setValueOutput('numPaginas', Util::calculaNumPaginas($total));

	}

	public function tabela($pagina = 1, $nome = null) {
        $this->buscaListaPaginada($pagina, $nome);
        parent::show(GaleriaAction::$VIEW_GALERIA.'tabela.tpl');
    }

	public function salvar($mensagem) {

    	try{
	    	$galeria = $this->montaBean();

	    	$cadastro = $this->getValueInput("cadastro");
	    	if ( Util::isBoolean($cadastro) ){
	    		$this->galeriaBO->salvar($galeria);
	    	}else{
	    		$this->galeriaBO->alterar($galeria);
	    	}

	    	$dir = Constantes::$DIR_CONTEXT . $galeria->getPath();
	    	if ( !file_exists($dir) ){
	    		mkdir($dir);
	    	}
	    	$dir = $dir . 'thumbs';
	    	if ( !file_exists($dir) ){
	    		mkdir($dir);
	    	}

	    	parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));

	        parent::chain('GaleriaAction.listar');
    	}catch (Exception $ex) {
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    }

	public function alterar($mensagem) {

    	try{
	    	$galeria = $this->montaBean();
	    	$this->galeriaBO->alterar($galeria);

	    	parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_SUCCESS, Constantes::$STR_MSG_SUCCESS));

	        parent::chain('GaleriaAction.listar');
    	}catch (Exception $ex) {
            parent::setValueOutput("msg", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    }

	public function alterarDescricaoArquivoGaleria($galeriaID = -1, $arquivoGaleriaID = -1, $dsArquivoGaleria = "", $tags = "") {

    	try{

    		$arquivoGaleria = new ArquivoGaleriaBean($arquivoGaleriaID, null, null, $dsArquivoGaleria, $tags);
	    	$this->galeriaBO->alterarDescricaoArquivoGaleria($arquivoGaleria);
	    	$this->listarArquivosGaleria($galeriaID);

    	}catch (Exception $ex) {
            parent::setValueOutput("msgArquivoVinculado", new MensagemMeta(Constantes::$MSG_ERROR, $ex->getMessage()));
            parent::voltar();
        }
    }

	public function upload(){

		$galeriaID = $_POST['galeriaID'];
		$galeria = $this->galeriaBO->buscarGaleria(new GaleriaBean($galeriaID));
		$dsArquivoGaleria = $_POST['dsArquivoGaleria'];
		$tags = $_POST['tags'];
		$uploadDir = Constantes::$DIR_CONTEXT . $galeria->getPath();

		// Set the allowed file extensions
		$fileTypes = array('png', 'jpg', 'jpeg'); // Allowed file extensions

		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

		if (!empty($_FILES['Filedata']) && $_POST['token'] == $verifyToken) {
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			$targetFile = $uploadDir . uniqid() . '.' . Util::getFileExtension($_FILES['Filedata']['name']);
			$targetFile = strtolower($targetFile);
			$targetFile = str_replace(" ","_", $targetFile);

			// Validate the filetype
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

				// Save the file
				$move = move_uploaded_file($tempFile, $targetFile);
				$this->cropImage($targetFile, $uploadDir);

				$this->galeriaBO->salvarArquivoGaleria(Util::getFileName($targetFile), $galeriaID, $dsArquivoGaleria, $tags);

			} else {

				// The file type wasn't allowed
				echo 'Tipo de dados inválido.';

			}
		}
    }

    function cropImage($filePath, $uploadDir){

    	$posx = $_POST['posx'];
    	$posy = $_POST['posy'];
    	$width = $_POST['width'];
    	$height = $_POST['height'];

    	// Largura e altura do preview na página
    	$pwidth = $_POST['pwidth'];
    	$pheight = $_POST['pheight'];

    	// Largura e altura real da imagem
    	list($owidth, $oheight) = getimagesize($filePath);

    	// Cálculo de proporções entre a imagem real e o preview
    	$rx = round($posx * ($owidth/$pwidth));
			$ry = round($posy * ($oheight/$pheight));

			$cw = round($width * ($owidth/$pwidth));
			$ch = round($height * ($oheight/$pheight));

			// Recorta a imagem de acordo com as cordenadas e recorde realizadas na página
    	$exec = "/usr/local/Cellar/imagemagick/6.9.4-3/bin/convert $filePath -crop " . $cw . "x" . $ch . "+" . $rx . "+" . $ry . " $filePath";
     	exec($exec);

			// Gera thumbnail
     	$thumbDest = $uploadDir . "thumbs/" . Util::getFileName($filePath);
     	$exec = "/usr/local/Cellar/imagemagick/6.9.4-3/bin/convert -thumbnail 200x200^ $filePath $thumbDest";
      exec($exec);

     	// Redimensiona a imagem
     	$exec = "/usr/local/Cellar/imagemagick/6.9.4-3/bin/convert -resize '800^>' $filePath" . '[0] ' . $filePath;
     // 	$exec = "/usr/local/Cellar/imagemagick/6.9.4-3/bin/convert $filePath -auto-orient -gravity center -background black -extent 600x $filePath";
      exec($exec);

      // Marca d'agua com logo
      $logoFilePath = Constantes::$DIR_CONTEXT . 'img/watermark.png';
      $exec = "/usr/local/Cellar/imagemagick/6.9.4-3/bin/convert $filePath -gravity SouthEast $logoFilePath -compose Multiply -composite $filePath";
      exec($exec);

    }

	private function montaBean(){
    	$galeria = parent::getObjectInput('GaleriaBean', '', '');
    	return $galeria;
    }

    public function getView() {
        return GaleriaAction::$VIEW_GALERIA;
    }

}

?>
