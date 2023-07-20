<?php $this->load->view($template['partials_sidebar_jobs']); ?>
<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                    <select name="businessSelector" onchange="selectUserjobs(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                        <option value="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
                        <?php foreach($business_list as $value){ ?>
                        <option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business') ?>" class=""><?php echo $value->data_name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <span class="d-flex fw-bold mb-3">Edit Job <?php echo validation_errors(); ?></span>
                <form action="<?php echo base_url('jobs/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
                <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <input type="hidden" id="select_user_id" name="select_user_id">
                    <input type="hidden" id="select_business_id_jobs" name="select_business_id">
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-white border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/jobs-profile.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Profile</span>
                                    <span class="fs-12 text-black">Info you share to your job posting profile</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" for="">Job Title</label>
                                    <input type="hidden" name="user_id" value="<?php echo $users->id ?>">
                                    <input type="hidden" name="job-id" value="<?php echo $job->id ?>">
                                    <input type="text" name="job-name" value="<?= $job->data_name; ?>" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="job-type" for="">Job Type</label>
                                    <select class="form-select form-select-sm" name="job-types" required>
                                        <?php 
                                            foreach($jobs_type as $value) { 
                                                $selected = '';

                                                if ($value->id == $job->jobs_types_id) {
                                                    $selected = 'selected';
                                                }
                                        ?>

                                            <option value="<?php echo $value->id ?>" <?= $selected ?>><?php echo $value->data_name ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="job-category" for="">Job Category</label>
                                    <select class="js-example-basic-multiple w-100 form-select form-select-sm" name="job-categories[]" multiple required>
                                    <?php 
                                        $user_job_categories = json_decode($job->data_categories);

                                        foreach ($jobs_categories as $value) {
                                            $selected = '';

                                            if (in_array($value->id, $user_job_categories)) {
                                                $selected = 'selected';
                                            }

                                            echo "<option value='$value->id' $selected>$value->data_name</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="job-description" for="">Job Description</label>
                                    <textarea class="form-control form-control-sm" name="job-description" id="" cols="30" rows="5"><?= $job->data_description; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="job-period">Salary Period</label>
                                    <select class="form-select form-select-sm" name="job-period" id="jobPeriod">
                                        <?php 
                                            foreach($salary_period as $value) { 
                                                $selected = '';

                                                if ($value->id == $job->jobs_salary_period_id) {
                                                    $selected = 'selected';
                                                }
                                        ?>
                                            <option value="<?php echo $value->id ?>" <?= $selected ?>><?php echo $value->data_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="currency">Currency</label>
                                    <select class="form-select form-select-sm mb-3" onchange="init_mask_money_jobs(this.value)" name="currency" id="currency" required>
                                        <option value="USD" <?= $job->jb_salary_currency == 'USD' ? 'selected' : ''; ?>>USD</option>
                                        <option value="IDR" <?= $job->jb_salary_currency == 'IDR' ? 'selected' : ''; ?>>IDR</option>
                                        <option value="AUD" <?= $job->jb_salary_currency == 'AUD' ? 'selected' : ''; ?>>AUD</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="address" for="">Salary Range</label>
                                    <div class="hstack d-flex gap-2">
                                        <label for="job-min-salary">Min</label>
                                        <input type="text" id="job-min-salary" class="form-control form-control-sm" name="job-min-salary_copy" value="<?= $job->jb_salary_min; ?>" onkeyup="inputsalary_min()">
                                        <input type="hidden" id="job-min-salary-copy" class="form-control form-control-sm" name="job-min-salary" value="<?= $job->jb_salary_min; ?>">
                                        <label for="job-max-salary">Max</label>
                                        <input type="text" id="job-max-salary" class="form-control form-control-sm" name="job-max-salary_copy" value="<?= $job->jb_salary_max; ?>" onkeyup="inputsalary_max()">
                                        <input type="hidden" id="job-max-salary-copy" value="<?= $job->jb_salary_max; ?>" class="form-control form-control-sm" name="job-max-salary">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Job Photo</label>
                                    <input type="file" class="form-control form-control-sm" name="__logo_files[]" accept="image/*" onchange="loadJobPhotoFile(event)" />
                                </div>
                                <div id="previewJobPhotoContainer" class="mb-3 d-none">
                                    <div>Preview Job Photo:</div>
                                    <img class="img-fluid" />
                                </div>
                                <div class="mb-3">
                                    <div>Current Job Photo:</div>
                                    <img class="img-fluid" src="<?php echo placeholder($job->file_path, $job->file_name_original); ?>" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Job Cover</label>
                                    <input type="file" class="form-control form-control-sm" name="__cover_files[]"  accept="image/*" onchange="loadJobCoverFile(event)" />
                                </div>
                                <div id="previewJobCoverContainer" class="mb-3 d-none">
                                    <div>Preview Job Cover:</div>
                                    <img class="img-fluid" />
                                </div>
                                <div class="mb-3">
                                    <div>Current Job Cover:</div>
                                    <img class="img-fluid" src="<?php echo placeholder($job->cover_file_path, $job->cover_file_name_original); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-white border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/jobs-location.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Location</span>
                                    <span class="fs-12 text-black">Your job posting location</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" name="address" for="">Job Address</label>
                                    <input type="text" class="form-control form-control-sm" name="job-address" value="<?= $job->jb_address; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selCountry">Job Country</label>
                                    <select class="form-select form-select-sm job-country" name="job-country" id="selCountry" required >
                                        <option value="<?php echo $country->id ?>"><?php echo $country->name ?></option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selState">Job State / Region</label>
                                    <select class="form-select form-select-sm" name="job-state" id="selState" required>
                                        <option value="<?php echo $state->id ?>"><?php echo $state->name ?></option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selCity">Job City / Regency</label>
                                    <select class="form-select form-select-sm" name="job-city" id="selCity" required>
                                        <option value="<?php echo $city->id ?>"><?php echo $city->name ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-white border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/jobs-contact.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Profile</span>
                                    <span class="fs-12 text-black">You job posting contact information</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" for="">Email</label>
                                    <input type="email" class="form-control form-control-sm" name="job-email" value="<?= $job->jb_contact_email; ?>" required>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Phone</label>
                                    <input type="nunber" class="form-control form-control-sm" name="job-number" value="<?= $job->jb_contact_number; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">Update Job</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_jobs']); ?>

<script>
    const loadJobPhotoFile = function(event) {
        $('#previewJobPhotoContainer').removeClass('d-none');
        var output = document.getElementById('previewJobPhotoContainer').children[1];
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
    };

    const loadJobCoverFile = function(event) {
        $('#previewJobCoverContainer').removeClass('d-none');
        var output = document.getElementById('previewJobCoverContainer').children[1];
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
    };
    
    var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
    var csrfHash = $(".txt_csrfname").val(); // CSRF hash

    $(function() {
		const country_id = $("#selCountry").val();
		const state_id = $("#selState").val();

        $("#selCountry").trigger('change.select2', mountState(country_id));

        $("#selCity").trigger('change.select2', mountCity(state_id));

	});

    function mountState(country_id) {
        $("#selState").select2({
			theme: "bootstrap5",
			ajax: {
				url: '<?php echo site_url('api/state/');?>' + country_id,
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term,
						[csrfName]: csrfHash
					};
				},
				processResults: function(response) {
					$(".txt_csrfname").val(response.token);
					return {
						results: response.response
					};
				},
				cache: true
			}
		});
    }

    function mountCity(state_id) {
        $("#selCity").select2({
			theme: "bootstrap5",
			ajax: {
				url: '<?php echo site_url('api/city/');?>' + state_id,
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term,
						[csrfName]: csrfHash
					};
				},
				processResults: function(response) {
					$(".txt_csrfname").val(response.token);
					return {
						results: response.response
					};
				},
				cache: true
			}
		});
    }
</script>
