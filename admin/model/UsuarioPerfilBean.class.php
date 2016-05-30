<?php

class UsuarioPerfilBean extends GenericBean{

    private $usuario;
    private $perfil;
	    
    function __construct($usuario = null, $perfil = null) {
        $this->usuario = $usuario;
        $this->perfil = $perfil;
    }

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getPerfil(){
		return $this->perfil;
	}

	public function setPerfil($perfil){
		$this->perfil = $perfil;
	}
	
    public function toArray() {
        $usuarioPerfil = array();

        $usuarioPerfil['usuario'] = $this->usuario;
        $usuarioPerfil['perfil'] = $this->perfil;
		       
        return $usuarioPerfil;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

    public function toBD() {
        return $this->toArray();
    }

}