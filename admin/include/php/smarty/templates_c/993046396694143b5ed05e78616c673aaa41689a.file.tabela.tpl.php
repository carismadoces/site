<?php /* Smarty version Smarty-3.0.6, created on 2016-05-24 17:44:49
         compiled from "view/galeria/tabela.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6581947925744bd414200c8-32464032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '993046396694143b5ed05e78616c673aaa41689a' => 
    array (
      0 => 'view/galeria/tabela.tpl',
      1 => 1395600235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6581947925744bd414200c8-32464032',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_action_button')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.action_button.php';
?><!-- Add the class 'table' -->
<table class="table" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th scope="col">Nome</th>
        	<th scope="col">Descrição</th>
        	<th scope="col">Path</th>
            <th scope="col" class="table-actions">Ações</th>
        </tr>
    </thead>
    
    <tbody>

    <?php  $_smarty_tpl->tpl_vars['galeria'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('galerias')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['galeria']->key => $_smarty_tpl->tpl_vars['galeria']->value){
?>
        <tr>
        	<td><?php echo $_smarty_tpl->getVariable('galeria')->value->getNome();?>
</td>
        	<td><?php echo $_smarty_tpl->getVariable('galeria')->value->getDsGaleria();?>
</td>
        	<td><?php echo $_smarty_tpl->getVariable('galeria')->value->getPath();?>
</td>
            <td>
            	<a href="GaleriaAction.editar!galeriaID-<?php echo $_smarty_tpl->getVariable('galeria')->value->getGaleriaID();?>
" title="Editar" class="with-tip"><img alt="edit" src="include/images/icons/fugue/pencil.png" width="16" height="16"/></a>
            	<a href="javascript:void(0);" onclick="abrirModalConfirmacao('GaleriaAction.excluir!galeriaID-<?php echo $_smarty_tpl->getVariable('galeria')->value->getGaleriaID();?>
');" title="Deletar" class="with-tip"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
            </td>
        </tr>

    <?php }} ?>

    </tbody>

</table>

<?php echo smarty_function_action_button(array('label'=>" Novo",'id'=>"btNovo",'type'=>"button",'icon'=>"fugue/plus-circle.png",'action'=>"GaleriaAction.cadastro",'extra'=>"style='float: right;'"),$_smarty_tpl);?>


<?php $_template = new Smarty_Internal_Template("view/include/paginacao.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>