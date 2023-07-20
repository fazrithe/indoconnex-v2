
<!-- Sidebar  -->
<nav id="sidebar" class="clean position-md-fixed d-none d-md-block">
    <div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/article.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Article</span>
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="discover"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('articles/discover')?>">Discover Article</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('articles/list')?>">My Article</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('articles/create')?>">Create Article</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="manage"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('articles/manage')?>">Manage Article</a></li>
    </ul>
    <hr class="text-prussianblue">
</nav>

<nav class="d-flex d-md-none offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-evenly mb-3">
        <a href="#"> <img src="<?php echo theme_user_locations(); ?>images/icons/article.png" alt="" srcset=""><b> Article</b></a>
    </div>
    <div class="offcanvas-body fw-bold">

        <ul class="list-unstyled">
            <li class="mb-3">
                <a href="<?php echo site_url('articles/discover') ?>" class="<?php if($this->uri->segment(3)=="discover"){echo "active";}?>"><span class="text-black">Discover Article</span></a>
            </li>
            <li class="mb-3">
                <a href="<?php echo site_url('articles/list')?>" class="<?php if($this->uri->segment(3)=="list"){echo "active";}?>"><span class="text-black">My Article</span></a>
            </li>
            <li class="mb-3">
                <a href="<?php echo site_url('articles/create') ?>" class="<?php if($this->uri->segment(3)=="create"){echo "active";}?>"><span class="text-black">Create Article</span></a>
            </li>
            <li class="mb-3">
                <a href="<?php echo site_url('articles/manage')?>" class="<?php if($this->uri->segment(2)=="manage"){echo "active";}?>"><span class="text-black">Manage Article</span></a>
            </li>
        </ul>
    </div>
    <div class="footer-sidebar">
        <!-- <label>Advertesing</label> -->
    </div>
</nav>
