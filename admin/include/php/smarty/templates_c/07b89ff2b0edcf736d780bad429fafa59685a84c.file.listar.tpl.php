<?php /* Smarty version Smarty-3.0.6, created on 2016-05-24 17:44:49
         compiled from "view/galeria/listar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12103092615744bd41391bd9-14942110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07b89ff2b0edcf736d780bad429fafa59685a84c' => 
    array (
      0 => 'view/galeria/listar.tpl',
      1 => 1395106597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12103092615744bd41391bd9-14942110',
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



<script type="text/javascript" src="include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="include/js/funcoes.js"></script>

<script type="text/javascript">

        $().ready(function() {

            $("#btBuscar").click(function(){
                carregaTabela(1);
            });
            
        });

        function carregaTabela(pagina){
            var nome = $("#nome").val().trim();

            $("#tbGaleria").append('<img src="include/images/ajax-loader.gif"/>');    
            $("#tbGaleria").load("GaleriaAction.tabela",
                {
            		nome : nome
                }
            );
        }
            
        function reload(){
            carregaTabela(1);
        }

</script>


<div id="content" class="block-border">

    <div class="block-content">
        <div class="h1 with-menu"><h1>Consultar Galeria</h1></div>


        <?php echo smarty_function_msg(array('obj'=>(($tmp = @$_smarty_tpl->getVariable('msg')->value)===null||$tmp==='' ? null : $tmp),'type'=>"small",'autoClose'=>false),$_smarty_tpl);?>

        <?php echo smarty_function_display_errors(array('errors'=>(($tmp = @$_smarty_tpl->getVariable('errosValidacao')->value)===null||$tmp==='' ? null : $tmp)),$_smarty_tpl);?>


        <div class="columns">
			<div class="colx1-left">           
		            <?php $_template = new Smarty_Internal_Template("view/galeria/formBusca.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		            <div id="tbGaleria"><?php $_template = new Smarty_Internal_Template("view/galeria/tabela.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?></div>
			</div>
		</div>
    </div>

</div>

<?php $_template = new Smarty_Internal_Template("layout/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>