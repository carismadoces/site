{include file="layout/head.tpl"}
{include file="layout/menu.tpl"}

{literal}

<script type="text/javascript" src="include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="include/js/funcoes.js"></script>

<script type="text/javascript">

        $().ready(function() {

            $("#btBuscar").click(function(){
                carregaTabela(1);
            })
        });

        function carregaTabela(pagina){
            var login = $("#login").val().trim();

            $("#tbAdmin").append('<img src="include/images/ajax-loader.gif"/>');    
            $("#tbAdmin").load("UsuarioAction.tabela",
                {
            		login: login,
                    pagina : pagina
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
        <div class="h1 with-menu"><h1>Consultar Usuário</h1></div>


        {msg obj=$msg|default:null type="small" autoClose=false}
        {display_errors errors=$errosValidacao|default:null}

        <div class="columns">
			<div class="colx1-left">           
		            {include file="view/usuario/formBusca.tpl"}
		            <div id="tbAdmin">{include file="view/usuario/tabela.tpl"}</div>
			</div>
		</div>
    </div>

</div>

{include file="layout/footer.tpl"}