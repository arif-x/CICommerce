<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Akun</a></li>
      <li><a href="#">Toko</a></li>
      <li><a href="#">Produk</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Daftar Produk</h2>
      <div style="margin-bottom: 10px;">
         <a href="<?= base_url() ?>user/toko/produk/tambah" class="btn btn-primary">Tambah Produk</a>
      </div>
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <thead>
               <tr>
                  <td class="text-center">Nama Produk</td>
                  <td class="text-center">Kategori</td>
                  <td class="text-center">Deskripsi</td>
                  <td class="text-center">Diskon</td>
                  <td class="text-center">Harga</td>
                  <td class="text-center">Gambar</td>
                  <td class="text-center">Stok</td>
                  <td class="text-center">Aksi</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($produk as $key => $value) { ?>
                  <tr>
                     <td class="text-center" style="text-transform: capitalize;"><?= $value['nama_produk'] ?></td>
                     <td class="text-center" style="text-transform: capitalize;"><?= $value['nama_kategori'] ?></td>
                     <td class="text-center" style="text-transform: capitalize;"><?= $value['deskripsi'] ?></td>
                     <td class="text-center" style="text-transform: capitalize;"><?= $value['diskon'] ?>%</td>
                     <td class="text-center" style="text-transform: capitalize;">
                        <?php if($value['diskon'] >= 0.01){ ?>
                           <s><?= "Rp " . number_format($value['harga'],0,',','.') ?></s>
                           <br>
                           <b><?= "Rp " . number_format($value['harga'] - ($value['harga'] * $value['diskon'] / 100),0,',','.') ?></b>
                        <?php }else{ ?>
                           <b><?= "Rp " . number_format($value['harga'],0,',','.') ?></b>
                        <?php } ?>
                     </td>
                     <td class="text-center" style="text-transform: capitalize;"><img src="<?= $value['gambar'] ?>" alt="$value['nama_produk']"></td>
                     <td class="text-center" style="text-transform: capitalize;"><?= $value['stok'] ?></td>
                     <td class="text-center">
                        <a type="button" href="<?= base_url() ?>user/toko/produk/edit/<?= $value['id_produk'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a type="button" href="<?= base_url() ?>user/toko/produk/delete/<?= $value['id_produk'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a>
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