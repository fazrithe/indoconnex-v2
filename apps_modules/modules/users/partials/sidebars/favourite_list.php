<!-- Sidebar  -->
<aside id="sidebar" class="clean d-none d-xl-block position-xl-fixed">
    <div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/favourite.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Favourite</span>
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)==""){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite')?>">All Category</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="business"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/business')?>">Pages</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="market"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/market')?>">Product & Service</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="job"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/job')?>">Job</a></li>
        <!-- <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="connection"){echo "active";}?>"><a class="text-black" href="#">Connection</a></li> -->
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="community"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/community')?>">Community</a></li>
        <!-- <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="favourite/business"){echo "active";}?>"><a class="text-black" href="#">Buy & Sell</a></li> -->
		<li class="list-group-item py-0 <?php if($this->uri->segment(2)=="buy"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/buy')?>">Buy & Sells</a></li>
		<li class="list-group-item py-0 <?php if($this->uri->segment(2)=="tender"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/tender')?>">Tender</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="article"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/article')?>">Article</a></li>
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
		<li class="list-group-item py-0 <?php if($this->uri->segment(2)==""){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite')?>">All Category</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="business"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/business')?>">Pages</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="market"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/market')?>">Product & Service</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="job"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/job')?>">Job</a></li>
        <!-- <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="connection"){echo "active";}?>"><a class="text-black" href="#">Connection</a></li> -->
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="community"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/community')?>">Community</a></li>
        <!-- <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="favourite/business"){echo "active";}?>"><a class="text-black" href="#">Buy & Sell</a></li> -->
		<li class="list-group-item py-0 <?php if($this->uri->segment(2)=="buy"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/buy')?>">Buy & Sells</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="article"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('favourite/article')?>">Article</a></li>
        <!-- <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="favourite/business"){echo "active";}?>"><a class="text-black" href="#">Tender</a></li> -->
        </ul>

    </div>
    <div class="footer-sidebar">
        <label>Advertesing</label>
    </div>
</nav>
