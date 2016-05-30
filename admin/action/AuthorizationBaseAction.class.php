<?php

/**
 * Classe Base para A Autorização nas Actions
 *
 * @author Magno
 */
class AuthorizationBaseAction {
    
    private $autorizacao;
    private static $LIVRE = "L";

    function __construct() {
        $this->autorizacao = array();
    }

    /**
     * Retorna o array montado com as autorizações
     * @return array
     */
    public function getAutorizacao() {
        return $this->autorizacao;
    }   

    /**
     * Adicionar todos os metodos de uma action para
     * um determinado grupo de usuarios
     * @param String $action Nome da Action
     * @param int $tipoUsuario Grupo de Usuario
     */
    public function addActionLivre($action, $tipoUsuario = "L"){

        $reflec = new ReflectionClass($action);
        $metodos = $reflec->getMethods(ReflectionMethod::IS_PUBLIC);

        $mets = array();

        foreach ($metodos as $met){
            //evitando pegar os metodos das superclasses
            if(strcmp($action, $met->class) == 0)
                $mets[] = $met->getName();
        }

        $this->autorizacao[$tipoUsuario][$action] = $mets;
    }

    /**
     * Adicionar um metodo especifico de uma action para
     * um determinado grupo de usuarios
     * @param String $action Nome da Action
     * @param String $metodo Nome do Metodo
     * @param int $tipoUsuario Grupo de Usuario
     */
    public function addMetodoLivre($action,$metodo,$tipoUsuario = "L"){
        $this->autorizacao[$tipoUsuario][$action][] = $metodo;
    }   

    /**
     * Verifica se o usuario pode acessar o metodo da action
     * @param int $tipoUsuario Grupo de Usuario
     * @param String $action Nome da Action
     * @param String $metodo Nome do Metodo     
     * @return true|false
     */
    public function isAutorizado($user,$action,$metodo){

        if(isset ($this->autorizacao[AuthorizationBaseAction::$LIVRE])){
            $actionsLivres = $this->autorizacao[AuthorizationBaseAction::$LIVRE];
            
            if(isset ($actionsLivres[$action])){
                $metodosLivres = $actionsLivres[$action];            
                
				$ind = array_search($metodo, $metodosLivres);

				if($ind !== false) return true;
			}
            
        }

        if($user == null) return false;

        if(isset ($this->autorizacao[$user->getTipo()])){
            $actionsLivres = $this->autorizacao[$user->getTipo()];
            if(isset ($actionsLivres[$action]))
                $metodosLivres = $actionsLivres[$action];
            else
                return false;

            $ind = array_search($metodo, $metodosLivres);
            
            if($ind !== false) return true;
            return false;
        }

        

    }


}
?>
