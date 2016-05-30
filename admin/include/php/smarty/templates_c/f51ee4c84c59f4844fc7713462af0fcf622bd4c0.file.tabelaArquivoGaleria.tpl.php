<?php /* Smarty version Smarty-3.0.6, created on 2016-05-28 14:46:40
         compiled from "view/galeria/tabelaArquivoGaleria.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5991512435749d9805f3380-28020968%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f51ee4c84c59f4844fc7713462af0fcf622bd4c0' => 
    array (
      0 => 'view/galeria/tabelaArquivoGaleria.tpl',
      1 => 1464457598,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5991512435749d9805f3380-28020968',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_msg')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.msg.php';
?><?php echo smarty_function_msg(array('obj'=>(($tmp = @$_smarty_tpl->getVariable('msgArquivoVinculado')->value)===null||$tmp==='' ? null : $tmp),'type'=>"small",'autoClose'=>true),$_smarty_tpl);?>


<table class="table" cellspacing="0" width="100%">

	<thead>
		<tr>
			<th scope="col">Imagem</th>
			<th scope="col">Arquivo</th>
			<th scope="col">Descrição</th>
			<th scope="col">Tags</th>
			<th scope="col" class="table-actions">Ações</th>
		</tr>
	</thead>
	<tbody id="aplicativoBody">

		<?php if (isset($_smarty_tpl->getVariable('arquivoGaleriaArray',null,true,false)->value)){?>
			<?php  $_smarty_tpl->tpl_vars['arquivoGaleria'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('arquivoGaleriaArray')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['arquivoGaleria']->key => $_smarty_tpl->tpl_vars['arquivoGaleria']->value){
?>
				<tr>
					<td>
						<img alt="" src="<?php echo $_smarty_tpl->getVariable('arquivoGaleria')->value->getThumbPath();?>
" width="100px">
					</td>
					<td><?php echo $_smarty_tpl->getVariable('arquivoGaleria')->value->getFile();?>
</td>
					<td id="ds_galeria_<?php echo $_smarty_tpl->getVariable('arquivoGaleria')->value->getArquivoGaleriaID();?>
"><?php echo $_smarty_tpl->getVariable('arquivoGaleria')->value->getDsArquivoGaleria();?>
</td>
					<td id="tags_<?php echo $_smarty_tpl->getVariable('arquivoGaleria')->value->getArquivoGaleriaID();?>
">
						<?php echo $_smarty_tpl->getVariable('arquivoGaleria')->value->getTags();?>

					</td>
					<td id="actions_<?php echo $_smarty_tpl->getVariable('arquivoGaleria')->value->getArquivoGaleriaID();?>
">
						<a href="javascript:void(0);" onclick="abrirModalConfirmacaoFuncao('excluirArquivoGaleria', <?php echo $_smarty_tpl->getVariable('arquivoGaleria')->value->getArquivoGaleriaID();?>
);" title="Excluir"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
						<img alt="edit" src="include/images/icons/fugue/pencil.png" width="16" height="16" style="cursor:pointer;" onclick="editarImagem(<?php echo $_smarty_tpl->getVariable('arquivoGaleria')->value->getArquivoGaleriaID();?>
)"/>
					</td>
				</tr>
			<?php }} ?>
		<?php }?>
	</tbody>
</table>
