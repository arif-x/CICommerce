<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Admin</a></li>
		<li><a href="#">Kategori</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Kategori</h2>
			<p class="lead">Halo, <strong>Admin</strong> - Isi form mengedit kategori.</p>
			<form method="POST" action="<?= base_url() ?>admin/kategori/edit/execute">
				<div class="row">
					<?php foreach ($kategori as $key => $value) { ?>
					<div class="col-sm-12">
						<fieldset id="personal-details">
							<legend>Data Kategori</legend>
							<input type="hidden" name="id_kategori" value="<?= $value['id_kategori'] ?>">
							<div class="form-group">
								<label for="input-file" class="control-label">Kategori</label>
								<input type="text" class="form-control" value="<?= $value['kategori'] ?>" id="input-file" name="kategori">
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
		