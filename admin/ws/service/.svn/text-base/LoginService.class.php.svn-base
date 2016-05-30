<?php
/**
 * Classe que representa os recursos WebService da Galeria
 * @access public
 * @author Daniel Eduardo
 * @package ws
 */
class LoginService {
	
	private $bean; 
	
	function LoginService() {
		$this->bean = new LoginBean();
	}
	
	function get(){

		$this->getBean();
		
		$content_type = 'text/json';
		$status_header = 'HTTP/1.1 200 OK';
		// set the status
		header($status_header);
		// set the content type
		header('Content-type: ' . $content_type);
		
		echo Util::array_to_json(true);

	}
	
	public function getBean(){
		return $this->bean;
	}
	
	public function setBean($bean){
		$this->bean = $bean;
	}
}