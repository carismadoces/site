<?php
/**
 * Description of ValueValidator:
 * 
 * Valida um valor para o Numero passado,
 * pode ser tanto um valor minimo, maximo, quanto um
 * valor exato, ex: 
 * 
 * \@ValueValidator (min = 10, max = 20, assert = 15)<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class ValueValidator extends BaseValidator{
    
    public $max;
    public $min;
    public $assert;
    
    public function validate($value) {
        

        if(!is_numeric($value))
            throw new ValidatorException ("Error, Value is not a Number Correct!!!");
        
        if(isset ($this->assert) && $this->assert > 0 && $value != $this->assert){
            throw new ValidatorException ("Error, Value Incorrect!!!");
        }
        
        if(isset ($this->assert) && $this->assert > 0 && $value == $this->assert){
            return;
        }
        
        if(isset ($this->min) && $this->min > 0 && 
                ($this->max == null || $this->max <= 0) && 
                $value < $this->min){
            throw new ValidatorException ("Error, Minimum Value Invalid!!!");
        }
        
        if(isset ($this->max) && $this->max > 0 && 
                ($this->min == null || $this->min <= 0) && 
                $value > $this->max){
            throw new ValidatorException ("Error, Maximum Value Invalid!!!");
        }
        

        if(isset ($this->min) && isset ($this->max)&& $this->min >= $this->max)
            throw new ValidatorException ("Error, Range Incorrect!!!");        

        
        if(isset ($this->max) && $this->max > 0 && 
                isset ($this->min) && $this->min > 0 && 
                ($value > $this->max || $value < $this->min)){
            throw new ValidatorException ("Error, Value is not in the Correct Range!!!");
        }
        
        
    }
    
}

?>
