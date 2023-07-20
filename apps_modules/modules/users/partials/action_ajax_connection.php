<script src="<?php echo theme_user_locations(). 'js/share.js'?>"></script>
<script>

var shareItems = document.querySelectorAll('.social_share')
JSShare.options.url = '<?php echo site_url('post/'.$this->session->userdata('username')) ?>'
for (var i = 0; i < shareItems.length; i += 1) {
    shareItems[i].addEventListener('click', function share(e) {
        return JSShare.go(this)
    })
}

function follow(id){
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	var user_id = "<?php echo $users->id ?>";
	$.ajax({
		url: "<?php echo site_url('connections/follow');?>",
		type: "POST",
		data: { follow_id: id, [csrfName]: csrfHash },
		timeout: 5000,
		dataType: "JSON",
	}).done( function (response) {
		$(".txt_csrfname").val(response.token);
		if(response.act === 'active'){
			$('#btnConnect_'+id).addClass('active');
			$('#btnConnect_'+id).text('Unfollow');
		} else {
			$('#btnConnect_'+id).removeClass('active');
			$('#btnConnect_'+id).text('Follow');
		}
		bs5Utils.Toast.show({
			type: 'indoconnex',
			icon: `<span class="material-icons-round text-atlantis md-14 me-2">check_circle</span>`,
			title: 'Success',
			subtitle: 'now',
			content: 'Your have successfully followed.',
			buttons: [

			],
			delay: 5000,
			dismissible: true
		});
	}).fail( function (params) {
		bs5Utils.Toast.show({
			type: 'indoconnex',
			icon: `<span class="material-icons-round text-orange md-14 me-2">cancel</span>`,
			title: 'Error',
			subtitle: 'now',
			content: 'Something went wrong! Please Try Again',
			buttons: [

			],
			delay: 5000,
			dismissible: true
		});
	});
}

function unfollow(id){
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	var user_id = "<?php echo $users->id ?>";
	$.ajax({
		url: "<?php echo site_url('connections/unfollow');?>",
		type: "POST",
		data: { follow_id: id, user_id: user_id, [csrfName]: csrfHash },
		timeout: 5000,
		dataType: "JSON",
	}).done(function (response) {
		$(".txt_csrfname").val(response.token);
		$('#hide_btn_where_'+id).show();
		$('#show_btn_where_'+id).hide();
		$('#show_btn_'+id).html(html);

		bs5Utils.Toast.show({
			type: 'indoconnex',
			icon: `<span class="material-icons-round text-atlantis md-14 me-2">check_circle</span>`,
			title: 'Success',
			subtitle: 'now',
			content: 'Your have successfully unfollowed.',
			buttons: [

			],
			delay: 5000,
			dismissible: true
		});
	}).fail( function (params) {
		bs5Utils.Toast.show({
			type: 'indoconnex',
			icon: `<span class="material-icons-round text-orange md-14 me-2">cancel</span>`,
			title: 'Error',
			subtitle: 'now',
			content: 'Something went wrong! Please Try Again',
			buttons: [

			],
			delay: 5000,
			dismissible: true
		});
	});
}

function showfollowing(){
	var user_id = "<?php echo $users->id ?>";
	$.ajax({
		type  : 'GET',
		url   : '<?php echo site_url('connections/show/following');?>',
		async : true,
		dataType : 'json',
	}).done(
		function(data){
			var html = '';
			var i;
			for(i=0; i<data.length; i++) {
				$filepath = data[i].file_path;
				$filename = data[i].file_name_original;
				html =
				'<div class="row mb-4 align-items-center row-cols-2"><div class="col">'+
					'<div class="d-flex align-items-center">'+
						'<div class="flex-shrink-0">'+
						'<img src="'+ data[i].file_path +"/"+ data[i].file_name_original+'" class="rounded-circle border work-experience-img" alt="">'+
						'</div>'+
						'<div class="flex-grow-1 ms-3 flex-column d-flex">'+
							'<a href="">'+
							'<span>'+ data[i].name_first +" "+ data[i].name_middle+" "+ data[i].name_last+'</span></a>'+

							'<span class="text-muted">'+ data[i].name_first +'</span>'+
						'</div>'+

						'<div class="flex-shrink-0 ps-auto text-right mx-2 align-items-center">'+
							'<button id="btnConnect" class="btn btn-sm btn-monik" data-bs-toggle="button" aria-pressed="" onclick="follow">Follow</button>'+
						'</div>'+
					'</div>'+
				'</div></div>';

				$('#showfollowing').append(html);
			}
		}
	);
}

function selectUserconnection(id){
	url = '<?php echo site_url();?>';
	if(id==1){
		window.location = url+"connections/list";
	}else{
		window.location = url+"connections/list_filter/"+ id;
	}
}

$('.btn-remove').click(function () {
	console.log($(this));
	console.log($(this).closest('.col'));

	$(this).closest('.col').remove();
});
</script>
