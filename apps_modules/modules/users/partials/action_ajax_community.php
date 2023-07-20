<script src="<?php echo theme_user_locations(). 'js/share.js'?>"></script>
<script>
	$('#modal_share').on('show.bs.modal', function (sender) {
		$postId = $(sender.relatedTarget).data('post-id');
		$check = $(sender.relatedTarget).data('check');
		$url = "<?php echo site_url('community/post/') ?>"+$postId;
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
	$('body').on('shown.bs.modal', '.modal-text', function() {

	});
    function textPost() {
        $("#textPost").modal("show");
    }

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
                                    '<a href="post/'+data[i].username+'"><span class="text-prussianblue fw-bold">'+data[i].fullname+'</span></a>'+
                                    '<span class="fs-14 text-pre-wrap text-break">'+data[i].data_description+'</span>'+
                                '</div>'+
                                $delete+
                            '</div>'+
                            '<div class="d-flex flex-row fs-12 align-text-center">'+
                                '<abbr title="'+DateTime.fromSQL(data[i].comment_created_at).toFormat("cccc, LLLL dd, yyyy 'at' t")+'" class="text-decoration-none"><span class="text-muted">'+DateTime.fromSQL(data[i].comment_created_at).toRelativeCalendar()+'</span></abbr>'+
                                '<button class="text-prussianblue ms-2 btn p-0 fs-12" type="button" id="" onclick="like('+data[i].comment_id+',this)" autocomplete="off" aria-pressed=""><span id="like_'+data[i].comment_id+'">'+res.like+'</span> Likes</button>'+
                                '<span class="text-prussianblue ms-2 p-0 fs-12">Reply</span>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                    $("#comment_" +data[i].relate_id).val('');
                    $('#show_comment_'+data[i].relate_id).append(html);
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
                                        '<a href="post/'+data[i].username+'"><span class="text-prussianblue fw-bold">'+data[i].fullname+'</span></a>'+
                                        '<span class="fs-14 text-pre-wrap text-break">'+data[i].data_description+'</span>'+
                                    '</div>'+
                                    $delete+
                                '</div>'+
                                '<div class="d-flex flex-row fs-12 align-items-center">'+
                                    '<abbr title="'+DateTime.fromSQL(data[i].comment_created_at).toFormat("cccc, LLLL dd, yyyy 'at' t")+'" class="text-decoration-none"><span class="text-muted">'+DateTime.fromSQL(data[i].comment_created_at).toRelativeCalendar()+'</span></abbr>'+
                                    '<button class="text-prussianblue ms-2 btn p-0 fs-12" type="button" id="" onclick="like('+data[i].comment_id+',this)" autocomplete="off" aria-pressed=""><span id="like_'+data[i].comment_id+'">0</span> Likes</button>'+
                                    '<span class="text-prussianblue ms-2">Reply</span>'+
                                '</div>'+
                            '</div>'+

                        '</div>';
                        $("#comment_" +data[i].id).val('');

                        $('#show_comment_'+data[i].relate_id).append(html);
                }
            }
        );
    }

    $(document).ready(function () {
        var post_id = $("#post_id").val();
        show_comment_all();
    });

    function textPostEdit(description, post_text_id) {
        document.getElementById("data_description").value = description;
        document.getElementById("post_text_id").value = post_text_id;
        $("#textPostEdit").modal("show");
    }

    function photoPost() {
        $("#photoPost").modal("show");
    }

    function postCommentAdd(id, sender){
        var comment = $("#comment_"+id).val();
        var post_id = $("#post_id").val();
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
                $(sender).children('#publisher').toggleClass('d-none');
                $(sender).children('#spinner-pub').toggleClass('d-none');
                $(sender).children('#spinner-load').toggleClass('d-none');
            },

        }).done(
            function (response) {
                // Update CSRF hash
                $(".txt_csrfname").val(response.token);
                $("#comment_field_"+id).toggleClass('d-none');
                show_comment(id);
                $(sender).prop('disabled', false);
                $(sender).children('#publisher').toggleClass('d-none');
                $(sender).children('#spinner-pub').toggleClass('d-none');
                $(sender).children('#spinner-load').toggleClass('d-none');

                bs5Utils.Toast.show({
                    type: 'indoconnex',
                    icon: `<span class="material-icons-round text-atlantis md-14 me-2">check_circle</span>`,
                    title: 'Success',
                    subtitle: 'now',
                    content: 'Your post was successfully posted.',
                    buttons: [

                    ],
                    delay: 5000,
                    dismissible: true
                });
            }
        ).fail( function (params) {
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
    function photoPostEdit(post_photo_id) {
        document.getElementById("post_photo_id").value = post_photo_id;
        $("#photoPostEdit").modal("show");
    }

    function videoPost(form) {
        $("#videoPost").modal("show");
    }

    function videoPostEdit(post_video_id) {
        document.getElementById("post_video_id").value = post_video_id;
        $("#videoPostEdit").modal("show");
    }

    function deletecommunity(id){
	    $('#community-id').val(id);
	    $('#deletecommunityModal').modal('show');
    }

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

        }).done(
            function (response) {
                // Update CSRF hash
                $(".txt_csrfname").val(response.token);
                $(".count_likes").val(response.likes);
                $("#like_" + id).html(response.likes);
                bs5Utils.Toast.show({
                    type: 'indoconnex',
                    icon: `<span class="material-icons-round text-atlantis md-14 me-2">check_circle</span>`,
                    title: 'Success',
                    subtitle: 'now',
                    content: 'Your post was successfully posted.',
                    buttons: [

                    ],
                    delay: 5000,
                    dismissible: true
                });
            }
        ).fail( function (params) {
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
        $comment = $('#'+post_id).find('.js-comment-field');
        $publisher = $('#'+post_id).find('.js-publisher');
        $publisher.prop('data-id', post_id);
        $publisher.click(function () {
            postCommentAdd(post_id, x);
        });
        $comment.toggleClass('d-none');
    }
    function follow(id){
        var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
        var csrfHash = $(".txt_csrfname").val(); // CSRF hash
        var user_id = "<?php echo $users->id ?>";
        $.ajax({
            url: "<?php echo site_url('community/follow');?>",
            type: "POST",
            data: { follow_id: id, [csrfName]: csrfHash },
            timeout: 5000,
            dataType: "JSON",
        }).done( function (response) {
            $(".txt_csrfname").val(response.token);
            if(response.act === 'active'){
                $('#btnConnect_'+id).addClass('active');
                $('#btnConnect_'+id).text('Leave Community');
            } else {
                $('#btnConnect_'+id).removeClass('active');
                $('#btnConnect_'+id).text('Join Community');
            }
            bs5Utils.Toast.show({
                type: 'indoconnex',
                icon: `<span class="material-icons-round text-atlantis md-14 me-2">check_circle</span>`,
                title: 'Success',
                subtitle: 'now',
                content: 'Your post was successfully posted.',
                buttons: [

                ],
                delay: 5000,
                dismissible: true
            });
        });
    }

    $('.abbrevNum2Str').each(function (index) {
        $value = $(this).prop('title');
        $num = new Intl.NumberFormat('en-US', {
            maximumFractionDigits: 1,
            notation: "compact" ,
            compactDisplay: "short"
            }).format($value);
        $(this).text($num);
    })
</script>
