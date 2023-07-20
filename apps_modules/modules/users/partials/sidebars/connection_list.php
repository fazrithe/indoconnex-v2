<!-- Sidebar  -->
<aside id="sidebar" class="clean d-none d-xl-block position-xl-fixed">
    <div class="d-flex align-items-center my-4">
        <img src="<?php echo theme_user_locations(); ?>images/icons/connection.png" alt="" />
        <span class="text-prussianblue fw-bold ms-2">Connection</span>
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="discover" && $this->uri->segment(3)!="people" && $this->uri->segment(3)!="pages"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connections/discover')?>">Discover Connection</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(3)=="people"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connections/discover/people')?>">Discover People</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(3)=="pages"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connections/discover/pages')?>">Discover Pages</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connections/list')?>">My Connection</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="invite"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connections/invite')?>">Invite Friends</a></li>
    </ul>

</aside>

<nav class="clean d-flex d-md-none offcanvas offcanvas-start clean" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-evenly mb-3">
        <div class="d-flex align-items-center my-4">
            <img src="<?php echo theme_user_locations(); ?>images/icons/connection.png" alt="" />
            <span class="text-prussianblue fw-bold ms-2">Connections</span>
        </div>
    </div>
    <div class="offcanvas-body fw-bold">
        <ul class="list-group mb-3">
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="discover" && $this->uri->segment(3)!="people" && $this->uri->segment(3)!="pages"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connection/discover')?>">Discover Connections</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(3)=="people"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connection/discover/people')?>">Discover People</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(3)=="pages"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connection/discover/pages')?>">Discover Pages</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="list"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connection/list')?>">My Connection</a></li>
        <li class="list-group-item py-0 <?php if($this->uri->segment(2)=="create"){echo "active";}?>"><a class="text-black" href="<?php echo site_url('connection/create')?>">Invite Friends</a></li>
        </ul>

    </div>
    <div class="footer-sidebar">
        <label>Advertesing</label>
    </div>
</nav>
