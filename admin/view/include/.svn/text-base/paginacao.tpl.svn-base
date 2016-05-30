{if isset($numPaginas) && $numPaginas > 1}

    <ul class="controls-buttons" style="text-align: center">

        {$anterior = $pagina-1}        
        
        {if $anterior <= 0} 
            {$anterior = 1} 
        {/if}
        
        <li>
            <a class="with-tip" title="Anterior" href="javascript:void(0);" onclick="carregaTabela({$anterior})">
                <img alt="" width="16" height="16" src="include/images/icons/fugue/navigation-180.png">&nbsp;
            </a>
        </li>

        {for $pg=1 to $numPaginas}

            {$click = "carregaTabela({$pg});"}
            {$style = ""}

            {if $pg eq $pagina}
                {$click=""}
                {$style = "current"}
            {/if}
            
            <li><a class="with-tip {$style}" title="Página {$pg}" href="javascript:void(0);" onclick="{$click}">{$pg}</a></li>

        {/for}

        {$proxima = $pagina+1}        
        
        {if $proxima >= $numPaginas} 
            {$proxima = $numPaginas} 
        {/if}    
            
        <li>
            <a class="with-tip" title="Próxima" href="javascript:void(0);" onclick="carregaTabela({$proxima})">
                &nbsp;<img alt="" width="16" height="16" src="include/images/icons/fugue/navigation.png">
            </a>
        </li>
        <li class="sep"></li>
        <li>
            <a class="with-tip" title="Recarregar" href="javascript:void(0);" onclick="reload()">
                &nbsp;<img alt="" width="16" height="16" src="include/images/icons/fugue/arrow-circle.png">
            </a>
        </li>

    </ul>

{/if}