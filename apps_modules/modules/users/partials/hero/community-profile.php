<!-- HEADER -->
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<div class="container mb-4">
    <div class="px-4 rounded-3 bg-white">
        <div class="position-relative hero-profile">
			<?php
			$cover =  base_url() . 'public/themes/user/images/placehold/business-21x9.png';
			if(!empty($community->cover_file_name_original)){
				$cover = base_url().$community->cover_file_path . $community->cover_file_name_original;
			}
			?>
            <img src="<?php echo $cover ?>"
                class="w-100 mx-auto d-block img-fluid rounded-3 mb-4 border border-5 border-white cover-profile"
                alt="">
            <?php if(!empty($checkusers_profile)){
            ?>
            <button type="button"
                class="btn btn-light d-none d-md-block position-absolute bottom-0 end-0 border border-5 border-white m-4"
                data-bs-toggle="modal" data-bs-target="#editcoverphotoModal">
                <span class="material-icons md-24 me-2 align-middle">photo_camera</span>
                Edit Cover Photo
            </button>
            <?php } ?>
            <button type="button"
                class="btn btn-light d-md-none position-absolute bottom-0 end-0 border border-5 border-white m-4 badge rounded-circle p-2"
                data-bs-toggle="modal" data-bs-target="#editcoverphotoModal">
                <span class="material-icons md-24 align-middle">photo_camera</span>
            </button>

            <!-- Modal Edit Cover Photo -->
            <div class="modal fade" id="editcoverphotoModal" tabindex="-1" aria-labelledby="editcoverphotoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editcoverphotoModalLabel">Edit Cover Photo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="form-action" class="form-horizontal" method="post" action="<?php echo current_url(); ?>" role="form" enctype="multipart/form-data">
                        <div class="modal-body row">
                                <?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
                                <input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
                                <input type="hidden" id="community_id" name="community_id" value="<?php echo $community->id ?>"/>
                                <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
								<div class="cover-preview col"></div>
                                <input type="hidden" name="form" value="cover"/>
                            <div class="mb-3 col">
                                <label for="formFile" class="form-label">Upload from your
                                    computer</label>
                                <input class="form-control" type="file" id="inputFile" name="__cover_files[]" accept="image/*" onchange="processCover(this)" data-title="Drag and drop a file">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                            <button id="btnCoverUpload" type="button" class="btn btn-danger">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-4 d-flex justify-content-center">
                <div class="position-relative hero-details">
                	<?php
						$profile = base_url().'public/themes/user/images/placehold/business-1x1.png';
						if (!empty($community->file_name_original)) {
							$profile = base_url().$community->file_path . $community->file_name_original;
						}
					?>
					<img src="<?php echo $profile?>" class="rounded display-profile" alt="">
                    <?php if(!empty($checkusers_profile)){ ?>
                    <button type="button"
                        class="btn btn-light position-absolute top-100 start-100 translate-middle badge border border-5 border-white rounded-circle p-2"
                        data-bs-toggle="modal" data-bs-target="#editprofilepictureModal">
                        <span class="material-icons md-24">photo_camera</span>
                    </button>
                    <?php } ?>
                    <!-- Modal Edit Photo Profile -->
                    <div class="modal fade" id="editprofilepictureModal" tabindex="-1"
                        aria-labelledby="editprofilepictureModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editprofilepictureModalLabel">Edit Profile Picture</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="form-action" class="form-horizontal" method="post" action="<?php echo current_url(); ?>" role="form" enctype="multipart/form-data">
                                <div class="modal-body row">
                                    <?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
                                    <input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
                                    <input type="hidden" id="business_id" name="business_id" value="<?php echo $community->id ?>"/>
                                    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
									<div class="profile-preview col"></div>
                                    <input type="hidden" name="form" value="photo"/>
                                    <div class="mb-3 col">
                                        <label for="formFile" class="form-label">Upload from your
                                            computer</label>
                                        <input class="form-control" type="file" name="__photo_files[]" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Drag and drop a file">
                                        <span id="passwordHelpInline" class="form-text">
                                            .jpg, .png  110px x 110px
                                        </span>
                                    </div>
                                    <!-- <label for="basic-url" class="form-label">Upload from URL</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3">https://</span>
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3">
                                    </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                                    <button id="btnProfileUpload" type="button" class="btn btn-danger">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <h5 class="d-none d-md-flex justify-content-start"><b><?php echo $community->data_name ?></b></h5>

                <h5 class="d-md-none d-flex justify-content-center"><b><?php echo $community->data_name ?></b></h5>

                <div class="d-flex align-items-center text-muted">
                    <?php
                    foreach($com_categories as $category_val){
                        if($community->data_categories == $category_val->id ){
                            echo $category_val->data_name;
                    ?>
                    <div class="badge rounded-pill bg-light text-black fw-normal m-1"><?php if(!empty($category_val->data_name)){echo $category_val->data_name;} ?></div>
               <?php  }}?>
                </div>
            </div>

            <div class="col-md-3 mb-4 text-center">
            <?php if(!empty($checkusers_profile)){ ?>
                <a href="<?php echo site_url('community/manage') ?>" class="btn btn-danger" role="button">Manage Community</a>
            <?php }else{ ?>
                <button type="button" id="btnConnect_<?php echo $community->id ?>" class="btn btn-danger <?php if(in_array($community->id, $friends)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($community->id, $friends)?>" onclick="follow('<?php echo $community->id ?>')"><?php echo (in_array($users->id, $friends)) ? 'Leave Community' : 'Join Community' ?></button>
                <button type="button" class="btn btn-favourite fs-20 text-danger bg-light rounded-circle p-2 text-align <?php echo active_favourite_home($community->id,'pcs_communities'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="communities" data-content-id="<?php echo $community->id ?>" autocomplete="off"></button>
            <?php } ?>
            </div>
        </div>

        <!-- Navbar User Profile -->
        <div>
            <ul class="nav nav-fill px-4" id="navbar-user-profile" role="tablist">
                <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2)=="post"){echo "active";}?>"
                    href="<?php echo site_url('community/post/'.$community->id) ?>">Post</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2)=="about"){echo "active";}?>"
                    href="<?php echo site_url('community/about/'.$community->id) ?>">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2)=="member"){echo "active";}?>"
                    href="<?php echo site_url('community/member/'.$community->id) ?>">Member</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(2)=="photo" or $this->uri->segment(3)=="album"){echo "active";}?>"
                    href="<?php echo site_url('community/photo/'.$community->id) ?>">Photo</a>
                </li>
        </div>
    </div>
