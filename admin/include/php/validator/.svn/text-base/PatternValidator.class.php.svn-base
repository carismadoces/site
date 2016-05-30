<?php
/**
 * Description of PatternValidator:
 * 
 * Valida um padrão com formato correto (expressão de linguagem), ex: 
 * 
 * \@PatternValidator<br/>
 * private $atributo;
 * 
 * @author Magno
 */
class PatternValidator extends BaseValidator{
    
    public $pattern;
    
    public function validate($value) {
        
        if($this->pattern == null || strlen($this->pattern) <= 0)
            throw new ValidatorException ("Error, Pattern Not Found in Annotation!!!");
        
        $value = trim($value);
        
        if($value == null || preg_match($this->pattern, $value))
            throw new ValidatorException ("Error, Format Invalid!!!");
    }
    
}

?>
