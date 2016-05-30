<?php

/**
 * Classe abstrata para padronizar as Actions com CRUD
 * @author Magno
 */
abstract class ActionDefault extends BaseAction{
    public abstract function cadastro();
    public abstract function salvar($bean);
    public abstract function editar($beanID);
    public abstract function listar();
    public abstract function buscar();
    public abstract function excluir($beanID);
    public abstract function detalhes($beanID);
    public abstract function getView();
}
?>
