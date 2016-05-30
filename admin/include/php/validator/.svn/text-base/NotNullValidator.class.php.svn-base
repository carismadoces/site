<?php
/**
 * Description of NotNullValidator:
 * 
 * Valida um valor que não pode ser nulo, ex: 
 * 
 * \@NotNullValidator<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class NotNullValidator extends BaseValidator{
    
    public function validate($value) {
        if($value == null)
            throw new ValidatorException ("Error, Value Can't Be NULL !!!");
    }
    
}

?>
