<?php

include_once 'include/php/addendum/annotations.php';

/**
 * Description of ValidatorAction
 *
 * Classe que faz a validação de acordo com as annotations nos beans
 * 
 * @author Magno
 */
class ValidatorAction {
    
    private $class;
    private $erros;
    
    function __construct($class) {
        $this->class = $class;
        $this->erros = array();
    }
    
    
    /**
     * Valida alguma propriedade especifica da classe (instancia) passada    
     * @return Array com os erros (objeto metadado) 
     */
    public function validate($property){        
        
        $ref = new ReflectionAnnotatedProperty($this->class, $property);          
        $annotations = $ref->getAllAnnotations();
        
        $errosTemp = array();
        
        foreach ($annotations as $anot) {
            
            try {
                
                $get = "get".ucfirst($property);                
                $anot->validate($this->class->$get());
                
            } catch (ValidatorException $ve) {              
                $erroMeta = new ErroMeta($ref->class, $property, $ve->getMessage());                
                $errosTemp[] = $erroMeta;
                $this->erros[] = $erroMeta;
            }
                    
        }                                
        
        return $errosTemp;
                
    }
    
    /**
     * Valida todas as propriedades da classe (instancia) passada    
     * @return Array com os erros (objeto metadado) 
     */
    public function validateAll(){
        
        $this->erros = array();
        
        $reflec = new ReflectionClass($this->class);
        
        foreach($reflec->getProperties() as $att){
            $this->validate($att->getName());
        }
        
        return $this->erros;
        
    }
    
    

    
}

?>
