<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i></a></li>
      <li><a href="#">Admin</a></li>
      <li><a href="#">Kategori</a></li>
   </ul>

   <div id="content" class="col-sm-9">
      <h2>Kategori</h2>
      <a style="margin-bottom: 10px" type="button" href="<?= base_url() ?>admin/kategori/tambah" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <thead>
               <tr>
                  <td class="text-center">Kategori</td>
                  <td class="text-right">Aksi</td>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($kategori as $key => $value) { ?>
                  <tr>
                     <td class="text-center">
                        <?= $value['kategori'] ?>
                     </td>
                     <td class="text-right">
                        <a href="<?= base_url() ?>admin/kategori/edit/<?= $value['id_kategori'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a type="button" href="<?= base_url() ?>admin/kategori/hapus/<?= $value['id_kategori'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a>
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