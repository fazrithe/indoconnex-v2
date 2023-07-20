<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_jobs']); ?>

<!-- Page Content  -->
<main class="py-4">
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                <select name="businessSelector" onchange="selectFilterjobs(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                <option value="1" data-id="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
                    <?php foreach($business_list as $value) {
                        $selected = '';
                    ?>
						<?php if ($filter_id == $value->id) $selected = 'selected'; ?>
                        <option value="<?php echo $value->id ?>"
                            data-id="<?php echo $value->id ?>"
                            data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class="" <?php echo $selected?> data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $value->data_name ?>">
                                <?php echo $value->data_name ?>
                        </option>

                    <?php } ?>
                </select>
            </div>
            <span class="d-flex fw-bold mb-3">My Jobs Page</span>
            <?php if(empty($jobs)){ ?>
            <div class="row mt-4 bg-white mb-4 align-items-center">
                <div class="d-flex flex-column align-items-center">
                    <img class="mx-auto mb-3 w-100" src="<?php echo base_url() ?>public/themes/user/images/empty/jobs.png" alt="no-jobs">
                    <?php if(!empty($checkusers_profile)) { ?>
                    <span class="text-mutex fw-semi fs-18 mb-3">You do not have any Jobs yet</span>
                    <?php } else { ?>
                        <span class="text-mutex fw-semi fs-18 mb-3"> do not have any Jobs yet</span>
                        <div class="flex-row">
                            <a href="<?php echo site_url('jobs/create')?>" class="btn btn-danger mb-3 fw-bold px-4">Create Job</a>
                        </div>
                    <?php } ?>
				</div>
            </div>
            <?php } ?>
            <?php foreach($jobs as $value){ ?>
            <div class="d-flex bg-white align-items-center mb-3">
                <div class="flex-shrink-0 placeholder-glow">
                    <img class="company-logos m-3 rounded-3 border placeholder" data-src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-imgtype="work" alt="">
                </div>
                <div class="flex-grow-1 ms-3 flex-column">
                    <span class="fw-bold text-prussianblue align-items-center d-flex fs-16"><?php echo $value->data_name ?></span>
                    <span class="text-muted fw-semi fs-14"><?php echo $value->fullname?></span>
                </div>
                <div class="flex-shrink-0 ps-auto text-right mx-2 d-grid">
                    <a href="<?php echo site_url('jobs/detail/'.$value->id); ?>" class="btn btn-danger fs-14 fw-bold" role="button">View Job Detail</a>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
    <?php echo $pagination; ?>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_jobs']); ?>
