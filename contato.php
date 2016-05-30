<!DOCTYPE html>
<html>
	<head>

		<?php include_once 'partials/head.php' ?>

	</head>
	<body>
		<div class="body">

			<?php include_once 'partials/header.php' ?>

			<div role="main" class="main">

				<br/>
				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				<div id="googlemaps" class="google-map">
					<iframe width="100%" height="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ5QRt51IuWpMR9-7hJK2K58E&key=AIzaSyBOuYn56HvcKFPxeLtg1azBlTh02duR06c" allowfullscreen></iframe>
				</div>

				<div class="container">

					<div class="row">
						<div class="col-md-6">

							<div class="alert alert-success hidden mt-lg" id="contactSuccess">
								<strong>Successo!</strong> Sua mensagem foi enviada para nós.
							</div>

							<div class="alert alert-danger hidden mt-lg" id="contactError">
								<strong>Erro!</strong> Houve um erro ao enviar a mensagem.
								<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
							</div>

							<h2 class="mb-sm mt-sm"><strong>Contato</strong></h2>
							<form id="contactForm" action="vendor/php/contact-form.php" method="POST">
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Seu Nome *</label>
											<input type="text" value="" data-msg-required="Por favor informe seu nome." maxlength="100" class="form-control" name="name" id="name" required>
										</div>
										<div class="col-md-6">
											<label>Seu Email *</label>
											<input type="email" value="" data-msg-required="Por favor informe seu email." data-msg-email="Por favor informe um email válido." maxlength="100" class="form-control" name="email" id="email" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Assunto</label>
											<input type="text" value="" data-msg-required="Por favor informe o assunto." maxlength="100" class="form-control" name="subject" id="subject" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Mensagem *</label>
											<textarea maxlength="5000" data-msg-required="Por favor informe a mensagem." rows="10" class="form-control" name="message" id="message" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" value="Enviar Mensagem" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Enviando...">
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-6">

							<h4 class="heading-primary"><strong>Lojas</strong></h4>
							<hr>

							<h4 class="heading-primary">Loja - Núcleo Bandeirante</h4>
							<ul class="list list-icons list-icons-style-3 mt-xlg">
								<li><i class="fa fa-map-marker"></i> <strong>Endereço:</strong> Terceira Avenida Bloco 1060B - Loja 01 - Núcleo Bandeirante - DF</li>
								<li><i class="fa fa-phone"></i> <strong>Telefones:</strong> (61) 3297-0192 / 8103-2601</li>
								<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:atendimento@carismaconfeitaria.com.br">atendimento@carismaconfeitaria.com.br</a></li>
							</ul>

							<hr>

							<h4 class="heading-primary">Loja - Vianópolis</h4>
							<ul class="list list-icons list-icons-style-3 mt-xlg">
								<li><i class="fa fa-map-marker"></i> <strong>Endereço:</strong> Av. Talles Pompeu de Pina - N. 50 - Vianópolis - Goiás</li>
								<li><i class="fa fa-phone"></i> <strong>Telefones:</strong> (61) 3335-1554</li>
								<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:atendimento@carismaconfeitaria.com.br">atendimento@carismaconfeitaria.com.br</a></li>
							</ul>

							<hr>

							<h4 class="heading-primary">Horário de Funcionamento</h4>
							<ul class="list list-icons list-dark mt-xlg">
								<li><i class="fa fa-clock-o"></i> Segunda - Sexta: 09:00 às 18:00</li>
								<li><i class="fa fa-clock-o"></i> Sábado: 09:00 às 17:00</li>
								<li><i class="fa fa-clock-o"></i> Domingo: Fechado</li>
							</ul>

						</div>

					</div>

				</div>

				<?php include_once 'partials/footer.php' ?>

			</div>

		<?php include_once 'partials/res_footer.php' ?>

		<!-- Current Page Vendor and Views -->
		<script src="js/views/view.contact.js"></script>


		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

	</body>
</html>
