<?php $this->load->view($template['partials_sidebar_jobs']); ?>
<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0 g-3">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <span class="d-flex fw-bold mb-3">My Job Preference <?php echo validation_errors(); ?></span>
                <form action="<?php echo base_url('preference_jobs/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">

                <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                <div class="col-12 col-md-6">
                    <div class="card border-0 mb-3 text-prussianblue" >
                        <div class="card-header bg-transparent border-0 pt-3 d-flex">
                            <div class="flex-shrink-0 d-flex">
                                <img src="<?php echo base_url()?>public/themes/user/images/icons/jobs-preference-profile.svg" class="img-circle" alt="">
                            </div>
                            <div class="flex-grow-1 ms-2 d-flex flex-column">
                                <span class="text-prussianblue fw-bold fs-16">Profile</span>
                                <span class="fs-12 text-black">Info you share as Job preference.</span>
                            </div>
                        </div>
                        <div class="card-body fs-12 text-black">
                            <div class="mb-3">
                                <label class="form-label" for="">Job Title</label>
                                <input type="hidden" name="user_id" value="<?php echo $users->id ?>">
                                <input type="hidden" name="job-id" value="<?php echo $jobs->id ?>">
                                <input type="text" name="job-name" class="form-control form-control-sm" required value="<?php echo $jobs->data_name ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" name="job-type" for="">Job Type</label>
                                <select class="form-select form-select-sm" name="job-types" required>
                                    <option value="0">Select Job Type</option>
                                    <?php foreach($jobs_type as $value) {
                                        $selected = '';
                                        if($jobs->jobs_types_id == $value->id){
                                            $selected = 'selected';
                                        }
                                        echo "<option value='".$value->id."' ".$selected.">".$value->data_name."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" name="job-category" for="">Job Category</label>
                                <select class="js-example-basic-multiple w-100 form-select form-select-sm" name="job-categories[]" multiple required>
                                    <?php
                                    $result = json_decode($jobs->data_categories);
                                    foreach($jobs_categories as $value){
                                        $selected = '';
                                        if(in_array($value->id, $result)) {
                                            $selected = 'selected';
                                        };
                                        echo "<option value='$value->id' $selected>$value->data_name</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" name="job-description" for="">Job Description</label>
                                <textarea class="form-control form-control-sm" name="job-description" id="" cols="30" rows="5"><?php echo $jobs->data_description ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="job-period">Salary Period</label>
                                <select class="form-select form-select-sm" name="job-period" id="jobPeriod">
                                    <option value="">Select Salary Period</option>
                                    <?php foreach($salary_period as $value){
                                            if($jobs->jobs_salary_period_id == $value->id){
                                                echo "<option value='".$value->id."' selected>".$value->data_name."</option>";
                                            }else{
                                                echo "<option value='".$value->id."'>".$value->data_name."</option>";
                                            }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="product-currency">Currency</label>
                                    <select class="form-select form-select-sm mb-3" onchange="init_mask_money_jobs(this.value)" name="job-currency" id="job-currency">
                                        <option value="">--Select Currency--</option>
                                        <?php foreach($jobs_currency as $val_currency){ 
										 	if($jobs->jb_currency == $val_currency){
												echo "<option value='".$val_currency."' selected>".$val_currency."</option>";
											}else{
												echo "<option value='".$val_currency."'>".$val_currency."</option>";
											}} ?>
                                    </select>
                                <label class="form-label" name="address" for="job-min-salary">Expected Salary Range</label>
                                <div class="hstack d-flex gap-2">
                                        <label for="job-min-salary">Min</label>
                                        <input type="text" id="job-min-salary" class="form-control form-control-sm" name="job-min-salary_copy" onkeyup="inputsalary_min()" value="<?php echo $jobs->jb_salary_min ?>">
                                        <input type="hidden" id="job-min-salary-copy" class="form-control form-control-sm" name="job-min-salary">
                                        <label for="job-max-salary">Max</label>
                                        <input type="text" id="job-max-salary" class="form-control form-control-sm" name="job-max-salary_copy" onkeyup="inputsalary_max()" value="<?php echo $jobs->jb_salary_max ?>">
                                        <input type="hidden" id="job-max-salary-copy" class="form-control form-control-sm" name="job-max-salary">
                                    </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="">Upload CV</label>
                                <input type="file" class="form-control form-control-sm" name="__files" id="__files" accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <a href="<?php echo site_url('jobs/download_cv/'.$jobs->id) ?>"><span class="text-break"><?php echo $jobs->upload_file_name ?></span></a> - Updated <abbr title="<?php echo carbon_long($jobs->updated_at)?>"><?php echo carbon_human($jobs->updated_at) ?></abbr>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="current" class="form-check-input" id="current" <?php echo ($jobs->status_current_open_work == 1 ? ' checked' : ''); ?> value="1">
                                    <label class="form-check-label" for="current">Lets recruiters know you are open to work</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card border-0 mb-3 text-prussianblue" >
                        <div class="card-header bg-transparent border-0 pt-3 d-flex">
                            <div class="flex-shrink-0 d-flex">
                                <img src="<?php echo base_url()?>public/themes/user/images/icons/job-preference-location.svg" class="img-circle" alt="">
                            </div>
                            <div class="flex-grow-1 ms-2 d-flex flex-column">
                                <span class="text-prussianblue fw-bold fs-16">Profile</span>
                                <span class="fs-12 text-black">Your Job preference location.</span>
                            </div>
                        </div>
                        <div class="card-body fs-12 text-black">
                            <div class="mb-3">
                                <label class="form-label" for="selCountry">Job Country</label>
                                <select class="form-select job-country" name="job-country" id="selCountry" required >
                                    <?php if(empty($country)){
                                        echo "<option value=''>Select State</option>";
                                    }else{
                                        echo "<option value='".$country->id."' selected>".$country->name."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="selState">Job State / Region</label>
                                <select class="form-select form-select-sm" name="job-state" id="selState" required>
                                    <?php if(empty($state)){
                                        echo "<option value=''>Select State</option>";
                                    }else{
                                        echo "<option value='".$state->id."' selected>".$state->name."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="selCity">Job City / Regency</label>
                                <select class="form-select form-select-sm" name="job-city" id="selCity" required>
                                    <?php if(empty($city)){
                                        echo "<option value=''>Select State</option>";
                                    }else{
                                        echo "<option value='".$city->id."' selected>".$city->name."</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>

                </div>

                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_jobs']); ?>
