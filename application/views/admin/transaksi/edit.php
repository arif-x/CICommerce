<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Admin</a></li>
		<li><a href="#">Konfirmasi Pembayaran</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Konfirmasi Pembayaran</h2>
			<p class="lead">Halo, <strong>Admin</strong> - Isi form mengedit transaksi.</p>
			<form method="POST" action="<?= base_url() ?>admin/transaksi/konfirmasi">
				<div class="row">
					<?php foreach ($transaksi as $key => $value) { ?>
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<legend>Data Konfirmasi Pembayaran</legend>
							<input type="hidden" name="id_transaksi" value="<?= $value['id_transaksi'] ?>">
							<div class="form-group">
								<label for="input-file" class="control-label">Konfirmasi Pembayaran</label>
								<select class="form-control" name="konfirmasi">
									<option selected="true" disabled="disabled">Pilih</option>
									<option value="3">Konfirmasi</option>
									<option value="7">Tolak</option>
								</select>
							</div>
						</fieldset>
						<br>
					</div>
					<?php } ?>
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
		