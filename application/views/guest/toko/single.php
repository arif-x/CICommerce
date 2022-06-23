<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Daftar Toko</a></li>
		<li><a href="#"><?= $title ?></a></li>
	</ul>

	<div class="so-page-builder" style="margin-top: 2vh; margin-bottom: 2vh;">
		<div class="container page-builder-ltr">
			<div class="text-center" style="margin: 150px 0px">
				<h1>TOKO TIDAK AKTIF</h1>
				<a href="<?= base_url() ?>toko/semua">Cari Toko Lainnya</a>
			</div>
			<div class="row row_a90w  row-style">
				<!-- Menu left-->
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col_vnxd  menu-left" style="margin-bottom: 10px;">
					<div class="col-md-12" style="margin-bottom: 5px;">
						<div class="product-item-container">
							<div class="left-block">
								<div class="image product-image-container ">
									<a class="lt-image" href="#" target="_self" title="Anantara Dhigu Resort &amp;amp; Spa, Maldives Hair Spa">
										<img src="<?= $foto ?>" alt="Anantara Dhigu Resort &amp;amp; Spa, Maldives Hair Spa">
									</a>
								</div>
							</div>
						</div>
						<p style="font-size: 4vh; margin-top: 2vh;">
							<strong><?= $title ?></strong>
						</p>
						<p>
							<?= $deskripsi ?>
						</p>
						<p>
							No. HP: <?= $no_hp ?>
						</p>
					</div>
				</div>
				<!--- SLider right-->
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col_anla slider-right">
					<div class="row row_ci4f  ">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_dg1b block block_1">
							<div class="module sohomepage-slider so-homeslider-ltr  ">
								<div class="modcontent">
									<div id="sohomepage-slider1">
										<div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="no" data-autoplay="no" data-autoheight="no" data-margin="10" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-lazyload="no" data-loop="no" data-hoverpause="no">
											<div class="item slider-item">
												<a href="#" title="Slider" target="_self">
													<img src="<?= $banner ?>" class="img-produk" alt="Banner">
												</a>
												<div class="sohomeslider-description">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<section id="box-link1" class="section-style">
		<div class="container page-builder-ltr">
			<div class="row row-style row_a1">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c  block block_3 title_neo1">
					<div class="module so-deals-1tr home1_deals so-deals">
						<div class="head-title">
							<h2 class="modtitle font-ct">
								<span>Produk</span>
							</h2>
						</div>
						<div class="container page-builder-ltr">
							<div class="row row-style row_a2">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_1bi4  col-style block block_5 title_neo2">
									<div class="module so-listing-tabs-ltr default-nav clearfix img-float label-1 home-lt1">
										<div class="modcontent">
											<div id="so_listing_tabs_1" class="so-listing-tabs first-load">
												<div class="ltabs-wrap">
													<div class="row">
														<?php foreach ($toko as $key => $value) {
															?>
															<div class="col-lg-3">
																<div class="wap-listing-tabs ltabs-items-container products-list grid">
																	<!--Begin Items-->
																	<div class="ltabs-items ltabs-items-selected items-category-1" data-total="16">
																		<div class="ltabs-items-inner ltabs-slider">
																			<div class="ltabs-item">
																				<div class="item-inner product-layout">
																					<div class="product-item-container">
																						<div class="left-block">
																							<div class="image product-image-container ">
																								<a class="lt-image" href="<?= base_url().'produk/detail/'.$value['slug'] ?>" title="<?= $value['nama_produk'] ?>">
																									<img class="img-produk" src="<?= $value['gambar'] ?>" alt="<?= $value['nama_produk'] ?>">
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
																										<i class="fa fa-heart-o"  data-id="'.$value['id_produk'].'"></i></button>';
																									} else {
																										echo '<button class="wishlist btn-button wishlist-button-remove" id="wishlist-button-remove" type="button" data-toggle="tooltip" data-id="'.$value['id_produk'].'">
																										<i class="fa fa-heart"  data-id="'.$value['id_produk'].'"></i></button>';
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
						</div>
						<div class="row">
							<div class="col">
								<!--Tampilkan pagination-->
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
	</div>