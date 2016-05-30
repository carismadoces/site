<?php
/**
 * Description of MinLengthValidator:
 * 
 * Valida um valor minimo para a String passada, ex: 
 * 
 * \@MinLengthValidator (min = 10)<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class MinLengthValidator extends BaseValidator{
    
    public $min;
    
    public function validate($value) {
        
        $value = trim($value);
        
        if($this->min == null || strlen($this->min) <= 0)
            throw new ValidatorException ("Error, Minimum Length Not Found in Annotation!!!");
        
        if($value == null || strlen($value) < $this->min)
            throw new ValidatorException ("Error, Minimum Length Invalid!!!");
        
    }
    
}

?>
