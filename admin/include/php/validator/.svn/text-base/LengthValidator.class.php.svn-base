<?php
/**
 * Description of LengthValidator:
 * 
 * Valida um valor de tamanho para uma String ou Array passado,
 * pode ser tanto um valor minimo, maximo, quanto um
 * valor exato, ex: 
 * 
 * \@LengthValidator (min = 10, max = 20, assert = 15)<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class LengthValidator extends BaseValidator{
    
    public $max;
    public $min;
    public $assert;
    
    public function validate($value) {
        
        $op = "";
        if(is_array($value))
            $op = "count";
        else if(is_string($value)){
            $op = "strlen";
            $value = trim($value);
        }else
            throw new ValidatorException ("Error, Type Value Invalid!!!");
        
        if(isset ($this->assert) && intval($this->assert) > 0 && $op($value) != $this->assert){
            throw new ValidatorException ("Error, Value Length Incorrect!!!");
        }
        
        if(isset ($this->assert) && intval($this->assert) > 0 && $op($value) == $this->assert){
            return;
        }
        
        if(isset ($this->min) && intval($this->min) > 0 && 
                ($this->max == null || intval($this->max) <= 0) && 
                $op($value) < $this->min){
            throw new ValidatorException ("Error, Minimum Length Invalid!!!");
        }
        
        if(isset ($this->max) && intval($this->max) > 0 && 
                ($this->min == null || intval($this->min) <= 0) && 
                $op($value) > $this->max){
            throw new ValidatorException ("Error, Maximum Length Invalid!!!");
        }
        

        if(isset ($this->min) && isset ($this->max)&& $this->min >= $this->max)
            throw new ValidatorException ("Error, Range Incorrect!!!");        

        
        if(isset ($this->max) && intval($this->max) > 0 && 
                isset ($this->min) && intval($this->min) > 0 && 
                ($op($value) > $this->max || $op($value) < $this->min)){
            throw new ValidatorException ("Error, Value is not in the Correct Range!!!");
        }
        
        
    }
    
}

?>
