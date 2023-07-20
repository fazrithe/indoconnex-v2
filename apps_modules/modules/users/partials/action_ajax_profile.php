<script src="<?php echo theme_user_locations(). 'js/share.js'?>"></script>
<script>
	$('#modal_share').on('show.bs.modal', function (sender) {
		$postId = $(sender.relatedTarget).data('post-id');
		$check = $(sender.relatedTarget).data('check');
		if($check == 'profile'){
			$url = "<?php echo site_url('post/') ?>"+$postId;
		}else if($check == 'profile_business'){
			$url = "<?php echo site_url('business/post/') ?>"+$postId;
		}else{
			$url = "<?php echo site_url('sharing/') ?>"+$postId;
		}
		$('#share_li').attr('data-url', $url);
		$('#share_fb').attr('data-url', $url);
		$('#share_wa').attr('data-url', $url);
		$('#share_tw').attr('data-url', $url);
		$('#share-url').val($url);

		var shareItems = document.querySelectorAll('.social_share');
		for (var i = 0; i < shareItems.length; i += 1) {
			shareItems[i].addEventListener('click', function share(e) {
				return JSShare.go(this);
			});
		}
		const cpy = new ClipboardJS('#copyUrl', {
			// container: document.getElementById('modal_share');
		});
		cpy.on('success', function(e) {
			$('#copyUrl').attr('title', "Copied");
			$('#copyUrl').tooltip('show');
			e.clearSelection();
		});

	});
</script>
<script>
	$('#textPostEdit').on('shown.bs.modal', function(sender) {
		var business_id = $("#business_id").val();
		var business_username = $("#business_username").val();
		$postId = $(sender.relatedTarget).data('post-id');
		$desc = $('#'+$postId).find('.js-postlink');
		document.getElementById("business_username_post_edit").value = business_username;
		document.getElementById("business_id_post_edit").value = business_id;

		document.getElementById("name_form_edit").value = $(sender.relatedTarget).data('from');
		document.getElementById("data_description").value = $($desc).text();
		document.getElementById("post_text_id").value = $(sender.relatedTarget).data('post-id');
	});
	function textPost(form) {
		document.getElementById("name_form").value = form;
		var business_id = $("#business_id").val();
		document.getElementById("business_id_post").value = business_id;
		var business_username = $("#business_username").val();
		document.getElementById("business_username_post").value = business_username;
		$("#textPost").modal("show");
	}

	function photoPost(form) {
		var business_id = $("#business_id").val();
		var business_username = $("#business_username").val();
		document.getElementById("business_id_photo").value = business_id;
		document.getElementById("business_username_photo").value = business_username;
		document.getElementById("name_form_photo").value = form;
		$("#photoPost").modal("show");
	}

	$('#photoPostEdit').on('shown.bs.modal', function(sender) {
		var business_id = $("#business_id").val();
		var business_username = $("#business_username").val();
		$postId = $(sender.relatedTarget).data('post-id');
		$desc = $('#'+$postId).find('.js-postlink');
		document.getElementById("business_id_photo_edit").value = business_id;
		document.getElementById("business_username_photo_edit").value = business_username;
		document.getElementById("name_form_photo_edit").value = $(sender.relatedTarget).data('from');
		document.getElementById("data_photo_description").value = $($desc).text();
		document.getElementById("post_photo_id").value = $(sender.relatedTarget).data('post-id');
	});

	function videoPost(form) {
		var business_id = $("#business_id").val();
		var business_username = $("#business_username").val();
		document.getElementById("business_id_video").value = business_id;
		document.getElementById("business_username_video").value = business_username;
		document.getElementById("name_form_video").value = form;
		$("#videoPost").modal("show");
	}

	$('#videoPostEdit').on('shown.bs.modal', function(sender) {
		var business_id = $("#business_id").val();
		var business_username = $("#business_username").val();
		$postId = $(sender.relatedTarget).data('post-id');
		$desc = $('#'+$postId).find('.js-postlink');
		document.getElementById("business_id_video_edit").value = business_id;
		document.getElementById("business_username_video_edit").value = business_username;
		document.getElementById("name_form_video_edit").value = $(sender.relatedTarget).data('from');
		document.getElementById("data_video_description").value = $($desc).text();
		document.getElementById("post_video_id").value = $(sender.relatedTarget).data('post-id');
		// document.getElementById("video-edit-url").value =
	});

