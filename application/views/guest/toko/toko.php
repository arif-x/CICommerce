<section id="box-link1" class="section-style" style="margin-top: 3vh;">
    <div class="container page-builder-ltr">
        <div class="row row-style row_a1">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c  block block_3 title_neo1">
                <div class="module so-deals-1tr home1_deals so-deals">
                    <div class="head-title">
                        <h2 class="modtitle font-ct">
                            <span>Toko</span>
                        </h2>
                    </div>
                    <div class="container product-detail">
                        <div class="row">
                            <div id="content" class="col-md-12 col-sm-12 col-xs-12">
                                <div class="products-category">
                                    <div class="products-category">
                                        <div class="products-list grid row number-col-3 so-filter-gird">
                                            <?php foreach ($toko as $key => $value) { ?>
                                                <div class="product-layout  col-lg-3 col-md-3 col-sm-6 col-xs-6" >
                                                    <div class="product-item-container">
                                                        <div class="left-block">
                                                            <div class="image product-image-container ">
                                                                <a class="lt-image" href="<?= base_url().'toko/detail/'.$value['slug'] ?>" target="_self" title="<?= $value['nama_toko'] ?>">
                                                                    <img class="img-produk" src="<?= $value['foto'] ?>" alt="<?= $value['nama_toko'] ?>">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <div class="caption">
                                                                <h4><a href="<?= base_url().'toko/detail/'.$value['slug'] ?>" title="<?= $value['nama_toko'] ?>" target="_self"><?= $value['nama_toko'] ?></a></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                    <style type="text/css">
                        .pagination .active span {
                            background-color: #ff5e00 !important;
                            border-color: #ff5e00 !important;
                            color: #fff;
                        }
                    </style>
                </div>
            </div>
        </div>
    </section>