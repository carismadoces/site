<!-- Add the class 'table' -->
<table class="table" cellspacing="0" width="100%">

    <thead>
        <tr>
        	<th scope="col">Nome</th>
            <th scope="col">Login</th>
            <th scope="col">Email</th>
            <th scope="col" class="table-actions">Ações</th>
        </tr>
    </thead>
    
    <tbody>

    {foreach $usuarios as $usuario}
        <tr>
        	<td>{$usuario->getNome()}</td>
        	<td>{$usuario->getLogin()}</td>
            <td>{$usuario->getEmail()}</td>
            <td>
            	<a href="UsuarioAction.editar!usuarioID-{$usuario->getUsuarioID()}" title="Editar" class="with-tip"><img alt="edit" src="include/images/icons/fugue/pencil.png" width="16" height="16"/></a>
            	<a href="javascript:void(0);" onclick="abrirModalConfirmacao('UsuarioAction.excluir!usuarioID-{$usuario->getUsuarioID()}');" title="Deletar" class="with-tip"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
            </td>
        </tr>

    {/foreach}

    </tbody>

</table>

{include file="view/include/paginacao.tpl"}