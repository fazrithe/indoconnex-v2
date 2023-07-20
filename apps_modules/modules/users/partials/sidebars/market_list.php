<!-- Sidebar  -->
<aside id="sidebar" class="clean d-none d-xl-block position-xl-fixed">
    <div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/product.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Products/Services</span>
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('market/discover')?>">Discover Product/Service</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('market/list')?>">My Product/Service</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('market/create')?>">Create Product/Service</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="manage"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('market/manage')?>">Manage Product/Service</a></li>
    </ul>

</aside>

<nav class="d-flex d-md-none offcanvas offcanvas-start clean" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-evenly mb-3">
        <div class="d-flex align-items-center my-4">
            <img src="<?php echo theme_user_locations(); ?>images/icons/market.png" alt="" />
            <span class="text-prussianblue fw-bold ms-2">Products/Services</span>
        </div>
    </div>
    <div class="offcanvas-body fw-bold">
        <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('market/discover')?>">Discover Product/Service</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('market/list')?>">My Product/Service</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('market/create')?>">Create Product/Service</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="manage"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('market/manage')?>">Manage Product/Service</a></li>
        </ul>

    </div>
    <div class="footer-sidebar">
        <label>Advertesing</label>
    </div>
</nav>
