<?php
function smarty_function_display_errors($params, $template) {

    $errors = isset ($params['errors']) ? $params['errors'] : null;
    $autoClose = isset ($params['autoClose']) ? $params['autoClose'] : false;

    if($errors == null || count($errors) <= 0) return '';
    
    $div = ""; $script = "";
    if($autoClose){
        $script = ' <script type="text/javascript">
                	
                    function fecharAutomatico(){
                	   $(".message error").fadeOut(1200);
                	}
                    
                    setTimeout("fecharAutomatico()",4000);
                    
                </script> ';
    }
    
    $conteudo = "";
    
    for ($i=0; $i<count($errors); $i++) {
        $er = $errors[$i];
        
        $onClick = "";
        $onMouseOver = "";
        $onMouseOut = "";
        
        if(strlen($er->getAtributo()) > 0){        
            $onClick = "onclick=\"$('#".$er->getAtributo()."').focus();\"";
            $onMouseOver = "onmouseover=\"$('#".$er->getAtributo()."').addClass('error');\"";
            $onMouseOut = "onmouseout=\"$('#".$er->getAtributo()."').removeClass('error');\"";
        }
        
        $conteudo .= "<span $onClick style=\"cursor: pointer;\" 
            $onMouseOver $onMouseOut>$er<br /></span>";
    }    

    if(strlen($conteudo) > 0){
        $div = $script.'<div class="message error"><span class="close-bt"></span>'.$conteudo.'</div>';
    }
        
    return $div;
}
?>


