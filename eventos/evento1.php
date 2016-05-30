<br/>
<h2>CASAMENTO - KAIKE &amp; ISADORA</h2>

<div class="container">

  <ul class="nav nav-pills sort-source" data-sort-id="portfolio" data-option-key="filter" data-plugin-options='{"layoutMode": "masonry", "filter": "*"}'>
  </ul>
  <div class="row">

    <ul class="portfolio-list sort-destination lightbox m-none" data-plugin-options='{"delegate": "a.lightbox-portfolio", "type": "image", "gallery": {"enabled": true}}' data-sort-id="portfolio">

      <?php

        $galeriaBO = new GaleriaBO();
        $arquivoGaleriaID = 4;
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
