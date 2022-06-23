<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Akun</a></li>
		<li><a href="#">Transaksi</a></li>
		<li><a href="#">Bayar</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Bayar</h2>
			<p class="lead">Kirim bukti bayar untuk pembayaran <strong><?= $title ?></strong></p>
			<form method="POST" action="<?= base_url() ?>user/transaksi/bayar" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<?php foreach ($transaksi as $key => $value) {
							?>
								<legend>Jumlah Harus Dibayar: <?= "Rp " . number_format(($value['jumlah_dibayar']),0,',','.') ?></legend>
								<input type="hidden" name="id_transaksi" value="<?= $value['id_transaksi'] ?>">
								<div class="form-group">
									<label for="input-bukti" class="control-label">Bukti Bayar</label>
									<input type="file" class="form-control" id="input-bukti" name="bukti_bayar">
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
		<!--Middle Part End-->
		<!--Right Part Start -->