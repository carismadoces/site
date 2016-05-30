<?php

// <button class="grey" type="button"></button>

function smarty_function_action_button($params, $template) {
    
    $label = isset ($params['label']) ? $params['label'] : '';        
    $acao = isset ($params['action']) ? trim($params['action']) : '';
    $class = isset ($params['class']) ? trim($params['class']) : '';
    $tipo = isset ($params['type']) ? $params['type'] : 'button';
    $extra = isset ($params['extra']) ? trim($params['extra']) : '';
    $icon = isset ($params['icon']) ? trim($params['icon']) : '';
    $id = isset ($params['id']) ? trim($params['id']) : '';

    $button = "";
    $location = "";
    if(strlen($acao) > 0)
        $location = 'onclick="window.location.href=\''.$acao.'\'"';

    $imgIcon = "";
    if(strlen($icon) > 0)
        $imgIcon = '<img width="16" height="16" src="include/images/icons/'.$icon.'">';

    $button = '<button id="'.$id.'" class="'.$class.'" '.$location.' type="'.$tipo.'" '.$extra.'>'.$imgIcon.$label.'</button>';

    return $button;
}
?>