<!-- Add the class 'table' -->
<table class="table" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th scope="col" class="table-actions">Ações</th>
        </tr>
    </thead>
    
    <tbody>

    {foreach $perfis as $perfil}
        <tr>
        	<td>{$perfil->getNome()}</td>
        	<td>{$perfil->getDsPerfil()}</td>
            <td>
            	<a href="PerfilAction.editar!perfilID-{$perfil->getPerfilID()}" title="Editar" class="with-tip"><img alt="edit" src="include/images/icons/fugue/pencil.png" width="16" height="16"/></a>
            	<a href="javascript:void(0);" onclick="abrirModalConfirmacao('PerfilAction.excluir!perfilID-{$perfil->getPerfilID()}');" title="Deletar" class="with-tip"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
            </td>
        </tr>

    {/foreach}

    </tbody>

</table>


{action_button label=" Novo" id="btNovo" type="button" icon="fugue/plus-circle.png" action="PerfilAction.cadastro" extra="style='float: right;'"}

{include file="view/include/paginacao.tpl"}