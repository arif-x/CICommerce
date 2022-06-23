<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Admin</a></li>
      <li><a href="#">Transaksi</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Transaksi</h2>
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <thead>
               <tr>
                  <td class="text-center">Nama Produk</td>
                  <td class="text-center">Jumlah</td>
                  <td class="text-center">Total Bayar</td>
                  <td class="text-center">Bukti Bayar</td>
                  <td class="text-center">Status</td>
                  <td class="text-center">Aksi</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($transaksi as $key => $value) { ?>
                  <tr>
                     <td class="text-center">
                        <?= $value['nama_produk'] ?>
                     </td>
                     <td class="text-center">
                        <?= $value['jumlah'] ?>
                     </td>
                     <td class="text-center">
                        <?= $value['jumlah_dibayar'] ?>
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
                     <td class="text-center">
                        <?php if($value['status'] == 1){
                           echo "Belum Dibayar";
                        } elseif($value['status'] == 2){
                           echo "Pembayaran Butuh Dikonfirmasi";
                        } elseif($value['status'] == 3){
                           echo "Pembayaran Berhasil & Pesanan Akan Dikirim Penjual";
                        } elseif($value['status'] == 4){
                           echo "Pesanan Dikirim";
                        } elseif($value['status'] == 5){
                           echo "Pesanan Diterima";
                        } elseif($value['status'] == 6){
                           echo "Pesanan Sukses";
                        } elseif($value['status'] == 0){
                           echo "Pesanan Dibatalkan";
                        } elseif($value['status'] == 7){
                           echo "Pembayaran Ditolak";
                        } ?>
                     </td>
                     <td class="text-center">
                        <a href="<?= base_url() ?>admin/transaksi/konfirmasi/<?= $value['id_transaksi'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
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