{include file="layout/head.tpl"}
{include file="layout/menu.tpl"}

{literal}

<script type="text/javascript" src="include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="include/js/funcoes.js"></script>

<script type="text/javascript">

	$().ready(function() {
		
		$("#frmAcao").validate({
            rules: {
	            	nome: {
	                    required: true,
	                    maxlength: 45
	                },
	                path:{
			            maxlength: 70
			        }
	            }
			});
	});

	function voltar(){
		document.forms[0].action = 'AcaoAction.listar';
		document.forms[0].submit();
	}

	function alterar(){
		$('#frmAcao').attr('action', 'AcaoAction.alterar');
		$('#frmAcao').submit();
	}
	
</script>
{/literal}

<div id="content" class="block-border">

    <div class="block-content">
        <div class="h1 with-menu"><h1>Ação</h1></div>
		
        {msg obj=$msg|default:null type="small" autoClose=false}
        {display_errors errors=$errosValidacao|default:null}

        <div class="columns">
			<div class="colx1-left">
                <form id="frmAcao" action="AcaoAction.salvar" class="form" method="post">
                	 <input type="hidden" name="acaoID" id="acaoID" value="{$acaoID|default:0}" />
                    <input type="hidden" name="cadastro" id="cadastro" value="{$cadastro}" />
			
                    <fieldset>
                        <legend>Dados da Ação</legend>
                        {form_input name="nome" label="Nome" required=true value="{$nome|default:''}"}
                        {form_input name="path" label="Caminho" required=false value="{$path|default:''}"}
                        
                        <label for="dispositivo">Pai:</label>
			            {html_options name=acaoPaiID id=acaoPaiID options=$acaoArray|default:array() selected=$acaoPaiID|default:''}
                    </fieldset>
					                    
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