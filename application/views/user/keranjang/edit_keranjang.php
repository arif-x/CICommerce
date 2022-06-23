<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Akun</a></li>
		<li><a href="#">Daftar Keranjang</a></li>
		<li><a href="#">Edit Keranjang</a></li>
	</ul>

	

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-md-9" id="content">
			<h2 class="title">Edit Keranjang</h2>
			<form method="POST" action="<?= base_url() ?>user/keranjang/edit-keranjang">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td class="text-center">Gambar</td>
							<td class="text-left">Nama Produk</td>
							<td class="text-left">Jumlah</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($keranjang as $key => $value) { ?>
							<tr>
								<td class="text-center">
									<a href="<?= base_url() ?>produk/detail/<?= $value['slug'] ?>" class="with-img"><img src="<?= $value['gambar'] ?>" alt="<?= $value['nama_produk'] ?>" class="img-thumbnail"></a>
								</td>
								<td><?= $value['nama_produk'] ?></td>
								<td>
									<div class="row">
										<div class="col-sm-12">
											<fieldset id="personal-details">
												<input type="hidden" name="id_keranjang" value="<?= $value['id_keranjang'] ?>">
												<div class="form-group">
													<input type="number" class="form-control" id="input-jumlah" placeholder="jumlah " name="jumlah" value="<?= $value['jumlah']?>">
												</div>
												<div class="buttons clearfix">
													<div class="">
														<input type="submit" class="btn btn-md btn-primary" value="Simpan">
													</div>
												</div>
											</fieldset>
											<br>
										</div>
									</div>

								</td>
							</tr>
						<?php } ?>
						
					</tbody>

				</table>
			</form>
		</div>
		<!--Middle Part End-->
		<!--Right Part Start -->
		