

<?php

/** MODELO PADRAO
      <p class="message error"></p>
    
    
    /**
     *  MODELO MENOR
     * 
     * <p class="message error"></p>
     * 
     */


function smarty_function_msg($params, $template) {

    $obj = isset ($params['obj']) ? $params['obj'] : null;
    $tam = isset ($params['tam']) ? $params['tam'] : '';
    $tipo = isset ($params['tipo']) ? $params['tipo'] : '';
    $conteudo = isset ($params['conteudo']) ? trim($params['conteudo']) : '';
    $autoClose = isset ($params['autoClose']) ? $params['autoClose'] : true;

    $div = ""; $script = "";
    if($autoClose){
        $script = ' <script type="text/javascript">
                	
                    function fecharAutomatico(){
                	   $(".message '.$tipo.'").fadeOut(1200);
                	}
                    
                    setTimeout("fecharAutomatico()",4000);
                    
                </script> ';
    }
    
    if($obj != null && strlen($obj->getConteudo()) > 0){

        $tipo = $obj->getTipo();
        $conteudo = trim($obj->getConteudo());

    }

    if(strlen($conteudo) > 0){

        $div = $script.'<p class="message '.$tipo.'"><span class="close-bt"></span>'.$conteudo.'</p>';

    }

    
        
    return $div;
}
?>


