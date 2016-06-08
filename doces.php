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

				<div id="alert" class="alert alert-default center">
					Selecione uma imagem para visualizar a galeria em alta qualidade.
				</div>

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

					<ul class="portfolio-list sort-destination lightbox m-none" data-plugin-options='{"delegate": "a.lightbox-portfolio", "type": "image", "gallery": {"enabled": true}}' data-sort-id="portfolio">

						<?php
							$list = $galeriaBO->listarArquivosGaleria($arquivoGaleriaID);

							foreach ($list as $key => $ag) {

								$file = $ag->getGaleria()->getPath() . $ag->getFile();
								$fileThumb = $ag->getGaleria()->getPath() . 'thumbs/' . $ag->getFile();

								$tags = $ag->getTagsToClass();
						?>

							<li class="col-lg-3 col-md-4 col-xs-6 isotope-item <?php echo $tags?>">
								<div class="portfolio-item">
									<span class="thumb-info thumb-info-lighten thumb-info-centered-icons">
										<span class="thumb-info-wrapper">
											<img src="<?php echo $fileThumb;?>" class="img-responsive" alt="">
											<span class="thumb-info-action">
												<a
													href="<?php echo $file;?>"
													class="lightbox-portfolio"
													title="<?php echo $ag->getDsArquivoGaleria();?>">
													<span class="thumb-info-action-icon thumb-info-action-icon-light"><i class="fa fa-search-plus"></i></span>
												</a>
											</span>
										</span>
									</span>
								</div>
							</li>

						<?php
							}
						?>
					</ul>

				</div>

			</div>

			<?php include_once 'partials/footer.php' ?>

		</div>

		<?php include_once 'partials/res_footer.php' ?>

		<script>

		$(function() {

			setTimeout(function(){
					$('#alert').hide( "pulsate", { direction: "down" }, "slow" );
			}, 8000);

		});

		</script>

	</body>
</html>
