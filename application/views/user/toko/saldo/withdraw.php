<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Akun</a></li>
      <li><a href="#">Toko</a></li>
      <li><a href="#">Saldo</a></li>
      <li><a href="#">Pengeluaran</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Pengeluaran Toko Saya</h2>
      <div class="row">
         <div class="col-md-6">
            <div class="text-left" style="margin-top: 10px;">
               <a href="<?= base_url().'user/toko/saldo/pemasukan' ?>" type="button" class="btn btn-primary">Ke Menu Pemasukan</a>
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
                  <td class="text-center">Ditarik Pada</td>
                  <td class="text-center">No. Rekening</td>
                  <td class="text-center">Jumlah</td>
                  <td class="text-center">Status</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($withdraw as $key => $value) { ?>
                  <tr>
                     <td class="text-center"><?= $value['withdraw_pada'] ?></td>
                     <td class="text-center"><?= $value['no_rek'] ?></td>
                     <td class="text-center"><?= "Rp " . number_format($value['jumlah'],0,',','.') ?></td>
                     <td class="text-center">
                        <?php if($value['status'] == 0){
                           echo "Withdraw sedang diperiksa dan akan segera dikirim <br>Atau<br>";
                           ?>
                           <a href="<?= base_url().'user/toko/saldo/tarik/batal/'.$value['id_withdraw'] ?>" type="button" class="btn btn-primary">Batalkan</a>
                           <?php   
                        } elseif($value['status'] == 1){
                           echo "Withdraw sukses";  
                        } elseif($value['status'] == 2){
                           echo "Withdraw dibatalkan";  
                        } elseif($value['status'] == 3){
                           echo "Withdraw ditolak";  
                        }
                        ?>
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