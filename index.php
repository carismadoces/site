<!DOCTYPE html>
<html>
	<head>
		<?php include_once 'partials/head.php' ?>
	</head>
	<body>

		<div class="body">

      <?php include_once 'partials/header.php' ?>

      <div class="slider-container rev_slider_wrapper">
        <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 1272, "gridheight": 423}'>
          <ul>
            <li data-transition="fade">
              <img src="img/banners/01.png"
                alt=""
                data-bgposition="center center"
                data-bgfit="cover"
                data-bgrepeat="no-repeat"
                class="rev-slidebg">
            </li>

						<li data-transition="fade">
              <img src="img/banners/02.png"
                alt=""
                data-bgposition="center center"
                data-bgfit="cover"
                data-bgrepeat="no-repeat"
                class="rev-slidebg">
            </li>

          </ul>
        </div>
      </div>

      <section class="p-xlg">
				<div class="container">
					<div class="row">
						<div class="col-md-12 center">
							<h2 class="mt-lg mb-sm">Aceitamos <strong>Encomendas</strong> para...</h2>
							<p class="font-size-md">Todos os tipos de eventos. <br/>Conheça nossos produtos e serviços e tenha certeza que irá proporcionar aos seus convidados
                uma experiência maravilhosa.</p>

							<hr class="custom-divider">
						</div>
					</div>
					<div class="row mt-lg">
						<div class="col-sm-4 pb-xlg">

							<span class="thumb-info thumb-info-no-zoom thumb-info-custom mb-xl center appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
								<span class="thumb-info-side-image-wrapper p-none">
									<img src="img/aniversario.png" class="img-responsive" alt="">
								</span>
								<span class="thumb-info-caption">
									<span class="thumb-info-caption-text">
										<h2 class="text-semibold mb-md mt-xs">Aniversários</h2>
										<p class="font-size-md">Conheça nossos bolos para aniversários, ou nos envie sua ideia que customizamos de acordo com seu gosto...</p>
										<a class="btn btn-primary mt-md" href="servicos.php#eventos">Veja Mais <i class="fa fa-long-arrow-right"></i></a>
									</span>
								</span>
							</span>

						</div>
						<div class="col-sm-4 pb-xlg">

							<span class="thumb-info thumb-info-no-zoom thumb-info-custom mb-xl center appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
								<span class="thumb-info-side-image-wrapper p-none">
									<img src="img/casamentos.png" class="img-responsive" alt="">
								</span>
								<span class="thumb-info-caption">
									<span class="thumb-info-caption-text">
										<h2 class="text-semibold mb-md mt-xs">Casamentos</h2>
										<p class="font-size-md">É um momento especial e único, venha conhecer nossos produtos para ter a certeza que não irá se arrepender nesse momento tão especial...</p>
										<a class="btn btn-primary mt-md" href="servicos.php#eventos">Veja Mais <i class="fa fa-long-arrow-right"></i></a>
									</span>
								</span>
							</span>

						</div>
						<div class="col-sm-4 pb-xlg">

							<span class="thumb-info thumb-info-no-zoom thumb-info-custom mb-xl center appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="600">
								<span class="thumb-info-side-image-wrapper p-none">
									<img src="img/eventos.png" class="img-responsive" alt="">
								</span>
								<span class="thumb-info-caption">
									<span class="thumb-info-caption-text">
										<h2 class="text-semibold mb-md mt-xs">Eventos</h2>
										<p class="font-size-md">Organizamos tudo em sua festa. Decoração, Cerimonial, Buffet, Bolos e Doces... Conte com nossa qualidade e excelência!<br/><br/></p>
										<a class="btn btn-primary mt-md" href="servicos.php#eventos">Veja Mais <i class="fa fa-long-arrow-right"></i></a>
									</span>
								</span>
							</span>

						</div>
					</div>
				</div>
			</section>

      <section class="section section-custom-map">
        <section class="section section-default section-footer">
          <div class="container">

            <div class="row center">
              <div class="col-md-12">
                <h2 class="mb-sm word-rotator-title">
                  Onde estamos...
                </h2>
              </div>
            </div>
            <hr class="tall">

            <div class="row">
              <div class="col-md-12">

                <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
                <div id="googlemaps" class="google-map">
										<iframe width="100%" height="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ5QRt51IuWpMR9-7hJK2K58E&key=AIzaSyBOuYn56HvcKFPxeLtg1azBlTh02duR06c" allowfullscreen></iframe>
								</div>

              </div>
            </div>
          </div>
        </section>
      </section>

      <?php include_once 'partials/footer.php' ?>

		</div>

		<?php include_once 'partials/res_footer.php' ?>

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
