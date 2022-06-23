<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Akun</a></li>
      <li><a href="#">Toko</a></li>
      <li><a href="#">Saldo</a></li>
      <li><a href="#">Pengeluaran</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Daftar Pengeluaran Toko</h2>
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
                           ?>
                           <form method="POST" action="<?= base_url().'admin/saldo-toko/pengeluaran/konfirmasi' ?>">
                              <div class="col-md-7" style="margin-bottom: 5px;">
                                 <input type="hidden" name="id_withdraw" value="<?= $value['id_withdraw'] ?>">
                                 <select name="konfirmasi" class="form-control">
                                    <option disabled selected="true">Pilih</option>
                                    <option value="1">Konfirmasi Pembayaran</option>
                                    <option value="3">Tolak</option>
                                 </select>
                              </div>
                              <div class="col-md-5" style="margin-top: 5px;">
                                 <button type="submit" class="btn btn-primary">Konfirmasi</button>
                              </div>
                           </form>
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