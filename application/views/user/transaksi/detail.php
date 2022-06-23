<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Akun</a></li>
      <li><a href="#">Transaksi</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Transaksi Saya</h2>
      <a type="button" class="btn btn-primary" style="margin-bottom: 10px" href="<?= base_url().'user/transaksi' ?>">Kembali</a>
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <thead>
               <tr class="text-center">
                  <td>Nama Produk</td>
                  <td>Resi</td>
                  <td>Dipesan Pada</td>
                  <td>Dibayar Pada</td>
                  <td>Bukti Bayar</td>
                  <td>Dikirim Pada</td>
                  <td>Diterima Pada</td>
                  <td>Selesai Pada</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($transaksi as $key => $value) { ?>
                  <tr class="text-center">
                     <td>
                        <?= $value['nama_produk'] ?>
                     </td>
                     <td>
                        <?php if(empty($value['resi'])){
                           echo "-";
                        } else {
                           echo $value['resi'];
                        } ?>
                     </td>
                     <td>
                        <?php if(empty($value['dipesan_pada'])){
                           echo "-";
                        } else {
                           echo $value['dipesan_pada'];
                        } ?>
                     </td>
                     <td>
                        <?php if(empty($value['dibayar_pada']) && $value['status'] == 1){
                           echo "-";
                        } elseif(!empty($value['dibayar_pada']) && $value['status'] == 7){
                           echo "Pembayaran Ditolak";
                        }else {
                           echo $value['dibayar_pada'];
                        } ?>
                     </td>
                     <td class="text-center">
                        <?php if(empty($value['dibayar_pada']) && $value['status'] == 1){
                           echo "Belum Dibayar";
                        } elseif($value['status'] == 7) {
                           echo "Pembayaran Ditolak Admin";
                        } elseif($value['status'] == 0) {
                           echo "Transaksi Dibatalkan";
                        }  else {
                           ?>
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Lihat</button>
                           <div id="myModal" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h4 class="modal-title">Bukti Bayar <?= $value['nama_produk'] ?></h4>
                                    </div>
                                    <div class="modal-body">
                                       <?= '<img src="'. $value['bukti_bayar'] .'">' ?>
                                    </div>
                                 </div>

                              </div>
                           </div>
                           <?php
                        } ?>
                     </td>
                     <td>
                        <?php if(empty($value['dikirim_pada'])){
                           echo "-";
                        } else {
                           echo $value['dikirim_pada'];
                        } ?>
                     </td>
                     <td>
                        <?php if(empty($value['diterima_pada'])){
                           echo "-";
                        } else {
                           echo $value['diterima_pada'];
                        } ?>
                     </td>
                     <td>
                        <?php if(empty($value['diterima_pada'])){
                           echo "-";
                        } else {
                           echo $value['diterima_pada'];
                        } ?>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>

         </table>
      </div>
   </div>
   <aside class="col-md-3 content-aside right_column sidebar-offcanvas">
      <span id="close-sidebar" class="fa fa-times"></span>
   </aside>