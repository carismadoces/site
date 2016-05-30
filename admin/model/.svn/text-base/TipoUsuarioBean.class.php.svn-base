<?php

class TipoUsuarioBean {

	/**
     * @AttributeType long
     */
    private $tipoUsuarioID;
    
    /**
     * @AttributeType String
     */
    private $dsTipo;
        
    function __construct($tipoUsuarioID, $dsTipo) {
        $this->tipoUsuarioID = $tipoUsuarioID;
        $this->dsTipo = $dsTipo;
    }

    public function getTipoUsuarioID() {
        return $this->tipoUsuarioID;
    }

    public function setTipoUsuarioID($tipoUsuarioID) {
        $this->usuarioID = $usuarioID;
    }

    public function getDsTipo() {
        return $this->dsTipo;
    }

    public function setDsTipo($dsTipo) {
        $this->dsTipo = $dsTipo;
    }

    public function toArray() {
        $tipoUsuario = array();

        $tipoUsuario['tipoUsuarioID'] = $this->tipoUsuarioID;
        $tipoUsuario['dsTipo'] = $this->dsTipo;

        return $tipoUsuario;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

    public function toBD() {
        $tipoUsuario = array();

        $tipoUsuario['tipoUsuarioID'] = $this->tipoUsuarioID;
        $tipoUsuario['dsTipo'] = $this->dsTipo;

        return $tipoUsuario;

    }

}