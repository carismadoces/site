<?php
/**
 * Description of NotEmptyValidator:
 * 
 * Valida uma String que não pode ser em branco, ex: 
 * 
 * \@NotEmptyValidator<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class NotEmptyValidator extends BaseValidator{
    
    public function validate($value) {
        
        $op = "";
        
        if(is_string($value))
            $op = "strlen";
        else if(is_array($value))
            $op = "count";
        else
            throw new ValidatorException ("Error, Type Value Invalid!!!");
        
        $value = trim($value);
        
        if($value == null || $op($value) <= 0)
            throw new ValidatorException ("Error, Value Can't Be Empty !!!");
    }
    
}

?>
