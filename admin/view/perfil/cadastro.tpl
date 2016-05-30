{include file="layout/head.tpl"}
{include file="layout/menu.tpl"}

{literal}

<script type="text/javascript" src="include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="include/js/funcoes.js"></script>

<script type="text/javascript">

	$().ready(function() {
		
		$("#frmPerfil").validate({
            rules: {
	            	nome: {
	                    required: true,
	                    maxlength: 45
	                },
	                identificador:{
			            maxlength: 100
			        }
	            }
			});
	});

	function voltar(){
		document.forms[0].action = 'PerfilAction.listar';
		document.forms[0].submit();
	}

	function alterar(){
		$('#frmPerfil').attr('action', 'PerfilAction.alterar');
		$('#frmPerfil').submit();
	}

	function vincularUsuario(){
		var usuarioID = $('#usuario option:selected').val();
		var perfilID = $('#perfilID').val();
		
		$("#tbUsuarioVinculado").append('<img src="include/images/ajax-loader.gif"/>');    
        $("#tbUsuarioVinculado").load("PerfilAction.vincularUsuario",
            {
        		usuarioID : usuarioID,
        		perfilID: perfilID
            }
        );
	}

	function removerVinculoUsuario(){
		
		var perfilID = arguments[0][1];
		var usuarioID = arguments[0][2];
		$("#tbUsuarioVinculado").append('<img src="include/images/ajax-loader.gif"/>');    
        $("#tbUsuarioVinculado").load("PerfilAction.removerVinculoUsuario",
            {
        		perfilID: perfilID,
        		usuarioID : usuarioID        		
            }
        );        
	}

	function vincularAcao(){
		var acaoID = $('#acao option:selected').val();
		var perfilID = $('#perfilID').val();
		
		$("#tbAcaoVinculada").append('<img src="include/images/ajax-loader.gif"/>');    
        $("#tbAcaoVinculada").load("PerfilAction.vincularAcao",
            {
        		acaoID : acaoID,
        		perfilID: perfilID
            }
        );
	}

	function removerVinculoAcao(){
		
		var acaoID = arguments[0][1];
		var perfilID = arguments[0][2];
		$("#tbAcaoVinculada").append('<img src="include/images/ajax-loader.gif"/>');    
        $("#tbAcaoVinculada").load("PerfilAction.removerVinculoAcao",
            {
        		acaoID : acaoID,
        		perfilID: perfilID        		
            }
        );        
	}
	
</script>
{/literal}

<div id="content" class="block-border">

    <div class="block-content">
        <div class="h1 with-menu"><h1>Perfil</h1></div>
		
        {msg obj=$msg|default:null type="small" autoClose=false}
        {display_errors errors=$errosValidacao|default:null}
        
        <div class="columns">
			<div class="colx1-left">
                <form id="frmPerfil" action="PerfilAction.salvar" class="form" method="post">
                	<input type="hidden" name="perfilID" id="perfilID" value="{$perfilID|default:0}" />
                    <input type="hidden" name="cadastro" id="cadastro" value="{$cadastro}" />
			
                    <fieldset>
                    	<legend><a href="#"> Dados do Perfil</a></legend>
                        
                        {form_input name="nome" label="Nome" required=true value="{$nome|default:''}"}
                        {form_input name="dsPerfil" label="Descrição" required=false value="{$dsPerfil|default:''}"}
                        
                    </fieldset>
                    
                    <!-- Vínculo Usuário -->
                    {if $cadastro == "false"}
	                    <fieldset>
	                        <legend><a href="#"> Usuários Vinculados</a></legend>
	                        
	                        <p>
			                    <label for="usuario">Usuário:</label>
			                    {html_options name=usuario id=usuario options=$usuariosArray|default:array() selected=$usuario|default:''}
			                    
			                    &nbsp;&nbsp;&nbsp;
			                    {action_button id="btVincular" label=" Vincular" type="button" icon="add.png" extra="onclick=\"javascript:vincularUsuario();\""}
			                </p>
			                
			                <p>
								<div id="tbUsuarioVinculado">{include file="view/perfil/tabelaUsuarioVinculado.tpl"}</div>
							</p>
	                        
	                    </fieldset>
                    {/if}
                    
                    <!-- Vínculo Ação -->
                    {if $cadastro == "false"}
	                    <fieldset>
	                    	<legend><a href="#"> Ações</a></legend>
	                        
	                        <p>
			                    <label for="acao">Ação:</label>
			                    {html_options name=acao id=acao options=$acoesArray|default:array() selected=$acao|default:''}
			                    
			                    &nbsp;&nbsp;&nbsp;
			                    {action_button id="btVincularAcao" label=" Vincular" type="button" icon="add.png" extra="onclick=\"javascript:vincularAcao();\""}
			                </p>
			                
			                <p>
								<div id="tbAcaoVinculada">{include file="view/perfil/tabelaAcaoVinculada.tpl"}</div>
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