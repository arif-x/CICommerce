<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Akun</a></li>
		<li><a href="#">Toko</a></li>
		<li><a href="#">Saldo</a></li>
		<li><a href="#">Withdraw</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Akun Saya</h2>
			<p class="lead">Halo, Isi form untuk melakukan withdraw.</p>
			<form method="POST" action="<?= base_url() ?>user/toko/saldo/tarik/request/execute" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<legend>Ajukan Withdraw/Penarikan</legend>
							<legend>Jumlah Saldo: <?= "Rp " . number_format($saldo,0,',','.') ?></legend>
								<div class="form-group">
									<label for="input-jumlah" class="control-label">Jumlah</label>
									<input type="text" class="form-control" id="input-jumlah" placeholder="Jumlah" value="" name="jumlah">
								</div>
								<div class="form-group">
									<label for="input-no_rek" class="control-label">No. Rekening</label>
									<input type="text" class="form-control" id="input-no_rek" placeholder="No. Rekening" value="" name="no_rek">
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
		