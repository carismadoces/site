<?php
/**
 * Description of AssertLengthValidator:
 * 
 * Valida um intervalo de tamanho de valores de uma String, ex: 
 * 
 * \@AssertLengthValidator (min = 2, max = 10)<br/>
 * private $atributo;
 * 
 * OBS: caso o vaor minimo não for estabelecido, irá receber 0 (zero)
 * 
 * @author Magno
 */
class AssertLengthValidator extends BaseValidator{
    
    public $min;
    public $max;
    
    public function validate($value) {
        
        $value = trim($value);
        
        if($this->min == null || strlen($this->min) <= 0)
            $this->min = 0;         
        
        if($this->max == null || strlen($this->max) <= 0)
            throw new ValidatorException ("Error, Maximum Length Not Found in Annotation!!!");
        
        if($this->min >= $this->max)
            throw new ValidatorException ("Error, Range Incorrect!!!");
        
        if($value == null || strlen($value) < $this->min || strlen($value) > $this->max)
            throw new ValidatorException ("Error, Value is not in the Correct Range!!!");
        
    }
    
}

?>
