<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Akun</a></li>
		<li><a href="#">Toko</a></li>
		<li><a href="#">Pesanan</a></li>
		<li><a href="#">Konfirmasi</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Kirim Produk</h2>
			<p class="lead">Kirim resi untuk Pengiriman <strong></strong></p>
			<form method="POST" action="<?= base_url() ?>user/toko/pesanan/konfirmasi/execute" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<?php foreach ($resi as $key => $value) {
							?>
								<legend>Kirim Resi & Proses</legend>
								<input type="hidden" name="id_transaksi" value="<?= $value['id_transaksi'] ?>">
								<div class="form-group">
									<label for="input-resi" class="control-label">Resi</label>
									<input type="text" class="form-control" id="input-bukti" name="resi">
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