</div>
<?php $this->load->view($template['action_ajax_favourite']); ?>
<script>
var $profilePreview;
var $coverPreview;
$('body').on('shown.bs.modal', '.modal', function() {
	if(!$profilePreview){
		$profilePreview = $('.profile-preview').croppie({
			enableExif: true,
			enforceBoundary:false,
			viewport: {
				width: 110,
				height: 110
			},
			boundary: {
				width: 200,
				height: 200
			}
		});

		$profilePreview.croppie('bind', {
			url: "<?php echo $profile ?>"
		}).then(function() {
			console.log('done update');
		});
	}
	if(!$coverPreview){
		$coverPreview = $('.cover-preview').croppie({
			enableExif: true,
			enforceBoundary:false,
			viewport: {
				width: 1070,
				height: 230
			},
			boundary: {
				width: 1100,
				height: 300
			}
		});

		$coverPreview.croppie('bind', {
			url: "<?php echo $cover ?>"
		}).then(function() {
			console.log('done update');
		});
	}
});

function processCover(input) {
    if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var imgData = e.target.result;
			var imgName = input.files[0].name;
			input.setAttribute("data-title", imgName);

			$('.cover-preview').addClass('ready');
			$coverPreview.croppie('bind', {
				url: e.target.result
			}).then(function() {

			});
		};
		reader.readAsDataURL(input.files[0]);
    }
}

function readUrl(input) {
    if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var imgData = e.target.result;
			var imgName = input.files[0].name;
			input.setAttribute("data-title", imgName);

			$('.profile-preview').addClass('ready');
			$profilePreview.croppie('bind', {
				url: e.target.result
			}).then(function() {

			});
		};
		reader.readAsDataURL(input.files[0]);
    }
}

$('#btnCoverUpload').click(function () {
	$('#btnCoverUpload').attr('disable');
	$coverPreview.croppie('result', {
		type: 'blob',
		size: 'viewport',
	}).then(function(blob) {
		$csrf = $('.modal-body.row').children('input[type=hidden]')[0];

		var fd = new FormData();
		fd.append($($csrf).attr('name'), $($csrf).attr('value'));
		fd.append('id', '<?php echo $CSRF['id']; ?>');
		fd.append('community_id', '<?php echo $community->id ?>');
		fd.append('<?php echo $CSRF['name']; ?>', '<?php echo $CSRF['hash']; ?>');
		fd.append('form', 'cover');
		fd.append('__cover_files[]', blob);

		$.ajax({
			type: 'POST',
			url: window.location.href,
			data: fd,
			processData: false,
			contentType: false
		}).done(function(data) {
			console.log('done update');
			window.location.reload(false);
            bs5Utils.Toast.show({
                type: 'indoconnex',
                icon: `<span class="material-icons-round text-atlantis md-14 me-2">check_circle</span>`,
                title: 'Success',
                subtitle: 'now',
                content: 'Photo has been uploaded.',
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
})

$('#btnProfileUpload').click(function () {
	$('#btnProfileUpload').attr('disable');
	$profilePreview.croppie('result', {
		type: 'blob',
		size: 'viewport',
	}).then(function(blob) {
		$csrf = $('.modal-body.row').children('input[type=hidden]')[0];

		var fd = new FormData();
		fd.append($($csrf).attr('name'), $($csrf).attr('value'));
		fd.append('id', '<?php echo $CSRF['id']; ?>');
		fd.append('community_id', '<?php echo $community->id ?>');
		fd.append('<?php echo $CSRF['name']; ?>', '<?php echo $CSRF['hash']; ?>');
		fd.append('form', 'photo');
		fd.append('__photo_files[]', blob);

		console.log('fd');
		console.log(fd);
		console.log('<?php echo current_url(); ?>');
		$.ajax({
			type: 'POST',
			url: window.location.href,
			data: fd,
			processData: false,
			contentType: false,
			beforeSend: function(xhr){
				console.log(window.location.href);
				console.log(xhr.url);
			},
		}).done(function(data) {
			window.location.reload(false);
            bs5Utils.Toast.show({
                type: 'indoconnex',
                icon: `<span class="material-icons-round text-atlantis md-14 me-2">check_circle</span>`,
                title: 'Success',
                subtitle: 'now',
                content: 'Photo has been uploaded.',
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
})

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

</script>
