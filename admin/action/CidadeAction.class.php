<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CidadeAction
 *
 * @author Magno
 */
class CidadeAction extends BaseAction{

    private $cidadeService;

    public static $VIEW_CIDADE = "view/cidade/";

    function __construct() {
        parent::__construct();
        $this->cidadeService = new CidadeService();
    }

    public function listarComboAjax(){
        $estadoID = intval(parent::getValueInput('estadoID'));

        if($estadoID > 0)
            $cidades = $this->cidadeService->listar(0,"",$estadoID);
        else
            $cidades = array();

        parent::setValueOutput('cidades', Util::arrayCombo($cidades, "cidadeID", "nome"));        
        parent::show(CidadeAction::$VIEW_CIDADE."combo.tpl");
    }
}
?>
