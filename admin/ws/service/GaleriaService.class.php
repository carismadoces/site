<?php

/**
 *
 * @access public
 * @author Daniel Eduardo
 * @package ws
 */
class GaleriaService extends GenericService{

	private $galeriaBO;
	private $bean;

	function __construct(){
		$this->galeriaBO = new GaleriaBO();
		$this->bean = new ArquivoGaleriaBean();
	}

	/**
	 @PathParam("/galeria/edit")
	**/
	public function alterarArquivoGaleria(){

		$this->bean->setDsArquivoGaleria($this->bean->getDsArquivoGaleria($this->bean->getArquivoGaleriaID()));
		$this->galeriaBO->alterarDescricaoArquivoGaleria($this->bean);

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

		header(Constantes::$HTTP_STATUS[200]);
	}

	/**
	 @PathParam("/galeria/excluirArquivoGaleria")
	**/
	public function excluirArquivoGaleria($arquivoGaleriaID = 0){

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');

		$this->galeriaBO->excluirArquivoGaleria($arquivoGaleriaID);
		header(Constantes::$HTTP_STATUS[200]);
	}

	/**
	 @PathParam("/galeria/upload")
	**/
	public function upload($galeriaID = 0, $dsArquivoGaleria = null){

		$galeria = $this->galeriaBO->buscarGaleria(new GaleriaBean($galeriaID));
		$uploadDir = Constantes::$DIR_CONTEXT . $galeria->getPath();

		if (!empty($_FILES['Filedata'])) {
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			$targetFile = $uploadDir . uniqid() . '.' . Util::getFileExtension($_FILES['Filedata']['name']);
			$targetFile = strtolower($targetFile);
			$targetFile = str_replace(" ","_", $targetFile);

			$fileTypes = array('png', 'jpg', 'jpeg'); // Allowed file extensions

			// Validate the filetype
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

				// Save the file
				$move = move_uploaded_file($tempFile, $targetFile);

				// Transform base64 to image
				file_put_contents($targetFile, base64_decode(file_get_contents($targetFile)));


				// Recorta a imagem de acordo com as cordenadas e recorde realizadas na página
		    	$exec = "/usr/local/Cellar/imagemagick/6.9.4-3/bin/convert $filePath -crop " . $cw . "x" . $ch . "+" . $rx . "+" . $ry . " $filePath";
		     	exec($exec);

				// Gera thumbnail
		     	$thumbDest = $uploadDir . "thumbs/" . Util::getFileName($filePath);
		     	$exec = "/usr/bin/convert -thumbnail 200x200^ $filePath $thumbDest";
		      	exec($exec);

		     	// Redimensiona a imagem
		     	$exec = "/usr/bin/convert -resize '800^>' $filePath" . '[0] ' . $filePath;
		     	exec($exec);

		      	// Marca d'agua com logo
		      	$logoFilePath = Constantes::$DIR_CONTEXT . 'img/watermark.png';
		      	$exec = "/usr/bin/convert $filePath -gravity SouthEast $logoFilePath -compose Multiply -composite $filePath";
		      	exec($exec);

				$this->galeriaBO->salvarArquivoGaleria(Util::getFileName($targetFile), $galeriaID, $dsArquivoGaleria);

			} else {

				// The file type wasn't allowed
				echo 'Tipo de dados inválido.';

			}
		}else{
			echo 'Não há imagem';
		}

	}

	/**
	 @PathParam("/galeria/list")
	 @RequestMethod("GET")
	**/
	public function listFiles($galeriaID){

		$skipped[] = '.';
		$skipped[] = '..';

		$galeria = new GaleriaBean();
		$galeria->setGaleriaID($galeriaID);
		$galeria = $this->galeriaBO->buscarGaleria($galeria);
		$maindir = Constantes::$DIR_CONTEXT . $galeria->getPath();

		if(is_dir($maindir)) {

			if($directory = opendir($maindir)){
		    	$arquivoGaleriaArray = $this->galeriaBO->listarArquivosGaleria($galeria->getGaleriaID(), 'DESC');
				echo $this->build($arquivoGaleriaArray);

			}
		}

	}

	/**
	 @PathParam("/galeria/list_paginada")
	 @RequestMethod("GET")
	**/
	public function listFilesPaginada($galeriaID, $pagina){

		$skipped[] = '.';
		$skipped[] = '..';

		$galeria = new GaleriaBean();
		$galeria->setGaleriaID($galeriaID);
		$galeria = $this->galeriaBO->buscarGaleria($galeria);
		$maindir = Constantes::$DIR_CONTEXT . $galeria->getPath();

		if(is_dir($maindir)) {

			if($directory = opendir($maindir)){
		    	$arquivoGaleriaArray = $this->galeriaBO->listarArquivosGaleriaPaginada($pagina, $galeria->getGaleriaID(), 'DESC');
				echo $this->build($arquivoGaleriaArray);

			}
		}

	}

/**
	 @PathParam("/galeria/arquivos")
	 @RequestMethod("GET")
	**/
	public function arquivos($galeriaPath){

		//$maindir = $_GET["path"];
		$skipped[] = '.';
		$skipped[] = '..';

		$galeria = new GaleriaBean();
		$galeria->setPath($galeriaPath);
		$galeria = $this->galeriaBO->buscarGaleria($galeria);
		$maindir = Constantes::$DIR_CONTEXT . $galeria->getPath();

		if(is_dir($maindir)) {

			if($directory = opendir($maindir)){

		    	$images = array();

		    	$arquivoGaleriaArray = $this->galeriaBO->listarArquivosGaleria($galeria->getGaleriaID(), 'DESC');
		    	foreach ($arquivoGaleriaArray as $ag) {
		    		$images[] = '{"img":"' . $galeria->getPath() . $ag->getFile() . '", "desc": "' . $ag->getDsArquivoGaleria() . '"}';
		    	}

				echo json_encode($images);

			}
		}

	}

	public function getBean(){
		return $this->bean;
	}

	public function setBean($bean){
		$this->bean = $bean;
	}
}
