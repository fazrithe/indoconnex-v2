<script src="<?php echo theme_user_locations(). 'js/share.js'?>"></script>
<script>
	$('#modal_share').on('show.bs.modal', function (sender) {
		$postId = $(sender.relatedTarget).data('post-id');
        $check = $(sender.relatedTarget).data('check');
		if($check == 'profile'){
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
		$('#copyUrl').click(function (params) {
			$(this).siblings('input#share-url').select();
    		document.execCommand("copy");
			$(this).siblings('input#share-url').attr('title', "Link Copied");
			$(this).siblings('input#share-url').tooltip('show');
		})
	});
</script>
<script>
$(document).ready(function(){
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash

    $.ajax({
        type  : 'GET',
        url   : '<?php echo site_url('api/business');?>',
        async : true,
        dataType : 'json',
    }).done(
        function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
            html +=
                '<div class="col-12 col-xs-6 col-md-4" >'+
                '<div class="card border-1">'+
                '<img src="" class="card-img-top fit-cover" width="280" height="150" id="product-feed" alt="Business Directory">'+
                '<div class="card-body">'+
                '<h5 class="card-title fw-bold"><a class="link-primary" href=""><span class="material-icons mx-2 text-verified align-middle">check_circle</span>'+
                '</a></h5>'+
                '<h6 class="card-subtitle mb-2 text-muted">'+
                '<small class="text-muted">@ssss</small>'+
                '</h6>'+
                '<div class="justify-content-center">'+
                '<span class="badge bg-light text-black mt-2 rounded-3 fw-normal"></span>'+
                '</div>'+
                '<div class="d-flex justify-content-center  my-2 text-black">'+
                '<div class="d-flex mt-2 mx-2 align-items-center bordered">'+
                '<span class="material-icons md-16 me-2 text-black">business</span>'+
                '<small>sss</small>'+
                '</div>'+
                '<div  class="vl mt-2"></div>'+
                '<div class="d-flex mx-2 mt-2 align-items-center">'+
                '<span class="material-icons md-16 me-2 text-black">location_on </span>'+
                '<small></small>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>';

            $('#listdatabusiness').html(html);
            }
        }
    );
    $('#inputMaps').on('change', function (params) {
        html = $('#inputMaps').val();

        if(typeof html !== 'undefined' && html !== false && html !== '' && html !== null) {
            if(html.substring(0,37) !== 'https://www.google.com/maps/embed?pb=') {
            var maps = $(html).attr('src');
                // For some browsers, `attr` is undefined; for others,
                // `attr` is false.  Check for both.
                if (typeof maps !== 'undefined' && maps !== false) {
                    $('#inputMaps').val(maps);
                }
            }
        }

    })

    $('#business-type').select2({
		placeholder: 'Business Type',
        allowClear: true
	});

    $('#business-categories').select2({
		placeholder: 'business-categories',
        allowClear: true
	});

	$('#sub-business-categories').select2({
		placeholder: 'Sub Business Category',
        allowClear: true
	});

    $('#business-location').select2({
		placeholder: 'Business Location',
        allowClear: true
	});

    $('#article-category').select2({
		placeholder: 'Article Category',
        allowClear: true
	});
});
</script>
