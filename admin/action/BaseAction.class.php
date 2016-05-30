<?php

#define('SMARTY_SPL_AUTOLOAD',1);
require dirname(__FILE__).'/../include/php/smarty/Smarty.class.php';

/**
 * Description of BaseAction
 *
 * Classe Base para as outras Actions que fore existir
 *
 * @author Magno
 */
 class BaseAction {
    
    private $input;
    private $output; 
    private $callShow = false;//indica se o metodo show foi chamado ou não
    
    private static $USER = "user";
    private static $SESSION_PARAMS = "session_params";
    public static $SESSION_URL_ANTERIOR = "urlAnterior";
    public static $SESSION_URL_ATUAL = "urlAtual";
    
    public static $ERROS_VALIDACAO = "errosValidacao";

    function __construct() {
        $this->init();
    }

    /**
     * Inicializa a sessão,
     * Seta os parametros do output (SMARTY),
     * e procura parametros na sessao (Para o caso de Actions-Chain)
     */
    private function init(){
        session_start();
        $this->setOutput();
        $this->setOutputFromSession();
    }
    
   
    public function isCallShow() {
        return $this->callShow;
    }

          
    public function getSession() {        
        return $_SESSION;
    }   

    /**
     * Seta um Valor (objeto ou nao) na Sessão
     * @param String $chave - identificação do valor
     * @param Mixed $valor - valor
     */
    public function setValueSession($chave, $valor){
        $_SESSION[$chave] = $valor;
    }

    /**
     * Pega um Valor (objeto ou nao) ga Sessão
     * @param String $chave - identificação do valor
     */
    public function getValueSession($chave){
        return isset ($_SESSION[$chave]) ? $_SESSION[$chave] : null;
    }

    /**
     * Seta um Usuario na Sessão
     * @param UsuarioBean $user - objeto Usuario
     */
    public function setUserSession($user){                
        $_SESSION[BaseAction::$USER] = $user;
    }

    public function getUserSession(){

        if(isset ($_SESSION[BaseAction::$USER]))
            return $_SESSION[BaseAction::$USER];
        return null;
    }

    public function isLogged(){
        if( isset ($_SESSION[BaseAction::$USER]) &&
                $_SESSION[BaseAction::$USER] instanceof UsuarioBean &&
                $_SESSION[BaseAction::$USER]->getUsuarioID() > 0 )
            return true;
        return false;
    }

    public function setUrlAtual($url){
        
        if(isset ($_SESSION[BaseAction::$SESSION_URL_ATUAL]) &&
                strlen($_SESSION[BaseAction::$SESSION_URL_ATUAL]) > 0){

            //Evitando de perder a anterior se ocorrer um Refresh
            if(strcmp($_SESSION[BaseAction::$SESSION_URL_ATUAL], $url) != 0)
                $_SESSION[BaseAction::$SESSION_URL_ANTERIOR] = $_SESSION[BaseAction::$SESSION_URL_ATUAL];
        }

        $_SESSION[BaseAction::$SESSION_URL_ATUAL] = $url;
       
    }

    public function getInput() {
        return $this->input;
    }

    public function setInput($input) {
        $this->input = $input;
    }

    /**
     * Seta no Output os parametros existentes na sessão,
     * metodo utilizado quando ocorrer um Encadeamento de Actions,
     * ou seja o valor de output de uma action e passado para outra
     */
    private function setOutputFromSession(){
        $sessionParams = @$_SESSION[BaseAction::$SESSION_PARAMS];
        
        if(isset ($sessionParams) && count($sessionParams) > 0){

            $keys = array_keys($sessionParams);

            for($i = 0; $i < count($keys); $i++){
                $this->setValueOutput($keys[$i], $sessionParams[$keys[$i]]);
            }

            $_SESSION[BaseAction::$SESSION_PARAMS] = null;
            unset ($_SESSION[BaseAction::$SESSION_PARAMS]);
            
        }
    }

    /**
     * Pega um valor do input (passados como parametro na url ou post)
     * @param String $nome - chave do atributo
     * @return Mixed Retorna o valor para a chave do atributo
     */
    public function getValueInput($nome = ""){
        if(strlen($nome) > 0 && isset ($this->input[$nome])){
            return $this->input[$nome];
        }else
            return null;
    }

    /**     
     * Pega um objeto do input:
     * Popula o objeto de acordo com suas propriedades e os nomes encontrados no INPUT
     * @param String $className - Nome da Classe do Objeto que deseja Popular
     * @param String $prefix - Caso exista algum prefixo nos formulario (Ex.: usuarioEmail, usuarioLogin)
     * @param String $sufix - Caso exista algum sufixo nos formulario (Ex.: emailUsuario, loginUsuario)
     * @return Retorna o objeto populado
     */
    public function getObjectInput($className = "", $prefix = "", $sufix = ""){
        
        $reflec = new ReflectionClass($className);
        $objeto = $reflec->newInstance();
        
        foreach($reflec->getProperties() as $att){

            $atributo = $att->getName();
            $set = "set".strtoupper($atributo[0]).substr($atributo, 1);
            
            if(method_exists($objeto, $set)){                
                $chave = $atributo;

                if(strlen($prefix) > 0)
                    $chave = $prefix.$chave;
                if(strlen($sufix) > 0)
                    $chave = $chave.$sufix;
                
                $objeto->$set(@$this->input[$chave]);

            }
            
        }
        
        /** VALIDANDO O OBJETO POPULADO **/
        
        $validador = new ValidatorAction($objeto);
        $errosValidacao = $validador->validateAll();
        
        if(count($errosValidacao) > 0){
            $this->setValueOutput(BaseAction::$ERROS_VALIDACAO, $errosValidacao);
            throw new ValidatorException("Erros de Validação");
        }
        
        return $objeto;

    }

    public function getOutput() {
        return $this->output;
    }

    /**
     * Seta as configurações do SMARTY
     */
    private function setOutput(){
        $this->output = new Smarty();
        $this->output->cache_dir = dirname(__FILE__)."/../include/php/smarty/cache";
        $this->output->config_dir = dirname(__FILE__)."/../include/php/smarty/configs";
        $this->output->compile_dir = dirname(__FILE__)."/../include/php/smarty/templates_c";
        $this->output->plugins_dir = dirname(__FILE__)."/../include/php/smarty/plugins";        
        $this->output->template_dir = "view/";
        #$this->output->debugging = true;
    }

    /**
     * Seta um objeto no output:
     * Percorre as propriedades do objeto e joga no OUTPUT
     * @param Object $objeto - Objeto a ser injetado
     * @param String $prefix - Caso queria identificar as propriedades com algum prefixo (Ex.: usuarioEmail, usuarioLogin)
     * @param String $sufix - Caso queria identificar as propriedades com algum sufixo (Ex.: emailUsuario, loginUsuario)
     */
    public function setObjectOutput($objeto = null, $prefix = "", $sufix = ""){

        $reflec = new ReflectionClass( $objeto );        

        foreach($reflec->getProperties() as $att){

            $atributo = $att->getName();
            $get = "get".strtoupper($atributo[0]).substr($atributo, 1);

            if(method_exists($objeto, $get)){
                $chave = $atributo;

                if(strlen($prefix) > 0)
                    $chave = $prefix.$chave;
                if(strlen($sufix) > 0)
                    $chave = $chave.$sufix;
                
                $this->output->assign($chave,$objeto->$get());

            }

        }
    }

    /**
     * Joga um valor no output
     * @param String $chave - nome de idenficação do valor
     * @param Mixed $valor - valor a ser injetado (pode ser qualquer tipo de dado: String, int, array, etc)
     */
    public function setValueOutput($chave,$valor){                
        $this->output->assign($chave,$valor);        
    }

    /**
     * Abre uma pagina (template)
     * Usa-se no final da execução dos metodos nas actions     
     * @param String $tpl - Pagina (template) a ser aberta
     */
    public function show($tpl){
        $this->callShow = true;
        $this->output->display($tpl);
    }
    
    /**
     * Retorna o conteudo de uma pagina (template)
     * @param String $tpl - Pagina (template) a ser retornada
     */
    public function getHtml($tpl){
        return $this->output->fetch($tpl);
    }

    /**
     * Redireciona para uma página
     * Detalhe: Caso, ocorra um ecadeamento de ações (ex.: de salvar, chama listar)
     * os parametros da primeira serão pertido ,caso não seja desejado use 
     * a function chain
     * @param String $url - url de redirecionamento (Ex.: UsuarioActioin.listar)
     */
    public function redirect($url){        
        header("Location: $url");
    }

    /**
     * Redirecona para uma página sem perder os parametros,
     * deve ser usada quando ocorre encadeamento de ações (ex.: de salvar, chama listar)
     * os parametros da primeira não serão pertidos, caso não seja desejado use
     * a function redirect
     * @param String $url - url de redirecionamento (Ex.: UsuarioActioin.listar)
     */
    public function chain($url){        
        $_SESSION[BaseAction::$SESSION_PARAMS] = $this->output->getTemplateVars();
        header("Location: $url");        
    }

    /**
     * Redirecona para a úlima página visitada sem perder os parametros,
     * pode ser usada quando ocorre algum erro esperado ou não na Action
     * os parametros da primeira não serão pertidos, caso não seja desejado use
     * a function redirect
     * @param String $url - url de redirecionamento (Ex.: UsuarioActioin.listar)
     */
    public function voltar(){
                
        $valores =  array_merge($this->input, $this->output->getTemplateVars());
        $_SESSION[BaseAction::$SESSION_PARAMS] = $valores;
        
        header("Location: ".$_SESSION[BaseAction::$SESSION_URL_ANTERIOR]);   
    }
    
}
?>
