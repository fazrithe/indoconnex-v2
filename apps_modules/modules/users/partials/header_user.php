<!-- NAVBAR -->
<header>
	<nav class="navbar fixed-top navbar-expand-lg navbar-light" id="navbar-user">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
				data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="material-icons text-black">menu</span>
			</button>
			<form class="d-flex d-md-none ms-1">
				<button class="input-group-text bg-white border-0" id="search-navbar" action="<?php echo base_url('search') ?>" method="get" role="form">
					<span class="material-icons text-black ">search</span>
				</button>
			</form>
			<a class="navbar-brand mb-2 mx-auto" href="
			<?php if($this->uri->segment(2)=="dashboard"){echo site_url('/');}else{echo site_url('user/dashboard');}?>
			">
				<img src="<?php echo theme_user_locations(); ?>images/logo/logo-beta.png" alt="indoconnex-logo">
			</a>
			<form class="d-none d-md-flex ms-5" action="<?php echo base_url('search') ?>" method="get" role="form">
				<div class="input-group">
					<span class="input-group-text bg-white border-end-0 rounded-pill-left" id="search-navbar">
						<span class="material-icons text-muted ">search</span>
					</span>
					<input class="form-control me-2 border-start-0 rounded-pill-right live-search" name="q" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
				</div>
			</form>
			<?php
			$url = 'https://ui-avatars.com/api/?size=60&name=' . $users->name_full;
			if(!empty($users->file_name_original)) {
				$url = base_url().$users->file_path . $users->file_name_original;
			}
			?>
			<a href="<?php echo site_url('post/'.$this->session->userdata('username')) ?>" class="d-block d-md-none">
				<img src='<?php echo $url ?>' class='rounded-circle nav-user-img d-block d-md-none' alt='<?php echo strtolower(str_replace($users->name_full, '-', ' ')) ?>'>
			</a>

			<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
				<div class="offcanvas-header">
					<a class="nav-link" href="<?php echo site_url('post/'.$this->session->userdata('username')) ?>">
						<?php
							if(!empty($this->session->userdata('is_login') == FALSE)){
								$this->load->view($template['partials_header']);
							}else{
								if(!empty($users->file_name_original)) {
									$url = base_url().$users->file_path . $users->file_name_original;
								}
								echo "<img src='".$url."' class='rounded-circle nav-user-img' alt='". strtolower(str_replace($users->name_full, '-', ' ')) ."'> Hi ".$users->username."";
							}
						?>
					</a>
					<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
					<ul class="navbar-nav justify-content-end flex-grow-1 pe-3 d-none d-md-flex">
						<!-- <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-dark d-flex align-items-center" href="#" id="navbarDropdown" role="button"
								data-bs-toggle="dropdown" aria-expanded="false">ENG (AUS)
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">ENG (US)</a></li>
								<li><a class="dropdown-item" href="#">ENG (UK)</a></li>
								<li><a class="dropdown-item" href="#">Bahasa Indonesia</a></li>
							</ul>
						</li> -->
						
							<a class="nav-link text-dark mt-1" href="<?php echo site_url('message/dashboard_chat');?>">
								<span class="fas fa-comment-alt"  style='font-size:18px'></span>
							</a>
						<li class="nav-item dropdown">
							<a class="nav-link text-dark mx-2" href="#" id="notifyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<span class="material-icons align-middle">notifications</span>
							</a>
							<ul class="dropdown-menu p-4 notificationBox end-0" aria-labelledby="notifyDropdown" >
								<div class="align-items-center d-flex">
									<span class="fw-bold fs-16 text-prussianblue">Notifications</span>
									<button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="dropdown" aria-label="Close"></button>
								</div>
								<hr>
								<div id="thenotify">

								</div>
							</ul>
						</li>
						<!-- <li class="nav-item dropdown">
							<a class="nav-link text-dark mx-2" href="#" id="notifyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="material-icons">mark_as_unread</i>
							</a>
							<ul class="dropdown-menu p-4 notificationBox end-0" aria-labelledby="notifyDropdown" >
								<div class="align-items-center d-flex">
									<span class="fw-bold fs-16 text-prussianblue">Message</span>
									<button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="dropdown" aria-label="Close"></button>
								</div>
								<hr>
								<div id="thenotify">
									<li class='mb-3'>
										<a href='$clickUrl' class='hstack d-flex'>
											<div class='flex-shrink-0 placeholder-glow'>
												<img src='<?php echo theme_user_locations(); ?>images/users/Ellipse 27.png' alt='' srcset='' class='rounded-circle feed-user-img'>
											</div>
											<div class='flex-grow-1 ms-2 d-flex flex-column'>
												<span class='fw-semi fs-14 text-black text-truncate'>Hallo</span>
												<span class='fs-10 text-black text-truncate'>Information for you...</span>
											</div>
										</a>
									</li>
									<div class="text-center">
									<a href="<?php echo site_url('message/inbox')?>">View All</a>
									</div>
								</div>
							</ul>
						</li> -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-dark d-flex align-items-center" href="#" id="navbarDropdown" role="button"
								data-bs-toggle="dropdown" aria-expanded="false">
								<?php
									if(!empty($this->session->userdata('is_login') == FALSE)){
										$this->load->view($template['partials_header']);
									}else{
										echo "<img src='".$url."' class='rounded-circle nav-user-img me-2' alt='". strtolower(str_replace($users->name_full, '-', ' ')) ."'>Hi ".$users->username."";
									}
								?>
							</a>
							<ul class="dropdown-menu text-dark" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="<?php echo site_url('user/dashboard') ?>">Dashboard</a></li>
								<li><a class="dropdown-item" href="<?php echo site_url('post/'.$this->session->userdata('username')) ?>">Your Profile</a></li>
								<li><a class="dropdown-item" href="<?php echo site_url('setting/general/'.$this->session->userdata('username')) ?>">Settings</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li>
									<a class="dropdown-item" href="<?php echo site_url('user/logout') ?>">Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="navbar-nav justify-content-end flex-grow-1 pe-3 d-flex d-md-none">
						<li class="nav-item">
							<a class="nav-link" href="#">
								<span class="material-icons align-middle">notifications</span> Notifications
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo site_url('setting/general/'.$this->session->userdata('username')) ?>"><span class="material-icons align-middle">settings</span> Settings</a>
						</li>
						<!-- <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-bs-toggle="dropdown" aria-expanded="false">ENG (AUS)
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">ENG (US)</a></li>
								<li><a class="dropdown-item" href="#">ENG (UK)</a></li>
								<li><a class="dropdown-item" href="#">Bahasa Indonesia</a></li>
							</ul>
						</li> -->
						<hr class="dropdown-divider">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo site_url('user/logout') ?>">
								<span class="material-icons align-middle">person</span> Log Out
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>
<!-- Live search -->
<div id="liveSearchContainer"></div>