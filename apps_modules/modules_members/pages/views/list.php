<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_pages']); ?>

<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-12 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <span class="d-flex fw-bold mb-3 ms-3 ms-md-0">My Place</span>
				<?php
					if(!empty($business_claims)){
					foreach($business_claims as $value){ ?>
                <div class="d-flex bg-white align-items-center mb-3">
                    <div class="flex-shrink-0 placeholder-glow">
                        <img class="company-logos m-3 rounded-3 border placeholder" data-src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-imgtype="business" alt="">
                    </div>

                    <div class="flex-grow-1 ms-3 flex-column">
                        <h6 class="fw-bold text-prussianblue align-items-center d-flex"><?php echo $value->data_name ?>
                        <?php if (!empty($value->status_verification)) { ?>
                            <span class="ms-2 material-icons text-verified md-16">check_circle</span>
                        <?php }?>
                        </h6>
                        <span class="text-muted"><?php echo $value->bd_address ?></span>
                    </div>
                    <div class="flex-column flex-md-row me-2 d-flex">
                        <div class="flex-shrink-0 ps-auto text-right m-2 d-grid">
							<span class="text-danger">Pending Verification</span>
                        </div>
                    </div>
                </div>
                <?php }} ?>
                <?php
					if(!empty($business_list)) :
					foreach($business_list as $value){ ?>
                <div class="d-flex bg-white align-items-center mb-3">
                    <div class="flex-shrink-0 placeholder-glow">
                        <img class="company-logos m-3 rounded-3 border placeholder" data-src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-imgtype="business" alt="">
                    </div>

                    <div class="flex-grow-1 ms-3 flex-column">
                        <h6 class="fw-bold text-prussianblue align-items-center d-flex"><?php echo $value->data_name ?>
                        <?php if (!empty($value->status_verification)) { ?>
                            <span class="ms-2 material-icons text-verified md-16">check_circle</span>
                        <?php }?>
                        </h6>
                        <span class="text-muted"><?php echo $value->bd_address ?></span>
                    </div>
                    <div class="flex-column flex-md-row me-2 d-flex">
                        <div class="flex-shrink-0 ps-auto text-right m-2 d-grid">
                            <a href="<?php echo site_url('business/about/'.urlencode($value->data_username)) ?>" class="btn btn-danger" role="button">View Profile Page</a>
                        </div>
                        <div class="flex-shrink-0 ps-auto text-right m-2 d-grid">
                            <a href="<?php echo site_url('business/manage/setting/'.$value->id)?>" class="btn btn-light" role="button">Manage Business</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
				<?php else: ?>
					<div class="card-body bg-white border-0">
						<div class="d-flex align-items-center flex-column">
							<div class="mb-3">
								<img src="<?php echo site_url('public/themes/user/images/business/default.png') ?>" alt="no-business">
							</div>
							<div class="mb-3">
								<span class="text-muted ">You do not have any business pages yet</span>
							</div>
							<div class="mb-3">
								<a href="<?php echo site_url('business/create') ?>" class="btn btn-danger">Create Business</a>
							</div>
						</div>
					</div>
				<?php endif;?>
            </div>

        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
