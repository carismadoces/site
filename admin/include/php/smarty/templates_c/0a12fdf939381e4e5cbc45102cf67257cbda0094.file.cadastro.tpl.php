<?php /* Smarty version Smarty-3.0.6, created on 2016-05-28 22:04:12
         compiled from "view/galeria/cadastro.tpl" */ ?>
<?php /*%%SmartyHeaderCode:430359067574a400cb9e9b8-15056063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a12fdf939381e4e5cbc45102cf67257cbda0094' => 
    array (
      0 => 'view/galeria/cadastro.tpl',
      1 => 1464483851,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '430359067574a400cb9e9b8-15056063',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_msg')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.msg.php';
if (!is_callable('smarty_function_display_errors')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.display_errors.php';
if (!is_callable('smarty_function_form_input')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.form_input.php';
if (!is_callable('smarty_function_action_button')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.action_button.php';
?><?php $_template = new Smarty_Internal_Template("layout/head.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template("layout/menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>



<link rel="stylesheet" type="text/css" href="include/js/uploadifive/uploadifive.css">
<link href="include/js/jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="include/js/funcoes.js"></script>
<script src="include/js/uploadifive/jquery.uploadifive.js" type="text/javascript"></script>
<script type="text/javascript" src="include/js/jcrop/jquery.Jcrop.min.js"></script>
<script type="text/javascript" src="include/js/jquery.rotate.js"></script>



<?php $_smarty_tpl->tpl_vars["string_to_hash"] = new Smarty_variable("unique_salt".($_smarty_tpl->getVariable('timestamp')->value), null, null);?>
<?php $_smarty_tpl->tpl_vars["pwidth"] = new Smarty_variable("500", null, null);?>
<?php $_smarty_tpl->tpl_vars["pheight"] = new Smarty_variable("300", null, null);?>

<script type="text/javascript">

	var allTags = ['Infantil', 'Casamento', 'Noivado', 'Personalizados', 'Diversos', 'Maquete', 'Aniversário', 'Infantil'];

	var rotate = 90;
	$().ready(function() {

		$("#frmGaleria").validate({
            rules: {
	        	nome: {
	            	required: true,
	                maxlength: 45
	            }
			}
	    });

		$('#arquivo').uploadifive({
			'formData'     : {},
	        'uploadScript' : "GaleriaAction.upload",
	        'auto'		: false,
	        'buttonText': "SELECIONE",
	        'onError'     : function(file, fileType, data) {
                abrirModalSimples(file,'Erro');
            },
            'onCancel'     : function() {
            	var jcrop = $('#preview').data('Jcrop');
            	jcrop.destroy();
				$('#preview').hide();
            },
            'onUploadComplete' : function(file, data) {

                var arquivos = $('#arquivos').val();
                if ( arquivos == "" ){
                	var arquivosArray = new Array();
                }else{
                	var arquivosArray = arquivos.split(',');
                }

                arquivosArray.push(file.name);

            	$('#arquivos').val(arquivosArray.join(','));
            },
            'onAddQueueItem' : function(file){

            	var reader = new FileReader();
                reader.onload = function(event){

                    document.getElementById('preview').src = event.target.result;
                    $('#preview').show();
                    $('#rotate').show();
                    $('#cropStart').show();

                    
	                	$('#rotate').click(function(){

	                		$('#preview').rotate(rotate);

	                		rotate += 90;

	                    });
	                

                }
                reader.readAsDataURL( file );
            },
            'onUploadComplete'  : function(){
            	var jcrop = $('#preview').data('Jcrop');
            	jcrop.destroy();
				$('#preview').hide();
				$('#rotate').hide();
				$('#cropStart').hide();
				listarArquivosGaleria();
				$('#dsArquivoGaleria').val('');

				rotate = 45;
            }
	    });

		$('#cropStart').click(function(){

			$('#rotate').hide();
			$('#cropStart').hide();
			$('#cropEnd').show();

			$('#preview').Jcrop({
	            onSelect: showCoords,
	            onChange: showCoords
	        });

		});

		$('#cropEnd').click(function(){

			$('#rotate').show();
			$('#cropStart').show();
			$('#cropEnd').hide();

			var jcrop = $('#preview').data('Jcrop');
    		if ( jcrop != null ){
        		jcrop.destroy();
    		}

		});



		//-------------------------------
    // Preloading data in markup
    //-------------------------------
    $('#gtags').tagit({
				availableTags: allTags,
				singleField: true,
        singleFieldNode: $('#tags')
    });
	});

	function voltar(){
		document.forms[0].action = 'GaleriaAction.listar';
		document.forms[0].submit();
	}

	function alterar(){
		$('#frmGaleria').attr('action', 'GaleriaAction.alterar');
		$('#frmGaleria').submit();
	}

	function upload(){

		if ( $('#dsArquivoGaleria').val() == ''){

			$.modal({
		        content: 'Descrição da imagem não informada, deseja prosseguir?',
		        title: 'Confirmação',
		        maxWidth: 500,
		        buttons: {
		            'Sim': function(win) {
			            win.closeModal();
			            enviarImagem();
			        },
			        'Não': function(win) {
			            win.closeModal();
			        }
		        }
		    });

		}else{
			enviarImagem();
		}
	}

	function enviarImagem(){
		$('#arquivo').data('uploadifive').settings.formData = {
        	'timestamp': "<?php echo $_smarty_tpl->getVariable('timestamp')->value;?>
",
        	'token'    : "<?php echo md5($_smarty_tpl->getVariable('string_to_hash')->value);?>
",
        	'posx'	   : $('#posx').val(),
        	'posy'	   : $('#posy').val(),
        	'width'	   : $('#width').val(),
        	'height'   : $('#height').val(),
        	'pwidth'   : <?php echo $_smarty_tpl->getVariable('pwidth')->value;?>
,
        	'pheight'   : <?php echo $_smarty_tpl->getVariable('pheight')->value;?>
,
        	'galeriaID'   : $('#galeriaID').val(),
        	'dsArquivoGaleria'   : $('#dsArquivoGaleria').val(),
					'tags'   : $('#tags').val()
    	};

		$('#arquivo').uploadifive('upload');
	}

	function showCoords(c){
	    $('#posx').val(c.x);
	    $('#posy').val(c.y);
	    $('#width').val(c.w);
	    $('#height').val(c.h);
	}

	function excluirArquivoGaleria(){
		var arquivoGaleriaID = arguments[0][1];
		var galeriaID = $('#galeriaID').val();

		$("#tbArquivoGaleria").append('<img src="include/images/ajax-loader.gif"/>');
        $("#tbArquivoGaleria").load("GaleriaAction.excluirArquivoGaleria",
            {
        		arquivoGaleriaID : arquivoGaleriaID,
        		galeriaID : galeriaID
            }
        );
	}

	function listarArquivosGaleria(){
		var galeriaID = $('#galeriaID').val();

		$("#tbArquivoGaleria").append('<img src="include/images/ajax-loader.gif"/>');
        $("#tbArquivoGaleria").load("GaleriaAction.listarArquivosGaleria",
            {
        		galeriaID : galeriaID
            }
        );
	}

	function editarImagem(id){

		var dsGaleriaID = '#ds_galeria_' + id;
		var textID = 'input_ds_' + id;
		var hiddenID = 'hidden_ds_' + id;

		var htmlDS = $(dsGaleriaID).text();
		$(dsGaleriaID).html('');

		$('<input/>').attr({ type: 'hidden', id: hiddenID, value: htmlDS}).appendTo(dsGaleriaID);
		$('<input/>').attr({ type: 'text', id: textID, size : '50'}).appendTo(dsGaleriaID);
		// $('#' + textID).focus();
		$('#' + textID).attr('value', htmlDS);

		// $('#' + textID).blur(function() {
		// 	var hiddenValue = $('#hidden_ds_' + $(this).attr('id').split('_')[2]).val();
		// 	$(dsGaleriaID).html(hiddenValue)
		// });

		$('#' + textID).keypress(function(event) {
			if ( event.which == 13 ) {
			    event.preventDefault();
			    var arquivoGaleriaID = $(this).attr('id').split('_')[2];
			    alterarArquivoGaleria(arquivoGaleriaID, $(this).val());
			}
		});

		// Tag
		var tagsID = '#tags_' + id;
		var tagID = 'tTags_' + id;
		var hTagID = 'hTag_' + id;
		var tagVal = $.trim($(tagsID).text());

		$(tagsID).html('');
		// $('<input/>').attr({ type: 'text', id: tagID, size : '50', value: tagVal}).appendTo(tagsID);
		$('<input/>').attr({ type: 'hidden', id: hTagID, value: tagVal}).appendTo(tagsID);
		// $('#'+tagID).attr('value', $('#hTag_'+id).val());

		$('<ul/>').attr({ id: 'uTag_'+id}).appendTo(tagsID);

		var actionsID = '#actions_' + id;
		$('<img/>').attr({ src: 'include/images/icons/fugue/tick-circle.png', style: 'cursor: pointer;', onclick: 'alterarArquivoGaleria('+id+',"'+ textID +'", "' + hTagID + '")'}).appendTo(actionsID);

		console.log(hTagID);
		$('#uTag_'+id).tagit({
				availableTags: allTags,
				singleField: true,
        singleFieldNode: $('#'+hTagID)
    });

	}

	function alterarArquivoGaleria(arquivoGaleriaID, textID, hTagID){
		var galeriaID = $('#galeriaID').val();

		var tags = $('#'+hTagID).val();
		var dsArquivoGaleria = $('#'+textID).val();

		$("#tbArquivoGaleria").append('<img src="include/images/ajax-loader.gif"/>');
    $("#tbArquivoGaleria").load("GaleriaAction.alterarDescricaoArquivoGaleria",
        {
    		galeriaID : galeriaID,
				arquivoGaleriaID : arquivoGaleriaID,
    		dsArquivoGaleria : dsArquivoGaleria,
				tags : tags
        }
    );
	}
</script>

<div id="content" class="block-border">

    <div class="block-content">
        <div class="h1 with-menu"><h1>Galeria</h1></div>

        <?php echo smarty_function_msg(array('obj'=>(($tmp = @$_smarty_tpl->getVariable('msg')->value)===null||$tmp==='' ? null : $tmp),'type'=>"small",'autoClose'=>false),$_smarty_tpl);?>

        <?php echo smarty_function_display_errors(array('errors'=>(($tmp = @$_smarty_tpl->getVariable('errosValidacao')->value)===null||$tmp==='' ? null : $tmp)),$_smarty_tpl);?>


        <div class="columns">
			<div class="colx1-left">
                <form id="frmGaleria" action="GaleriaAction.salvar" class="form" method="post">
                	<input type="hidden" name="galeriaID" id="galeriaID" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('galeriaID')->value)===null||$tmp==='' ? 0 : $tmp);?>
" />
                    <input type="hidden" name="cadastro" id="cadastro" value="<?php echo $_smarty_tpl->getVariable('cadastro')->value;?>
" />
                    <input type="hidden" name="arquivos" id="arquivos" value="<?php echo $_smarty_tpl->getVariable('arquivos')->value;?>
" />
                    <input type="hidden" name="posx" id="posx" value="" />
                    <input type="hidden" name="posy" id="posy" value="" />
                    <input type="hidden" name="width" id="width" value="" />
                    <input type="hidden" name="height" id="height" value="" />
										<input type="hidden" name="tags" id="tags" value=""/>

                    <fieldset>
                        <legend>Dados Galeria</legend>

                        <?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->getVariable('nome')->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp1=ob_get_clean();?><?php echo smarty_function_form_input(array('name'=>"nome",'label'=>"Nome",'required'=>true,'value'=>$_tmp1),$_smarty_tpl);?>

                        <?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->getVariable('dsGaleria')->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp2=ob_get_clean();?><?php echo smarty_function_form_input(array('name'=>"dsGaleria",'label'=>"Descrição",'required'=>true,'value'=>$_tmp2),$_smarty_tpl);?>

                        <?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->getVariable('path')->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp3=ob_get_clean();?><?php echo smarty_function_form_input(array('name'=>"path",'label'=>"Path",'required'=>true,'value'=>$_tmp3),$_smarty_tpl);?>


                    </fieldset>

                    <?php if ($_smarty_tpl->getVariable('cadastro')->value=="false"){?>
	                    <fieldset>
	                        <legend>Imagens da Galeria</legend>

							<div id="tbArquivoGaleria"><?php $_template = new Smarty_Internal_Template("view/galeria/tabelaArquivoGaleria.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?></div>

	                    </fieldset>

	                    <fieldset>
	                        <legend><a href="#"> Enviar Imagens</a></legend>

							<?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->getVariable('dsArquivoGaleria')->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp4=ob_get_clean();?><?php echo smarty_function_form_input(array('name'=>"dsArquivoGaleria",'label'=>"Descrição",'required'=>false,'value'=>$_tmp4),$_smarty_tpl);?>


							<label for="tags">Tags:</label>
							<ul id="gtags">
	            </ul>

							<?php echo smarty_function_form_input(array('name'=>"arquivo",'label'=>"Fotos",'type'=>"file",'required'=>true),$_smarty_tpl);?>

							<img id="preview" width="<?php echo $_smarty_tpl->getVariable('pwidth')->value;?>
" height="<?php echo $_smarty_tpl->getVariable('pheight')->value;?>
" style="display: none;"/>
							<input type="button" id="rotate" value="Rodar" style="display: none;"/>
							<input type="button" id="cropStart" value="Recortar" style="display: none;"/>
							<input type="button" id="cropEnd" value="Finalizar" style="display: none;"/>

							<p style="text-align: right;">
	                            <?php echo smarty_function_action_button(array('id'=>"uploadButton",'label'=>"Enviar Arquivo",'type'=>"button",'icon'=>"fugue/arrow-090.png",'extra'=>"onclick=\"javascript:upload();\""),$_smarty_tpl);?>

	                        </p>
	                    </fieldset>
	             	<?php }?>

                    <p style="text-align: right;">
                        <?php echo smarty_function_action_button(array('type'=>"voltar",'label'=>"Voltar"),$_smarty_tpl);?>

						<?php echo smarty_function_action_button(array('label'=>"Limpar",'type'=>"reset",'class'=>"grey"),$_smarty_tpl);?>

                        <?php echo smarty_function_action_button(array('label'=>"Salvar",'type'=>"submit"),$_smarty_tpl);?>

                    </p>
                </form>
            </div>
        </div>
    </div>

</div>

<?php $_template = new Smarty_Internal_Template("layout/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
