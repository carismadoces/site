<body>
    <nav id="main-nav">

        <ul class="container_12">
			
			{if {user_permission path="menu_usuario"}}
				<li class="users" title="Usuario"><a title="UsuarioAction.listar" href="UsuarioAction.listar">Usuário</a>
	                <ul>
	                	{if {user_permission path="UsuarioAction.listar"}}
	                    	<li><a title="Consultar Usuário" href="UsuarioAction.listar">Consultar</a></li>
	                    {/if}
	                    {if {user_permission path="UsuarioAction.cadastro"}}
	                    	<li><a title="Cadastrar Usuário" href="UsuarioAction.cadastro">Cadastrar</a></li>
	                    {/if}
	                </ul>
	            </li>
            {/if}
            
            {if {user_permission path="menu_perfil"}}
	            <li class="profile" title="Perfil"><a title="PerfilAction.listar" href="PerfilAction.listar">Perfil</a>
	                <ul>
	                	{if {user_permission path="PerfilAction.listar"}}
	                    	<li><a title="Consultar Perfil" href="PerfilAction.listar">Consultar</a></li>
	                    {/if}
	                    {if {user_permission path="PerfilAction.cadastro"}}
	                    	<li><a title="Cadastrar Perfil" href="PerfilAction.cadastro">Cadastrar</a></li>
	                    {/if}
	                    {if {user_permission path="AcaoAction.listar"}}
	                    	<li><a title="Ação" href="AcaoAction.listar">Ação</a></li>
	                    {/if}
	                </ul>
	            </li>
	        {/if}
	        
	        {if {user_permission path="menu_galeria"}}        
	            <li class="galeria" title="Galeria"><a title="GaleriaAction.listar" href="GaleriaAction.listar">Galeria</a>
	                <ul>
	                	{if {user_permission path="GaleriaAction.listar"}}
	                    	<li><a title="Galeria" href="GaleriaAction.listar">Consultar</a></li>
	                    {/if}
	                </ul>
	            </li>
            {/if}
            
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
                <li class="spaced">Usuário: <strong>{pessoa_session}</strong></li>
              
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