<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<div class="container mb-4">
    <div class="px-4 rounded-3 bg-white">
        <div class="position-relative hero-profile">
			<?php
			$cover =  base_url() . 'public/themes/user/images/placehold/business-21x9.png';
			if(!empty($jobs->cover_file_name_original)){
				$cover = base_url().$jobs->cover_file_path . $jobs->cover_file_name_original;
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
                                <input type="hidden" id="job-id" name="job-id" value="<?php echo $jobs->id ?>"/>
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
					<img src="<?php echo placeholder($jobs->file_path, $jobs->file_name_original, 'job')?>" class="rounded display-profile" alt="">
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
                                    <input type="hidden" id="job-id" name="job-id" value="<?php echo $jobs->id ?>"/>
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
                <h5 class="d-none d-md-flex justify-content-start fs-18 fw-bold"><?php echo $jobs->data_name ?></h5>
                <p class="d-none d-md-flex justify-content-start fs-14"><a class="text-muted" href=""><?php echo $jobs->fullname ?></a></p>

                <h5 class="d-md-none d-flex justify-content-center fs-18 fw-bold"><?php echo $jobs->data_name ?></h5>
                <p class="d-md-none d-flex justify-content-start fs-14"><a class="text-muted" href=""><?php echo $jobs->fullname ?></a></p>

                <div class="d-flex align-items-center text-muted">
                    <?php
                    if(!empty($jobs->data_categories)){
                        $category = json_decode($jobs->data_categories);
                        foreach($category as $valuecategory){
                            $this->db->select('*');
                            $this->db->where('id', $valuecategory);
                            $query = $this->db->get('pbd_business_categories')->row();
                    ?>
                    <div class="badge rounded-pill bg-light text-black fw-normal m-1"><?php if(!empty($query->data_name)){echo $query->data_name;} ?></div>
                    <?php }} ?>
                </div>
            </div>
            <?php if(!empty($checkusers_profile)){ ?>
            <div class="col-md-3 mb-4 text-center">
                <a href="<?php echo site_url('jobs/manage/') ?>" class="btn btn-danger" role="button">Manage</a>
            </div>
            <?php }elseif(empty(check_apply($jobs->id))){ ?>
                <div class="col-md-3 mb-4 text-center">
                <a href="#" class="btn btn-danger px-4" role="button" data-bs-toggle="modal" data-bs-target="#modal_apply<?php echo $jobs->id ?>">Apply</a>
                <button type="button" class="btn btn-favourite fs-20 text-danger bg-light rounded-circle p-2 text-align <?php echo active_favourite_home($jobs->id,'pcj_jobs'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="jobs" data-content-id="<?php echo $jobs->id ?>" autocomplete="off"></button>    
                </div>
            <?php }else{ ?>
                <div class="col-md-3 mb-4 text-center">
                <a href="#" class="btn btn-primary px-4" role="button" data-bs-toggle="modal" data-bs-target="#modal_applied<?php echo $jobs->id ?>">Applied</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- BODY -->
<div class="container mb-4">
    <!-- SECTION -->
    <div class="col-lg-12 msn-widget p-4 rounded-3">
        <div class="d-flex align-items-start">
            <p class="mb-4 text-prussianblue fw-bold">General Information</p>
        </div>
        <div class="row mb-3">
            <p class="fs-14 text-break text-pre-wrap"><?php echo $jobs->data_description ?></p>
        </div>
        <div class="row d-flex row-cols-1 row-cols-md-3 mb-3">
            <div class="col">
                <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">work</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">Jobs Type</span>
                        <span class="text-black ms-2 ms-md-0 fs-14"><?php echo $jobs->data_type ?></span>
                    </div>
                </div>
                <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">location_city</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">Jobs Category</span>
                        <?php
                                $category = '';
                                $cat = json_decode($jobs->data_categories);
                                if(!empty($jobs->data_categories)){
                                    foreach ($jobs_categories as $value) {
                                        if($value->id == $cat[0]) {
                                            $category = $value->data_name;
                                        }
                                    }
                                }
                        ?>
                        <span class="text-black ms-2 ms-md-0 fs-14"><?php echo $category ?></span>
                    </div>
                </div>
                <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">monetization_on</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <?php
                            $period = '';
                            foreach ($jobs_period as $value) {
                                if($value->id == $jobs->jobs_salary_period_id){
                                    $period = $value->data_name;
                                }
                            }
                            if(!empty($period)) {
                        ?>
                        <span class="fw-bold fs-12">Salary Period</span>
                        <span class="text-black ms-2 ms-md-0 fs-14"><?php echo $period ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18 text-white">monetization_on</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">Salary Range</span>
                        <span class="text-black ms-2 ms-md-0 fs-14"><?php echo $jobs->jb_salary_min ?>-<?php echo $jobs->jb_salary_max ?></span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">place</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">Address</span>
                        <span class="text-black ms-2 ms-md-0 fs-14 text-wrap"><?= $jobs->jb_address; ?></span>
                    </div>
                </div>
                <?php
                    $location = json_decode($jobs->data_location);
                ?>
                <!-- <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">place</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">Post Code</span>
                        <span class="text-black ms-2 ms-md-0 fs-14"></span>
                    </div>
                </div> -->
                <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">place</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">Country</span>
                        <span class="text-black ms-2 ms-md-0 fs-14"><?php echo $location[0]->country_name ?></span>
                    </div>
                </div>
                <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">place</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">State Provincy</span>
                        <span class="text-black ms-2 ms-md-0 fs-14"><?php echo $location[0]->state_name ?></span>
                    </div>
                </div>
                <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">place</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">City</span>
                        <span class="text-black ms-2 ms-md-0 fs-14"><?php echo $location[0]->city_name ?></span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex text-gray align-items-start mb-3">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">phone</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">Phone Number</span>
                        <span class="text-black ms-2 ms-md-0 fs-14"><?php echo $jobs->jb_contact_number ?></span>
                    </div>
                </div>

                <div class="d-flex text-gray align-items-start">
                    <div class="flex-shrink-0 d-flex me-3">
                        <span class="material-icons md-18">email</span>
                    </div>
                    <div class="d-flex flex-grow-1 flex-row flex-md-column">
                        <span class="fw-bold fs-12">Email</span>
                        <span class="text-black ms-2 ms-md-0 fs-14"><?php echo $jobs->jb_contact_email ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_apply<?php echo $jobs->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Apply <?php echo $jobs->data_name ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('jobs/apply') ?>" method="post" role="form" enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="users_id" value="<?php echo $users->id ?>" />
                <input type="hidden" name="job-id" value="<?php echo $jobs->id ?>" />
                <input type="hidden" name="job-user" value="<?php echo $users->username ?>">
                <input type="hidden" name="form" value="form-detail">
                <div class="form-group">
                    <label class="form-label" for="inputFile">Upload CV</label>
                    <input type="file" name="__files" accept="application/pdf" class="form-control" id="inputFile">
                </div><br>
                <div class="form-group">
                    <label class="form-label" for="description">Make your Pitch! (Recommended)</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
					<div class="modal-footer border-top">
						<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
						<button class="btn btn-danger">Send</button>
					</div>
				</form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_applied<?php echo $jobs->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Apply <?php echo $jobs->data_name ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <h4>This position has been applied</h4>
            </div>
            </div>
        </div>
    </div>
    <?php
						$profile = base_url().'public/themes/user/images/placehold/business-1x1.png';
						if (!empty($jobs->file_name_original)) {
							$profile = base_url().$jobs->file_path . $jobs->file_name_original;
						}
					?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
<script>
var $profilePreview;
var $coverPreview;
$('body').on('shown.bs.modal', '.modal', function() {
    console.log('ss');
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
		fd.append('job-id', '<?php echo $jobs->id ?>');
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
		fd.append('job-id', '<?php echo $jobs->id ?>');
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
</script>