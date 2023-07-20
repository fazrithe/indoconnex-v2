<!-- Sidebar  -->
<aside id="sidebar" class="clean d-none d-xl-block position-xl-fixed">
    <div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/business.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Business</span>
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="business/discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/discover')?>">Discover Business</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="business/list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/list')?>">My Business</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="business/create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/create')?>">Create Business</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)!=="business/manage"){echo "d-none";}?>"><a class="text-black" href="#">Manage Business Page</a></li>
    </ul>
    <hr class="text-prussianblue">
    <ul class="list-group mb-3 d-flex align-items-start <?php if($this->uri->segment(2)!=="manage"){echo "d-none";}?>">
        <!-- <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="setting"){echo "active";}?>">
            <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url("business/manage/setting/")?>">
                <span class="material-icons me-2">settings</span>Settings</a>
        </li> -->
        <!-- <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="verify"){echo "active";}?>">
            <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url('business/manage/verify')?>">
                <span class="material-icons me-2">check</span> Business Verification</a>
		</li> -->
    </ul>
	<div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/places.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Places</span>
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="place/discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('place/discover')?>">Discover Places</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="place/list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('place/list')?>">My Places</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="place/create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('place/create')?>">Create Place</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)!=="place/manage"){echo "d-none";}?>"><a class="text-black" href="#">Manage Place Page</a></li>
    </ul>
    <hr class="text-prussianblue">
    <ul class="list-group mb-3 d-flex align-items-start <?php if($this->uri->segment(2)!=="manage"){echo "d-none";}?>">
        <!-- <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="setting"){echo "active";}?>">
            <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url("business/manage/setting/")?>">
                <span class="material-icons me-2">settings</span>Settings</a>
        </li> -->
        <!-- <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="verify"){echo "active";}?>">
            <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url('business/manage/verify')?>">
                <span class="material-icons me-2">check</span> Business Verification</a>
		</li> -->
    </ul>
</aside>

<nav class="d-flex d-md-none offcanvas offcanvas-start clean" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-start align-items-center mb-3">
        <div class="d-flex my-4">
            <img src="<?php echo theme_user_locations(); ?>images/icons/business.png" alt="" />
            <span class="text-prussianblue fw-bold ms-2">Business</span>
        </div>
        <div class="d-flex flex-shrink-0 ms-auto text-right">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    </div>
    <div class="offcanvas-body fw-bold">
        <ul class="list-group mb-3">
            <li class="list-group-item py-md-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="business/discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/discover')?>">Discover Business</a></li>
            <li class="list-group-item py-md-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="business/list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/list')?>">My Business</a></li>
            <li class="list-group-item py-md-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="business/create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/create')?>">Create Business</a></li>
            <li class="list-group-item py-md-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)!=="business/manage"){echo "d-none";}?>"><a class="text-black" href="<?php echo site_url('business/manage/setting')?>">Manage Business</a></li>
        </ul>

        <ul class="list-group mb-3 d-flex align-items-start <?php if($this->uri->segment(2)!=="manage"){echo "d-none";}?>">
            <!-- <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="setting"){echo "active";}?>">
                <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url('business/manage/setting')?>">
                    <span class="material-icons me-2">settings</span>Settings</a>
            </li> -->
            <!-- <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="verify"){echo "active";}?>">
                <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url('business/manage/verify')?>">
                    <span class="material-icons me-2">check</span> Business Verification</a>
            </li> -->
        </ul>
    </div>
	<div class="offcanvas-header d-flex justify-content-start align-items-center mb-3">
        <div class="d-flex my-4">
			<img src="<?php echo theme_user_locations(); ?>images/icons/places.png" alt="" />
            <span class="text-prussianblue fw-bold ms-2">Place</span>
        </div>
        <div class="d-flex flex-shrink-0 ms-auto text-right">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    </div>
    <div class="offcanvas-body fw-bold">
        <ul class="list-group mb-3">
		<li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="place/discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('place/discover')?>">Discover Places</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="place/list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('place/list')?>">My Places</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)=="place/create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('place/create')?>">Create Place</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(1).'/'.$this->uri->segment(2)!=="place/manage"){echo "d-none";}?>"><a class="text-black" href="#">Manage Place Page</a></li>
        </ul>

        <ul class="list-group mb-3 d-flex align-items-start <?php if($this->uri->segment(2)!=="manage"){echo "d-none";}?>">
            <!-- <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="setting"){echo "active";}?>">
                <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url('business/manage/setting')?>">
                    <span class="material-icons me-2">settings</span>Settings</a>
            </li> -->
            <!-- <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="verify"){echo "active";}?>">
                <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url('business/manage/verify')?>">
                    <span class="material-icons me-2">check</span> Business Verification</a>
            </li> -->
        </ul>
    </div>
    <div class="footer-sidebar">
        <label>Advertesing</label>
    </div>
</nav>
