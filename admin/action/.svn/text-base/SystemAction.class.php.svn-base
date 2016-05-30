<?php

/**
 * Description of SystemAction
 *
 * Classe Principal das Actions :
 *
 * Quebra a url, montando a classe action passada e seu metodo
 * e depois o executa
 * Tambem separa a string com os parametros
 *
 * @author Daniel
 */
class SystemAction {

    private $url;
    private $actionClass;
    private $actionMetodo;
    private $params;
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
        $_GET['url'] = isset($_GET['url']) ? $_GET['url'] : 'IndexAction.index';
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

        if (strpos($this->url, ".") === FALSE)
            $this->url .= ".index";

        $arrayUrl = explode(".", $this->url);

        if (strpos($arrayUrl[1], "!"))
            $arrayUrl[1] = substr($arrayUrl[1], 0, strpos($arrayUrl[1], "!"));

        $this->setActionClass($arrayUrl[0]);
        $this->setActionMetodo($arrayUrl[1]);
    }

    /**
     * Monta a String com os Parametros
     */
    private function explodeParams() {
        $arrayUrl = explode("!", $this->url);
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
    public function setParams($explodeParams) {
        $this->params = array();

        if (strlen($explodeParams) > 0) {

            $parametros = explode(",", $explodeParams);

            for ($i = 0; $i < count($parametros); $i++) {
                $param = explode("-", $parametros[$i]);
                if (Constantes::$URL_CRIPTOGRAFADA) {
                    $param[0] = Seguranca::descriptografaLink($param[0]);
                    $param[1] = Seguranca::descriptografaLink($param[1]);
                }
                $this->params[addslashes(trim($param[0]))] = addslashes(trim($param[1]));
            }
        } else if (count($_POST) > 0) {
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
        
        if (!method_exists($this->subAction, $metodo)){
            $this->showErro("Funcionalidade Não Encontrada!!!");
            return;
        }

        $this->subAction->setInput($this->params);

        if (!$this->isAjax())
            $this->subAction->setUrlAtual($this->url);
        else
            $isAjax = true;

        try {
            
        	$action = $this->actionClass . '.' . $this->actionMetodo;
        	if( !$this->subAction->isLogged() && !empty($this->subAction) && !$this->isAcaoLivreAutenticacao($action) ) {
        		$this->subAction->setValueOutput('urlAnterior',  implode(".", array($this->actionClass, $this->actionMetodo) ) );
                $this->subAction->show('view/login/login.tpl');
                return;
        	}
        	
        	//Verificando Autorizaçao
            /*
        	$autorizacao = new AuthorizationAction();
            if(!$autorizacao->isAutorizado($this->subAction->getUserSession(), $this->actionClass, $metodo,$this->subAction->getValueSession(Constantes::$SESSION_NIVEL_USUARIO))){
                $this->subAction->setValueOutput('urlAnterior', $this->subAction->getValueSession(BaseAction::$SESSION_URL_ANTERIOR));
                $this->subAction->show('view/login/acessoNegado.tpl');
                return;
            }
            */
        	
            $refMetodo = new ReflectionMethod($this->actionClass, $metodo);
            $metParametros = $refMetodo->getParameters();

            $paramValues = array();

            foreach ($metParametros as $metPar) {
                $name = $metPar->getName();

                if (stripos($name, "Bean"))
                    $paramValues[$name] = $this->subAction->getObjectInput(ucfirst($name));
                else
                    $paramValues[$name] = $this->subAction->getValueInput($name);
            }

            $rs = $refMetodo->invokeArgs($this->subAction, $paramValues);
            
            //coloca o retorno da action chamada no output
            if(isset ($rs))
                $this->subAction->setValueOutput("rs".$metodo,$rs);
            
            //se não chamou o método show redireciona para o  tpl com o mesmo nome do método chamado
            if (!$this->subAction->isCallShow() && !$isAjax) {
                $uri = $this->subAction->getView() . $metodo . ".tpl";
                $this->subAction->show($uri);                
            }
            
        } catch (ValidatorException $ex) { 

            //QUANDO OCORRE ERRO DE VALIDAÇÃO VOLTA PRO PRA PAGINA ANTERIOR
            $this->subAction->voltar();
            
        }catch (Exception $ex) {

        	//QUANDO OCORRE ALGUM ERRO INESPERADO VAI PARA PAGINA DE ERROS
            $this->showErro($ex->getMessage(), $ex->getTraceAsString(), $ex->getFile());
            
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
    	$this->addAcaoLivre("ModalidadeAction.consultarHorariosModalidadeAjax");
    	$this->addAcaoLivre("LoginAction.login");
    }
    
    public function showErro($mensagem, $pilha = "", $arquivo = ""){
        $this->subAction->setValueOutput('classe', $this->url);
        $this->subAction->setValueOutput('mensagem', $mensagem);
        $this->subAction->setValueOutput('pilha', $pilha);
        $this->subAction->setValueOutput('arquivo', $arquivo);
        $this->subAction->show("view/erros/error.tpl");
    }

}

?>
