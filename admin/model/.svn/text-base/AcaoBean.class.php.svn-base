<?php

class AcaoBean extends GenericBean{

    private $acaoID;
    private $nome;
    private $path;
    private $acaoPai;
    
    private $filhos;
    
    function __construct($acaoID = null, $nome = "", $path = "", $acaoPai = null) {
        $this->acaoID = $acaoID;
        $this->nome = $nome;
        $this->path = $path;
        $this->acaoPai = $acaoPai;
    }

	public function getAcaoID(){
		return $this->acaoID;
	}

	public function setAcaoID($acaoID){
		$this->acaoID = $acaoID;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getPath(){
		return $this->path;
	}

	public function setPath($path){
		$this->path = $path;
	}
	
	public function getAcaoPai(){
		return $this->acaoPai;
	}

	public function setAcaoPai($acaoPai){
		$this->acaoPai = $acaoPai;
	}
    
	public function getFilhos(){
		return $this->filhos;
	}

	public function setFilhos($filhos){
		$this->filhos = $filhos;
	}
	
    public function toArray() {
        $acao = array();

        $acao['acaoID'] = $this->acaoID;
        $acao['nome'] = $this->nome;
        $acao['acao'] = $this->acao;
        
        if ( $this->acaoPai != null ){
        	$acao['acaoPai'] = $this->acaoPai->toArray();
        }
		
        return $acao;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

    public function toBD() {
        return $this->toArray();
    }

}