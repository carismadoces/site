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
				<h2>DOCES</h2>

				<ul class="nav nav-pills sort-source" data-sort-id="portfolio" data-option-key="filter" data-plugin-options='{"layoutMode": "masonry", "filter": "*"}'>
					<li data-option-value="*" class="active"><a href="#">Todas</a></li>

					<?php

						$galeriaBO = new GaleriaBO();
						$arquivoGaleriaID = 2;
						$tags = $galeriaBO->consultaTodasTags($arquivoGaleriaID);

						foreach ($tags as $key => $tag) {

								$tagLower = Util::replace_accents(strtolower($tag));

					?>
						<li data-option-value=".<?php echo $tagLower; ?>"><a href="#"><?php echo $tag;?></a></li>
					<?php } ?>
				</ul>

				<hr>

				<div class="row">


					<ul id="portfolioLoadMoreWrapper" class="portfolio-list sort-destination lightbox m-none" data-plugin-options='{"delegate": "a.lightbox-portfolio", "type": "image", "gallery": {"enabled": true}}' data-sort-id="portfolio" data-total-pages="5">

						<?php
							$list = $galeriaBO->listarArquivosGaleria($arquivoGaleriaID);

							foreach ($list as $key => $ag) {

								$file = $ag->getGaleria()->getPath() . $ag->getFile();
								$fileThumb = $ag->getGaleria()->getPath() . 'thumbs/' . $ag->getFile();

								$tags = $ag->getTagsToClass();
						?>



						<?php
							}
						?>
					</ul>

					<div class="col-md-12">

						<div id="portfolioLoadMoreLoader" class="portfolio-load-more-loader">
							<div class="bounce-loader">
								<div class="bounce1"></div>
								<div class="bounce2"></div>
								<div class="bounce3"></div>
							</div>
						</div>

						<button id="portfolioLoadMore" type="button" class="btn-portfolio-lazy-load btn btn-3d btn-default btn-lg btn-block font-size-xs text-uppercase outline-none p-md mb-xl">Load More...</button>
					</div>

				</div>

			</div>

			<?php include_once 'partials/footer.php' ?>

		</div>

		<?php include_once 'partials/res_footer.php' ?>

		<?php include_once 'template.html' ?>

		<script>

			/*
			Load More
			*/
			var portfolioLoadMore = {

				pages: 0,
				currentPage: 1,
				$wrapper: $('#portfolioLoadMoreWrapper'),
				$btn: $('#portfolioLoadMore'),
				$loader: $('#portfolioLoadMoreLoader'),

				build: function() {

					var self = this

					self.pages = self.$wrapper.data('total-pages');

					if(self.pages <= 1) {

						self.$btn.remove();
						return;

					} else {

						self.$btn.on('click', function() {
							self.loadMore();
						});

						// Lazy Load
						if(self.$btn.hasClass('btn-portfolio-lazy-load')) {
							self.$btn.appear(function() {
								self.$btn.trigger('click');
							}, {
								data: undefined,
								one: false,
								accX: 0,
								accY: 0
							});
						}

					}

				},
				loadMore: function() {

					var self = this;

					self.$btn.hide();
					self.$loader.show();

					// Ajax
					$.ajax({
						url: 'admin/ws/galeria/list_paginada?galeriaID=2&pagina=' + (parseInt(self.currentPage)+1),
						complete: function(data) {

							var divTemplate = $("#div-data").html();
							var galeryTemplate = _.template(divTemplate);
							var $items = galeryTemplate({items:data.responseJSON});

							setTimeout(function() {

									self.$wrapper.append( $items );
										// .isotope( 'appended', $items );

									self.currentPage++;

									if(self.currentPage < self.pages) {
										self.$btn.show().blur();
									} else {
										self.$btn.remove();
									}

									$('[data-plugin-lightbox]:not(.manual), .lightbox:not(.manual)').each(function() {
										var $this = $(this),
											opts;

										var pluginOptions = $this.data('plugin-options');
										console.log(pluginOptions);
										if (pluginOptions)
											opts = pluginOptions;

										$this.themePluginLightbox(opts);
									});
							});

							self.$loader.hide();
						}
					});

				}

			}

			if($('#portfolioLoadMoreWrapper').get(0)) {
				portfolioLoadMore.build();
			}

		</script>

	</body>
</html>
