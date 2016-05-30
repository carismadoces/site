<?php /* Smarty version Smarty-3.0.6, created on 2016-05-24 17:44:49
         compiled from "view/include/paginacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18034623065744bd41469cb5-59483578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1960f6564d0c7ba1f2288e371b626d979edfa6bd' => 
    array (
      0 => 'view/include/paginacao.tpl',
      1 => 1326498848,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18034623065744bd41469cb5-59483578',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('numPaginas',null,true,false)->value)&&$_smarty_tpl->getVariable('numPaginas')->value>1){?>

    <ul class="controls-buttons" style="text-align: center">

        <?php $_smarty_tpl->tpl_vars['anterior'] = new Smarty_variable($_smarty_tpl->getVariable('pagina')->value-1, null, null);?>        
        
        <?php if ($_smarty_tpl->getVariable('anterior')->value<=0){?> 
            <?php $_smarty_tpl->tpl_vars['anterior'] = new Smarty_variable(1, null, null);?> 
        <?php }?>
        
        <li>
            <a class="with-tip" title="Anterior" href="javascript:void(0);" onclick="carregaTabela(<?php echo $_smarty_tpl->getVariable('anterior')->value;?>
)">
                <img alt="" width="16" height="16" src="include/images/icons/fugue/navigation-180.png">&nbsp;
            </a>
        </li>

        <?php $_smarty_tpl->tpl_vars['pg'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['pg']->step = 1;$_smarty_tpl->tpl_vars['pg']->total = (int)ceil(($_smarty_tpl->tpl_vars['pg']->step > 0 ? $_smarty_tpl->getVariable('numPaginas')->value+1 - (1) : 1-($_smarty_tpl->getVariable('numPaginas')->value)+1)/abs($_smarty_tpl->tpl_vars['pg']->step));
if ($_smarty_tpl->tpl_vars['pg']->total > 0){
for ($_smarty_tpl->tpl_vars['pg']->value = 1, $_smarty_tpl->tpl_vars['pg']->iteration = 1;$_smarty_tpl->tpl_vars['pg']->iteration <= $_smarty_tpl->tpl_vars['pg']->total;$_smarty_tpl->tpl_vars['pg']->value += $_smarty_tpl->tpl_vars['pg']->step, $_smarty_tpl->tpl_vars['pg']->iteration++){
$_smarty_tpl->tpl_vars['pg']->first = $_smarty_tpl->tpl_vars['pg']->iteration == 1;$_smarty_tpl->tpl_vars['pg']->last = $_smarty_tpl->tpl_vars['pg']->iteration == $_smarty_tpl->tpl_vars['pg']->total;?>

            <?php $_smarty_tpl->tpl_vars['click'] = new Smarty_variable("carregaTabela(".($_smarty_tpl->tpl_vars['pg']->value).");", null, null);?>
            <?php $_smarty_tpl->tpl_vars['style'] = new Smarty_variable('', null, null);?>

            <?php if ($_smarty_tpl->tpl_vars['pg']->value==$_smarty_tpl->getVariable('pagina')->value){?>
                <?php $_smarty_tpl->tpl_vars['click'] = new Smarty_variable('', null, null);?>
                <?php $_smarty_tpl->tpl_vars['style'] = new Smarty_variable("current", null, null);?>
            <?php }?>
            
            <li><a class="with-tip <?php echo $_smarty_tpl->getVariable('style')->value;?>
" title="Página <?php echo $_smarty_tpl->tpl_vars['pg']->value;?>
" href="javascript:void(0);" onclick="<?php echo $_smarty_tpl->getVariable('click')->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pg']->value;?>
</a></li>

        <?php }} ?>

        <?php $_smarty_tpl->tpl_vars['proxima'] = new Smarty_variable($_smarty_tpl->getVariable('pagina')->value+1, null, null);?>        
        
        <?php if ($_smarty_tpl->getVariable('proxima')->value>=$_smarty_tpl->getVariable('numPaginas')->value){?> 
            <?php $_smarty_tpl->tpl_vars['proxima'] = new Smarty_variable($_smarty_tpl->getVariable('numPaginas')->value, null, null);?> 
        <?php }?>    
            
        <li>
            <a class="with-tip" title="Próxima" href="javascript:void(0);" onclick="carregaTabela(<?php echo $_smarty_tpl->getVariable('proxima')->value;?>
)">
                &nbsp;<img alt="" width="16" height="16" src="include/images/icons/fugue/navigation.png">
            </a>
        </li>
        <li class="sep"></li>
        <li>
            <a class="with-tip" title="Recarregar" href="javascript:void(0);" onclick="reload()">
                &nbsp;<img alt="" width="16" height="16" src="include/images/icons/fugue/arrow-circle.png">
            </a>
        </li>

    </ul>

<?php }?>