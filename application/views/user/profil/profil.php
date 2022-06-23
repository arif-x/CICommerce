<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Akun</a></li>
		<li><a href="#">Akun Saya</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Akun Saya</h2>
			<p class="lead">Halo, <strong><?php foreach ($profil as $key => $value) { echo ($value['nama_lengkap']); }?></strong> - Untuk mengubah informasi akun anda.</p>
			<form method="POST" action="<?= base_url() ?>user/profil/edit">
				<div class="row">
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<?php foreach ($profil as $key => $value) {
								?> 
								<legend>Informasi Pribadi</legend>
								<div class="form-group">
									<label for="input-namalengkap" class="control-label">Nama Lengkap</label>
									<input type="text" class="form-control" id="input-namalengkap" placeholder="Nama Lengkap" value="<?= $value['nama_lengkap'] ?>" name="nama_lengkap">
								</div>
								<div class="form-group">
									<label for="input-email" class="control-label">E-Mail</label>
									<input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="<?= $value['email'] ?>" name="email" disabled>
								</div>
								<div class="form-group">
									<label for="input-tanggallahir" class="control-label">Tanggal Lahir</label>
									<input type="date" class="form-control" id="input-tanggallahir" placeholder="Tanggal Lahir" value="<?= $value['tanggal_lahir'] ?>" name="tanggal_lahir">
								</div>
								<div class="form-group">
									<label for="input-notelepon" class="control-label">Nomor Telepon</label>
									<input type="number" class="form-control" id="input-notelepon" placeholder="Nomor Telepon" value="<?= $value['no_telp'] ?>" name="no_telp">
								</div>
								<div class="form-group">
									<label for="input-alamat-lengkap" class="control-label">Alamat Lengkap</label>
									<input type="text" class="form-control" id="input-alamat-lengkap" placeholder="Alamat Lengkap" value="<?= $value['alamat_lengkap'] ?>" name="alamat_lengkap">
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
		</div>

		<hr>
		<div class="col-md-9">
			<h2>Password</h2>
			<h4>Ingin mengubah password?</h4>
			<form method="POST" action="<?= base_url() ?>user/password/change">
				<div class="row">
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<legend>Ubah Password</legend>
							<div class="form-group">
								<label>Password Lama</label>
								<input type="password" class="form-control" name="old_password">
							</div>
							<div class="form-group">
								<label>Password Baru</label>
								<input type="password" class="form-control" name="password_reset">
							</div>
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
		<!--Middle Part End-->
		<!--Right Part Start -->
		