<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_community']); ?>

<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <span class="d-flex fw-bold mb-3">My Community</span>
                <?php
				if(!empty($communities_list)):
				foreach($communities_list as $value){ ?>
                <div class="d-flex bg-white align-items-center mb-3">
                    <div class="flex-shrink-0 placeholder-glow">
                        <img class="company-logos placeholder m-3 rounded-3 border" data-src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-imgtype="shopping_bag" alt="">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column">
                        <h6 class="fw-bold text-prussianblue align-items-center d-flex"><?php echo $value->data_name ?>
                        <?php if (!empty($value->status_verification)) { ?>
                            <span class="ms-2 material-icons text-verified md-16">check_circle</span>
                        <?php }?>
                    </h6>
                        <span class="text-muted"><?php echo $total_rows ?> Members</span>
                    </div>
                    <div class="flex-shrink-0 ps-auto text-right mx-2 d-grid">
                        <a href="<?php echo base_url('community/post/') ?><?php echo $value->id ?>" class="btn btn-danger">View Community Profile</a>
                    </div>
                </div>
                <?php }; else: ?>
					<div class="card-body bg-white border-0">
						<div class="d-flex align-items-center flex-column">
							<div class="mb-3">
								<img src="<?php echo site_url('public/themes/user/images/products/default.png') ?>" alt="no-community-service">
							</div>
							<div class="mb-3">
								<span class="text-muted ">You do not have any Community yet</span>
							</div>
						</div>
                        <div class="d-md-flex justify-content-md-center d-grid gap-2 d-md-block">
                            <a href="<?php echo site_url('community/create') ?>" class="btn btn-danger">Create Community</a>
                            <a href="<?php echo site_url('community/discover') ?>" class="btn btn-danger">Join Community</a>
                        </div>
					</div>
				<?php endif ?>
            </div>
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>