<div class="mb-3 p-3 rounded-3 msn-widget">
    <div class="d-flex align-items-center">
		<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
        <div class="me-md-4 me-1">
            <img src="<?php echo placeholder($users->file_path, $users->file_name_original) ?>" class="rounded-circle feed-user-img">
        </div>
        <div class="flex-grow-1 me-md-2 me-1">
            <input class="form-control" type="text" placeholder="Create post"
                aria-label="Create post" onclick="textPost('')" data-name_form="profile">
        </div>
        <div class="me-md-2 me-1">
            <button class="btn d-flex align-items-center justify-content-center p-0" onclick="photoPost('')">
                <img src="<?php echo theme_user_locations(); ?>images/icons/photo.svg" class="status-icon">
                <small class="d-none d-lg-block ms-2">Photo</small>
            </button>
        </div>
        <div class="me-md-2 me-1">
            <button class="btn d-flex align-items-center justify-content-center p-0" onclick="videoPost('')">
                <img src="<?php echo theme_user_locations(); ?>images/icons/video.svg" class="status-icon">
                <small class="d-none d-lg-block ms-2">Video</small>
            </button>
        </div>
        <div class="me-md-2 me-1">
            <a href="<?php echo site_url('articles/create/'.$this->session->userdata('user_id')) ?>" role="button" class="btn d-flex align-items-center justify-content-center" id="mediapostButton">
                <img src="<?php echo theme_user_locations(); ?>images/icons/article.svg" width="24">
                <small class="d-none d-lg-block ms-2">Article</small>
            </a>
        </div>
        <div class="me-md-0 me-1">
            <button class="btn d-flex align-items-center justify-content-center p-0" data-bs-toggle="modal"
                data-bs-target="#jobPost" id="mediapostButton">
                <img src="<?php echo theme_user_locations(); ?>images/icons/lookingfor.svg" width="24">
                <small class="d-none d-lg-block ms-2 text-nowrap">Look for</small>
            </button>
        </div>
    </div>
</div>
