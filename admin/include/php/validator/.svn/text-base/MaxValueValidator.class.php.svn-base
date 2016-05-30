<?php
/**
 * Description of MaxValueValidator:
 * 
 * Valida o valor maximo para o valor passado, ex: 
 * 
 * \@MaxValueValidator (max = 10)<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class MaxValueValidator extends BaseValidator{
    
    public $max;
    
    public function validate($value) {
        
        $value = trim($value);
        
        if($this->max == null || strlen($this->max) <= 0)
            throw new ValidatorException ("Error, Maximum Value Not Found in Annotation!!!");
        
        if($value == null || $value > $this->max)
            throw new ValidatorException ("Error, Value is Greater than the Maximum Allowed!!!");
        
    }
    
}

?>
