
<!-- Sidebar  -->
<nav id="sidebar" class="clean position-md-fixed d-none d-md-flex flex-column">
    <div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/jobs.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Jobs</span>
    </div>
    <div class="accordion h-100" id="accordionJobPanel">
        <div class="accordion-item">
            <h2 class="accordion-header" id="accordionJobPanel-H1">
			<ul class="list-group mb-3">
        	<li class="list-group-item py-0 <?php if($this->uri->segment(2)=="discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('user/login')?>">Login & Register</a></li>
    		</ul>
            </h2>
        </div>
    </div>

    <div class="row align-items-end vstack">
        <span class="d-flex justify-content-between">
            <a class="d-flex fs-8 text-black">Privacy</a>
            <a class="d-flex fs-8 text-black">Terms</a>
            <a class="d-flex fs-8 text-black">Advertising</a>
            <a class="d-flex fs-8 text-black">Ad Choices</a>
            <a class="d-flex fs-8 text-black">Cookies</a>
        </span>
        <span class="text-black fw-bold fs-8">Indoconnex © 2021</span>
    </div>
</nav>

<nav class="clean d-flex d-md-none offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-evenly mb-3">
        <a href="#"><img src="<?php echo theme_user_locations(); ?>images/icons/jobs.png" alt="" srcset=""><b> My Jobs</b></a>
    </div>
    <div class="offcanvas-body fw-bold">

        <ul class="list-unstyled">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('user/login')?>">Login & Register</a></li>
        </ul>
    </div>
</nav>
