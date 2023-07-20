<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_education']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >
            <div class="mb-4 p-4 rounded-3 msn-widget" >
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/community.svg') ?>" class="img-circle" alt="community-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('community/discover') ?>" class="text-prussianblue fw-bold ">Community</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="prod-rand">
                        <?php foreach ($communities as $value){ ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="placeholder-glow business-card position-relative">
                                    <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'community', '16x9') ?>" alt="<?php echo slug(words('$value->data_name', 5)) ?>" class="card-img-top w-100">
                                    <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pcs_communities'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="communities" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body flex-column d-flex placeholder-glow px-3">
                                    <span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
                                        <a class="text-black" href="<?php echo site_url('community/post/'.$value->id)?>"><?php echo $value->data_name ?></a>
                                    </span>
                                    <span class="fs-14 text-muted text-wrap align-items-center d-flex">
                                        <span class="material-icons fs-14 me-1">people</span>
                                        <abbr class="abbrevNum2Str me-1" title="<?php echo total_followers($value->id);?>" ><?php echo total_followers($value->id);?></abbr> Followers
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
			<?php echo $pagination; ?>
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
