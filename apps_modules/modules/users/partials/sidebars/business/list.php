<!-- Sidebar  -->
<aside id="sidebar" class="clean d-none d-xl-block position-xl-fixed">
    <div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/business.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Business</span>
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/discover')?>">Discover Business</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/list')?>">My Business</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/create')?>">Create Business</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)!=="manage"){echo "d-none";}?>"><a class="text-black" href="#">Manage Business</a></li>
    </ul>
    <hr class="text-prussianblue">
    <ul class="list-group mb-3 d-flex align-items-start <?php if($this->uri->segment(2)!=="manage"){echo "d-none";}?>">
        <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="setting"){echo "active";}?>">
            <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url("business/manage/setting/")?>">
                <span class="material-icons me-2">settings</span>Settings</a>
        </li>
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
            <span class="text-prussianblue fw-bold ms-2">Business Pages</span>
        </div>
        <div class="d-flex flex-shrink-0 ms-auto text-right">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    </div>
    <div class="offcanvas-body fw-bold">
        <ul class="list-group mb-3">
            <li class="list-group-item py-md-0 <?php if($this->uri->segment(2)=="discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/discover')?>">Discover Business Pages</a></li>
            <li class="list-group-item py-md-0 <?php if($this->uri->segment(2)=="list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/list')?>">My Business Page</a></li>
            <li class="list-group-item py-md-0 <?php if($this->uri->segment(2)=="create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('business/create')?>">Create Business Page</a></li>
            <li class="list-group-item py-md-0 <?php if($this->uri->segment(2)!=="manage"){echo "d-none";}?>"><a class="text-black" href="<?php echo site_url('business/manage/setting')?>">Manage Business Page</a></li>
        </ul>

        <ul class="list-group mb-3 d-flex align-items-start <?php if($this->uri->segment(2)!=="manage"){echo "d-none";}?>">
            <li class="list-group-item py-0 w-100 <?php if($this->uri->segment(3)=="setting"){echo "active";}?>">
                <a class="justify-content-start d-flex align-items-center" href="<?php echo site_url('business/manage/setting')?>">
                    <span class="material-icons me-2">settings</span>Settings</a>
            </li>
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
