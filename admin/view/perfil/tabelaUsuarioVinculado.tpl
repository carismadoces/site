{msg obj=$msgVinculoUsuario|default:null type="small" autoClose=true}

<!-- Add the class 'table' -->
<table class="table" cellspacing="0" width="100%">

    <thead>
        <tr>
        	<th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col" class="table-actions">Ações</th>
        </tr>
    </thead>
    
    <tbody>
	
	{if isset($usuariosPerfilArray) && count($usuariosPerfilArray) > 0}
	    {foreach $usuariosPerfilArray as $perfilUsuario}
	        <tr>
	        	<td>{$perfilUsuario->getUsuario()->getNome()}</td>
	            <td>{$perfilUsuario->getUsuario()->getEmail()}</td>
	            <td>
	            	<a href="javascript:void(0);" onclick="abrirModalConfirmacaoFuncao('removerVinculoUsuario', {$perfilUsuario->getPerfil()->getPerfilID()}, {$perfilUsuario->getUsuario()->getUsuarioID()});" title="Excluir Vínculo"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
	            </td>
	        </tr>
	
	    {/foreach}
	{/if}
    </tbody>

</table>

{include file="view/include/paginacao.tpl"}