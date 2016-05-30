<?php

class PerfilBean extends GenericBean{

    private $perfilID;
    private $nome;
    private $dsPerfil;
	    
    function __construct($perfilID = null, $nome = null, $dsPerfil = null) {
        $this->perfilID = $perfilID;
        $this->nome = $nome;
        $this->dsPerfil = $dsPerfil;
    }

	public function getPerfilID(){
		return $this->perfilID;
	}

	public function setPerfilID($perfilID){
		$this->perfilID = $perfilID;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getDsPerfil(){
		return $this->dsPerfil;
	}

	public function setDsPerfil($dsPerfil){
		$this->dsPerfil = $dsPerfil;
	}
	
    public function toArray() {
        $perfil = array();

        $perfil['id_perfil'] = $this->perfilID;
        $perfil['nome'] = $this->nome;
        $perfil['name'] = $this->ds;
		
        return $perfil;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

    public function toBD() {
        return $this->toArray();
    }

}