function like(id, x) {
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	var user_id = "<?php echo $users->id ?>";
	$.ajax({
		url: "<?php echo site_url('user/profile/post_like');?>",
		type: "POST",
		data: { id: id, user_id: user_id, [csrfName]: csrfHash },
		timeout: 5000,
		dataType: "JSON",

	}).done(function (response) {
		// Update CSRF hash
		$(".txt_csrfname").val(response.token);
		$(".count_likes").val(response.likes);
		$("#like_" + id).html(response.likes);
		bs5Utils.Toast.show({
			type: 'indoconnex',
			icon: `<span class="material-icons-round text-atlantis md-14 me-2">check_circle</span>`,
			title: 'Success',
			subtitle: 'now',
			content: 'Your have successfully liked.',
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

function comment(post_id, x) {
	//alert('hit1');
	//alert(post_id);
	$comment_show = $('#'+post_id).find('.js-comment-field-show');
	//console.log($comment_show)
	$comment = $('#'+post_id).find('.js-comment-field');
	//console.log($comment)
	$publisher = $('#'+post_id).find('.js-publisher');
	$publisher.prop('data-id', post_id);
	$publisher.click(function () {
		postCommentAdd(post_id, x);
	});
	show_comment(post_id);
	$comment.toggleClass('d-none');
	$comment_show.toggleClass('d-none');
}

function comment2(post_id, user_id, x) {
	//alert('hit2');
	$comment_show = $('#'+post_id+user_id).find('.js-comment-field-show');
	$comment = $('#'+post_id+user_id).find('.js-comment-field');
	$publisher = $('#'+post_id+user_id).find('.js-publisher');
	$publisher.prop('data-id', post_id);
	$publisher.click(function () {
		postCommentAdd2(post_id, user_id, x);
	});
	show_comment2(post_id, user_id);
	$comment.toggleClass('d-none');
	$comment_show.toggleClass('d-none');
}

function reply(comment_id, x) {
	$comment = $('#the_comment_'+comment_id).closest('.comments').parent().find('.js-comment-field');
	$publisher = $('#the_comment_'+comment_id).closest('.comments').parent().find('.js-publisher');
	$publisher.prop('data-id', comment_id);

	$publisher.click(function () {
		postCommentAdd(comment_id, x, $comment.attr('data-postId'));
	});
	$comment.toggleClass('d-none');
}

function postCommentAdd(id, sender, box_id = null){
	//alert('postCommentAdd')
	//alert(id)
	var comment = $("#comment_"+id).val();
	//console.log(comment);
	if(box_id) {
		comment = $("#comment_"+box_id).val();
	}
	if(comment){
		var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
		var csrfHash = $(".txt_csrfname").val(); // CSRF hash
		var user_id = "<?php echo $users->id ?>";
		$.ajax({
			url: "<?php echo site_url('user/profile/post_comment');?>",
			type: "POST",
			data: { post_id: id, user_id: user_id, comment: comment, [csrfName]: csrfHash },
			timeout: 5000,
			dataType: "JSON",
			beforeSend: function (params) {
				$(sender).prop('disabled', true);
				$(sender).children('.js-publisher-stats').toggleClass('d-none');
				$(sender).children('.js-spinner-pub').toggleClass('d-none');
				$(sender).children('.js-spinner-load').toggleClass('d-none');
			},
		}).done(
			function (response) {
				// Update CSRF hash
				$(".txt_csrfname").val(response.token);
				$("#comment_field_"+id).toggleClass('d-none');
				show_comment(id);
				$(sender).prop('disabled', false);
				$(sender).children('.js-publisher-stats').toggleClass('d-none');
				$(sender).children('.js-spinner-pub').toggleClass('d-none');
				$(sender).children('.js-spinner-load').toggleClass('d-none');
			}
		);
	}
}

function postCommentAdd2(id, user_id2, sender, box_id = null){
	//alert('postCommentAdd2');
	var comment = $("#comment_relate_"+id).val();
	//alert(comment)
	if(box_id) {
		comment = $("#comment_"+box_id).val();
	}
	if(comment){
		var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
		var csrfHash = $(".txt_csrfname").val(); // CSRF hash
		var user_id = "<?php echo $users->id ?>";
		$.ajax({
			url: "<?php echo site_url('user/profile/post_comment');?>",
			type: "POST",
			data: { post_id: id, user_id: user_id, comment: comment, [csrfName]: csrfHash },
			timeout: 5000,
			dataType: "JSON",
			beforeSend: function (params) {
				$(sender).prop('disabled', true);
				$(sender).children('.js-publisher-stats').toggleClass('d-none');
				$(sender).children('.js-spinner-pub').toggleClass('d-none');
				$(sender).children('.js-spinner-load').toggleClass('d-none');
			},
		}).done(
			function (response) {
				// Update CSRF hash
				$(".txt_csrfname").val(response.token);
				$("#comment_field_"+id+user_id2).toggleClass('d-none');
				show_comment2(id, user_id2);
				$(sender).prop('disabled', false);
				$(sender).children('.js-publisher-stats').toggleClass('d-none');
				$(sender).children('.js-spinner-pub').toggleClass('d-none');
				$(sender).children('.js-spinner-load').toggleClass('d-none');
			}
		);
	}
}

$(document).ready(function () {
	var post_id = $("#post_id").val();
	show_comment_all();
	$('.js-postlink').each(function (params) {
		$(this).html(PostLink.link($(this).text()));
	})
});

function show_comment(id){
	var user_id = "<?php echo $users->id ?>";
	var site = "<?php echo site_url();?>";
	$.ajax({
		type  : 'GET',
		url   : '<?php echo site_url('user/profile/show_comment');?>/'+id,
		async : true,
		dataType : 'json',

	}).done( function(res){
		data = res.data;
		var html = '';
		var i;
		$('#show_comment_'+id).empty();

		for(i=0; i<data.length; i++){
			if(data[i].relate_id == id) {
			$proflimage = '<img src="public/themes/user/images/placehold/user-1x1.png" class="rounded-circle feed-user-img" alt="">';

			if(data[i].file_name_original){
				$proflimage = '<img src="'+ site +""+ data[i].file_path +"/"+ data[i].file_name_original+'" class="rounded-circle feed-user-img" alt="">';
			}
			$delete = '';
			if (user_id === data[i].users_id) {
				$delete = 	'<div class="dropdown ms-3 d-flex align-items-center">'+
								'<a type="button" id="btn_delete_comment_'+data[i].comment_id+'" role="button" data-bs-toggle="dropdown"'+
									'aria-expanded="false">'+
									'<span class="text-muted material-icons">more_horiz</span>'+
								'</a>'+
								'<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="btn_delete_comment_'+data[i].comment_id+'">'+
									'<li>'+
									'<a class="dropdown-item" data-bs-toggle="modal"'+
									'data-bs-target="#modal_del_comment"'+ 'href="#" data-bs-comment-id="'+data[i].comment_id+'">Delete</a>'+
									'</li>'+
								'</ul>'+
							'</div>';
			};
			html =
				'<div class="row d-flex align-items-start" id="the_comment_'+data[i].comment_id+'">'+
					'<div class="w-auto">'+
					$proflimage+
					'</div>'+
					'<div class="ms-3 w-auto mb-2 max-comment">'+
						'<div class="d-flex flex-row">'+
							'<div class="bg-light px-2 py-1 rounded-3 mb-1 vstack">'+
								'<a href="'+ site +"post/"+ data[i].username+'"><span class="text-prussianblue fw-bold">'+data[i].fullname+'</span></a>'+
								'<div class="fs-14 text-pre-wrap text-break js-comment-desc">'+data[i].data_description+'</div>'+
							'</div>'+
							$delete+
						'</div>'+
						'<div class="d-flex flex-row fs-12 align-items-center pe-5">'+
							'<abbr title="'+DateTime.fromSQL(data[i].comment_created_at).toFormat("cccc, LLLL dd, yyyy 'at' t")+'" class="text-decoration-none"><span class="text-muted">'+DateTime.fromSQL(data[i].comment_created_at).toRelativeCalendar()+'</span></abbr>'+
							'<button class="text-prussianblue ms-2 btn p-0 fs-12" type="button" onclick="like('+data[i].comment_id+',this)" autocomplete="off" aria-pressed=""><span id="like_'+data[i].comment_id+'">'+res.like+'</span> Likes</button>'+
							'<button class="text-prussianblue ms-2 btn p-0 fs-12 pe-5" type="button" onclick="reply('+data[i].comment_id+',this)" autocomplete="off" >Reply</button>'+
						'</div>'+
					'</div>'+
				'</div>';
				$("#comment_" +data[i].relate_id).val('');
				$('#show_comment_'+data[i].relate_id).append(html);
				// $('#show_comment_'+data[i].relate_id).find('.js-comment-desc').text(data[i].data_description);
			}
		}
	});
}
function show_comment2(id, userId){
	var user_id = "<?php echo $users->id ?>";
	var site = "<?php echo site_url();?>";
	$.ajax({
		type  : 'GET',
		url   : '<?php echo site_url('user/profile/show_comment');?>/'+id,
		async : true,
		dataType : 'json',

	}).done( function(res){
		data = res.data;
		var html = '';
		var i;
		$('#show_comment_'+id+userId).empty();

		for(i=0; i<data.length; i++){
			if(data[i].relate_id == id) {
			$proflimage = '<img src="public/themes/user/images/placehold/user-1x1.png" class="rounded-circle feed-user-img" alt="">';

			if(data[i].file_name_original){
				$proflimage = '<img src="'+ site +""+ data[i].file_path +"/"+ data[i].file_name_original+'" class="rounded-circle feed-user-img" alt="">';
			}
			$delete = '';
			if (user_id === data[i].users_id) {
				$delete = 	'<div class="dropdown ms-3 d-flex align-items-center">'+
								'<a type="button" id="btn_delete_comment_'+data[i].comment_id+'" role="button" data-bs-toggle="dropdown"'+
									'aria-expanded="false">'+
									'<span class="text-muted material-icons">more_horiz</span>'+
								'</a>'+
								'<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="btn_delete_comment_'+data[i].comment_id+'">'+
									'<li>'+
									'<a class="dropdown-item" data-bs-toggle="modal"'+
									'data-bs-target="#modal_del_comment"'+ 'href="#" data-bs-comment-id="'+data[i].comment_id+'">Delete</a>'+
									'</li>'+
								'</ul>'+
							'</div>';
			};
			html =
				'<div class="row d-flex align-items-start" id="the_comment_'+data[i].comment_id+'">'+
					'<div class="w-auto">'+
					$proflimage+
					'</div>'+
					'<div class="ms-3 w-auto mb-2 max-comment">'+
						'<div class="d-flex flex-row">'+
							'<div class="bg-light px-2 py-1 rounded-3 mb-1 vstack">'+
								'<a href="'+ site +"post/"+ data[i].username+'"><span class="text-prussianblue fw-bold">'+data[i].fullname+'</span></a>'+
								'<div class="fs-14 text-pre-wrap text-break js-comment-desc">'+data[i].data_description+'</div>'+
							'</div>'+
							$delete+
						'</div>'+
						'<div class="d-flex flex-row fs-12 align-items-center pe-5">'+
							'<abbr title="'+DateTime.fromSQL(data[i].comment_created_at).toFormat("cccc, LLLL dd, yyyy 'at' t")+'" class="text-decoration-none"><span class="text-muted">'+DateTime.fromSQL(data[i].comment_created_at).toRelativeCalendar()+'</span></abbr>'+
							'<button class="text-prussianblue ms-2 btn p-0 fs-12" type="button" onclick="like('+data[i].comment_id+',this)" autocomplete="off" aria-pressed=""><span id="like_'+data[i].comment_id+'">'+res.like+'</span> Likes</button>'+
							'<button class="text-prussianblue ms-2 btn p-0 fs-12 pe-5" type="button" onclick="reply('+data[i].comment_id+',this)" autocomplete="off" >Reply</button>'+
						'</div>'+
					'</div>'+
				'</div>';
				$("#comment_" +data[i].relate_id+userId).val('');
				$('#show_comment_'+data[i].relate_id+userId).append(html);
				// $('#show_comment_'+data[i].relate_id).find('.js-comment-desc').text(data[i].data_description);
			}
		}
	});
}

function show_comment_all(){
	var user_id = "<?php echo $users->id ?>";
	var site = "<?php echo site_url();?>";
	$.ajax({
		type  : 'GET',
		url   : '<?php echo site_url('user/profile/show_comment_all');?>',
		async : true,
		dataType : 'json',
	}).done(
		function(data){
			var html = '';
			var i;
			for(i=0; i<data.length; i++) {
				$proflimage = '<img src="<?php echo base_url('public/themes/user/images/placehold/user-1x1.png') ?>" class="rounded-circle feed-user-img" alt="">';
				if(data[i].file_name_original){
					$proflimage = '<img src="'+ site +""+ data[i].file_path +""+ data[i].file_name_original+'" class="rounded-circle feed-user-img" alt="">';
				}
				$delete = '';
				if (user_id === data[i].users_id) {
				$delete = 	'<div class="dropdown ms-3 d-flex align-items-center">'+
								'<a type="button" id="btn_delete_comment_'+data[i].comment_id+'" role="button" data-bs-toggle="dropdown"'+
									'aria-expanded="false">'+
									'<span class="text-muted material-icons">more_horiz</span>'+
								'</a>'+
								'<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="btn_delete_comment_'+data[i].comment_id+'">'+
									'<li>'+
									'<a class="dropdown-item" data-bs-toggle="modal"'+
									'data-bs-target="#modal_del_comment"'+ 'href="#" data-bs-comment-id="'+data[i].comment_id+'">Delete</a>'+
									'</li>'+
								'</ul>'+
							'</div>';
				};
				html =
					'<div class="row d-flex align-items-start" id="the_comment_'+data[i].comment_id+'">'+
						'<div class="w-auto">'+
						$proflimage+
						'</div>'+
						'<div class="ms-3 w-auto mb-2 max-comment">'+
							'<div class="d-flex flex-row">'+
								'<div class="bg-light px-2 py-1 rounded-3 mb-1 vstack">'+
									'<a href="'+ site +"post/"+data[i].username+'"><span class="text-prussianblue fw-bold">'+data[i].fullname+'</span></a>'+
									'<div class="fs-14 text-pre-wrap text-break js-comment-desc">'+data[i].data_description+'</div>'+
								'</div>'+
								$delete+
							'</div>'+
							'<div class="d-flex flex-row fs-12 align-items-center pe-5">'+
								'<abbr title="'+DateTime.fromSQL(data[i].comment_created_at).toFormat("cccc, LLLL dd, yyyy 'at' t")+'" class="text-decoration-none"><span class="text-muted">'+DateTime.fromSQL(data[i].comment_created_at).toRelativeCalendar()+'</span></abbr>'+
								'<button class="text-prussianblue ms-2 btn p-0 fs-12 ms-auto" type="button" id="" onclick="like('+data[i].comment_id+',this)" autocomplete="off" aria-pressed=""><span id="like_'+data[i].comment_id+'">0</span> Likes</button>'+
								'<button class="text-prussianblue ms-2 btn p-0 fs-12 pe-5" type="button" onclick="reply('+data[i].comment_id+',this)" autocomplete="off" >Reply</button>'+
							'</div>'+
						'</div>'+

					'</div>';
					$("#comment_" +data[i].id).val('');
					$('#show_comment_'+data[i].relate_id).append(html);
					// $('#show_comment_'+data[i].relate_id).find('.js-comment-desc').text(data[i].data_description);

			}
		}
	);
}

$('#modal_del_comment').on('shown.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget;
  // Extract info from data-bs-* attributes;
  var recipient = button.getAttribute('data-bs-comment-id');
  $('#del_comment_id').val(recipient);
})

$('#form_delete_comment').click(function () {
	$form = $('#form_del_comment')[0];
	$id = $($form).children('#del_comment_id').val();
	$.ajax({
		type  : 'POST',
		url   : '<?php echo site_url('user/profile/delete_comment');?>/'+$id,
		data  : $($form).serialize(),
		async : true,
	}).done(function(data){
		$('#the_comment_'+$id).empty();
		$('#modal_del_comment').modal('toggle');

		bs5Utils.Toast.show({
			type: 'indoconnex',
			icon: `<span class="material-icons-round text-atlantis md-14 me-2">check_circle</span>`,
			title: 'Success',
			subtitle: 'now',
			content: 'Comment has been Deleted.',
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
});

$('.album.d-none').each(function( index ) {
	$albumCount = $( this ).data('album-count');
	if($albumCount < 4) {
		$( this ).toggleClass('d-none');
	}
})

function password(){
	var old_pass = $("#old_pass").val();
	var new_pass = $("#new_pass").val();
	var confirm_pass = $("#confirm_pass").val();
	var user_id = $("#user_id").val();
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	if(new_pass == confirm_pass){
		var user_id = "<?php echo $users->id ?>";
		$.ajax({
			url: "<?php echo site_url('user/setting/security/update');?>",
			type: "POST",
			data: { user_id: user_id, new_pass: new_pass, old_pass: old_pass, [csrfName]: csrfHash },
			timeout: 5000,
			dataType: "JSON",
		}).done(
			function (response) {
				// Update CSRF hash
				$(".txt_csrfname").val(response.token);
				var html = '';
				html +=
					''+
					'<span class="text-success" style="color:grey">Success</span>';
					$('#pass_success').html(html);
			}
		);
	}else{
		var html = '';
				html +=
					''+
					'<span class="text-success" style="color:red">Pasword no match</span>';
					$('#pass_error').html(html);
	}
}

$(document).ready(function(){
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	var country  = $("#selCountry_edit").val();
	$("#selCountry").select2({
		theme: "bootstrap5",
		ajax: {
			url: '<?php echo site_url('api/country');?>',
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
					[csrfName]: csrfHash
				};
			},
			processResults: function (response) {
				$(".txt_csrfname").val(response.token);
				$("#selCountry-id").val(response.token);
				return {
					results: response.response
				};
			},
			cache: true
		}
	});

	$('#selCountry').on('select2:select', function (){
		country_id = $("#selCountry").val();
		$("#selState").prop('disabled', false);

		$("#selState").select2({
			theme: "bootstrap5",
			ajax: {
				url: '<?php echo site_url('api/state/');?>' + country_id,
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term,
						[csrfName]: csrfHash
					};
				},
				processResults: function(response) {
					$(".txt_csrfname").val(response.token);
					return {
						results: response.response
					};
				},
				cache: true
			}
		});
	});

	$('#selState').on('select2:select', function (){
		state_id = $("#selState").val();
		$("#selCity").prop('disabled', false);
		$("#selCity").select2({
			theme: "bootstrap5",
			ajax: {
				url: '<?php echo site_url('api/city/');?>' + state_id,
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term,
						[csrfName]: csrfHash
					};
				},
				processResults: function(response) {
					$(".txt_csrfname").val(response.token);
					return {
						results: response.response
					};
				},
				cache: true
			}
		});
	});

	$('.js-businessSelector').select2({
		templateResult: businessFormat,
		templateSelection: businessFormat,
		dropdownAutoWidth: true,
		width: '100%',
		theme: "business",
		placeholder: 'Search'
	});

	function businessFormat(option){
		if (!option.id) {
			return option.text;
		}
		var optimage = $(option.element).data('image');
		if(!optimage){
			return option.text;
		} else {
			var $option = $(
				'<span><img src="' + optimage + '" width="23px" class="me-auto img-circle" /> ' + option.text + '</span>'
			);
		return $option;
		}
	}
	$("#selCountry_edit").select2({
	ajax: {
		url: '<?php echo site_url('api/country');?>',
		type: "post",
		dataType: 'json',
		delay: 250,
		data: function (params) {
			return {
			searchTerm: params.term, // search term
			[csrfName]: csrfHash
			};
		},
		processResults: function (response) {
			$(".txt_csrfname").val(response.token);
			$("#selCountry").val(response.response);
			if(response.country_id){
				selCountry(response.country_id);
			}else{
				selCountry(country);
			}

			return {
			results: response.response
			};
		},
		cache: true
	}
	});
});

function manage(id){
	url = '<?php echo site_url();?>';
	window.location = url+"business/manage/setting/"+ id;
}

function selectUser(id){
	user_id = $("#id").val();
	if(id == 1){
		document.getElementById('select_user_id').value = user_id;
		document.getElementById('select_business_id').value = '';
	}else{
		document.getElementById('select_business_id').value = id;
		document.getElementById('select_user_id').value = '';
	}
}

function selectUserList(id){
	$.ajax({
		type  : 'GET',
		url   : '<?php echo site_url('articles/show');?>/'+id,
		async : true,
		dataType : 'json',
	}).done(
		function(data){
			var html = '';
			var i;
			for(i=0; i<data.length; i++){
				document.getElementById("panel").style.display = "none";
				html +=
				'<div class="row">'+
					'<div class="col-3">'+
						'<img src="<?php echo base_url()?>'+data[i].file_path+data[i].file_name_original+'" class="mg-fluid img-thumbnail" alt="User Image">'+
					'</div>'+
					'<div class="col-7">'+
						'<a href="#" class="">'+data[i].data_name+'</a><br>'+
						'<span class="fs-8 text-black"><b>Market</b></span> <span class="fs-8">'+data[i].created_at+'</span>'+
					'<div class="row">'+
						'<div class="col-9">'+data[i].data_name+
						'</div>'+
					'</div>'+
					'</div>'+
					'<div>'+
						'<a href="<?php echo site_url('articles/edit/'.$this->session->userdata('user_id').'/') ?>'+data[i].id+'" class="btn btn-sm btn-danger text-white"> <span class="material-icons text-white">edit</span></a>'+
						' <a href="#"  data-bs-toggle="modal" data-bs-target="#del_article'+data[i].id+'" class="btn btn-sm btn-danger text-white"><span class="material-icons text-white">delete</span></a>'+
					'</div>'+
				'</div>'+
				'<hr>';
			}
			$("#show").html(html);
		}
	);
}


$(document).ready(function() {
	$(  ".input-text" ).on({
		keydown: function(event) {
		if (event.which === 32)
		return false;
		},
		change: function() {
		this.value = this.value.replace(/\s/g, "");
		}
	});

	$('#current1').click(function (params) {
		if($(this).is(':checked')){
			$('#datepicker2').prop('disabled', true);
		} else {
			$('#datepicker2').prop('disabled', false);
		}
	});
	$('#current2').click(function (params) {
		if($(this).is(':checked')){
			$('#datepicker6').prop('disabled', true);
		} else {
			$('#datepicker6').prop('disabled', false);
		}
	});
	$('#current3').click(function (params) {
		if($(this).is(':checked')){
			$('#datepicker4').prop('disabled', true);
		} else {
			$('#datepicker4').prop('disabled', false);
		}
	});
	$('#current4').click(function (params) {
		if($(this).is(':checked')){
			$('#datepicker8').prop('disabled', true);
		} else {
			$('#datepicker8').prop('disabled', false);
		}
	});
});


function getkey(e)
{
	if (window.event)
	return window.event.keyCode;
	else if (e)
	return e.which;
	else
	return null;
}
function angkadanhuruf(e, goods, field)
{
	var angka, karakterangka;
	angka = getkey(e);
	if (angka == null) return true;

	karakterangka = String.fromCharCode(angka);
	karakterangka = karakterangka.toLowerCase();
	goods = goods.toLowerCase();

	// check goodkeys
	if (goods.indexOf(karakterangka) != -1)
		return true;
	// control angka
	if ( angka==null || angka==0 || angka==8 || angka==9 || angka==27 )
	return true;

	if (angka == 13) {
		var i;
		for (i = 0; i < field.form.elements.length; i++)
			if (field == field.form.elements[i])
				break;
		i = (i + 1) % field.form.elements.length;
		field.form.elements[i].focus();
		return false;
		};
	// else return false
	return false;
}

function selectUserArticle(id){
	url = '<?php echo site_url();?>';
	if(id==1){
		window.location = url+"articles/list";
	}else{
		window.location = url+"articles/list_filter/"+ id;
	}
}

function myFunction() {
  var x = document.getElementById("skills").value;
  document.getElementById("skills_").innerHTML = x;
}

</script>

