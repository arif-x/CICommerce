<section id="box-link1" class="section-style" style="margin-top: 3vh;">
    <div class="container page-builder-ltr">
        <div class="row row-style row_a1">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c  block block_3 title_neo1">
                <div class="module so-deals-1tr home1_deals so-deals">
                    <div class="head-title">
                        <h2 class="modtitle font-ct">
                            <span>Produk</span>
                        </h2>
                    </div>
                    <div class="container product-detail">
                        <div class="row">
                            <div id="content" class="col-md-12 col-sm-12 col-xs-12">
                                <div class="products-category">
                                    <div class="products-category">

                                        <div class="products-list grid row number-col-3 so-filter-gird">
                                            <?php foreach ($produk as $key => $value) { ?>
                                                <div class="product-layout  col-lg-3 col-md-3 col-sm-6 col-xs-6" >
                                                    <div class="product-item-container">
                                                        <div class="left-block">
                                                            <div class="image product-image-container ">
                                                                <a class="lt-image" href="#" title="<?= $value['nama_produk'] ?>">
                                                                    <img src="<?= $value['gambar'] ?>" alt="<?= $value['nama_produk'] ?>">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="button-group">
                                                            <div class="button-inner so-quickview">
                                                                <?php
                                                                $wishlist_check = &get_instance();
                                                                $wishlist_check->load->model('auth/user_model', 'auth_user');
                                                                $wishlist_check->load->model('user/wishlist_model', 'wishlist_model');
                                                                $user =  $wishlist_check->auth_user->current_user();
                                                                if(empty($user)){
                                                                    echo '<button class="wishlist btn-button wishlist-button" id="wishlist-button" type="button" data-toggle="tooltip" data-id="'.$value['id_produk'].'">
                                                                    <i class="fa fa-heart-o"></i></button>';
                                                                } else {
                                                                    $id_user = $wishlist_check->auth_user->current_user()->id_user;
                                                                    $result = $wishlist_check->wishlist_model->check($value['id_produk'], $id_user);
                                                                    if(empty($result)) {
                                                                        echo '<button class="wishlist btn-button wishlist-button" id="wishlist-button" type="button" data-toggle="tooltip" data-id="'.$value['id_produk'].'">
                                                                        <i class="fa fa-heart-o"></i></button>';
                                                                    } else {
                                                                        echo '<button class="wishlist btn-button wishlist-button-remove" id="wishlist-button-remove" type="button" data-toggle="tooltip" data-id="'.$value['id_produk'].'">
                                                                        <i class="fa fa-heart"></i></button>';
                                                                    }
                                                                }
                                                                ?>

                                                                <button class="addToCart btn-button keranjang-button" type="button" data-toggle="tooltip" title="Tambah ke Keranjang" value="1" data-id="<?= $value['id_produk'] ?>">
                                                                    <span class="hidden">Tambah ke Keranjang</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <div class="caption">
                                                                <h4><a href="<?= base_url().'produk/detail/'.$value['slug'] ?>" title="$value['nam_produk'] ?>" target="_self"><?= $value['nama_produk'] ?></a></h4>
                                                                <small><?= $value['nama_toko'] ?></small>
                                                                <div class="total-price clearfix">
                                                                    <?php if ($value['diskon'] >= 0.01) { ?>
                                                                        <div class="price price-left">
                                                                            <span class="price-new"><?= "Rp " . number_format($value['harga'] - ($value['harga'] * $value['diskon'] / 100), 0, ',', '.') ?></span>
                                                                            <span class="price-old"><?= "Rp " . number_format($value['harga'], 0, ',', '.') ?></span>
                                                                        </div>
                                                                        <div class="price-sale price-right">
                                                                            <span class="discount 123">-<?= $value['diskon'] ?>%<strong>OFF</strong></span>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <div class="price price-left">
                                                                            <span class="price-new"><?= "Rp " . number_format($value['harga'], 0, ',', '.') ?></span>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
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

