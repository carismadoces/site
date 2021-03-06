<?php

class GaleriaBean extends GenericBean{

    private $galeriaID;
    private $nome;
    private $dsGaleria;
    private $path;

    private $acoes;

    function __construct($galeriaID = 0, $nome = "", $dsGaleria = "", $path = "") {
        $this->galeriaID = $galeriaID;
        $this->nome = $nome;
        $this->dsGaleria = $dsGaleria;
        $this->path = $path;
    }

	public function getGaleriaID(){
		return $this->galeriaID;
	}

	public function setGaleriaID($galeriaID){
		$this->galeriaID = $galeriaID;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getDsGaleria(){
		return $this->dsGaleria;
	}

	public function setDsGaleria($dsGaleria){
		$this->dsGaleria = $dsGaleria;
	}

	public function getPath(){
		return $this->path;
	}

	public function setPath($path){
		$this->path = $path;
	}

    public function toArray() {
        $galeria = array();

        $galeria['galeriaID'] = $this->galeriaID;
        $galeria['nome'] = $this->nome;
        $galeria['dsGaleria'] = $this->dsGaleria;
        $galeria['path'] = $this->path;

        return $galeria;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

    public function toBD() {
        return $this->toArray();
    }
}
