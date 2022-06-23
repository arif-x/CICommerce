<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Admin</a></li>
		<li><a href="#">Slider</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Slider</h2>
			<p class="lead">Halo, <strong>Admin</strong> - Isi form untuk menambah slider.</p>
			<form method="POST" action="<?= base_url() ?>admin/slider/tambah/execute" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<legend>Data Slider</legend>
							<div class="form-group">
								<label for="input-file" class="control-label">Gambar Slider</label>
								<input type="file" class="form-control" id="input-file" name="slider">
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
		</div>
		<!--Middle Part End-->
		<!--Right Part Start -->
		