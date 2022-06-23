<!-- Main Container  -->
<div id="content" style="margin-top: 3vh;">
	<div class="so-page-builder">
		<div class="container page-builder-ltr">
			<div class="row row_a90w  row-style">
				<!-- Menu left-->
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col_vnxd  menu-left">
					<div class="row row_f8gy  ">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_gafz col-style megamenu-style-dev megamenu-dev">
							<div class="responsive">
								<div class="so-vertical-menu no-gutter">
									<nav class="navbar-default">
										<div class=" container-megamenu  container   vertical  ">
											<div id="menuHeading">
												<div class="megamenuToogle-wrapper">
													<div class="megamenuToogle-pattern">
														<div class="container">
															<div><span></span><span></span><span></span></div>
															<span class="title-mega">
																Kategori
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="navbar-header">
												<span class="title-navbar hidden-lg hidden-md"> Kategori </span>
												<button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
											</div>
											<div class="vertical-wrapper">
												<span id="remove-verticalmenu" class="fa fa-times"></span>
												<div class="megamenu-pattern">
													<div class="container">
														<ul class="megamenu" data-transition="slide" data-animationtime="300">
															<?php foreach ($kategori as $key => $value) { ?>
																<li class="item-vertical  style1">
																	<p class="close-menu"></p>
																	<a href="<?= base_url().'produk/kategori/'.$value['slug'] ?>" class="clearfix">
																		<i class="fa fa-bookmark-o"></i>
																		<span>
																			<strong><?= $value['kategori'] ?></strong>
																		</span>
																	</a>
																</li>
															<?php } ?>
															<li class="loadmore"><i class="fa fa-plus-square"></i><span class="more-view"> Lihat Semua</span></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--- SLider right-->
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col_anla  slider-right" style="margin-bottom: 10px">
					<div class="row row_ci4f  ">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_dg1b block block_1" style="margin-bottom: 10px">
							<div class="module sohomepage-slider so-homeslider-ltr  ">
								<div class="modcontent">
									<div id="sohomepage-slider1">
										<div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
											<?php foreach ($slider as $key => $value) { ?>
												<div class="item slider-item">
													<a href="#" title="Slider" target="_self">
														<img src="<?= $value['slider'] ?>" class="img-produk" alt="Banner">
													</a>
													<div class="sohomeslider-description">
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_hmsd block block_2" style="margin-bottom: 10px;">
							<div class="home1-banner-1 clearfix">
								<div class="item-1 col-lg-6 col-md-6 col-sm-6 banners">
									<div>
										<a title="Static Image" href="#"><img src="<?= base_url('asset/') ?>image/catalog/demo/banners/home1/bn-1.jpg " alt="Static Image"></a>
									</div>
								</div>
								<div class="item-2 col-lg-6 col-md-6 col-sm-6 banners">
									<div>
										<a title="Static Image" href="#"><img src="<?= base_url('asset/') ?>image/catalog/demo/banners/home1/bn-2.jpg" alt="Static Image"></a>
									</div>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<section id="box-link1" class="section-style">
			<div class="container page-builder-ltr">
				<div class="row row-style row_a1">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c  block block_3 title_neo1">
						<div class="module so-deals-1tr home1_deals so-deals">
							<div class="head-title">
								<h2 class="modtitle font-ct">
									<span>Toko</span>
								</h2>
								<div class="pull-right">
									<a href="<?= base_url() ?>toko/semua">
										<h2 class="modtitles font-ct">
											<span>Lihat Semua</span>
										</h2>
									</a>
								</div>
							</div>
							<div class="container product-detail" style="margin-top: 2vh;">
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
						</div>
					</div>
				</div>
			</section>

			<section id="box-link1" class="section-style">
				<div class="container page-builder-ltr">
					<div class="row row-style row_a1">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c  block block_3 title_neo1">
							<div class="module so-deals-1tr home1_deals so-deals">
								<div class="head-title">
									<h2 class="modtitle font-ct">
										<span>Produk</span>
									</h2>
									<div class="pull-right">
										<a href="<?= base_url() ?>produk/semua">
											<h2 class="modtitles font-ct">
												<span>Lihat Semua</span>
											</h2>
										</a>
									</div>
								</div>
								<div class="container product-detail" style="margin-top: 2vh;">
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
																			<a class="lt-image" href="<?= base_url().'produk/detail/'.$value['slug'] ?>" title="<?= $value['nama_produk'] ?>">
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
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>

<!-- //Main Container -->