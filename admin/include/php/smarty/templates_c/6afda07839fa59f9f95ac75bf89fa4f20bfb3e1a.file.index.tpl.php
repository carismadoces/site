<?php /* Smarty version Smarty-3.0.6, created on 2016-05-25 00:40:01
         compiled from "view/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121453114757451e916e0bb4-60756201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6afda07839fa59f9f95ac75bf89fa4f20bfb3e1a' => 
    array (
      0 => 'view/index.tpl',
      1 => 1464033369,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121453114757451e916e0bb4-60756201',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_msg')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.msg.php';
if (!is_callable('smarty_function_display_errors')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.display_errors.php';
?><?php $_template = new Smarty_Internal_Template("layout/head.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template("layout/menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>



<script type="text/javascript">

	$().ready(function() {

	});

</script>



<br/>
<br/>

<div id="content" class="block-border">

    <div class="block-content">

        <?php echo smarty_function_msg(array('obj'=>(($tmp = @$_smarty_tpl->getVariable('msg')->value)===null||$tmp==='' ? null : $tmp),'type'=>"small",'autoClose'=>false),$_smarty_tpl);?>

        <?php echo smarty_function_display_errors(array('errors'=>(($tmp = @$_smarty_tpl->getVariable('errosValidacao')->value)===null||$tmp==='' ? null : $tmp)),$_smarty_tpl);?>


    </div>

</div>

<?php $_template = new Smarty_Internal_Template("layout/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
