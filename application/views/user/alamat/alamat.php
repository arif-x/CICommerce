<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Akun</a></li>
      <li><a href="<?= base_url() ?>user/profil">Akun Saya</a></li>
      <li><a href="#">Daftar Alamat</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Daftar Alamat</h2>
      <div style="margin-bottom: 10px;">
         <a href="<?= base_url() ?>user/alamat/tambah" class="btn btn-primary">Tambah Alamat</a>
      </div>
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <thead>
               <tr>
                  <td class="text-left">Alamat</td>
                  <td class="text-left">Aksi</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($alamat as $key => $value) { ?>
                  <tr>
                     <td class="text-left" style="text-transform: capitalize;"><?= $value['alamat'] ?></td>
                     <td class="text-left">
                        <a type="button" href="<?= base_url() ?>user/alamat/edit/<?= $value['id_alamat'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a type="button" href="<?= base_url() ?>user/alamat/delete/<?= $value['id_alamat'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a>
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