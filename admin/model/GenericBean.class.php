<?php
/**
 * Classe genérica Bean
 * @access public
 * @author Daniel Eduardo
 * @package model
 */
class GenericBean {

	private $pagina;
	private $limite;
	 
	public function getPagina() {
		return $this->pagina;
	}

	public function setPagina($pagina) {
		$this->pagina = $pagina;
	}

	public function getLimite() {
		return $this->limite;
	}

	public function setLimite($limite) {
        $this->limite = $limite;
    }
}
?>