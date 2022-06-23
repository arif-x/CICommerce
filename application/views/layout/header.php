<!DOCTYPE html>
<html lang="en">

<head>
   <title>Ecommerce<?= ' | '.$title ?></title>
   <meta charset="utf-8">
   <meta name="keywords" content="html5 template, best html5 template, best html template, html5 basic template, multipurpose html5 template, multipurpose html template, creative html templates, creative html5 templates" />
   <meta name="description" content="SuperMarket is a powerful Multi-purpose HTML5 Template with clean and user friendly design. It is definite a great starter for any eCommerce web project." />
   <meta name="author" content="Magentech">
   <meta name="robots" content="index, follow" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>asset/image/logo/logos.png" />
   <link rel="stylesheet" href="<?= base_url() ?>asset/css/bootstrap/css/bootstrap.min.css">
   <link href="<?= base_url() ?>asset/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/js/owl-carousel/owl.carousel.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/themecss/lib.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/js/minicolors/miniColors.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/themecss/so_sociallogin.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/themecss/so_searchpro.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/themecss/so_megamenu.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/themecss/so-categories.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/themecss/so-listing-tabs.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/themecss/so-category-slider.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/themecss/so-newletter-popup.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/footer/footer1.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/header/header1.css" rel="stylesheet">
   <link id="color_scheme" href="<?= base_url() ?>asset/css/theme.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/responsive.css" rel="stylesheet">
   <link href="<?= base_url() ?>asset/css/quickview/quickview.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" type="text/css">
   <style type="text/css">
      body {
         font-family: Roboto, sans-serif;
      }
   </style>
   <link href="<?= base_url() ?>asset/css/img.css" rel="stylesheet">
   <script type="text/javascript" src="<?= base_url() ?>asset/js/jquery-2.2.4.min.js"></script>

</head>

