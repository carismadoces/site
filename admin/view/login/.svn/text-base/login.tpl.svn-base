{include file="layout/head.tpl"}
{literal}

<link href="include/css/special-pages.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="include/js/jquery.validate.min.js" language="javascript"></script>

<script type="text/javascript">
$().ready(function() {

        $("#frmLogin").validate({
            rules: {
                login: {
                    required: true
                },
                senha: {
                    required: true
                }

            }
        });

});
</script>
{/literal}
<!-- the 'special-page' class is only an identifier for scripts -->
<body class="special-page login-bg dark">
    <!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie, .ie7 or .ie6 prefix to your css selectors when needed -->
    <!--[if lt IE 9]><div class="ie"><![endif]-->
    <!--[if lt IE 8]><div class="ie7"><![endif]-->

<section id="login-block">
    <div class="block-border"><div class="block-content">

            <div class="block-header">Acesso Restrito</div>
            
            {msg obj=$msg|default:null type="small"}

            <form class="form with-margin" name="frmLogin" id="frmLogin" method="post" action="LoginAction.login">
            	<input type="hidden" name="urlAnterior" value="{$urlAnterior|default:''}"/>
            	
                <p class="inline-small-label">
                    <label for="login"><span class="big">Usuário:</span></label>
                    <input type="text" name="login" id="login" class="full-width" value="{$login|default:''}" />
                    <label for="login" class="error"></label>
                </p>
                <p class="inline-small-label">
                    <label for="senha"><span class="big">Senha:</span></label>
                    <input type="password" name="senha" id="senha" class="full-width"/>
                    <label for="senha" class="error"></label>
                </p>

                <button type="submit" class="float-right">Login</button>

                <p class="input-height">
                </p>
            </form>

            <br/>

            <form class="form" id="password-recovery" method="post" action="LoginAction.recuperarSenha">
                <fieldset class="grey-bg no-margin collapse">
                    <legend><a href="#">Perdeu a sua senha?</a></legend>
                    <p class="input-with-button">
                        <label for="recovery-mail">Informe Seu Email</label>
                        <input type="text" name="recovery-mail" id="recovery-mail" value="">
                        <button type="button">Enviar</button>
                    </p>
                </fieldset>
            </form>
        </div></div>
</section>

<!--[if lt IE 8]></div><![endif]-->
<!--[if lt IE 9]></div><![endif]-->
</body>