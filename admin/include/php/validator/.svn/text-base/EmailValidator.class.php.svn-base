<?php
/**
 * Description of EmailValidator:
 * 
 * Valida um email com formato correto (mail@mail.com), ex: 
 * 
 * \@EmailValidator<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class EmailValidator extends BaseValidator{
    
    public function validate($value) {
        
        $value = trim($value);
        
        $pattern = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
        
        if($value == null || !preg_match($pattern, $value))
            throw new ValidatorException ("Error, Email Invalid!!!");
    }
    
}

?>
