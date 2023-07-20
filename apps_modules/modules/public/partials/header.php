<noscript>
<div class="alert alert-danger">
    <span><strong>For full functionality of this site it is necessary to enable JavaScript. </strong> Here are the <a href="http://www.enable-javascript.com/" class="alert-link" target="_blank"> instructions how to enable JavaScript in your web browser</a>.</span>
</div>
</noscript>

<!-- function class active on mainmenu -->
<?php
function set_active_menu($parameter = '') {
$class_active 	= '';
$class_name 	= 'active';
if(!empty($_GET['pages'])) {
    if(is_array($parameter)) {
        if(in_array($_GET['pages'], $parameter)) {
            $class_active = $class_name;
        }
    } else {
        if($_GET['pages'] == $parameter) {
            $class_active = $class_name;
        }
    }
}
return $class_active;
}
?>
<!-- homepub -->
<!-- NAVBAR -SMALL-->
<nav class="navbar navbar-expand-lg  bg-dark fixed-top fixed-top-2">
	<div class="container-fluid smallwidgetarea ">
		<ul class="navbar-nav">
		<li class="nav-item smallwidget weather">
			<!-- WEATHER-->
			<a class="nav-link text-light" aria-current="page" href="#">
				<span id="weathercountry">
					<span id="country-name"></span>,</span>
			</a>
		</li>
		<li class="nav-item smallwidget weather">
			<!-- WEATHER-->
			<a class="nav-link text-light" aria-current="page" href="#">
				<span id="weathercountry">
					<span id="city-name"></span> ,</span>
			</a>
		</li>
		<li class="nav-item smallwidget weather">
			<a class="nav-link text-light" aria-current="page" href="#">
			<span id="weathericon">
				<img id="clouds-img" width="18px;">
			</span>
				<span id="clouds"></span>&#8451;
			</a>
		</li>
		<span class="empty-space"></span>
		<!-- <li class="nav-item smallwidget forex">
			<a class="nav-link text-light" aria-current="page" href="#"><span id="forexcountry"><strong>USD/IDR</strong></span>
			</a>
		</li>
		<li class="nav-item smallwidget forex">
			<a class="nav-link text-light" aria-current="page" href="#"><span id="forexvalue"><span id="currency-usd"></span></span>
			</a>
		</li> -->
		<!-- <li class="nav-item smallwidget forex">
			<a class="nav-link" aria-current="page" href="#"><span class="material-icons md-18 md-red">expand_more</span>
			</a>
		</li> -->
			<!-- FOREX 2-->
		<span class="empty-space"></span>
		<!-- <li class="nav-item smallwidget forex">
			<a class="nav-link text-light" aria-current="page" href="#"><span id="forexcountry"><strong>AUD/IDR</strong></span>
			</a>
		</li>
		<li class="nav-item smallwidget forex">
			<a class="nav-link text-light" aria-current="page" href="#"><span id="forexvalue"><span id="currency-aud"></span></span>
			</a>
		</li> -->
		<!-- <li class="nav-item smallwidget forex">
			<a class="nav-link" aria-current="page" href="#"><span class="material-icons md-18 md-green">expand_less</span>
			</a>
		</li> -->
			<!-- FOREX 3-->
		<span class="empty-space"></span>
		<!-- <li class="nav-item smallwidget forex">
			<a class="nav-link text-light" aria-current="page" href="#"><span id="forexcountry"><strong>USD/IDR</strong></span>
			</a>
		</li>
		<li class="nav-item smallwidget forex">
			<a class="nav-link text-light" aria-current="page" href="#"><span id="forexvalue">0.60%</span>
			</a>
		</li>
		<li class="nav-item smallwidget forex">
			<a class="nav-link" aria-current="page" href="#"><span class="material-icons md-18 md-green">expand_less</span>
			</a>
		</li> -->
		<div class="col-10" style="overflow-y:hidden;">
			<iframe style="pointer-events: none;" src="https://fxpricing.com/fx-widget/ticker-tape-widget.php?id=53,909,247,56,13,1790,247,56&border=show&speed=50&click_target=blank&theme=dark&tm-cr=000&hr-cr=FFFFFF13&by-cr=28A745&sl-cr=DC3545&flags=circle&d_mode=compact-name&column=ask,bid,spread&lang=en&font=Arial, sans-serif" width="1200" height="30" style="border: unset;"></iframe><div id="fx-pricing-widget-copyright"></div><style type="text/css">#fx-pricing-widget-copyright{text-align: center; font-size: 13px; font-family: sans-serif; margin-top: 10px; margin-bottom: 10px; color: #9db2bd;} #fx-pricing-widget-copyright a{text-decoration: unset; color: #bb3534; font-weight: 600;}</style>
		</div>
		</ul>
	</div>
</nav>

