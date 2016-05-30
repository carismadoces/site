<?php
/**
 * Description of ValidatorException
 *
 * Classe que representa a exceção lançada pelos validadores
 * 
 * @author Magno
 */
class ValidatorException extends Exception{

    public function __construct($message) {
        parent::__construct($message);
    }
    
}

?>
