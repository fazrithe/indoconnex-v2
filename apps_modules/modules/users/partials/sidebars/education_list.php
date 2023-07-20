<!-- Sidebar  -->
<aside id="sidebar" class="clean d-none d-xl-block position-xl-fixed">
    <div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/campus.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Campus & Education</span>
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)==""){echo "active";}?>"><a class="text-black" href="<?php echo site_url('education')?>">All Category</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="business"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('education/business')?>">Pages</a></li>
        <!-- <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="connection"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('education/connection')?>">Connection</a></li> -->
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="community"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('education/community')?>">Community</a></li>
    </ul>

</aside>

<nav class="clean d-flex d-md-none offcanvas offcanvas-start clean" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-evenly mb-3">
        <div class="d-flex align-items-center my-4">
            <img src="<?php echo theme_user_locations(); ?>images/icons/community.png" alt="" />
            <span class="text-prussianblue fw-bold ms-2">Community</span>
        </div>
    </div>
    <div class="offcanvas-body fw-bold">
        <ul class="list-group mb-3">
		<li class="list-group-item py-0 <?php if($this->uri->segment(2)==""){echo "active";}?>"><a class="text-black" href="<?php echo site_url('education')?>">All Category</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="business"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('education/business')?>">Pages</a></li>
        <!-- <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="connection"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('education/connection')?>">Connection</a></li> -->
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="community"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('education/community')?>">Community</a></li>
        </ul>

    </div>
    <div class="footer-sidebar">
        <label>Advertesing</label>
    </div>
</nav>
