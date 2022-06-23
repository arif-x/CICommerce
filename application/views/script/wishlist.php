<script type="text/javascript">
	$('.wishlist-button').on('click', function(){
		<?php 
		$CI = &get_instance();
		$CI->load->model('auth/user_model', 'auth_user');
		$result = $CI->auth_user->current_user();
		if(!empty($result->id_user)){ ?>
			var data_id = $(this).data('id')
			$.ajax({
				url: "<?= base_url() ?>user/wishlist/store/"+$(this).data('id'),
				type: "POST",
				success: function () {
					$('.wishlist[data-id="'+data_id+'"]').toggleClass('wishlist-button wishlist-button-remove');
					$('.wishlist > i[data-id="'+data_id+'"]').toggleClass('fa fa-heart-o fa fa-heart');
				},
				error: function () {
					console.log('Error:', );
				}
			});
		<?php } elseif(empty($result->id_user)){ ?>
			window.location.href = "<?= base_url().'login' ?>";
		<?php } ?>
	});

	$('.wishlist-button-remove').on('click', function(){
		<?php 
		$CI = &get_instance();
		$CI->load->model('auth/user_model', 'auth_user');
		$result = $CI->auth_user->current_user();
		if(!empty($result->id_user)){ ?>
			var data_id = $(this).data('id')
			$.ajax({
				url: "<?= base_url() ?>user/wishlist/store/"+$(this).data('id'),
				type: "POST",
				success: function () {
					$('.wishlist[data-id="'+data_id+'"]').toggleClass('wishlist-button-remove wishlist-button');
					$('.wishlist > i[data-id="'+data_id+'"]').toggleClass('fa fa-heart fa fa-heart-o');
				},
				error: function () {
					console.log('Error:', );
				}
			});
		<?php } elseif(empty($result->id_user)){ ?>
			window.location.href = "<?= base_url().'login' ?>";
		<?php } ?>
	});
</script>