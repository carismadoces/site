<?php

/**
 * Description of SystemActionWS
 *
 * Classe Principal dos Serviços WebService :
 *
 * Quebra a url, montando o serviço, seus recursos e os parâmetros
 * e depois o executa
 *
 * @author Daniel Eduardo
 */
class SystemActionWS {

    private $url;
    private $actionClass;
    private $actionMetodo;
    private $params;
    private $paramsMethod;
    private $subAction;
    
    private $acaoLivre = array();

    function __construct() {
        $this->setUrl();
        $this->explodeUrl();
        $this->configAcaoLivre();
    }

    public function getUrl() {
        return $this->url;
    }

    /**
     * Seta a url q vem pelo GET
     */
    private function setUrl() {
        $_GET['url'] = isset($_GET['url']) ? $_GET['url'] : null;
        $this->url = $_GET['url'];
    }

    /**
     * Explode a Url - Dividindo em Action (Classe e Metodo)
     * e Parametros
     */
    private function explodeUrl() {
        $this->explodeAction();
        $this->explodeParams();
    }

    /**
     * Explode a String da Action em Classe e Metodo
     */
    private function explodeAction() {

        $arrayUrl = explode("/", str_replace(Constantes::$CONTEXT_PATH, '', $this->url));
        $actionClass = $arrayUrl[0];
		$actionClass = ucwords($actionClass) . "Service";

        $this->setActionClass($actionClass);
        $this->setActionMetodo($arrayUrl[1]);
    }

    /**
     * Monta a String com os Parametros
     */
    private function explodeParams() {
        $arrayUrl = explode("?", $_SERVER['REQUEST_URI']);
        if (count($arrayUrl) > 1)
            $explodeParams = $arrayUrl[1];
        else
            $explodeParams = "";

        $this->setParams($explodeParams);
    }

    public function getActionClass() {
        return $this->actionClass;
    }

    private function setActionClass($actionClass) {
        $this->actionClass = $actionClass;
    }

    public function getActionMetodo() {
        return $this->actionMetodo;
    }

    private function setActionMetodo($actionMetodo) {
        $this->actionMetodo = $actionMetodo;
    }

    public function getParams() {
        return $this->params;
    }

    /**
     * Explode os parametros, montando um ARRAY
     * @param String $explodeParams - parametros
     */
    public function setParams($arrayUrl) {
        $this->params = array();

        if (count($arrayUrl) > 0) {

        	$parametros = explode("&", $arrayUrl); 
            for ($i = 0; $i < count($parametros); $i++) {
            	$param = explode("=", $parametros[$i]);
            	
            	if ( $param[0] != null && $param[1] != null ){
               		$this->params[addslashes(trim($param[0]))] = addslashes(trim($param[1]));
            	}
            }
        }

        if (count($_POST) > 0) {
            $this->params = $_POST;

            $keys = array_keys($_POST);

            for ($i = 0; $i < count($keys); $i++) {
                $this->params[addslashes(trim($keys[$i]))] = addslashes(trim($_POST[$keys[$i]]));
            }
        }
    }

    public function isAjax() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strcmp(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']),'xmlhttprequest') == 0);
    }

    public function getSubAction() {
        return $this->subAction;
    }

    public function setSubAction($subAction) {
        $this->subAction = $subAction;
    }
	
    /**
     * Instancia a Action passada e executa o metodo
     */
    public function run() {
        
        $isAjax = false;
        
        $this->subAction = new $this->actionClass();
        $metodo = $this->actionMetodo;
        
//        if (!method_exists($this->subAction, $metodo)){
//            $this->showErro("Funcionalidade Não Encontrada!!!");
//            return;
//        }

        try {
            
//        	$action = $this->actionClass . '.' . $this->actionMetodo;
//        	if( !$this->subAction->isLogged() && !empty($this->subAction) && !$this->isAcaoLivreAutenticacao($action) ) {
//        		$this->subAction->setValueOutput('urlAnterior',  implode(".", array($this->actionClass, $this->actionMetodo) ) );
//                $this->subAction->show('view/login/login.tpl');
//                return;
//        	}
        	
        	//Verificando Autorizaçao
            /*
        	$autorizacao = new AuthorizationAction();
            if(!$autorizacao->isAutorizado($this->subAction->getUserSession(), $this->actionClass, $metodo,$this->subAction->getValueSession(Constantes::$SESSION_NIVEL_USUARIO))){
                $this->subAction->setValueOutput('urlAnterior', $this->subAction->getValueSession(BaseAction::$SESSION_URL_ANTERIOR));
                $this->subAction->show('view/login/acessoNegado.tpl');
                return;
            }
            */
        	
			$login = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : null;
	        $senha = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : null;
	        if (true){
	        //if ( $login != null && $senha != null ){
	        	$usuarioDAO = new UsuarioDAO(); 
		        $usuario = new UsuarioBean(null, null, $login, $senha);
				$usuario = $usuarioDAO->buscarUsuario($usuario);

				if (true){
		        //if(!empty($usuario) && Seguranca::testaSenha($senha, $usuario->getSenha()) === TRUE){
		            
			        $metodo = $this->buscaMetodo();
		        	
					if ( $metodo != null ){
			            $refMetodo = new ReflectionMethod($this->actionClass, $metodo);
			            
			            // Valida type request method
			            $execMethod = $this->typeRequestMethod($refMetodo);
			            if ($execMethod){
			            
				            $metParametros = $refMetodo->getParameters();
				
				            if ( !isset($this->paramsMethod) && $this->paramsMethod == null ){
				            	$this->paramsMethod = $this->params;
				            }
				            
				            $this->atribuirValoresBean();
				            $rs = $refMetodo->invokeArgs($this->subAction, $this->paramsMethod);
			            }
					}else{
						// TODO Tratar erro path n�o encontrado
						$status_code = 404;
						header(Constantes::$HTTP_STATUS[$status_code], null, $status_code);
					}
				
		        }else{			        
		        	header('WWW-Authenticate: Basic realm="Autenticacao Hitech Student"');
    				header('HTTP/1.0 401 Unauthorized');
		        }
	        }else{
	        	header('WWW-Authenticate: Basic realm="Autenticacao Hitech Student"');
    			header('HTTP/1.0 401 Unauthorized');
	        }
	        
        } catch (ValidatorException $ex) { 

            //QUANDO OCORRE ERRO DE VALIDAÇÃO VOLTA PRO PRA PAGINA ANTERIOR
            $this->subAction->voltar();
            
        }catch (Exception $ex) {

        	$status_code = 500;
        	header(Constantes::$HTTP_STATUS[$status_code], null, $status_code);
        	
        	//QUANDO OCORRE ALGUM ERRO INESPERADO VAI PARA PAGINA DE ERROS
			echo $ex->getMessage();
        }
    }

