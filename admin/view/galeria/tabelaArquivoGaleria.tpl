{msg obj=$msgArquivoVinculado|default:null type="small" autoClose=true}

<table class="table" cellspacing="0" width="100%">

	<thead>
		<tr>
			<th scope="col">Imagem</th>
			<th scope="col">Arquivo</th>
			<th scope="col">Descrição</th>
			<th scope="col">Tags</th>
			<th scope="col" class="table-actions">Ações</th>
		</tr>
	</thead>
	<tbody id="aplicativoBody">

		{if isset($arquivoGaleriaArray)}
			{foreach $arquivoGaleriaArray as $arquivoGaleria}
				<tr>
					<td>
						<img alt="" src="{$arquivoGaleria->getThumbPath()}" width="100px">
					</td>
					<td>{$arquivoGaleria->getFile()}</td>
					<td id="ds_galeria_{$arquivoGaleria->getArquivoGaleriaID()}">{$arquivoGaleria->getDsArquivoGaleria()}</td>
					<td id="tags_{$arquivoGaleria->getArquivoGaleriaID()}">
						{$arquivoGaleria->getTags()}
					</td>
					<td id="actions_{$arquivoGaleria->getArquivoGaleriaID()}">
						<a href="javascript:void(0);" onclick="abrirModalConfirmacaoFuncao('excluirArquivoGaleria', {$arquivoGaleria->getArquivoGaleriaID()});" title="Excluir"><img alt="del" src="include/images/icons/fugue/cross-circle.png" width="16" height="16"/></a>
						<img alt="edit" src="include/images/icons/fugue/pencil.png" width="16" height="16" style="cursor:pointer;" onclick="editarImagem({$arquivoGaleria->getArquivoGaleriaID()})"/>
					</td>
				</tr>
			{/foreach}
		{/if}
	</tbody>
</table>
