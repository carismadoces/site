{msg obj=$msgVinculoAcao|default:null type="small" autoClose=true}

<!-- Add the class 'table' -->
<table class="table" cellspacing="0" width="100%">

    <thead>
        <tr>
        	<th scope="col">Nome</th>
            <th scope="col">Path</th>
            <th scope="col" class="table-actions">Ações</th>
        </tr>
    </thead>
    
    <tbody>
	
	{if isset($acaoPerfilArray) && count($acaoPerfilArray) > 0}
	    {foreach $acaoPerfilArray as $acaoPerfil}
	        <tr>
	        	<td>{$acaoPerfil->getAcao()->getNome()}</td>
	            <td>{$acaoPerfil->getAcao()->getPath()}</td>
	            <td>
	            	<a href="javascript:void(0);" onclick="abrirModalConfirmacaoFuncao('removerVinculoAcao', {$acaoPerfil->getAcao()->getAcaoID()}, {$acaoPerfil->getPerfil()->getPerfilID()});" title="Excluir Vínculo"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
	            </td>
	        </tr>
	
	    {/foreach}
	{/if}
    </tbody>

</table>

{include file="view/include/paginacao.tpl"}