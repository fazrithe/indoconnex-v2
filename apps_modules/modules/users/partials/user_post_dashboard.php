<div class="mb-4 p-4 rounded-3 msn-widget">
    <div class="d-flex align-items-center">
		<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
        <div class="me-md-4 me-1">
			<div class="image_outer_container">
				<div class="green_icon" style="<?php echo user_online($users->id) ?>"></div>
					<div class="image_inner_container">
						<img src='<?php echo placeholder($users->file_path, $users->file_name_original) ?>' class='rounded-circle border feed-user-img' alt='img'>
					</div>
				</div>
			<div class='status-circle'></div>	
		</div>
        <div class="flex-grow-1 me-md-2 me-1">
            <input class="form-control" type="text" placeholder="Create post"
                aria-label="Create post" onclick="textPost('dashboard')" data-name_form="dashboard">
        </div>
        <div class="me-md-2 me-1">
            <button class="btn d-flex align-items-center justify-content-center p-0" onclick="photoPost('dashboard')">
                <img src="<?php echo theme_user_locations(); ?>images/icons/photo.svg" class="status-icon">
                <small class="d-none d-lg-block ms-2">Photo</small>
            </button>
        </div>
        <div class="me-md-2 me-1">
            <button class="btn d-flex align-items-center justify-content-center p-0" onclick="videoPost('dashboard')">
                <img src="<?php echo theme_user_locations(); ?>images/icons/video.svg" class="status-icon">
                <small class="d-none d-lg-block ms-2">Video</small>
            </button>
        </div>
        <div class="me-md-2 me-1">
            <a href="<?php echo site_url('articles/create/'.$this->session->userdata('user_id')) ?>" role="button" class="btn d-flex align-items-center justify-content-center p-0">
                <img src="<?php echo theme_user_locations(); ?>images/icons/article.svg" height="24" class="status-icon">
                <small class="d-none d-lg-block ms-2">Article</small>
            </a>
        </div>
        <div class="me-md-0 me-1">
            <button class="btn d-flex align-items-center justify-content-center p-0" data-bs-toggle="modal"
                data-bs-target="#jobPost">
                <img src="<?php echo theme_user_locations(); ?>images/icons/lookingfor.svg" width="24" class="status-icon">
                <small class="d-none d-lg-block ms-2 text-nowrap">Look for</small>
            </button>
        </div>
    </div>
</div>
