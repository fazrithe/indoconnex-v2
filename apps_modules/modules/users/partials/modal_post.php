 <!-- Modal -->
	<div class="modal fade" id="photoPost" tabindex="-1" aria-labelledby="photoPostLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Upload Photo</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
				<form action="<?php echo base_url('user/profile/add_photo_post/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
				<input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
				<input type="hidden" name="business_id" id="business_id_photo">
				<input type="hidden" name="business_username" id="business_username_photo">
				<input type="hidden" name="username" id="username_post" value="<?php echo $users->username ?>">
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="form" id="name_form_photo"/>
				<div class="modal-body">
					<div class="mb-3">
						<textarea name="data_description" cols="1" rows="1" class="form-control" placeholder="Say something about this photo"></textarea>
					</div>
					<div class="mb-3">
						<label for="formFile" class="form-label">Upload from your
							computer</label>
						<input class="form-control" type="file" id="formFile" name="__photo_post_files[]">
					</div>

					<label for="basic-url" class="form-label">Upload from URL</label>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon3">https://</span>
						<input type="text" name="image-url" class="form-control" id="image-url"
							aria-describedby="basic-addon3">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">Submit</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="photoPostEdit" tabindex="-1" aria-labelledby="photoPostLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Upload Photo</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
			<form action="<?php echo base_url('user/profile/add_photo_post/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
				<input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="post_photo_id" id="post_photo_id"/>
				<input type="hidden" name="business_id" id="business_id_photo_edit">
				<input type="hidden" name="business_username" id="business_username_photo_edit">
				<input type="hidden" name="form" id="name_form_photo_edit"/>
				<input type="hidden" name="form_action" value="edit"/>
				<div class="modal-body">
					<div class="mb-3">
						<textarea id="data_photo_description" name="data_description" cols="1" rows="1" class="form-control" placeholder="Say something about this photo"></textarea>
					</div>
					<div class="mb-3">
						<label for="uploadUrl">From URL</label>
						<input type="text" name="image-url" id="image-url" class="form-control">
					</div>
					<div class="mb-3">
						<label for="uploadUrl">From File</label>
						<input type="file" name="__photo_post_files[]" id="" class="form-control">
					</div>
				</div>
			<div class="modal-footer border-top">
				<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Submit</button>
			</div>
			</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="textPost" tabindex="-1" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="textPostLabel">Create a New Post</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
			<form action="<?php echo base_url('user/profile/add_post/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data" id="textPostForm">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
				<input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
				<input type="hidden" name="business_id" id="business_id_post">
				<input type="hidden" name="business_username" id="business_username_post">
				<input type="hidden" name="username" id="username_post" value="<?php echo $users->username ?>">
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="form" id="name_form"/>
				<input type="file" name="__photos[]" id="textPostFiles" class="form-control" multiple hidden>
			<div class="modal-body">
				<div class="mb-3">
					<textarea name="data_description" id="textPostDescription" cols="30" rows="10" class="form-control" placeholder="What's on your mind?"></textarea>
				</div>
			</div>
			<div class="modal-footer border-top px-3 justify-content-start">
				<!-- <div class="col px-0 align-items-start">
					<button type="button" role="button" class="btn p-sm-0" id="profile-photo-post-upload"><img src="<?php echo theme_user_locations(); ?>images/icons/photo.png"  alt="User Image"></button>
					<button  type="button" role="button" class="btn p-sm-0" id="profile-video-post-upload"><img src="<?php echo theme_user_locations(); ?>images/icons/video.png"  alt="User Image"></button>
				</div> -->
				<div class="col px-0 align-items-end text-right">
					<button type="button" class="btn  btn-muted" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">Post</button>
				</div>
			</div>
			</form>
			</div>
		</div>
	</div>
	<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="textPostEdit" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="textPostLabel">Edit a Post</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/edit_post/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
					<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
					<input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
					<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
					<input type="hidden" name="business_id" id="business_id_post_edit">
					<input type="hidden" name="business_username" id="business_username_post_edit">
					<input type="hidden" name="username" id="username_post_edit" value="<?php echo $users->username ?>">
					<input type="hidden" name="post_text_id" id="post_text_id"/>
					<input type="hidden" name="form" id="name_form_edit"/>
				<div class="modal-body">
					<div class="mb-3">
						<textarea name="data_description" id="data_description" cols="30" rows="10" class="form-control" placeholder="What's on your mind?"></textarea>
					</div>
				</div>
				<div class="modal-footer border-top">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">Post</button>

				</div>
				</form>
			</div>
		</div>
	</div>
	<?php
		if(!empty($posts)) {
		foreach($posts as $value){
			$post_id            = $value->id;
	?>
	<div class="modal fade" id="del_post_text_profile<?php echo $post_id ?>" tabindex="-1" aria-labelledby="albumslabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<form action="<?php echo base_url('user/profile/delete_post/'.$post_id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
			<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
			<input type="hidden" name="id" value="<?php echo $users->id ?>" />
			<input type="hidden" name="username" value="<?php echo $users->username ?>" />
			<input type="hidden" name="form" value="post/" />
				<div class="modal-body">
					<p>Are you sure you want to delete?</p>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="post_text_id" value="<?php echo $post_id;?>">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn btn-danger">Delete</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="del_post_text_dashboard<?php echo $post_id ?>" tabindex="-1" aria-labelledby="albumslabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<form action="<?php echo base_url('user/profile/delete_post/'.$post_id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
			<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
			<input type="hidden" name="id" value="<?php echo $users->id ?>" />
			<input type="hidden" name="username" value="<?php echo $users->username ?>" />
			<input type="hidden" name="form" value="dashboard" />
				<div class="modal-body">
					<p>Are you sure you want to delete?</p>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="post_text_id" value="<?php echo $post_id;?>">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn btn-danger">Delete</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="del_post_lookfor_text_dashboard<?php echo $post_id ?>" tabindex="-1" aria-labelledby="albumslabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<form action="<?php echo base_url('user/profile/delete_post_lookfor/'.$post_id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
			<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
			<input type="hidden" name="id" value="<?php echo $users->id ?>" />
			<input type="hidden" name="username" value="<?php echo $users->username ?>" />
			<input type="hidden" name="form" value="dashboard" />
				<div class="modal-body">
					<p>Are you sure you want to delete?</p>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="post_text_id" value="<?php echo $post_id;?>">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn btn-danger">Delete</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="del_post_updated_photo_profile<?php echo $post_id ?>" tabindex="-1" aria-labelledby="albumslabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<form action="<?php echo base_url('user/profile/delete_post_photo_profile/'.$post_id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
			<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
			<input type="hidden" name="id" value="<?php echo $users->id ?>" />
			<input type="hidden" name="username" value="<?php echo $users->username ?>" />
			<input type="hidden" name="form" value="dashboard" />
				<div class="modal-body">
					<p>Are you sure you want to delete?</p>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="post_updated_photo_profile_id" value="<?php echo $post_id;?>">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn btn-danger">Delete</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="del_post_text_profile_business<?php echo $post_id ?>" tabindex="-1" aria-labelledby="albumslabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<form action="<?php echo base_url('user/profile/delete_post/'.$post_id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
			<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
			<input type="hidden" name="business_id" value="<?php if(!empty($business->id)){echo $business->id;} ?>" />
			<input type="hidden" name="form" value="business/post/" />
				<div class="modal-body">
					<p>Are you sure you want to delete?</p>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="post_text_id" value="<?php echo $post_id;?>">
					<button class="btn btn-muted" data-bs-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn btn-danger">Delete</button>
				</div>
			</form>
			</div>
		</div>
	</div>
	<?php }} ?>


	<div class="modal fade" id="modal_del_comment" tabindex="-1" aria-labelledby="modal_del_comment" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
				<form action="" id="form_del_comment" method="post" role="form">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="comment_id" id="del_comment_id" value=""/>
					<div class="modal-body">
						<p>Are you sure you want to Delete this Comment?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-muted" data-bs-dismiss="modal" aria-hidden="true">Cancel</button>
						<button type="button" id="form_delete_comment" class="btn btn-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="videoPost" tabindex="-1" aria-labelledby="videoPostLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Upload Video</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
				<form action="<?php echo base_url('user/profile/add_video_post/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
				<input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
				<input type="hidden" name="business_id" id="business_id_video">
				<input type="hidden" name="business_username" id="business_username_video">
				<input type="hidden" name="username" id="username_post" value="<?php echo $users->username ?>">
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="form" id="name_form_video"/>
				<div class="modal-body">
					<div class="mb-3">
						<textarea name="data_description" cols="1" rows="1" class="form-control" placeholder="Say something about this video"></textarea>
					</div>

					<label for="basic-url" class="form-label">Upload from Youtube</label>
					<div class="mb-3">
						<input type="text" name="video-url" class="form-control" id="video-url"
							aria-describedby="basic-addon3">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">Submit</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="videoPostEdit" tabindex="-1" aria-labelledby="photoPostLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Upload Video</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
			<form action="<?php echo base_url('user/profile/add_video_post/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
				<input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="post_video_id" id="post_video_id"/>
				<input type="hidden" name="business_id" id="business_id_video_edit">
				<input type="hidden" name="business_username" id="business_username_video_edit">
				<input type="hidden" name="form" id="name_form_video_edit"/>
				<input type="hidden" name="form_action" value="edit"/>
				<div class="modal-body">
					<div class="mb-3">
						<textarea id="data_video_description" name="data_description" cols="1" rows="1" class="form-control" placeholder="What's on your mind?"></textarea>
					</div>
					<div class="mb-3">
						<label for="uploadUrl">From Youtube</label>
						<input type="text" id="video-edit-url" name="video-url" id="" class="form-control">
					</div>
				</div>
			<div class="modal-footer border-top">
				<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Submit</button>
			</div>
			</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="jobPost" tabindex="-1" aria-labelledby="jobPostLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
					<h5 class="modal-title" id="">Looking For</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
				<form action="<?php echo base_url('user/profile/add_looking_post/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
				<input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<div class="modal-body">
				<div class="row mb-3">
					<div class="col">
						<div class="p-3 border bg-light">
							<div class="form-check">
								<input class="form-check-input"  onclick="checkLooking()" type="radio" name="r_looking" value="business" id="r_business">
								<label class="form-check-label" for="flexRadioDefault1">
									Business
								</label>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="p-3 border bg-light">
							<div class="form-check">
								<input class="form-check-input" onclick="checkLooking()" type="radio" name="r_looking" value="jobs" id="r_jobs">
								<label class="form-check-label" for="flexRadioDefault2">
									Jobs
								</label>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="p-3 border bg-light">
							<div class="form-check">
								<input class="form-check-input" onclick="checkLooking()" type="radio" name="r_looking" value="distributor" id="r_distributor">
								<label class="form-check-label" for="flexRadioDefault2">
									Distributor
								</label>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="form" id="form">
				<div id="formLooking" style="display: none;">
				<div class="row mb-3">
					<div class="col">
						<div class="input-group mb-3">
							<input type="hidden" name="select_user_id_business" id="select_user_id_business">
							<input type="hidden" name="select_business_id_business" id="select_business_id_business">
							<select name="s_business_types" onchange="selectBusinessLooking(this.value)" class="form-select" >
								<option selected>Select Business</option>
								<?php foreach($business_types as $value ){
									echo "<option value='".$value->id."'>".$value->data_name."</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<div class="input-group mb-3">
						<textarea name="description_business" id="description_business" class="form-control" aria-label="With textarea"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
							<select name="s_business_user" onchange="selectUserbusiness(this.value)" id="" class=" border-0 bg-white p-2 js-businessSelector">
								<option value="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
								<?php foreach($business_list as $value){ ?>
								<option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business') ?>" class=""><?php echo $value->data_name ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				</div>
				<div id="formLookingJobs"  style="display: none;">
				<div class="row mb-3">
					<div class="col">
						<div class="input-group mb-3">
							<select name="s_type_job"  onchange="selectJobsTypeLooking(this.value)" class="form-select" id="s_type_job" aria-label="Default select example">
								<option selected>Select Job Type</option>
								<?php foreach($jobs_types as $value ){
									echo "<option value='".$value->id."'>".$value->data_name."</option>";
								} ?>
							</select>
							<input type="hidden" id="i_type_job">
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<div class="input-group mb-3">
							<select name="s_category_job" onchange="selectJobsCategoryLooking(this.value)" class="form-select" aria-label="Default select example">
								<option selected>Select Category Type</option>
								<?php foreach($jobs_categories as $value ){
									echo "<option value='".$value->id."'>".$value->data_name."</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<div class="input-group mb-3">
						<textarea name="description_job" id="description_job" class="form-control" aria-label="With textarea"></textarea>
						</div>
					</div>
				</div>
				</div>
				<div id="formLookingDistributor" style="display: none;">
				<div class="row mb-3">
					<div class="col">
						<div class="input-group mb-3">
							<select name="s_type_distributor" onchange="selectDisTypeLooking(this.value)" class="form-select" aria-label="Default select example">
								<option selected>Select Distributor Type</option>
								<?php foreach($distributor_types as $value ){
									echo "<option value='".$value->id."'>".$value->data_name."</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<div class="input-group mb-3">
						<textarea name="description_distributor" id="description_distributor" class="form-control" aria-label="With textarea"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
							<select name="s_business_user" onchange="selectUserbusiness(this.value)" id="" class=" border-0 bg-white p-2 js-businessSelector">
								<option value="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
								<?php foreach($business_list as $value){ ?>
								<option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business') ?>" class=""><?php echo $value->data_name ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				</div>
				</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function checkLooking(){
		var checkBusiness = document.getElementById("r_business");
		var checkJobs = document.getElementById("r_jobs");
		var checkDistributor = document.getElementById("r_distributor");
			// Get the output text
		var form = document.getElementById("formLooking");
		var formJobs = document.getElementById("formLookingJobs");
		var formDistributor = document.getElementById("formLookingDistributor");
		if (checkBusiness.checked == true){
			form.style.display = "block";
			formJobs.style.display = "none";
			formDistributor.style.display = "none";
			document.getElementById('form').value = "business";
		} else if (checkJobs.checked == true){
			form.style.display = "none";
			formDistributor.style.display = "none";
			formJobs.style.display = "block";
			document.getElementById('form').value = "jobs";
		} else {
			form.style.display = "none";
			formDistributor.style.display = "block";
			formJobs.style.display = "none";
			document.getElementById('form').value = "distributor";
		}
	}

	function selectBusinessLooking(id){
		user_id = $("#id").val();
		$.ajax({
		type  : 'GET',
		url   : '<?php echo site_url('api/business/type');?>/'+id,
		async : true,
		dataType : 'json',
		}).done(
			function(data){
				var i;
				for(i=0; i<data.length; i++){
					document.getElementById('description_business').value = 'Im looking for a '+data[i].data_name;
				}
			}
		);
	}

	function selectJobsTypeLooking(id){
		user_id = $("#id").val();
		$.ajax({
		type  : 'GET',
		url   : '<?php echo site_url('api/job/type');?>/'+id,
		async : true,
		dataType : 'json',
		}).done(
			function(data){
				var i;
				for(i=0; i<data.length; i++){
					document.getElementById('i_type_job').value = data[i].data_name;
				}
			}
		);
	}

	function selectJobsCategoryLooking(id){
		user_id = $("#id").val();
		type_job = $("#i_type_job").val();
		$.ajax({
		type  : 'GET',
		url   : '<?php echo site_url('api/job/category');?>/'+id,
		async : true,
		dataType : 'json',
		}).done(
			function(data){
				var i;
				for(i=0; i<data.length; i++){
					document.getElementById('description_job').value = 'Im looking for a job as '+type_job+' in '+data[i].data_name;
				}
			}
		);
	}

	function selectDisTypeLooking(id){
		user_id = $("#id").val();
		$.ajax({
		type  : 'GET',
		url   : '<?php echo site_url('api/distributor/type');?>/'+id,
		async : true,
		dataType : 'json',
		}).done(
			function(data){
				var i;
				for(i=0; i<data.length; i++){
					document.getElementById('description_distributor').value = 'Im looking for a '+data[i].data_name;
				}
			}
		);
	}

	function selectUserbusiness(id){
	user_id = $("#id").val();
	if(id == 1){
		document.getElementById('select_user_id_business').value = user_id;
		document.getElementById('select_business_id_business').value = '';
	}else{
		document.getElementById('select_business_id_business').value = id;
		document.getElementById('select_user_id_business').value = '';
	}
}
</script>