<body class="account-login account res layout-1">
   <?php 
   $CI = &get_instance();
   $CI->load->model('auth/user_model', 'auth_user');
   $CI->load->model('user/keranjang_model');
   ?>

   <div id="wrapper" class="wrapper-fluid banners-effect-10">


      <!-- Header Container  -->
      <header id="header" class=" typeheader-1">
         <!-- Header Top -->
         <div class="header-top hidden-compact">
            <div class="container">
               <div class="row">
                  <div class="col-lg-3 col-xs-6 header-logo ">
                     <div class="navbar-logo">
                        <a href="<?= base_url() ?>"><img src="<?= base_url().'asset/image/logo/logo.png' ?>" alt="Your Store" width="110" height="auto" title="Your Store"></a>
                     </div>
                  </div>
                  <div class="col-lg-7 header-sevices">
                  </div>
                  <div class="col-lg-2 col-xs-6 header-cart">
                     <div class="shopping_cart">
                        <div id="cart" class="btn-shopping-cart">
                           <a data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown">
                              <div class="shopcart">
                                 <span class="handle pull-left"></span>
                                 <div class="cart-info">
                                    <h2 class="title-cart">Keranjang</h2>
                                    <h2 class="title-cart2 hidden">Keranjang Saya</h2>
                                    <span class="total-shopping-cart cart-total-full">
                                       <?php 
                                       $result = $CI->auth_user->current_user();
                                       if (!empty($result)) {
                                          $total_keranjang = $CI->keranjang_model->get_count_dan_jumlah($result->id_user);
                                          foreach ($total_keranjang as $key => $value) {
                                             ?>
                                             <span class="items_cart"><?= $value['total_row'] ?> </span>
                                             <span class="items_cart2">Produk</span>
                                             <?php
                                          }
                                       } else {
                                          ?>
                                          <span class="items_cart" id="login">Login</span>
                                          <script type="text/javascript">
                                             $('#login').on('click', function(){
                                                window.location.href = "<?= base_url().'login' ?>";
                                             });
                                          </script>
                                          <?php
                                       }
                                       ?>
                                       
                                    </span>
                                 </div>
                              </div>
                           </a>
                           <?php 
                           $result = $CI->auth_user->current_user();
                           if (!empty($result)) {
                              ?>
                              <ul class="dropdown-menu pull-right shoppingcart-box">
                                 <li class="content-item">
                                    <?php $detail_keranjang = $CI->keranjang_model->index_no_pagination($result->id_user); ?>
                                    <table class="table table-striped" id="tabel-keranjang" style="margin-bottom:10px;">
                                       <tbody>
                                          <?php foreach ($detail_keranjang as $key => $value) { ?>
                                             <tr>
                                                <td class="text-center size-img-cart">
                                                   <a href="<?= base_url() ?>produk/detail/<?= $value['slug'] ?>"><img src="<?= $value['gambar'] ?>" alt="<?= $value['nama_produk'] ?>" title="<?= $value['nama_produk'] ?>" class="img-thumbnail"></a>
                                                </td>
                                                <td class="text-left"><a href="product.html"><?= $value['nama_produk'] ?></a></td>
                                                <td class="text-right"><?= $value['jumlah'] ?></td>
                                                <td class="text-right">
                                                   <span class="price-new"><?= "Rp " . number_format($value['harga'] - ($value['harga'] * $value['diskon'] / 100), 0, ',', '.') ?></span>
                                                </td>
                                                <td class="text-right">
                                                   <s><?= "Rp " . number_format(($value['harga'] * $value['jumlah']),0,',','.') ?></s>
                                                </td>
                                                <td class="text-center">
                                                   <button data-toggle="tooltip" id="hapus_keranjangs" data-id="<?= $value['id_keranjang'] ?>" title="" class="btn btn-danger btn-xs" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                             </tr>
                                          <?php } ?>
                                       </tbody>
                                    </table>
                                    
                                 </li>
                                 <li>
                                    <div class="checkout clearfix">
                                       <a href="<?= base_url().'user/keranjang' ?>" class="btn btn-view-cart inverse">Lihat Semua Keranjang</a>
                                    </div>
                                 </li>
                              </ul>
                           <?php } ?>
                        </div>   
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- //Header Top -->
         <!-- Header center -->
         <div class="header-center">
            <div class="container">
               <div class="row">
                  <!-- Menuhome -->
                  <div class="col-lg-8 col-md-8 col-sm-1 col-xs-3 header-menu">
                     <div class="megamenu-style-dev megamenu-dev">
                        <div class="responsive">
                           <nav class="navbar-default">
                              <div class="container-megamenu horizontal">
                                 <div class="navbar-header">
                                    <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                       <span class="icon-bar"></span>
                                       <span class="icon-bar"></span>
                                       <span class="icon-bar"></span>
                                    </button>
                                 </div>
                                 <div class="megamenu-wrapper">
                                    <span id="remove-megamenu" class="fa fa-times"></span>
                                    <div class="megamenu-pattern">
                                       <div class="container">
                                          <ul class="megamenu">
                                             <li class="full-width menu">
                                                <a href="<?= base_url() ?>">HOME</a>
                                             </li>
                                             <li>
                                                <a href="<?= base_url('toko/semua') ?>">Daftar TOKO</a>
                                             </li>
                                             <li class="full-width menu">
                                                <a href="<?= base_url('produk/semua') ?>">Daftar Produk</a>
                                             </li>
                                             <?php
                                             $result = $CI->auth_user->current_user();
                                             if (empty($result)) {
                                                echo '<li class="full-width menu">
                                                <a href="' . base_url('login') . '">Login</a>
                                                </li><li class="full-width menu">
                                                <a href="'.base_url('auth/user/daftar').'">Daftar Sekarang</a>
                                                </li>';
                                             } else {
                                                ?>
                                                <li class="item-style1 content-full with-sub-menu hover">
                                                   <p class="close-menu"></p>
                                                   <a  class="clearfix">
                                                      <strong>
                                                         Akun Saya
                                                      </strong>
                                                      <span class="labelNew"></span>
                                                      <b class="caret"></b>
                                                   </a>
                                                   <div class="sub-menu" style="width: 100%; right: 0px;">
                                                      <div class="content">
                                                         <div class="border"></div>
                                                         <div class="row">
                                                            <div class="col-sm-6">
                                                               <div class="categories ">
                                                                  <div class="row">
                                                                     <div class="col-sm-12 static-menu">
                                                                        <div class="menu">
                                                                           <ul>
                                                                              <li>
                                                                                 <a href="#" class="main-menu">Personal</a>
                                                                                 <ul>
                                                                                    <li><a href="<?= base_url() ?>user/profil">Profil</a></li>
                                                                                    <li><a href="<?= base_url() ?>user/alamat">Daftar Alamat</a></li>
                                                                                    <li><a href="<?= base_url() ?>user/wishlist">Wishlist</a></li>
                                                                                    <li><a href="<?= base_url() ?>user/keranjang">Keranjang Belanja</a></li>
                                                                                    <li><a href="<?= base_url() ?>user/transaksi">Transaksi</a></li>
                                                                                 </ul>
                                                                              </li>
                                                                           </ul>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                               <div class="categories ">
                                                                  <div class="row">
                                                                     <div class="col-sm-12 static-menu">
                                                                        <div class="menu">
                                                                           <ul>
                                                                              <li>
                                                                                 <a href="#" class="main-menu">Toko</a>
                                                                                 <ul>
                                                                                    <li><a href="<?= base_url() ?>user/toko">Toko Saya</a></li>
                                                                                    <li><a href="<?= base_url() ?>user/toko/konfigurasi">Konfigurasi Toko Saya</a></li>
                                                                                    <li><a href="<?= base_url() ?>user/toko/produk">Produk</a></li>
                                                                                    <li><a href="<?= base_url() ?>user/toko/pesanan">Pesanan</a></li>
                                                                                 </ul>
                                                                              </li>
                                                                           </ul>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </li>
                                                <li>
                                                   <a href="<?= base_url('logout')?>">Logout</a>
                                                </li>
                                                <?php
                                             } ?>

                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </nav>
                        </div>
                     </div>
                  </div>
                  <!--Searchhome-->
                  <div class="col-lg-4 col-md-4 col-sm-11 col-xs-9 header-search">
                     <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                        <form method="GET" action="<?= base_url().'produk/cari' ?>">
                           <div id="search0" class="search input-group form-group">
                              <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Cari" name="query">

                              <span class="input-group-btn">
                                 <button type="submit" class="button-search btn btn-default btn-lg"><i class="fa fa-search"></i><span class="hidden">Search</span></button>
                              </span>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- //Header center -->
      </header>
      <div class="container" style="margin-top: 10px">
         <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <?php echo $this->session->flashdata('success'); ?>
            </div>
         <?php }else if($this->session->flashdata('error')){  ?>
            <div class="alert alert-error alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <?php echo $this->session->flashdata('error'); ?>
            </div>
         <?php }else if($this->session->flashdata('warning')){  ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <?php echo $this->session->flashdata('warning'); ?>
            </div>
         <?php }else if($this->session->flashdata('info')){  ?>
            <div class="alert alert-info alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <?php echo $this->session->flashdata('info'); ?>
            </div>
         <?php } ?>
      </div>
      <!-- //Header Container  -->