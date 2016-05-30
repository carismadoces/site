<?php
/**
 * Description of MaxLengthValidator:
 * 
 * Valida um valor maximo para a String passada, ex: 
 * 
 * \@MaxLengthValidator (max = 10)<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class MaxLengthValidator extends BaseValidator{
    
    public $max;
    
    public function validate($value) {
        
        $value = trim($value);
        
        if($this->max == null || strlen($this->max) <= 0)
            throw new ValidatorException ("Error, Maximum Length Not Found in Annotation!!!");
        
        if($value == null || strlen($value) > $this->max)
            throw new ValidatorException ("Error, Maximum Length Invalid!!!");
        
    }
    
}

?>
