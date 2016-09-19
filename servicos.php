<?php

include_once 'admin/autoload.php';
include_once 'admin/include/php/Conexao.class.php';
include_once 'admin/include/php/Constantes.class.php';
include_once 'admin/include/php/Util.class.php';

?>
<!DOCTYPE html>
<html>
	<head>

		<?php include_once 'partials/head.php' ?>

	</head>
	<body>
		<div class="body">

			<?php include_once 'partials/header.php' ?>

			<div role="main" class="main">

				<div class="container">

					<br/>
					<h4 class="heading-primary">NOSSOS <strong> PRODUTOS E SERVIÇOS</strong></h4>

					<div class="row">
						<div class="col-md-10">
							<p class="lead">
								Nosso diferêncial é a qualidade.
								Para você que deseja saborear em casa, com os amigos ou na sua empresa, temos o mais diverso cardápio de doces e salgados para você fazer a festa.
								Encomende e tenha a certeza que estará saboreando um dos melhores doces e salgados da sua vida.
							</p>
						</div>
						<div class="col-md-2">
							<a href="contato.php" class="btn btn-lg btn-primary mt-xl pull-right">Fale Conosco!</a>
						</div>
					</div>

					<hr>

					<section class="p-xlg">
						<div class="container">
							<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="featured-box featured-box-primary featured-box-effect-1 mt-xlg">
											<div class="box-content">
												<h4 class="text-uppercase">Aniversários</h4>
												<p>Conheça nossos bolos para aniversários, ou nos envie sua ideia que customizamos de acordo com seu gosto!</p>
											</div>
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="featured-box featured-box-secondary featured-box-effect-1 mt-xlg">
											<div class="box-content">

												<h4 class="text-uppercase">Casamentos</h4>
												<p>É um momento especial e único, venha conhecer nossos produtos para ter a certeza que não irá se arrepender nesse momento tão especial!</p>
											</div>
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="featured-box featured-box-tertiary featured-box-effect-1 mt-xlg">
											<div class="box-content">
												<h4 class="text-uppercase">Eventos</h4>
												<p>Organizamos tudo em sua festa. Decoração, Cerimonial, Buffet, Bolos e Doces... Conte com nossa qualidade e excelência!</p>
											</div>
										</div>
									</div>
								</div>
							</div>
					</section>

					<h4 id="eventos" class="heading-primary center">EVENTOS REALIZADOS</h4>
					<hr>

					<div id="alert" class="alert alert-default center">
						Selecione uma imagem para visualizar a galeria em alta qualidade.
					</div>

					<?php include_once 'eventos/evento1.php' ?>
					<?php include_once 'eventos/evento2.php' ?>
					<?php include_once 'eventos/evento3.php' ?>
					<?php include_once 'eventos/evento4.php' ?>

				</div>

				<?php include_once 'partials/footer.php' ?>

			</div>

		<?php include_once 'partials/res_footer.php' ?>

	</body>

	<script>

		$(document).ready(function() {
			if(window.location.hash.length > 0) {
				console.log($(window.location.hash).offset().top);
					window.scrollTo(0, $(window.location.hash).offset().top-150);
			}
		});

	</script>
</html>
