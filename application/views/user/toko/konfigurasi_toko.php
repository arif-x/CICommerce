<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Akun</a></li>
		<li><a href="#">Toko Saya</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Toko Saya</h2>
			<p class="lead">Halo, <strong><?= $title ?></strong> - Untuk mengubah informasi toko anda.</p>
			<form method="POST" action="<?= base_url() ?>user/toko/edit" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<?php foreach ($toko as $key => $value) {
								?>
								<legend>Informasi Toko</legend>
								<div class="form-group">
									<label for="input-namalengkap" class="control-label">Nama Toko</label>
									<input type="text" class="form-control" id="input-nama_toko" placeholder="Nama Toko" value="<?= $value['nama_toko'] ?>" name="nama_toko">
								</div>
								<div class="form-group">
									<label for="input-tanggallahir" class="control-label">Deskripsi</label>
									<input type="text" class="form-control" id="input-deskripsi" placeholder="Deskripsi" value="<?= $value['deskripsi'] ?>" name="deskripsi">
								</div>
								<div class="form-group">
									<label for="input-alamat-lengkap" class="control-label">Alamat Lengkap</label>
									<input type="text" class="form-control" id="input-alamat-lengkap" placeholder="Alamat Lengkap" value="<?= $value['alamat'] ?>" name="alamat">
								</div>
								<div class="form-group">
									<label for="input-no-hp" class="control-label">No. HP</label>
									<input type="number" class="form-control" id="input-no-hp" placeholder="Nomor HP" value="<?= $value['no_hp'] ?>" name="no_hp">
								</div>
								<div class="form-group">
									<label for="input-foto" class="control-label">Foto</label>
									<input type="file" class="form-control" id="input-foto" placeholder="Foto" value="<?= $value['foto'] ?>" name="foto">
								</div>
								<div class="form-group">
									<label for="input-alamat-lengkap" class="control-label">Banner</label>
									<input type="file" class="form-control" id="input-banner" placeholder="Banner" value="<?= $value['banner'] ?>" name="banner">
								</div>
								<?php
							}
							?>
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

			<hr>
			<div class="col-md-12">
				<h2>Zona Merah</h2>
				<h4>Ingin menonaktifkan semua data toko?</h4>
				<form method="POST" action="<?= base_url() ?>user/toko/set-aktivasi">
					<div class="row">
						<div class="col-sm-12">
							<fieldset id="personal-details">
								<?php foreach ($toko as $key => $value) {
									?>
									<legend>Aktivasi Toko</legend>
									<div class="form-group">
										<label>Status Aktif</label>
										<select class="form-control" name="aktivasi">
											<option disabled selected="true">Pilih</option>
											<option value="1">Aktif</option>
											<option value="0">Nonaktif</option>
										</select>
									</div>
									<?php
								}
								?>
							</fieldset>
							<br>
						</div>
						<div class="buttons clearfix">
							<div class="pull-right">
								<input type="submit" class="btn btn-md btn-primary" value="Simpan">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!--Middle Part End-->
		<!--Right Part Start -->