<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Akun</a></li>
		<li><a href="#">Daftar Alamat</a></li>
		<li><a href="#">Edit Alamat</a></li>
	</ul>

	

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Edit Alamat</h2>
			<form method="POST" action="<?= base_url() ?>user/alamat/edit">
				<?php foreach ($alamat as $key => $value) { ?>
					<div class="row">
						<div class="col-sm-12">
							<fieldset id="personal-details">
								<input type="hidden" name="id_alamat" value="<?= $value['id_alamat'] ?>">
								<legend>Edit Alamat</legend>
								<div class="form-group">
									<label for="input-alamatlengkap" class="control-label">Alamat Lengkap</label>
									<input type="text" class="form-control" id="input-alamatlengkap" placeholder="Alamat Lengkap" name="alamat" value="<?= $value['alamat']?>">
								</div>
							</fieldset>
							<br>
						</div>
					</div>

				<?php } ?>

				<div class="buttons clearfix">
					<div class="pull-right">
						<input type="submit" class="btn btn-md btn-primary" value="Simpan">
					</div>
				</div>
			</form>
		</div>
		<!--Middle Part End-->
		<!--Right Part Start -->
		