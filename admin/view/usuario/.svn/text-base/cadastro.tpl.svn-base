{include file="layout/head.tpl"}
{include file="layout/menu.tpl"}

{literal}

<script type="text/javascript" src="include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="include/js/funcoes.js"></script>

<script type="text/javascript">

	$().ready(function() {

		$("#frmUsuario").validate({
            rules: {
	            	nome: {
	                    required: true
	                },
		            email:{
			            email:true,
			            required: true
			        },
	                senha: {
	                    required: true,
	                    minlength: 5,
	                    maxlength: 15
		            },
		            r_senha: {
		                    required: true,
		                    minlength: 5,
		                    equalTo: "#senha"
		            }
	            }
			});
	});

	function voltar(){
		document.forms[0].action = 'UsuarioAction.listar';
		document.forms[0].submit();
	}

	function alterar(){
		$('#frmUsuario').attr('action', 'UsuarioAction.alterar');
		$('#frmUsuario').submit();
	}
	
</script>
{/literal}

<div id="content" class="block-border">

    <div class="block-content">
        <div class="h1 with-menu"><h1>Cadastro</h1></div>

        {msg obj=$msg|default:null type="small" autoClose=false}
        {display_errors errors=$errosValidacao|default:null}

        <div class="columns">
			<div class="colx1-left">
                <form id="frmUsuario" action="UsuarioAction.salvar" class="form" method="post">
                    <input type="hidden" name="usuarioID" id="usuarioID" value="{$usuarioID|default:0}" />
			
                    <fieldset>
                        <legend>Dados Usuário</legend>	
                        {form_input name="nome" label="Nome" required=true value="{$nome|default:''}"}	
                        {form_input name="email" label="Email" required=true value="{$email|default:''}"}
                    </fieldset>
                    
                    <fieldset>
                        <legend>Dados Autenticação Usuário</legend>	
                        {form_input name="login" label="Login" required=true value="{$login|default:''}"}
                        
                        {if isset($cadastro) && $cadastro}
                        	{form_input type="password" name="senha" label="Senha Nova" required=true}
                        	{form_input type="password" name="r_senha" label="Confirmação" required=true}
                        {/if}       
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