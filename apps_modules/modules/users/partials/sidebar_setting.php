 <!-- Sidebar  -->
 <nav id="sidebar" class="clean position-md-fixed d-none d-md-block">
    <div class="overflow-auto mt-4">
        <ul class="list-unstyled">
            <li>
                <a href="#"><b>Settings</b></a>
            </li>
            <?php if(!empty($users->password)){ ?>
            <li>
                <a href="<?php echo site_url('setting/general/'.$this->session->userdata('username')) ?>" class="<?php if($this->uri->segment(2)=="general"){echo "active";}?> d-flex flex-row align-items-center">
					<span class="material-icons fs-14">settings</span>
					<span class="text-black ms-3"> General</span>
				</a>
            </li>
            <li>
				<a href="<?php echo site_url('profile/setting/'.$this->session->userdata('username')) ?>" class="<?php if($this->uri->segment(2)=="setting"){echo "active";}?> d-flex flex-row align-items-center">
					<span class="material-icons fs-14">person</span>
					<span class="text-black ms-3"> Edit Profile</span>
				</a>
            </li>
            <li>
                <a href="<?php echo site_url('setting/security/'.$this->session->userdata('username')) ?>" class="<?php if($this->uri->segment(2)=="security"){echo "active";}?> d-flex flex-row align-items-center">
					<span class="material-icons fs-14">lock</span>
					<span class="text-black ms-3"> Security & Login</span>
				</a>
            </li>
            <li>
                <a href="<?php echo site_url('setting/privacy/'.$this->session->userdata('username')) ?>" class="<?php if($this->uri->segment(2)=="privacy"){echo "active";}?> d-flex flex-row align-items-center">
					<span class="material-icons fs-14">shield</span>
					<span class="text-black ms-3"> Privacy Setting & Tools</span>
				</a>
            </li>
            <?php }else{ ?>
            <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#notifpass" class="<?php if($this->uri->segment(2)=="general"){echo "active";}?>"><span class="material-icons-outlined">settings</span><span class="text-black"> General</span></a>
            </li>
            <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#notifpass" class="<?php if($this->uri->segment(2)=="setting"){echo "active";}?>"><span class="material-icons">person</span><span class="text-black"> Edit Profile</span></a>
            </li>
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#notifpass" class="<?php if($this->uri->segment(2)=="security"){echo "active";}?>"><span class="material-icons">lock</span><span class="text-black"> Security & Login</span></a>
            </li>
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#notifpass" class="<?php if($this->uri->segment(2)=="privacy"){echo "active";}?>"><span class="material-icons fs-14">shield</span>><span class="text-black"> Privacy Setting & Tools</span></i></a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="footer-sidebar">
        <!-- <label>Advertesing</label> -->
    </div>
</nav>

<nav class="d-flex d-md-none offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-evenly mb-3">
        <a href="#"><b>Settings</b></a>
    </div>
    <div class="offcanvas-body fw-bold">
        <ul class="list-unstyled">
        <?php if(!empty($users->password)){ ?>
        <li class="mb-2">
            <a href="<?php echo site_url('setting/general/'.$this->session->userdata('username')) ?>" class="<?php if($this->uri->segment(3)=="general"){echo "active";}?>"><span class="material-icons-outlined">settings</span><span class="text-black"> General</span></a>
        </li>
        <li class="mb-2">
        <a href="<?php echo site_url('profile/setting/'.$this->session->userdata('username')) ?>" class="<?php if($this->uri->segment(3)=="setting"){echo "active";}?>"><span class="material-icons">person</span><span class="text-black"> Edit Profile</span></a>
        </li>
        <li class="mb-2">
            <a href="<?php echo site_url('setting/security/'.$this->session->userdata('username')) ?>" class="<?php if($this->uri->segment(3)=="security"){echo "active";}?>"><span class="material-icons">lock</span><span class="text-black"> Security & Login</span></a>
        </li>
        <li class="mb-2">
            <a href="<?php echo site_url('setting/privacy/'.$this->session->userdata('username')) ?>" class="<?php if($this->uri->segment(3)=="privacy"){echo "active";}?>"><span class="material-icons fs-14">shield</span>><span class="text-black"> Privacy Setting & Tools</span></i></a>
        </li>
        <?php }else{ ?>
        <li class="mb-2">
        <a href="#" data-bs-toggle="modal" data-bs-target="#notifpass" class="<?php if($this->uri->segment(3)=="general"){echo "active";}?>"><span class="material-icons-outlined">settings</span><span class="text-black"> General</span></a>
        </li>
        <li class="mb-2">
        <a href="#" data-bs-toggle="modal" data-bs-target="#notifpass" class="<?php if($this->uri->segment(3)=="setting"){echo "active";}?>"><span class="material-icons">person</span><span class="text-black"> Edit Profile</span></a>
        </li>
        <li class="mb-2">
            <a href="#" data-bs-toggle="modal" data-bs-target="#notifpass" class="<?php if($this->uri->segment(3)=="security"){echo "active";}?>"><span class="material-icons">lock</span><span class="text-black"> Security & Login</span></a>
        </li>
        <li class="mb-2">
            <a href="#" data-bs-toggle="modal" data-bs-target="#notifpass" class="<?php if($this->uri->segment(3)=="privacy"){echo "active";}?>"><span class="material-icons fs-14">shield</span>><span class="text-black"> Privacy Setting & Tools</span></i></a>
        </li>
        <?php } ?>
        </ul>
    </div>
    <div class="footer-sidebar">
        <!-- <label>Advertesing</label> -->
    </div>
</nav>

<div class="modal fade" id="notifpass" aria-labelledby="albumslabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p><b>Password cannot be empty</b></p>
            </div>
        <div class="modal-footer border-top">
            <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
        </div>
        </form>
        </div>
    </div>
</div>
