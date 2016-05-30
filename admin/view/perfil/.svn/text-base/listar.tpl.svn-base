{include file="layout/head.tpl"}
{include file="layout/menu.tpl"}

{literal}

<script type="text/javascript" src="include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="include/js/funcoes.js"></script>

<script type="text/javascript">

        $().ready(function() {

            $("#btBuscar").click(function(){
                carregaTabela(1);
            });
            
        });

        function carregaTabela(pagina){
            var nome = $("#nome").val().trim();

            $("#tbPerfil").append('<img src="include/images/ajax-loader.gif"/>');    
            $("#tbPerfil").load("PerfilAction.tabela",
                {
            		nome : nome
                }
            );
        }
            
        function reload(){
            carregaTabela(1);
        }

</script>
{/literal}

<div id="content" class="block-border">

    <div class="block-content">
        <div class="h1 with-menu"><h1>Consultar Perfil</h1></div>


        {msg obj=$msg|default:null type="small" autoClose=false}
        {display_errors errors=$errosValidacao|default:null}

        <div class="columns">
			<div class="colx1-left">           
		            {include file="view/perfil/formBusca.tpl"}
		            <div id="tbPerfil">{include file="view/perfil/tabela.tpl"}</div>
			</div>
		</div>
    </div>

</div>

{include file="layout/footer.tpl"}