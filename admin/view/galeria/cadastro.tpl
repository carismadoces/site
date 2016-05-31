{include file="layout/head.tpl"}
{include file="layout/menu.tpl"}

{literal}

<link rel="stylesheet" type="text/css" href="include/js/uploadifive/uploadifive.css">
<link href="include/js/jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="include/js/funcoes.js"></script>
<script src="include/js/uploadifive/jquery.uploadifive.js" type="text/javascript"></script>
<script type="text/javascript" src="include/js/jcrop/jquery.Jcrop.min.js"></script>
<script type="text/javascript" src="include/js/jquery.rotate.js"></script>

{/literal}

{assign var="string_to_hash" value="unique_salt$timestamp"}
{assign var="pwidth" value="500"}
{assign var="pheight" value="300"}

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

                    {literal}
	                	$('#rotate').click(function(){

	                		$('#preview').rotate(rotate);

	                		rotate += 90;

	                    });
	                {/literal}

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
        	'timestamp': "{$timestamp}",
        	'token'    : "{$string_to_hash|md5}",
        	'posx'	   : $('#posx').val(),
        	'posy'	   : $('#posy').val(),
        	'width'	   : $('#width').val(),
        	'height'   : $('#height').val(),
        	'pwidth'   : {$pwidth},
        	'pheight'   : {$pheight},
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

        {msg obj=$msg|default:null type="small" autoClose=false}
        {display_errors errors=$errosValidacao|default:null}

        <div class="columns">
			<div class="colx1-left">
                <form id="frmGaleria" action="GaleriaAction.salvar" class="form" method="post">
                	<input type="hidden" name="galeriaID" id="galeriaID" value="{$galeriaID|default:0}" />
                    <input type="hidden" name="cadastro" id="cadastro" value="{$cadastro}" />
                    <input type="hidden" name="arquivos" id="arquivos" value="{$arquivos}" />
                    <input type="hidden" name="posx" id="posx" value="" />
                    <input type="hidden" name="posy" id="posy" value="" />
                    <input type="hidden" name="width" id="width" value="" />
                    <input type="hidden" name="height" id="height" value="" />
										<input type="hidden" name="tags" id="tags" value=""/>

                    <fieldset>
                        <legend>Dados Galeria</legend>

                        {form_input name="nome" label="Nome" required=true value="{$nome|default:''}"}
                        {form_input name="dsGaleria" label="Descrição" required=true value="{$dsGaleria|default:''}"}
                        {form_input name="path" label="Path" required=true value="{$path|default:''}"}

                    </fieldset>

                    {if $cadastro == "false"}
	                    <fieldset>
	                        <legend>Imagens da Galeria</legend>

							<div id="tbArquivoGaleria">{include file="view/galeria/tabelaArquivoGaleria.tpl"}</div>

	                    </fieldset>

	                    <fieldset>
	                        <legend><a href="#"> Enviar Imagens</a></legend>

							{form_input name="dsArquivoGaleria" label="Descrição" required=false value="{$dsArquivoGaleria|default:''}"}

							<label for="tags">Tags:</label>
							<ul id="gtags">
	            </ul>

							{form_input name="arquivo" label="Fotos" type="file" required=true}
							<img id="preview" width="{$pwidth}" height="{$pheight}" style="display: none;"/>
							<input type="button" id="rotate" value="Rodar" style="display: none;"/>
							<input type="button" id="cropStart" value="Recortar" style="display: none;"/>
							<input type="button" id="cropEnd" value="Finalizar" style="display: none;"/>

							<p style="text-align: right;">
	                            {action_button id="uploadButton" label="Enviar Arquivo" type="button" icon="fugue/arrow-090.png" extra="onclick=\"javascript:upload();\""}
	                        </p>
	                    </fieldset>
	             	{/if}

                    <p style="text-align: right;">
                        {action_button type="voltar" label="Voltar"}
						{action_button label="Limpar" type="reset" class="grey"}
                        {action_button label="Salvar" type="submit"}
                    </p>
                </form>
            </div>
        </div>
    </div>

</div>

{include file="layout/footer.tpl"}
