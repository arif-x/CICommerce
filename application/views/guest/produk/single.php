<div class="container product-detail">
  <div class="row">

    <?php foreach ($produk as $key => $value) {
      $toko_status;
      foreach ($toko as $key => $value) {
        $toko_status = $value['status'];
      }
    ?>

    <?php if($toko_status == 0){} ?>
    <?php if($toko_status == 0){ ?>


    <?php foreach ($produk as $key => $value) { ?>
      <div id="content" class="col-md-12 col-sm-12 col-xs-12">
        <div class="sidebar-overlay "></div>
        <div class="product-view product-detail">
          <div class="product-view-inner clearfix">
            <div class="content-product-left  col-md-5 col-sm-6 col-xs-12">
              <div class="so-loadeding"></div>
              <div class="large-image  class-honizol">
                <?php if ($value['diskon'] >= 0.01) { ?>
                  <div class="box-label">
                    <span class="label-product label-sale">
                      <?= $value['diskon'] ?>%
                    </span>
                  </div>
                <?php } else {} ?>
                <a href="<?= $value['gambar'] ?>"  title="<?= $value['nama_produk'] ?>" class="image-nya">
                  <img class="img-produk product-image-zoom" src="<?= $value['gambar'] ?>" data-zoom-image="<?= $value['gambar'] ?>">
                </a>
              </div>
              <script>
                $(document).ready(function() {
                  $('.image-nya').magnificPopup({ 
                    type: 'image',
                    gallery:{enabled:true}
                  });
                });
              </script>
            </div>
            <div class="content-product-right col-md-7 col-sm-6 col-xs-12">
              <div class="title-product">
                <h1><?= $value['nama_produk'] ?></h1>
              </div>
              <!-- <div class="box-review">
                <div class="rating">
                  <div class="rating-box">
                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>                            
                  </div>
                </div>
              </div> -->
              <div class="product_page_price price pull-left" itemscope="">
                <?php if ($value['diskon'] >= 0.01) { ?>
                  <span class="price-new"><span id="price-special"><?= "Rp " . number_format($value['harga'] - ($value['harga'] * $value['diskon'] / 100), 0, ',', '.') ?></span></span>
                  <span class="price-old" id="price-old"><?= "Rp " . number_format($value['harga'], 0, ',', '.') ?></span>
                  <div class="price price-left">
                  </div>
                <?php } else { ?>
                  <div class="price price-left">
                    <span class="price-new"><?= "Rp " . number_format($value['harga'], 0, ',', '.') ?></span>
                  </div>
                <?php } ?>
              </div>
              <div class="product-box-desc">
                <div class="inner-box-desc">
                  <?php if($value['stok'] <= 0) { ?>
                    <div class="stock"><span>Stok:</span> Stok Habis</div>
                  <?php } else { ?>
                    <div class="stock"><span>Stok:</span> <i class="fa fa-check-square-o"></i> <?= $value['stok'] ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="short_description form-group">
                <h3>OverView</h3>
              </div>
              <div id="product">
                <div class="box-cart clearfix">
                  <div class="form-group box-info-product">
                    <div class="cart">
                      <input type="button" id="btn-masuk" value="Masukkan Keranjang" data-id="<?= $value['id_produk'] ?>" class="addToCart btn btn-mega btn-lg " data-toggle="tooltip" title="Masukkan Keranjang" data-original-title="Masukkan Keranjang">
                    </div>
                    <div class="add-to-links wish_comp">
                      <ul class="blank">
                        <li class="wishlist">
                         <?php
                         $wishlist_check = &get_instance();
                         $wishlist_check->load->model('auth/user_model', 'auth_user');
                         $wishlist_check->load->model('user/wishlist_model', 'wishlist_model');
                         $user =  $wishlist_check->auth_user->current_user();
                         if(empty($user)){
                           echo '<a class="wishlist btn-button wishlist-button" id="wishlist-button" type="button" data-toggle="tooltip" data-id="'.$value['id_produk'].'">
                           <i class="fa fa-heart-o" data-id="'.$value['id_produk'].'"></i></a>';
                         } else {
                           $id_user = $wishlist_check->auth_user->current_user()->id_user;
                           $result = $wishlist_check->wishlist_model->check($value['id_produk'], $id_user);
                           if(empty($result)) {
                             echo '<a class="wishlist btn-button wishlist-button" id="wishlist-button" type="button" data-toggle="tooltip" data-id="'.$value['id_produk'].'">
                             <i class="fa fa-heart-o" data-id="'.$value['id_produk'].'"></i></a>';
                           } else {
                             echo '<a class="wishlist btn-button wishlist-button-remove" id="wishlist-button-remove" type="button" data-toggle="tooltip" data-id="'.$value['id_produk'].'">
                             <i class="fa fa-heart" data-id="'.$value['id_produk'].'"></i></a>';
                           }
                         }
                         ?>
                       </li>
                     </ul>
                   </div>
                 </div>
                 <div class="clearfix"></div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="product-attribute module">
        <div class="row content-product-midde clearfix">
          <div class="col-xs-12">
            <div class="producttab">
              <div class="tabsslider">
                <div class="tab-content">
                  <div id="tab-description">
                    <h2 style="margin: 0px 0px 10px !important">Deskripsi</h2>
                    <p class="text-justify"><?= $value['deskripsi'] ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    <div class="content-product-bottom bottom-product clearfix">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#product-related">Produk Terkait</a></li>
      </ul>
      <div class="tab-content">
        <div id="product-related" class="tab-pane fade in active">
          <div class="clearfix module horizontal">
            <div class="products-category">
              <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="no" data-autoplay="no" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="3" data-items_column1="3" data-items_column2="2" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                <?php foreach ($similiar as $key => $value) { ?>
                  <div class="product-layout">
                    <div class="product-item-container">
                      <div class="left-block">
                        <div class="product-image-container">
                          <a href="<?= base_url().'produk/detail/'.$value['slug'] ?>" title="<?= $value['nama_produk'] ?>">
                            <img src="<?= $value['gambar'] ?>" alt="<?= $value['nama_produk'] ?>" class="img-1 img-responsive">
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
                            <i class="fa fa-heart-o" data-id="'.$value['id_produk'].'"></i></button>';
                          } else {
                            $id_user = $wishlist_check->auth_user->current_user()->id_user;
                            $result = $wishlist_check->wishlist_model->check($value['id_produk'], $id_user);
                            if(empty($result)) {
                              echo '<button class="wishlist btn-button wishlist-button" id="wishlist-button" type="button" data-toggle="tooltip" data-id="'.$value['id_produk'].'">
                              <i class="fa fa-heart-o" data-id="'.$value['id_produk'].'"></i></button>';
                            } else {
                              echo '<button class="wishlist btn-button wishlist-button-remove" id="wishlist-button-remove" type="button" data-toggle="tooltip" data-id="'.$value['id_produk'].'">
                              <i class="fa fa-heart" data-id="'.$value['id_produk'].'"></i></button>';
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
                          <h4><a href="<?= base_url().'produk/detail/'.$value['slug'] ?>" title="<?= $value['nama_produk'] ?>" target="_self"><?= $value['nama_produk'] ?></a></h4>
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
  </div>
<?php } ?>
</div>
</div>
