<?php

class ArquivoGaleriaBean extends GenericBean{

    private $arquivoGaleriaID;
    private $file;
    private $galeria;
    private $dsArquivoGaleria;
    private $tags;

    function __construct($arquivoGaleriaID = 0, $file = "", $galeria = null, $dsArquivoGaleria = "", $tags = "") {
        $this->arquivoGaleriaID = $arquivoGaleriaID;
        $this->file = $file;
        $this->galeria = $galeria;
        $this->dsArquivoGaleria = $dsArquivoGaleria;
        $this->tags = $tags;
    }

	public function getArquivoGaleriaID(){
		return $this->arquivoGaleriaID;
	}

	public function setArquivoGaleriaID($arquivoGaleriaID){
		$this->arquivoGaleriaID = $arquivoGaleriaID;
	}

	public function getFile(){
		return $this->file;
	}

	public function setFile($file){
		$this->file = $file;
	}

	public function getGaleria(){
		return $this->galeria;
	}

	public function setGaleria($galeria){
		$this->galeria = $galeria;
	}

	public function getDsArquivoGaleria(){
		return $this->dsArquivoGaleria;
	}

	public function setDsArquivoGaleria($dsArquivoGaleria){
		$this->dsArquivoGaleria = $dsArquivoGaleria;
	}

	public function getThumbPath(){
		return '../' .$this->getGaleria()->getPath() . 'thumbs/' .$this->file;
	}

  public function getTags(){
		return $this->tags;
	}

  public function getTagsToClass(){
     return strtolower(str_replace(',', ' ', $this->tags));
	}

	public function setTags($tags){
		$this->tags = $tags;
	}

  public function toArray() {
      $arquivoGaleria = array();

      $arquivoGaleria['arquivoGaleriaID'] = $this->arquivoGaleriaID;
      $arquivoGaleria['file'] = $this->file;
      $arquivoGaleria['dsArquivoGaleria'] = $this->dsArquivoGaleria;

      if ( $this->galeria != null ){
      	$arquivoGaleria['galeria'] = $this->galeria;
      }

      if ( $this->tags != null ){
      	$arquivoGaleria['tags'] = $this->tags;
      }

      return $arquivoGaleria;
  }

  public function toJson() {
      return json_encode($this->toArray());
  }

  public function toBD() {
      return $this->toArray();
  }
}