    function typeRequestMethod($refMetodo){
    	
    	$ref = new ReflectionAnnotatedMethod($this->actionClass, $refMetodo->getName());
    	$annotation = $ref->getAnnotation('RequestMethod');
    	
    	$method = $_SERVER['REQUEST_METHOD'];
    	/*
    	if (strpos($annotation->value, $method) === FALSE){
    		$status_code = 405;
			header(Constantes::$HTTP_STATUS[$status_code], null, $status_code);
			header("Allow: " . $annotation->value, true, 405);
    		return false;
    	}*/
    	return true;
    }
    
    /**
     * TODO  IMPLEMENTA��O TEMPOR�RIA.
     * MODIFICAR IMPLEMENTA��O PARA UTILIZAR COMPARA��O VIA EXPRESS�O REGULAR.
     */
    private function buscaMetodo(){
		
	    $class_methods = get_class_methods($this->actionClass);
		foreach ($class_methods as $method_name) {
		    $ref = new ReflectionAnnotatedMethod($this->actionClass, $method_name);          
        	$annotation = $ref->getAnnotation('PathParam');
        	
        	if ( isset($annotation->value) && $this->comparaPath($annotation->value) ){
				return $method_name;        		
        	}
		}
		
		return null;
    }
    
    private function comparaPath($pm){
    	
    	$pmArray = explode("/", substr($pm, 1, strlen($pm)));
		$cmArray = explode("/", str_replace(Constantes::$CONTEXT_PATH, "", $this->url));
    	
		if ( sizeof($pmArray) != sizeof($cmArray) ){
			return false;
		}
		
		$i=0;
    	foreach ($pmArray as $pma) {
    		
    		if ( Util::startswith($pma, ":") ){
    			$this->paramsMethod[] = $cmArray[$i];
    		}else if ( strcmp($pma, $cmArray[$i]) != 0 ){
    			return false;
    		}
    		$i++;
    	}
    	
    	return true;
    	
    }
    
    private function atribuirValoresBean(){
    	
    	$getBean = 'getBean';
    	if( method_exists($this->subAction, $getBean) ){
    		$bean = $this->subAction->$getBean();

	    	$chaves = array_keys($this->params);
	    	for ($i=0; $i < count($chaves); $i++) {

	    		$chave = $chaves[$i];
	    		$valorAtributo = $this->params[$chave];
				$this->atribuirValor($bean, $chave, $valorAtributo);
	        }
    	}
    }
    
    /**
     * Função recursiva que popula objeto dentro de objeto. 
     * @param unknown_type $bean
     * @param unknown_type $chave
     * @param unknown_type $valor
     */
    private function atribuirValor($bean, $chave, $valor){
    	try{
    		
    		$chaveArray = explode("_", $chave);
			if ( count($chaveArray) > 1 ){
				
				$attributeName = $chaveArray[0];
				
				unset($chaveArray[0]);
				
				$methodName = new ReflectionMethod($bean, 'get'.ucwords($attributeName));
				$propertyValue = $methodName->invokeArgs($bean, array());
					
				if ($propertyValue == null){
					$rc = new ReflectionClass(ucwords($attributeName) . 'Bean');
					$rcInstance = $rc->newInstance();
					$refSet = new ReflectionMethod($bean, 'set'.ucwords($attributeName));
					$refSet->invokeArgs($bean, array($rcInstance));

					$this->atribuirValor($rcInstance, implode("_", $chaveArray), $valor);
				}else{
					$this->atribuirValor($propertyValue, implode("_", $chaveArray), $valor);
				}					
				
			}else{		
		    	$refMetodo = new ReflectionMethod($bean, 'set'.ucwords($chave));
		    	$refMetodo->invoke($bean, $valor);
			}
	    	
    	}catch (Exception $ex){
    	}
    }
    
    private function isAcaoLivreAutenticacao($url){

    	for ($i=0; $i < sizeof($this->acaoLivre); $i++){
    		if ( strcmp($this->acaoLivre[$i], $url) == 0 ){
    			return true;
    		}
    	}
    	
    	return false;
    }
    
    private function addAcaoLivre($url){
    	$this->acaoLivre[sizeof($this->acaoLivre)] = $url;
    }
    
    private function configAcaoLivre(){
    	$this->addAcaoLivre("LoginAction.login");
    }
    
    public function showErro($mensagem, $pilha = "", $arquivo = ""){
    }
}

?>