<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Akun</a></li>
		<li><a href="#">Toko</a></li>
		<li><a href="#">Produk</a></li>
		<li><a href="#">Tambah Produk</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Akun Saya</h2>
			<p class="lead">Halo, Isi form untuk menambah produk.</p>
			<form method="POST" action="<?= base_url() ?>user/toko/produk/tambah/execute" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<legend>Tambah Produk</legend>
							<div class="form-group">
								<label for="input-namaproduk" class="control-label">Nama Produk</label>
								<input type="text" class="form-control" id="input-namaproduk" placeholder="Nama Produk" value="" name="nama_produk">
							</div>
							<div class="form-group">
								<label for="input-deskripsi" class="control-label">Kategori</label>
								<select class="form-control" name="kategori" id="kategori"></select>
							</div>
							<div class="form-group">
								<label for="input-deskripsi" class="control-label">Deskripsi</label>
								<input type="text" class="form-control" id="input-deskripsi" placeholder="Deskripsi" value="" name="deskripsi">
							</div>
							<div class="form-group">
								<label for="input-diskon" class="control-label">Diskon</label>
								<input type="number" class="form-control" id="input-diskon" placeholder="0" value="" name="diskon">
							</div>
							<div class="form-group">
								<label for="input-harga" class="control-label">Harga</label>
								<input type="number" class="form-control" id="input-harga" placeholder="0" value="" name="harga">
							</div>
							<div class="form-group">
								<label for="input-gambar" class="control-label">Gambar</label>
								<input type="file" class="form-control" id="input-gambar" value="" name="gambar">
							</div>
							<div class="form-group">
								<label for="input-stok" class="control-label">Stok</label>
								<input type="number" class="form-control" id="input-stok" placeholder="0" value="" name="stok">
							</div>
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
				$(document).ready(function(){
					$.ajax({
						url : "<?= base_url().'user/toko/produk/get-kategori' ?>",
						method : "GET",
						async : true,
						dataType : 'json',
						success: function(data){
							$('select[name="kategori"]').empty();
							var sub = '';
							var i;
							sub = '<option diabled selected="true" value="">Pilih</option>';
							for(i=0; i<data.length; i++){
								sub += '<option value='+data[i].id_kategori+'>'+data[i].kategori+'</option>';
							}
							$('#kategori').html(sub);
						}
					});
				})
			</script>
		</div>
		<!--Middle Part End-->
		<!--Right Part Start -->
		