<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Akun</a></li>
      <li><a href="#">Transaksi</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Transaksi Saya</h2>
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <thead>
               <tr>
                  <td class="text-center">Gambar</td>
                  <td class="text-left">Nama Produk</td>
                  <td class="text-center">Harga Barang</td>
                  <td class="text-center">Jumlah</td>
                  <td class="text-center">Total Bayar</td>
                  <td class="text-center">Status</td>
                  <td class="text-center">Bukti Bayar</td>
                  <td class="text-center">Detail</td>
                  <td class="text-center">Aksi</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($transaksi as $key => $value) { ?>
                  <tr>
                     <td class="text-center">
                        <a href="<?= base_url() ?>produk/detail/<?= $value['slug'] ?>" class="with-img"><img src="<?= $value['gambar'] ?>" alt="<?= $value['nama_produk'] ?>" class="img-thumbnail"></a>
                     </td>
                     <td class="text-left"><a href="<?= base_url() ?>produk/detail/<?= $value['slug'] ?>"><?= $value['nama_produk'] ?></a></td>
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
                     <td class="text-right"><?= $value['jumlah'] ?></td>
                     <td class="text-right">
                        <?= "Rp " . number_format(($value['jumlah_dibayar']),0,',','.') ?>
                     </td>
                     <td class="text-center">
                        <?php if($value['status'] == 1){
                           echo "Belum Dibayar";
                        } elseif($value['status'] == 2){
                           echo "Pembayaran Diproses";
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
                     <td class="text-center"><a href="<?= base_url().'user/transaksi/detail/'.$value['id_transaksi'] ?>">Lihat Detail</a></td>
                     <td style="width: 20%" class="text-center">
                        <div class="row">
                           <?php if($value['status'] == 1){ ?>
                              <div class="col-md-6">
                                 <a href="<?= base_url() ?>user/transaksi/bayar-sekarang/<?= $value['id_transaksi'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Bayar"><i class="fa fa-money"></i></a>
                              </div>
                              <div class="col-md-6">
                                 <a type="submit" href="<?= base_url() ?>user/transaksi/batalkan-transaksi/<?= $value['id_transaksi'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a>
                              </div>
                           <?php } elseif($value['status'] >= 2 && $value['status'] < 3){ ?>
                              Transaksi dalam Proses
                           <?php } elseif($value['status'] == 4){ ?>
                              <a href="<?= base_url() ?>user/transaksi/terima/<?= $value['id_transaksi'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Terima"><i class="fa fa-get-pocket"></i></a>
                           <?php } elseif($value['status'] == 5){ ?>
                              Transaksi Selesai
                           <?php } elseif($value['status'] == 6){ ?>
                              Transaksi Selesai
                           <?php } elseif($value['status'] == 7){ ?>
                              <div class="col-md-6">
                                 <a href="<?= base_url() ?>user/transaksi/bayar-sekarang/<?= $value['id_transaksi'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Bayar Kembali"><i class="fa fa-money"></i></a>
                              </div>
                              <div class="col-md-6">
                                 <a type="submit" href="<?= base_url() ?>user/transaksi/batalkan-transaksi/<?= $value['id_transaksi'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a>
                              </div>
                           <?php } elseif($value['status'] == 0){ ?>
                              Transaksi Dibatalkan
                           <?php } ?>
                        </div>
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