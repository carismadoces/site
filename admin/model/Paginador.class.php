<?php
/**
 * Classe que representa o bean do paginador, classe respons‡vel por armazenar os dados de para uma resposta com 
 * elementos de uma pagina‹o.
 * @access public
 * @author Daniel Eduardo
 * @package model
 */
class Paginador extends GenericBean{
	
    private $colecao;
    private $pagina;
    private $total;
    
    function __construct() {
    }

    public function getColecao() {
        return $this->colecao;
    }

    public function setColecao($colecao) {
        $this->colecao = $colecao;
    }
	
	public function getPagina() {
        return $this->pagina;
    }

    public function setPagina($pagina) {
        $this->pagina = $pagina;
    }
    
	public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }
    
    public function toArray() {
        $paginador = array();

        $paginador['colecao'] = $this->colecao;
        $paginador['pagina'] = $this->pagina;
        $paginador['total'] = $this->total;
		
        return $paginador;
    }
}
?>