<?php
/**
 * RETORNA VERDADEIRO CASO O USUÁRIO TENHA ACESSO A AÇÃO SOLICITADA.
 */
function smarty_function_user_permission($params, $template) {
    
	$pathParam = isset ($params['path']) ? $params['path'] : '';
	$user = $_SESSION['user'];
    
    $acoes = $user->getAcoes();
    if ( count($acoes) > 0 ){
	    foreach ($acoes as $acao){
	    	if ( strcmp($acao->getPath(), $pathParam) === 0 ){
	    		return true;
	    	}
	    }
    }
    
    return false;
}
?>


