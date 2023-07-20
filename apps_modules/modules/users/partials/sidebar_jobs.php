
<!-- Sidebar  -->
<nav id="sidebar" class="clean position-md-fixed d-none d-md-flex flex-column">
    <div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/jobs.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Jobs</span>
    </div>
    <div class="accordion h-100" id="accordionJobPanel">
        <div class="accordion-item">
            <h2 class="accordion-header" id="accordionJobPanel-H1">
            <button class="accordion-button text-black fs-12 fw-semi bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJobPanel-C1" aria-expanded="true" aria-controls="accordionJobPanel-C1">
                For Job Seeker
            </button>
            </h2>
            <div id="accordionJobPanel-C1" class="accordion-collapse collapse show" aria-labelledby="accordionJobPanel-H1">
                <div class="accordion-body py-0">
                    <li class="list-group-item p-0 <?php if($this->uri->segment(2)=="discover"){echo "active";}?>"><a class="text-black fs-12 fw-semi" href="<?php echo site_url('jobs/discover')?>">Discover Job</a></li>
                    <li class="list-group-item p-0 <?php if($this->uri->segment(2)=="preference"){echo "active";}?>"><a class="text-black fs-12 fw-semi" href="<?php echo site_url('jobs/preference')?>">My Preference Jobs</a></li>
                    <hr class="text-muted my-1">
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="accordionJobPanel-H2">
            <button class="accordion-button collapsed text-black fs-12 fw-semi" type="button" data-bs-toggle="collapse" data-bs-target="#accordionJobPanel-C2" aria-expanded="false" aria-controls="accordionJobPanel-C2">
                For Recruiter
            </button>
            </h2>
            <div id="accordionJobPanel-C2" class="accordion-collapse collapse show" aria-labelledby="accordionJobPanel-H2">
                <div class="accordion-body py-0">
                    <li class="list-group-item p-0 <?php if($this->uri->segment(2)=="employee"){echo "active";}?>">
                        <a class="text-black fs-12 fw-semi" href="<?php echo site_url('jobs/employee')?>">Find Employee</a>
                    </li>
                    <li class="list-group-item p-0 <?php if($this->uri->segment(2)=="list"){echo "active";}?>">
                        <a class="text-black fs-12 fw-semi" href="<?php echo site_url('jobs/list')?>">My Job Posting</a>
                    </li>
                    <li class="list-group-item p-0 <?php if($this->uri->segment(2)=="applicant"){echo "active";}?>">
                        <a class="text-black fs-12 fw-semi" href="<?php echo site_url('jobs/applicant')?>">Job Applicant</a>
                    </li>
                    <li class="list-group-item p-0 <?php if($this->uri->segment(2)=="create"){echo "active";}?>">
                        <a class="text-black fs-12 fw-semi" href="<?php echo site_url('jobs/create')?>">Create Jobs</a>
                    </li>
                    <li class="list-group-item p-0 <?php if($this->uri->segment(2)=="manage"){echo "active";}?>">
                        <a class="text-black fs-12 fw-semi" href="<?php echo site_url('jobs/manage')?>">Manage Jobs</a>
                    </li>
                </div>
            </div>
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
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('jobs/discover')?>">Discover Job</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="preference"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('jobs/preference')?>">My Preference Jobs</a></li>
        <hr class="text-muted my-1">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="employee"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('jobs/employee')?>">Find Employee</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('jobs/list')?>">My Job Posting</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="applicant"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('jobs/applicant')?>">Job Applicant</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('jobs/create')?>">Create Jobs</a></li>
    	<li class="list-group-item py-0 <?php if($this->uri->segment(2)=="manage"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('jobs/manage')?>">Manage Jobs</a></li>
        </ul>
    </div>
</nav>
