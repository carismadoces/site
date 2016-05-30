<?php
/**
 * Classe que representa o bean de autentica‹o no sistema via web service.
 * @access public
 * @author Daniel Eduardo
 * @package model
 */
class LoginBean {
	
    private $usuario;
    private $senha;
    
    function __construct($usuario = "", $senha = "") {
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function toArray() {
        $login = array();

        $login['usuario'] = $this->usuario;
        $login['senha'] = $this->senha;

        return $login;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
?>