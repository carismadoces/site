<?php /* Smarty version Smarty-3.0.6, created on 2016-05-24 12:51:42
         compiled from "view/layout/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9237603185744788e5149d5-45543398%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3269674be922204b19df2b6c4aa1e2ccaa60d9d8' => 
    array (
      0 => 'view/layout/menu.tpl',
      1 => 1396186742,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9237603185744788e5149d5-45543398',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_user_permission')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.user_permission.php';
if (!is_callable('smarty_function_pessoa_session')) include '/Users/danyelsanches/Sites/workspace/carisma/admin/action/../include/php/smarty/plugins/function.pessoa_session.php';
?><body>
    <nav id="main-nav">

        <ul class="container_12">
			
			<?php ob_start();?><?php echo smarty_function_user_permission(array('path'=>"menu_usuario"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>
				<li class="users" title="Usuario"><a title="UsuarioAction.listar" href="UsuarioAction.listar">Usuário</a>
	                <ul>
	                	<?php ob_start();?><?php echo smarty_function_user_permission(array('path'=>"UsuarioAction.listar"),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?>
	                    	<li><a title="Consultar Usuário" href="UsuarioAction.listar">Consultar</a></li>
	                    <?php }?>
	                    <?php ob_start();?><?php echo smarty_function_user_permission(array('path'=>"UsuarioAction.cadastro"),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3){?>
	                    	<li><a title="Cadastrar Usuário" href="UsuarioAction.cadastro">Cadastrar</a></li>
	                    <?php }?>
	                </ul>
	            </li>
            <?php }?>
            
            <?php ob_start();?><?php echo smarty_function_user_permission(array('path'=>"menu_perfil"),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4){?>
	            <li class="profile" title="Perfil"><a title="PerfilAction.listar" href="PerfilAction.listar">Perfil</a>
	                <ul>
	                	<?php ob_start();?><?php echo smarty_function_user_permission(array('path'=>"PerfilAction.listar"),$_smarty_tpl);?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5){?>
	                    	<li><a title="Consultar Perfil" href="PerfilAction.listar">Consultar</a></li>
	                    <?php }?>
	                    <?php ob_start();?><?php echo smarty_function_user_permission(array('path'=>"PerfilAction.cadastro"),$_smarty_tpl);?>
<?php $_tmp6=ob_get_clean();?><?php if ($_tmp6){?>
	                    	<li><a title="Cadastrar Perfil" href="PerfilAction.cadastro">Cadastrar</a></li>
	                    <?php }?>
	                    <?php ob_start();?><?php echo smarty_function_user_permission(array('path'=>"AcaoAction.listar"),$_smarty_tpl);?>
<?php $_tmp7=ob_get_clean();?><?php if ($_tmp7){?>
	                    	<li><a title="Ação" href="AcaoAction.listar">Ação</a></li>
	                    <?php }?>
	                </ul>
	            </li>
	        <?php }?>
	        
	        <?php ob_start();?><?php echo smarty_function_user_permission(array('path'=>"menu_galeria"),$_smarty_tpl);?>
<?php $_tmp8=ob_get_clean();?><?php if ($_tmp8){?>        
	            <li class="galeria" title="Galeria"><a title="GaleriaAction.listar" href="GaleriaAction.listar">Galeria</a>
	                <ul>
	                	<?php ob_start();?><?php echo smarty_function_user_permission(array('path'=>"GaleriaAction.listar"),$_smarty_tpl);?>
<?php $_tmp9=ob_get_clean();?><?php if ($_tmp9){?>
	                    	<li><a title="Galeria" href="GaleriaAction.listar">Consultar</a></li>
	                    <?php }?>
	                </ul>
	            </li>
            <?php }?>
            
        </ul>
    </nav>
    <div id="sub-nav"><div class="container_12">

            <a class="nav-button" title="Ajuda" href="#"><b>Ajuda</b></a>

            <form action="search.php" method="post" name="search-form" id="search-form">
                <input type="hidden" value="" id="search-last" name="search-last"><input type="text" autocomplete="off" title="Search admin..." value="" id="s" name="s"><div class="result-block" id="search-result" style="display: none;"><span class="arrow"><span></span></span><div id="server-search">Loading results...</div><p class="result-info" id="search-info">-</p></div>
            </form>

        </div></div>
    
    
    <div id="status-bar"><div class="container_12">

            <ul id="status-infos">
                <li class="spaced">Usuário: <strong><?php echo smarty_function_pessoa_session(array(),$_smarty_tpl);?>
</strong></li>
              
                <li class="spaced" style="height: 3.25em;">
                	<a title="Logout" class="button red" href="LoginAction.logout" style="position: relative;">
                		<span class="smaller">SAIR</span>
                	</a>
                </li>
            </ul>

            <ul id="breadcrumb">
                <li><a title="Home" href="#">Home</a></li>
                <li><a title="Dashboard" href="#">Admin</a></li>
            </ul>

        </div>
    </div>