<!-- Add the class 'table' -->
<table class="table" cellspacing="0" width="100%">

    <thead>
        <tr>
        	<th scope="col">Nome</th>
            <th scope="col">Caminho</th>
            <th scope="col" class="table-actions">Ação</th>
        </tr>
    </thead>
    
    <tbody>

    {foreach $acoes as $acao}
        <tr>
        	<td>{$acao->getNome()}</td>
        	<td>{$acao->getPath()}</td>
            <td>
            	<a href="AcaoAction.editar!acaoID-{$acao->getAcaoID()}" title="Editar" class="with-tip"><img alt="edit" src="include/images/icons/fugue/pencil.png" width="16" height="16"/></a>
            	<a href="javascript:void(0);" onclick="abrirModalConfirmacao('AcaoAction.excluir!acaoID-{$acao->getAcaoID()}');" title="Deletar" class="with-tip"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
            </td>
        </tr>
        
        {foreach $acao->getFilhos() as $his}
        	
        	<tr>
        		<td style="padding-left:30px;">{$his->getNome()}</td>
        		<td>{$his->getPath()}</td>
            	<td>
	            	<a href="AcaoAction.editar!acaoID-{$his->getAcaoID()}" title="Editar" class="with-tip"><img alt="edit" src="include/images/icons/fugue/pencil.png" width="16" height="16"/></a>
	            	<a href="javascript:void(0);" onclick="abrirModalConfirmacao('AcaoAction.excluir!acaoID-{$his->getAcaoID()}');" title="Deletar" class="with-tip"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
	            </td>
        	</tr>
        	
        {/foreach}

    {/foreach}

    </tbody>

</table>


{action_button label=" Novo" id="btNovo" type="button" icon="fugue/plus-circle.png" action="AcaoAction.cadastro" extra="style='float: right;'"}

{include file="view/include/paginacao.tpl"}