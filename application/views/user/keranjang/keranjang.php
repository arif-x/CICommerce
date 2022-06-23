<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Akun</a></li>
      <li><a href="#">Daftar Keranjang</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Keranjang Saya</h2>
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <thead>
               <tr>
                  <td class="text-center">Gambar</td>
                  <td class="text-left">Nama Produk</td>
                  <td class="text-right">Stok</td>
                  <td class="text-right">Harga Barang</td>
                  <td class="text-right">Jumlah</td>
                  <td class="text-right">Total Bayar</td>
                  <td class="text-right">Aksi</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($keranjang as $key => $value) { ?>
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
                     <td class="text-right"><?= $value['jumlah'] ?></td>
                     <td class="text-right">
                        <?php if($value['diskon'] >= 0.01){ ?>
                           <s><?= "Rp " . number_format(($value['harga'] * $value['jumlah']),0,',','.') ?></s>
                           <br>
                           <b><?= "Rp " . number_format((($value['harga'] - ($value['harga'] * $value['diskon'] / 100)) * $value['jumlah']),0,',','.') ?></b>
                        <?php }else{ ?>
                           <b><?= "Rp " . number_format(($value['harga'] * $value['jumlah']),0,',','.') ?></b>
                        <?php } ?>
                     </td>
                     <td class="text-center" style="width: 15%">
                        <div class="row">
                           <div class="col-md-6">
                              <a href="#" id="tambah_pesanan<?= $value['id_keranjang'] ?>" data-toggle="tooltip" title="" data-id="<?= $value['id_keranjang'] ?>" class="btn btn-primary" data-original-title="Pesan Sekarang"><i class="fa fa-plus"></i></a>
                              <script type="text/javascript">
                                 $(document).ready(function(){
                                    $('#tambah_pesanan<?= $value['id_keranjang'] ?>').on('click', function(){
                                       $.getJSON('<?= base_url() ?>user/keranjang/single/<?= $value['id_keranjang'] ?>', function (data) {
                                        $('#modal-headers').html("Pesan Sekarang");
                                        $('#myModal').modal('show');
                                        $('#formPesan').attr('action', '<?= base_url() ?>user/transaksi/store/<?= $value['id_keranjang'] ?>');
                                        $('#pesan').html('Pesan '+data.nama_produk);
                                     });
                                    });
                                 });
                              </script>
                           </div>
                           <div class="col-md-6">
                              <a type="submit" href="<?= base_url() ?>user/keranjang/delete/<?= $value['id_keranjang'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a>
                           </div>
                        </div>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>

         </table>
      </div>

      <div id="myModal" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 id="modal-headers" class="modal-title">Pesan Sekarang</h4>
               </div>
               <div class="modal-body">
                  <p id="pesan"></p>
                  <form id="formPesan" method="POST" action="">
                     <div class="form-group">
                        <label>Jumlah</label>
                        <input type=number name="jumlah" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Alamat</label>
                        <select name="alamat" class="form-control">
                           <option disabled selected="true">Pilih</option>
                           <?php foreach ($alamat as $key => $value) { ?>
                              <option value="<?= $value['alamat'] ?>"><?= $value['alamat'] ?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="text-left">
                        <button type="submit" class="btn btn-primary">Pesan</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
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