<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Akun</a></li>
      <li><a href="#">Toko</a></li>
      <li><a href="#">Saldo</a></li>
      <li><a href="#">Pemasukan</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Pemasukan Toko Saya</h2>
      <div class="row">
         <div class="col-md-6">
            <div class="text-left" style="margin-top: 10px;">
               <a href="<?= base_url().'user/toko/saldo/pengeluaran' ?>" type="button" class="btn btn-primary">Ke Menu Pengeluaran</a>
               <a href="<?= base_url().'user/toko/saldo/tarik/request' ?>" type="button" class="btn btn-primary">Tarik Saldo/Withdraw</a>
            </div>
         </div>
         <div class="col-md-6">
            <div class="text-right">
               <h3>Total Saldo: <?= "Rp " . number_format($jumlah_saldo,0,',','.') ?></h3>
            </div>
         </div>
      </div>
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <thead>
               <tr>
                  <td class="text-center">Detail Transaksi Pesanan</td>
                  <td class="text-center">Jumlah</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($saldo as $key => $value) { ?>
                  <tr>
                     <td class="text-center"><a href="<?= base_url().'user/toko/saldo/pemasukan/detail/'.$value['id_transaksi'] ?>">Lihat Detail</a></td>
                     <td class="text-center"><?= "Rp " . number_format($value['jumlah'],0,',','.') ?></td>
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
      <div>
         <h3>Tentang Saldo Toko</h3>
         <p>Saldo Toko didapat dari hasil penjualan yang sudah sukses, anda bisa menariknya ke rekening anda</p>
      </div>
   </div>
   <aside class="col-md-3 content-aside right_column sidebar-offcanvas">
      <span id="close-sidebar" class="fa fa-times"></span>
   </aside>