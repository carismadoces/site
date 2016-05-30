<?php

class UsuarioBean {

    private $usuarioID;
    private $nome;
    private $login;
    private $senha;
    private $email;
    private $dataCriacao;
    
    private $acoes;

    function __construct($usuarioID = 0, $nome = "", $login = "", $senha = "", $email = "", $dataCriacao = "") {
        $this->usuarioID = $usuarioID;
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
        $this->email = $email;
        $this->dataCriacao = $dataCriacao;
    }

    public function getUsuarioID() {
        return $this->usuarioID;
    }

    public function setUsuarioID($usuarioID) {
        $this->usuarioID = $usuarioID;
    }

	public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }
    
	public function getAcoes(){
		return $this->acoes;
	}

	public function setAcoes($acoes){
		$this->acoes = $acoes;
	}
	
    public function toArray() {
        $usuario = array();

        $usuario['usuarioID'] = $this->usuarioID;
        $usuario['login'] = $this->login;
        $usuario['nome'] = $this->nome;
        $usuario['senha'] = $this->senha;
        $usuario['email'] = $this->email;
        $usuario['dataCriacao'] = $this->dataCriacao;

        return $usuario;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

    public function toBD() {
        $usuario = array();

        $usuario['login'] = $this->login;
        $usuario['nome'] = $this->nome;
        $usuario['senha'] = $this->senha;
        $usuario['email'] = $this->email;
        $usuario['dataCriacao'] = $this->dataCriacao;

        return $usuario;

    }

}