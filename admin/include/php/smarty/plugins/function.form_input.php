<?php

/** <p>
        <label for="field1">Default block label</label>
        <input type="text" id="field1" name="field1"/>
    </p>
 * **/

function smarty_function_form_input($params, $template) {

    $required = isset ($params['required']) ? $params['required'] : false;
    $label = isset ($params['label']) ? $params['label'] : '';
    $title = isset ($params['title']) ? $params['title'] : '';
    $tipo = isset ($params['type']) ? $params['type'] : 'text';
    $nome = isset ($params['name']) ? trim($params['name']) : '';
    $value = isset ($params['value']) ? trim($params['value']) : '';
    $extra = isset ($params['extra']) ? trim($params['extra']) : '';

    $div = "";

    $requiredClass = "";
    if($required){
        $requiredClass = 'class="required"';
    }
   
    if(strlen($nome) > 0){

        $div = '<p>
                    <label for="'.$nome.'" '.$requiredClass.'>'.$label.':</label>
                    <input type="'.$tipo.'" id="'.$nome.'" name="'.$nome.'" value="'.$value.'" '.$extra.' title="'.$title.'" class="full-width"/>
                </p>';

    }



    return $div;
}
?>