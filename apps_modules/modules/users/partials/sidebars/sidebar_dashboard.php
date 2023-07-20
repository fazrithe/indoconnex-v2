<!-- Sidebar  -->
 <nav id="sidebar" class="lefty d-none d-xl-block position-xl-fixed">
    <!-- <div class="sidebar-header">
        <img src="<?php echo theme_user_locations(); ?>images/logo/logo.png" alt="" />
    </div> -->
    <div class="">
        <ul class="list-unstyled components">
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
							<div class="d-flex justify-content-center h-100">
						<div class="image_outer_container">
							<div class="green_icon" style="<?php echo user_online($users->id) ?>"></div>
							<div class="image_inner_container">
							<img src='<?php echo placeholder($users->file_path, $users->file_name_original) ?>' class='rounded-circle border feed-user-img' alt='img'>
							</div>
						</div>
					</div>
					<div class='status-circle'></div>
				</div>
				<div class="flex-grow-1 ms-2 flex-column d-flex">
					<a href="<?php echo site_url('post/'.$this->session->userdata('username')) ?>" class="text-prussianblue fw-bold"><?php echo str_limit(trim($users->name_first .' '. $users->name_middle .' '. $users->name_last), 15) ?></span></a>
					<span class="fs-8 text-black text-truncate"><?php
					if(!empty($users->data_status))
					echo str_limit($users->data_status, 25);
					else
					echo '-';
					?></span>
				</div>
			</div>
            <hr class="text-muted my-4">
            <li class="mb-2">
                <a href="<?php echo site_url('business/discover') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/business.png" class="img-menu me-1 me-md-2 mb-md-0">Pages</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('market/discover') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/product.png" class="img-menu me-1 me-md-2 mb-md-0"> Product Services</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('jobs/discover') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/jobs.png" class="img-menu me-1 me-md-2 mb-md-0"> Jobs</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('connections/discover') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/connection.png" class="img-menu me-1 me-md-2 mb-md-0"> Connections</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('community/discover') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/community.png" class="img-menu me-1 me-md-2 mb-md-0"> Communities</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('articles/discover') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/article.png" class="img-menu me-1 me-md-2 mb-md-0"> Articles</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('buysells/discover') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/buy.png" class="img-menu me-1 me-md-2 mb-md-0"> Buy & Sells</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('tender/discover') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/partnership.png" class="img-menu me-1 me-md-2 mb-md-0"> Tender</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('education') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/campus.png" class="img-menu me-1 me-md-2 mb-md-0"> Campus & Education</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('favourite') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/favourite.png" class="img-menu me-1 me-md-2 mb-md-0"> Favourite</a>
            </li>
            <li class="mb-2">
                <a href="<?php echo site_url('covid/world') ?>" class="fw-bold fs-14 p-0 d-flex align-items-center"><img src="<?php echo theme_user_locations(); ?>images/icons/covid19.png" class="img-menu me-1 me-md-2 mb-md-0"> Covid-19 Information</a>
            </li>
			<!-- <li class="">
                <a class="p-0">
        			<p class=""><small>Privacy.Terms.Advertesing <br>Indoconnex</small></p>
				</a>
            </li> -->
        </ul>
    </div>
</nav>
<nav class="d-flex d-md-none offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-evenly mb-3 align-items-start">
        <div class="flex-shrink-0 d-flex">
            <?php echo icon_default($users->file_path,$users->file_name_original ) ?>
        </div>
        <div class="flex-grow-1 ms-2 d-flex flex-column">
            <a href="<?php echo site_url('post/'.$this->session->userdata('username')) ?>" class="text-prussianblue fw-bold"><?php echo trim($users->name_first .' '. $users->name_middle .' '. $users->name_last) ?></a><br>
            <span class="fs-10 text-black"><?php echo $users->data_status ?></span>
        </div>
        <div class="d-flex flex-shrink-0 ps-auto text-right">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    </div>
    <div class="offcanvas-body fw-bold p-4">
        <ul class="list-unstyled d-flex flex-column justify-content-start">
            <li class="mb-3">
                <a class="d-flex flex-row align-items-center" href="<?php echo site_url('business/discover') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/business.png" class="img-menu me-2">Business Pages</a>
            </li>
            <li class="mb-3">
                <a class="d-flex flex-row align-items-center" href="<?php echo site_url('market/discover') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/product.png" class="img-menu me-2">Product Services</a>
            </li>
            <li class="mb-3">
                <a class="d-flex flex-row align-items-center" href="<?php echo site_url('jobs/discover') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/jobs.png" class="img-menu me-2">Jobs</a>
            </li>
            <li class="mb-3">
                <a class="d-flex flex-row align-items-center" href="<?php echo site_url('connections/discover') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/connection.png" class="img-menu me-2">Connections</a>
            </li>
            <li class="mb-3">
                <a class="d-flex flex-row align-items-center" href="<?php echo site_url('community/discover') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/community.png" class="img-menu me-2">Community</a>
            </li>
            <li class="d-flex flex-row align-items-center mb-3">
                <a class="d-flex flex-row align-items-center" href="<?php echo site_url('buysells/discover') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/buy.png" class="img-menu me-2">Buy & Sells</a>
            </li>
            <li class="mb-3">
                <a class="d-flex flex-row align-items-center" href="<?php echo site_url('articles/discover') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/article.png" class="img-menu me-2">Article</a>
            </li>
            <li class="d-flex flex-row align-items-center mb-3">
                <a href="<?php echo site_url('tender') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/partnership.png" class="img-menu me-2">Tender</a>
            </li>
            <li class="d-flex flex-row align-items-center mb-3">
                <a href="<?php echo site_url('education') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/campus.png" class="img-menu me-2">Campus & Education</a>
            </li>
            <li class="d-flex flex-row align-items-center mb-3">
                <a href="<?php echo site_url('favourite') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/favourite.png" class="img-menu me-2">Favourite</a>
            </li>
            <li class="d-flex flex-row align-items-center mb-3">
                <a href="<?php echo site_url('covid/world') ?>"><img src="<?php echo theme_user_locations(); ?>images/icons/covid19.png" class="img-menu me-2">Covid-19 Information</a>
            </li>
            <hr>
            <li class="mb-3">
                <a class="d-flex flex-row align-items-center img-menu" href="<?php echo site_url('setting/general/'.$this->session->userdata('username')) ?>"><span class="material-icons me-2">settings</span>Settings</a>
            </li>
            <li class="mb-3">
                <a class="d-flex flex-row align-items-center img-menu text-nowrap" href="<?php echo site_url('user/logout') ?>"><span class="material-icons me-2">logout</span>Log Out</a>
            </li>
        </ul>
    </div>

    <div class="d-flex flex-column justify-content-evenly m-4">
        <span class="d-flex justify-content-between mb-3">
            <a class="d-flex fs-8 text-black">Privacy</a>
            <a class="d-flex fs-8 text-black">Terms</a>
            <a class="d-flex fs-8 text-black">Advertising</a>
            <a class="d-flex fs-8 text-black">Ad Choices</a>
            <a class="d-flex fs-8 text-black">Cookies</a>
        </span>
        <span class="text-black fw-bold fs-8">Indoconnex © 2021</span>
    </div>
</nav>
