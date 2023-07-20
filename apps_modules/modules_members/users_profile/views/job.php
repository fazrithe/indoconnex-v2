<!-- navbar -->
<?php $this->load->view($template['partials_navbar_user']); ?>

<?php if(empty($users_profile->status_privacy) || !empty($checkusers_profile)) { ?>
<?php if (!empty($jobs)) : ?>
<div class="container px-1">
<?php if($checkusers_profile){?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <span class="text-prussianblue fw-bold fs-16 mb-3">Job Preference</span>
                <div class="col-md-6 flex-column d-flex">
                    <button class="rounded-pill btn btn-danger ms-2 fs-12 fw-bold mb-2 me-auto">Open to Work</button>
                    <span class="text-black fs-14 text-break ms-2 mb-3">
                       <?php echo $users_jobs->data_description ?>
                    </span>

                    <span class="hstack ms-2">
                        <button class="btn btn-prussianblue fs-14 fw-bold me-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#modal_cv<?php echo $users_jobs->id ?>">View CV</button>
                        <a href="<?php echo site_url('jobs/preference')?>" class="btn btn-prussianblue fs-14 fw-bold px-3 py-2">Manage Preference</a>
                    </span>
                </div>
                <div class="col-md-6">
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <span class="text-gray d-flex flex-row align-items-start">
                                <span class="material-icons md-18 me-3">badge</span>
                                <div class="d-flex flex-column">
                                    <span class="fs-12 fw-bold">Job Title</span>
                                    <span class="text-black fs-14"><?php echo $users_jobs->data_name ?></span>
                                </div>
                            </span>
                        </div>
                        <div class="col">
                            <span class="text-gray d-flex flex-row align-items-start">
                                <span class="material-icons md-18 me-3">monetization_on</span>
                                <div class="d-flex flex-column">
                                    <span class="fs-12 fw-bold">Salary Periode</span>
                                    <span class="text-black fs-14">
                                    <?php
                                        foreach($jobs_salary_period as $period_val){
                                            if($users_jobs->jobs_salary_period_id == $period_val->id){
                                                echo $period_val->data_name;
                                            }
                                        }
                                    ?>
                                    </span>
                                    <span class="fs-12 fw-bold">Expected Salary Range</span>
                                    <!-- <span id="job-salary" class="text-black fs-14 placeholder" data-currency="IDR" data-low="1<?php echo $users_jobs->jb_salary_min?>" data-high="<?php echo $users_jobs->jb_salary_max?>"> -->
                                    <?php echo $users_jobs->jb_salary_min?> - <?php echo $users_jobs->jb_salary_max?>
                                    <!-- </span> -->
                                </div>
                            </span>
                        </div>
                        <div class="col">
                            <span class="text-gray d-flex flex-row align-items-start">
                                <span class="material-icons md-18 me-3">work</span>
                                <div class="d-flex flex-column">
                                    <span class="fs-12 fw-bold">Job Type</span>
                                    <span class="text-black fs-14">  <?php
                                        foreach($jobs_type as $type_val){
                                            if($users_jobs->jobs_types_id == $type_val->id){
                                                echo $type_val->data_name;
                                            }
                                        }
                                    ?></span>
                                </div>
                            </span>
                        </div>
                        <div class="col">
                            <span class="text-gray d-flex flex-row align-items-start">
                                <span class="material-icons md-18 me-3">location_on</span>
                                <div class="d-flex flex-column">
                                    <span class="fs-12 fw-bold">City</span>
                                    <span class="text-black fs-14">
                                    <?php
                                        $result = json_decode($users_jobs->data_location);
                                        if(!empty($result)){
                                        foreach($result as $value_city){
                                            echo $value_city->city_name;
                                        }}
                                    ?>
                                    </span>
                                    <span class="fs-12 fw-bold">Country</span>
                                    <span class="text-black fs-14">
                                    <?php
                                        $result = json_decode($users_jobs->data_location);
                                        if(!empty($result)){
                                        foreach($result as $value_country){
                                            echo $value_country->country_name;
                                        }}
                                    ?>
                                    </span>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php foreach($jobs as $value){ ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex flex-md-row flex-column bg-white align-items-center mb-3">
                <div class="flex-shrink-0 placeholder-glow">
                    <img data-src="<?php echo base_url()?><?php echo $value->file_path ?><?php echo $value->file_name_original ?>" class="company-logos m-3 rounded-3 border placeholder" data-imgtype="work" alt="">
                </div>
                <div class="flex-grow-1 ms-3 flex-column">
                    <span class="text-black fw-bold fs-14"><?php echo $value->data_name ?></span>
                    <span class="text-muted mb-3 d-flex fw-semi fs-14"><?php echo $value->username ?></span>
                    <div class="row row-cols-1 row-cols-md-2">
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
                <div class="d-flex">
                    <div class="flex-shrink-0 ps-auto text-right m-2">
                        <?php if($checkusers_profile){ ?>
                        <a href="<?php echo site_url('jobs/manage')?>" class="btn btn-prussianblue" role="button">Manage Job</a>
                        <a href="<?php echo site_url('jobs/applicant')?>" class="btn btn-prussianblue" role="button">View Applicant</a>
                        <?php } ?>
                        <?php if(!$checkusers_profile){
                            if(empty(check_apply($value->id))){
                                echo "<a href='#' class='btn btn-primary px-4' role='button' data-bs-toggle='modal' data-bs-target='#modal_apply".$value->id."'>Apply Now</a>";
                            }
                        } ?>
                    </div>
                </div>
            </div>
        
    </div>
</div>
<?php } ?>
</div>
<?php else: ?>
<div class="container px-1">
    <div class="p-4 bg-white">
        <div class="card-body d-flex flex-column align-items-center">
			<img class="mx-auto mb-3 w-100" src="<?php echo base_url()?>public/themes/user/images/empty/job.png" alt="no-job-offered">
            <?php if(!empty($checkusers_profile)) { ?>
            <span class="text-mutex fw-semi fs-18 mb-3">You do not have any open job vacancies yet</span>
			<a href="<?php echo site_url('jobs/create/') ?>" class="btn btn-danger mb-3 fw-bold px-4">Create Job</a>
            <?php } else { ?>
                <span class="text-mutex fw-semi fs-18 mb-3"><?php echo $users_profile->name_first ?> does not have any open job vacancies yet</span>
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
                    <label class="form-label" for="inputFile">Upload CV</label>
                    <input type="file" name="__files" accept="application/pdf" class="form-control" id="inputFile">
                </div><br>
                <div class="form-group">
                    <label class="form-label" for="description">Make your Pitch! (Recommended)</label>
                    <textarea name="description" class="form-control"></textarea>
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

<?php if(!empty($checkusers_profile)) { ?>
<div class="modal fade" id="modal_cv<?php echo $users_jobs->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">CV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <embed type="application/pdf" src="<?php echo base_url()?><?php echo $users_jobs->upload_file_path ?><?php echo $users_jobs->upload_file_name ?>" width="480" height="400"></embed>

            </div>
        </div>
    </div>
<?php } ?>

<?php } else { ?>
    <div class="container mb-4">
        <div class="row">
            <div class="col mx-auto">
                <div class="mb-4 rounded-3 msn-widget">
                    <div class="text-center p-md-4 p-2">
                        This account is Private
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
