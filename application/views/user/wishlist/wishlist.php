<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Akun</a></li>
      <li><a href="#">Wishlist</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Wish List Saya</h2>
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <thead>
               <tr>
                  <td class="text-center">Gambar</td>
                  <td class="text-left">Nama Produk</td>
                  <td class="text-right">Stok</td>
                  <td class="text-right">Harga Barang</td>
                  <td class="text-right">Aksi</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($wishlist as $key => $value) { ?>
                  <tr>
                     <td class="text-center">
                        <a href="<?= base_url() ?>produk/detail/<?= $value['slug'] ?>" class="with-img"><img src="<?= $value['gambar'] ?>" alt="<?= $value['nama_produk'] ?>" class="img-thumbnail"></a>
                     </td>
                     <td class="text-left"><a href="<?= base_url() ?>produk/detail/<?= $value['slug'] ?>"><?= $value['nama_produk'] ?></a></td>
                     <td class="text-right"><?= $value['stok'] ?></td>
                     <td class="text-right">
                        <div class="price">
                           <?php if($value['diskon'] >= 0.01){ ?>
                              <s><?= "Rp " . number_format($value['harga'],0,',','.') ?></s>
                              <br>
                              <b><?= "Rp " . number_format($value['harga'] - ($value['harga'] * $value['diskon'] / 100),0,',','.') ?></b>
                           <?php }else{ ?>
                              <b><?= "Rp " . number_format($value['harga'],0,',','.') ?></b>
                           <?php } ?>
                        </div>
                     </td>
                     <td class="text-right">
                        <!-- <a href="#" data-toggle="tooltip" title="" class="keranjang-button btn btn-primary" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></a> -->
                        <button class="btn-button keranjang-button btn btn-primary" data-toggle="tooltip" title="Tambah ke Keranjang" value="1" data-id="<?= $value['id_produk'] ?>"><i class="fa fa-shopping-cart"></i></button>

                        <a type="submit" href="<?= base_url() ?>user/wishlist/delete/<?= $value['id_wishlist'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>

         </table>
      </div>
      <div class="buttons clearfix">
         <div class="pull-right">
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
               .with-img img {
                  max-width: 60%;
                  height: auto;
               }
            </style>
         </div>
      </div>
   </div>
   <aside class="col-md-3 content-aside right_column sidebar-offcanvas">
      <span id="close-sidebar" class="fa fa-times"></span>
   </aside>