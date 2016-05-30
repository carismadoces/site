<?php

class AcaoPerfilBean extends GenericBean{

    private $acao;
    private $perfil;
	    
    function __construct($acao = null, $perfil = null) {
        $this->acao = $acao;
        $this->perfil = $perfil;
    }

	public function getAcao(){
		return $this->acao;
	}

	public function setAcao($acao){
		$this->acao = $acao;
	}

	public function getPerfil(){
		return $this->perfil;
	}

	public function setPerfil($perfil){
		$this->perfil = $perfil;
	}
	
    public function toArray() {
        $acaoPerfil = array();

        $acaoPerfil['acao'] = $this->acao;
        $acaoPerfil['perfil'] = $this->perfil;
		       
        return $acaoPerfil;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

    public function toBD() {
        return $this->toArray();
    }

}