<?php
/**
 * Description of MaskValidator:
 * 
 * Valida um valor correto de acordo com a mascara, ex: 
 * 
 * \@MaskValidator (mask = "99/99/9999")<br/>
 * private $atributo;
 * 
 * 9 - Numeros de 0 a 9;<br/>
 * a - Letras Minusculas de "a" a "z";<br/>
 * A - Letras Maiusculas de "A" a "Z";<br/>
 * # - Letra ou Número;<br/>
 * * - Qualquer valor;<br/>
 * 
 * @author Magno
 */
class MaskValidator extends BaseValidator{
    
    private $COD_NUMERO = "9";
    private $COD_LETRA_MIN = "a";
    private $COD_LETRA_MAI = "A";
    private $COD_ALFA_NUM = "#";
    private $COD_QUALQUER = "*";
    private $reservados = array("[","/","^","$",".","|","?","*","+","(",")");
    
    public $mask;
    
    public function validate($value) {
        
        $value = trim($value);
        
        if($this->mask == null || strlen($this->mask) <= 0)
            throw new ValidatorException ("Error, Mask Not Found in Annotation!!!");
                
        $pattern = $this->geraER($this->mask);
        
        if($value == null || !preg_match($pattern, $value))
            throw new ValidatorException ("Error, Format Invalid!!!");
        
    }
    
    private function geraER($mask){
        $expRegular = "/^";
        
        for ($i = 0; $i < strlen($mask); $i++) {
            
            $charPos = $mask[$i];
            
            $more = "+";
            
            if($i == strlen($mask) -1) $more = "";
            
            if(strcmp($charPos, $this->COD_NUMERO) == 0){
                $expRegular .= "[0-9]".$more;
            }else if(strcmp($charPos, $this->COD_LETRA_MAI) == 0){
                $expRegular .= "[A-Z]".$more;
            }else if(strcmp($charPos, $this->COD_LETRA_MIN) == 0){
                $expRegular .= "[a-z]".$more;
            }else if(strcmp($charPos, $this->COD_ALFA_NUM) == 0){
                $expRegular .= "[a-zA-Z]|[0-9]".$more;
            }else if(strcmp($charPos, $this->COD_QUALQUER) == 0){
                $expRegular .= ".".$more;
            }else{
                
                $escape = "";
                if(array_search($charPos, $this->reservados))
                    $escape = "\\";
                        
                $expRegular .= $escape.$charPos;
            }
            
        }
        
        $expRegular .= "$/";
        
        return $expRegular;
        
    }
    
}

?>
