<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Akun</a></li>
		<li><a href="#">Toko</a></li>
		<li><a href="#">Produk</a></li>
		<li><a href="#">Edit Produk</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Akun Saya</h2>
			<p class="lead">Halo, Isi form untuk mengedit produk.</p>
			<form method="POST" action="<?= base_url() ?>user/toko/produk/edit/execute" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<legend>Edit Produk</legend>
							<?php foreach ($produk as $key => $value) { ?>
								<input type="hidden" name="id_produk" value="<?= $value['id_produk'] ?>">
								<div class="form-group">
									<label for="input-namaproduk" class="control-label">Nama Produk</label>
									<input type="text" class="form-control" id="input-namaproduk" placeholder="Nama Produk" value="<?= $value['nama_produk'] ?>" name="nama_produk">
								</div>
								<div class="form-group">
									<label for="input-deskripsi" class="control-label">Kategori</label>
									<select class="form-control" name="kategori" id="kategori"></select>
								</div>
								<div class="form-group">
									<label for="input-deskripsi" class="control-label">Deskripsi</label>
									<input type="text" class="form-control" id="input-deskripsi" placeholder="Deskripsi" value="<?= $value['deskripsi'] ?>" name="deskripsi">
								</div>
								<div class="form-group">
									<label for="input-diskon" class="control-label">Diskon</label>
									<input type="number" class="form-control" id="input-diskon" placeholder="0" value="<?= $value['diskon'] ?>" name="diskon">
								</div>
								<div class="form-group">
									<label for="input-harga" class="control-label">Harga</label>
									<input type="number" class="form-control" id="input-harga" placeholder="0" value="<?= $value['harga'] ?>" name="harga">
								</div>
								<div class="form-group">
									<label for="input-gambar" class="control-label">Gambar</label>
									<input type="file" class="form-control" id="input-gambar" value="" name="gambar">
								</div>
								<div class="form-group">
									<label for="input-stok" class="control-label">Stok</label>
									<input type="number" class="form-control" id="input-stok" placeholder="0" value="<?= $value['stok'] ?>" name="stok">
								</div>
							<?php } ?>
						</fieldset>
						<br>
					</div>
				</div>

				<div class="buttons clearfix">
					<div class="pull-right">
						<input type="submit" class="btn btn-md btn-primary" value="Simpan">
					</div>
				</div>
			</form>
			<script type="text/javascript">
				<?php foreach ($produk as $key => $value) { ?>
					var id = <?= $value['id_produk'] ?>;
				<?php } ?>
				$(document).ready(function(){
					$.ajax({
						url : "<?= base_url().'user/toko/produk/get-kategori' ?>",
						method : "GET",
						async : true,
						dataType : 'json',
						success: function(data){
							
							var sub = '';
							var i;
							for(i=0; i<data.length; i++){
								sub += '<option value='+data[i].id_kategori+'>'+data[i].kategori+'</option>';
							}
							$('#kategori').html(sub);
							$.getJSON('<?= base_url().'user/toko/produk/single/json/' ?>' + id, function(data) {
								$("#kategori option[value='"+data[0]['id_kategori']+"']").prop('selected', true);
							});
						}
					});
				})
			</script>
		</div>
		<!--Middle Part End-->
		<!--Right Part Start -->
		