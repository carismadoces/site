<!-- Add the class 'table' -->
<table class="table" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th scope="col">Nome</th>
        	<th scope="col">Descrição</th>
        	<th scope="col">Path</th>
            <th scope="col" class="table-actions">Ações</th>
        </tr>
    </thead>
    
    <tbody>

    {foreach $galerias as $galeria}
        <tr>
        	<td>{$galeria->getNome()}</td>
        	<td>{$galeria->getDsGaleria()}</td>
        	<td>{$galeria->getPath()}</td>
            <td>
            	<a href="GaleriaAction.editar!galeriaID-{$galeria->getGaleriaID()}" title="Editar" class="with-tip"><img alt="edit" src="include/images/icons/fugue/pencil.png" width="16" height="16"/></a>
            	<a href="javascript:void(0);" onclick="abrirModalConfirmacao('GaleriaAction.excluir!galeriaID-{$galeria->getGaleriaID()}');" title="Deletar" class="with-tip"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
            </td>
        </tr>

    {/foreach}

    </tbody>

</table>

{action_button label=" Novo" id="btNovo" type="button" icon="fugue/plus-circle.png" action="GaleriaAction.cadastro" extra="style='float: right;'"}

{include file="view/include/paginacao.tpl"}