<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexAction
 *
 * @author Daniel Eduardo
 */
class IndexAction extends BaseAction {
    
    public static $VIEW = "view/";

    function __construct() {
        parent::__construct();
    }

    public function index(){                               
        parent::show( IndexAction::$VIEW."index.tpl" );
    }
    
    public function getView() {
        return IndexAction::$VIEW;
    }
    
}
?>
