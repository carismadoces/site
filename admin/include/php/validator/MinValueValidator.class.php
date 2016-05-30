<?php
/**
 * Description of MinValueValidator:
 * 
 * Valida o valor minimo para o valor passado, ex: 
 * 
 * \@MinValueValidator (min = 10)<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class MinValueValidator extends BaseValidator{
    
    public $min;
    
    public function validate($value) {
        
        if($this->min == null || strlen($this->min) <= 0)
            throw new ValidatorException ("Error, Minimum Value Not Found in Annotation!!!");
        
        if($value == null || $value < $this->min)
            throw new ValidatorException ("Error, Value is Less than the Minimum Allowed!!!");
        
    }
    
}

?>
