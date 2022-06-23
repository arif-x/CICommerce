<div id="modalKeranjang" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="m-title"></h4>
			</div>
			<div class="modal-body">
				<p id="pesan"></p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#btn-masuk').on('click', function(){
		<?php 
		$CI = &get_instance();
		$CI->load->model('auth/user_model', 'auth_user');
		$result = $CI->auth_user->current_user();
		if(!empty($result->id_user)){ ?>
			$.ajax({
				url: "<?= base_url() ?>user/keranjang/store/"+$(this).data('id')+"/1",
				type: "POST",
				success: function (message) {
					messages = JSON.parse(message);
					$('#m-title').text(messages.info);
					$('#pesan').text(messages.message);
					$('#modalKeranjang').modal('show');
					$.ajax({
						url: "<?= base_url() ?>user/keranjang/ajax",
						success: function (data) {
							datas = JSON.parse(data);
							$('#tabel-keranjang tbody').empty();
							$('.items_cart').html(datas.length);
							for (var i = 0; i < datas.length; i++) {
								var row = '';
								if(datas[i].diskon >= 0.01){
									harga = datas[i].harga - (datas[i].harga * datas[i].diskon /100);
								} else {
									harga = datas[i].harga;
								}
								row = '<tr><td class="text-center size-img-cart">'+
								'<a href="<?= base_url() ?>produk/detail/'+datas[i].slug+'">'+
								'<img src="'+datas[i].gambar+'" '+
								'title="'+datas[i].nama_produk+'" class="img-thumbnail"></a></td>'+
								'<td class="text-left"><a href="<?= base_url() ?>produk/detail/'+datas[i].slug+'">'+datas[i].nama_produk+'</a></td>'+
								'<td class="text-right">'+datas[i].jumlah+'</td>'+
								'<td class="text-right"><span class="price-new">'+ harga +'</span>'+
								'<td class="text-center"><button onclick="deleteFunction('+datas[i].id_keranjang+')" data-toggle="tooltip" id="hapus_keranjangs" data-id="'+datas[i].id_keranjang+'"'+ 
								'title="" class="btn btn-danger btn-xs hh" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button></td>'+
								'</tr>';
								$('#tabel-keranjang tbody').html(row);
							}
						},
						error: function(error) {
							console.log(error);
						}
					});
				},
				error: function () {
					window.location.href = "<?= base_url().'login' ?>";
				}				
			});
		<?php } elseif(empty($result->id_user)){ ?>
			window.location.href = "<?= base_url().'login' ?>";
		<?php } ?>
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		<?php 
		$CI = &get_instance();
		$CI->load->model('auth/user_model', 'auth_user');
		$result = $CI->auth_user->current_user();
		if(!empty($result->id_user)){ ?>
			$.ajax({
				url: "<?= base_url() ?>user/keranjang/ajax",
				success: function (data) {
					datas = JSON.parse(data);
					$('#tabel-keranjang tbody').empty();
					$('.items_cart').html(datas.length);
					for (var i = 0; i < datas.length; i++) {
						var row = '';
						if(datas[i].diskon >= 0.01){
							harga = datas[i].harga - (datas[i].harga * datas[i].diskon /100);
						} else {
							harga = datas[i].harga;
						}
						row = '<tr><td class="text-center size-img-cart">'+
						'<a href="<?= base_url() ?>produk/detail/'+datas[i].slug+'">'+
						'<img src="'+datas[i].gambar+'" '+
						'title="'+datas[i].nama_produk+'" class="img-thumbnail"></a></td>'+
						'<td class="text-left"><a href="<?= base_url() ?>produk/detail/'+datas[i].slug+'">'+datas[i].nama_produk+'</a></td>'+
						'<td class="text-right">'+datas[i].jumlah+'</td>'+
						'<td class="text-right"><span class="price-new">'+ harga +'</span>'+
						'<td class="text-center"><button onclick="deleteFunction('+datas[i].id_keranjang+')" data-toggle="tooltip" id="hapus_keranjangs" data-id="'+datas[i].id_keranjang+'"'+ 
						'title="" class="btn btn-danger btn-xs hh" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button></td>'+
						'</tr>';
						$('#tabel-keranjang tbody').html(row);
					}
				},
				error: function(error) {
					console.log(error);
				}
			});
		<?php } elseif(empty($result->id_user)){ ?>
			// window.location.href = "<?= base_url().'login' ?>";
		<?php } ?>
	})
</script>

<script type="text/javascript">
	function deleteFunction(id) {
		<?php 
		$CI = &get_instance();
		$CI->load->model('auth/user_model', 'auth_user');
		$result = $CI->auth_user->current_user();
		if(!empty($result->id_user)){ ?>
			$.ajax({
				url: "<?= base_url() ?>user/keranjang/delete-ajax/"+id,
				success: function (data) {
					$.ajax({
						url: "<?= base_url() ?>user/keranjang/ajax",
						success: function (data) {
							datas = JSON.parse(data);
							$('#tabel-keranjang tbody').empty();
							$('.items_cart').html(datas.length);
							for (var i = 0; i < datas.length; i++) {
								var row = '';
								if(datas[i].diskon >= 0.01){
									harga = datas[i].harga - (datas[i].harga * datas[i].diskon /100);
								} else {
									harga = datas[i].harga;
								}
								row = '<tr><td class="text-center size-img-cart">'+
								'<a href="<?= base_url() ?>produk/detail/'+datas[i].slug+'">'+
								'<img src="'+datas[i].gambar+'" '+
								'title="'+datas[i].nama_produk+'" class="img-thumbnail"></a></td>'+
								'<td class="text-left"><a href="<?= base_url() ?>produk/detail/'+datas[i].slug+'">'+datas[i].nama_produk+'</a></td>'+
								'<td class="text-right">'+datas[i].jumlah+'</td>'+
								'<td class="text-right"><span class="price-new">'+ harga +'</span>'+
								'<td class="text-center"><button onclick="deleteFunction('+datas[i].id_keranjang+')" data-toggle="tooltip" id="hapus_keranjangs" data-id="'+datas[i].id_keranjang+'"'+ 
								'title="" class="btn btn-danger btn-xs hh" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button></td>'+
								'</tr>';
								$('#tabel-keranjang tbody').html(row);
							}
						},
						error: function(error) {
							console.log(error);
						}
					});
				},
				error: function(error){

				}
			});
		<?php } elseif(empty($result->id_user)){ ?>
			window.location.href = "<?= base_url().'login' ?>";
		<?php } ?>
	}
</script>