<!-- navbar -->
<?php $this->load->view($template['partials_navbar_business_public']); ?>

<?php if (!empty($jobs)) : ?>
<div class="container mb-4">
    <div class="p-4 bg-white">

    <?php foreach($jobs as $value){ ?>
        <div class="card-body">
            <div class="d-flex bg-white align-items-center mb-3">
                <div class="flex-shrink-0 placeholder-glow">
                    <img data-src="<?php echo base_url()?><?php echo $value->file_path ?><?php echo $value->file_name_original ?>" class="company-logos m-3 rounded-3 border placeholder" data-imgtype="work" alt="">
                </div>
                <div class="flex-grow-1 ms-3 flex-column">
                    <span class="text-black fw-bold fs-14"><?php echo $value->data_name ?></span>
                    <span class="text-muted mb-3 d-flex fw-semi fs-14"><?php echo $value->data_username ?></span>
                    <div class="row row-cols-2">
                        <div class="col hstack text-black fs-14">
                            <span class="material-icons md-16 text-gray me-2">place</span>
                            <?php
                                $result = json_decode($value->data_location);
                                if(!empty($result)){
                                foreach($result as $value_city){
                                    echo $value_city->city_name;
                                }}
                            ?>
                        </div>
                        <div class="col hstack text-black fs-14">
                            <span class="material-icons md-16 text-gray me-2">business</span> General
                        </div>
                        <div class="col hstack text-black fs-14">
                            <span class="material-icons md-16 text-gray me-2">work</span>
                            <?php
                                foreach($jobs_type as $type_val){
                                    if($value->jobs_types_id == $type_val->id){
                                        echo $type_val->data_name;
                                    }
                                }
                            ?>
                        </div>
                        <div class="col hstack text-black fs-14">
                            <span class="material-icons md-16 text-gray me-2" data-currency="IDR" data-low="<?php echo $value->jb_salary_min?>" data-high="<?php echo $value->jb_salary_max?>">monetization_on</span> /
                            <?php
                                foreach($jobs_salary_period as $period_val){
                                    if($value->jobs_salary_period_id == $period_val->id){
                                        echo $period_val->data_name;
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr style="border: 1px solid #007bff;">
        <?php } ?>
    </div>
</div>

<?php else: ?>

<div class="container mb-4">
    <div class="p-4 bg-white">
        <div class="card-body d-flex flex-column align-items-center">
			<img class="mx-auto mb-3 w-100" src="<?php echo site_url('public/themes/user/images/empty/job.png') ?>" alt="no-job-offered">
            <?php if(!empty($checkusers_profile)) { ?>
            <span class="text-mutex fw-semi fs-18 mb-3">You do not have any open job vacancies yet</span>
			<a href="<?php echo site_url('jobs/create/') ?>" class="btn btn-danger mb-3 fw-bold px-4">Create Job</a>
            <?php } else { ?>
                <span class="text-mutex fw-semi fs-18 mb-3"><?php echo $business->data_name ?> does not have any open job vacancies yet</span>
            <?php } ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($jobs)){ ?>
    <?php foreach($jobs as $value){ ?>
<div class="modal fade" id="modal_apply<?php echo $value->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Apply <?php echo $value->data_name ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('jobs/apply') ?>" method="post" role="form" enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="users_id" value="<?php echo $users->id ?>" />
                <input type="hidden" name="job-id" value="<?php echo $value->id ?>" />
                <input type="hidden" name="job-user" value="<?php echo $users_profile->username ?>">
                <div class="form-group">
                    <label class="visually-hidden" for="inputFile">File Upload</label>
                    <input type="file" name="__files" required accept="application/pdf" class="form-control" id="inputFile">
                </div>
					<div class="modal-footer border-top">
						<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
						<button class="btn btn-danger">Send</button>
					</div>
				</form>
            </div>
            </div>
        </div>
    </div>
<?php }} ?>