<!-- NAVBAR -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light mt-6" id="navbar-public">
	<div class="container-fluid">
		<a class="navbar-brand mb-2" href="<?php echo base_url('/') ?>">
			<img src="<?php echo theme_user_locations(); ?>images/logo/logo-beta.png" alt="indoconnex-logo" height="40">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="offcanvas offcanvas-start" id="navbarSupportedContent">
			<div class="offcanvas-body">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item flex-row d-flex d-md-block">
						<a class="nav-link text-dark <?php if($this->uri->segment(1)==""){echo "active";}?>" aria-current="page" href="<?php echo base_url() ?>">Home</a><button type="button" class="btn-close text-reset ms-auto d-md-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</li>
					<li class="nav-item">
						<a class="nav-link text-dark <?php if($this->uri->segment(1)=="about-us"){echo "active";}?>" href="<?php echo site_url('about-us')?>">Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-dark <?php if($this->uri->segment(1)=="partners"){echo "active";}?>" href="<?php echo site_url('partners')?>">Partners</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-dark <?php if($this->uri->segment(1)=="news"){echo "active";}?>" href="<?php echo site_url('news')?>">News & Events</a>
						</li>
					<li class="nav-item">
						<a class="nav-link text-dark  <?php if($this->uri->segment(1)=="covid"){echo "active";}?>" href="<?php echo site_url('covid/info')?>">Covid-19</a>
					</li>
					<li class="nav-item">
					<a class="nav-link text-dark <?php if($this->uri->segment(1)=="contact-us"){echo "active";}?>" href="<?php echo site_url('contact-us')?>">Contact Us</a>
					</li>
					<li class="nav-item dropdown has-megamenu">
						<a class="nav-link text-dark dropdown-toggle text-wrap" href="#" data-bs-toggle="dropdown">Product & Services </a>
						<div class="dropdown-menu megamenu px-2 pb-1 border-0 rounded-0" role="menu">
							<div class="row fw-semi ">
								<div class="col-lg-2 col-6 ms-auto">
									<ul class="list-unstyled">
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Indoconnex Website') ?>">Indoconnex Websites</a></li>
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Digital Marketing') ?>">Digital Marketing</a></li>
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','UI UX Design') ?>">UI/UX Design</a></li>
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Graphic Design') ?>">Graphic Design</a></li>
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Content Creator') ?>">Copwriter/Content Creator</a></li>
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Business Consultant') ?>">Business Consultant</a></li>
									</ul>
								</div>
								<div class="col-lg-2 col-6">
									<ul class="list-unstyled">
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Software Development Outsourcing') ?>">Software Development Outsourcing</a></li>
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Corporate Identity') ?>">Corporate Identity</a></li>
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Business Matching') ?>">Business Matching</a></li>
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Document Distilation') ?>">Document Distilation</a></li>
										<li><a class="nav-link text-black" href="<?php echo base_url().'service/'.preg_replace('/[^a-zA-Z0-9-&]/', '-','Brochure') ?>">Brochure</a></li>
									</ul>
								</div>
								<div class="col-6 g-0 d-flex">
									<img src="<?php echo theme_user_locations(); ?>images/banner/image-31.png" class="ms-auto" alt="Product & Services">
									<img src="<?php echo theme_user_locations(); ?>images/banner/image-30.png" class="" alt="Product & Services">
								</div>
							</div>
						</div>
					</li>
				</ul>
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<!-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-dark d-flex align-items-center" href="#" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">ENG (AUS)
						</a>
						<ul class="dropdown-menu text-dark" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="#">ENG (US)</a></li>
							<li><a class="dropdown-item" href="#">ENG (UK)</a></li>
							<li><a class="dropdown-item" href="#">Bahasa Indonesia</a></li>
						</ul>
					</li> -->

					<li class="nav-item dropdown">
						<?php if(empty($this->session->userdata('is_login')) && $this->session->userdata('is_login') == FALSE):  ?>
						<a class="nav-link dropdown-toggle text-dark d-flex align-items-center" href="#" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							<img src="<?php echo theme_user_locations(); ?>images/icons/become-a-member.png" class="rounded-circle nav-user-img me-2" alt="">
							Become a member
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item text-dark" href="<?php echo site_url('user/login') ?>">Login</a></li>
							<li><a class="dropdown-item text-dark" href="<?php echo site_url('user/register') ?>">Register</a></li>
						</ul>
						<?php else: ?>
						<a class="nav-link dropdown-toggle text-dark d-flex align-items-center" href="#" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							<?php
								if(!empty($this->session->userdata('is_login') == FALSE)){
									$this->load->view($template['partials_header']);
									}else{
										if(empty($users->file_name_original)){
											echo "<img src='".base_url()."public/themes/user/images/placehold/user-1x1.png' class='rounded-circle nav-user-img text-dark me-2' alt='img'> Hi ".$users->username."";
										}else{
											echo "<img src='".base_url().$users->file_path . $users->file_name_original."' class='rounded-circle nav-user-img text-dark me-2' alt='img'> Hi ".$users->username."";
									}
								}
							?>
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="<?php echo site_url('user/dashboard') ?>">Dashboard</a></li>
							<li><a class="dropdown-item" href="<?php echo site_url('post/'.$this->session->userdata('username')) ?>">Your Profile</a></li>
							<li><a class="dropdown-item" href="<?php echo site_url('setting/general/'.$this->session->userdata('username')) ?>">Settings</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="<?php echo site_url('user/logout') ?>">Log Out</a></li>
						</ul>
						<?php endif ?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
