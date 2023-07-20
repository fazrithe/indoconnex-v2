<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_jobs']); ?>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >

		<span class="d-flex fw-bold mb-3">Discover Find Employee</span>

            <div class="d-flex bg-white mb-3">
                <form action="<?php echo base_url('jobs/employee/filter') ?>" class="row p-2 w-100" method="get" role="form">
                <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <div class="d-flex justify-content-evenly">
                        <div class="input-group input-group-sm border-0 d-flex align-items-center py-1 mx-auto">
                            <span class="input-group-text bg-white border-0" id="basic-addon1">
                                <span class="material-icons text-danger">search</span>
                            </span>
                            <input type="text" class="form-control border border-2 rounded-0" placeholder="Search" aria-label="" aria-describedby="basic-addon1" id="" name="job-name">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span class="d-none d-md-block text-white px-3">Search</span>
                                <span class="material-icons text-white d-block d-md-none">search</span>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex">
						<select name="job-location" id="" class="form-select border-0 fw-semi fs-12">
                            <option value="0">Country</option>
							<?php foreach($countries as $value){
									if($country_name == $value->name){
										echo "<option value='".$value->id."' selected>".$value->name."</option>";
									}else{
										echo "<option value='".$value->id."'>".$value->name."</option>";
									}
                        } ?>
                        </select>
                        <select name="job-type" id="" class="form-select border-0 fw-semi fs-12">
							<option value="0">Select Job Type</option>
                            <?php foreach($jobs_type as $value){
                                echo "<option value='".$value->id."'>".$value->data_name."</option>";
                            } ?>
                        </select>
                        <select name="job-category" id="" class="form-select border-0 fw-semi fs-12">
                            <option value="0">Job Category</option>
                            <?php foreach($jobs_categories as $value){
                                echo "<option value='".$value->id."'>".$value->data_name."</option>";
                            } ?>
                        </select>
						<div class="dropdown">
							<button id="job-salary" type="button" class="btn fw-semi fs-12 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								Job Salary
							</button>
							<ul class="dropdown-menu" aria-labelledby="job-salary">
								<li class="hstack gap-2 py-1 dropdown-item">
									<label for="" class="form-label">Min</label>
									<input type="text" name="salary-min" class="form-control" placeholder="Minimum Salary">
								</li>
								<li class="hstack gap-2 py-1 dropdown-item">
									<label for="" class="form-label">Max</label>
									<input type="text" name="salary-max" class="form-control" placeholder="Maximum Salary">
								</li>
								<li class="gap-2 py-1 dropdown-item">
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="salary-period" id="hourly" value="" autocomplete="off">
                                        <label class="btn btn-outline-monik" for="hourly">Hourly</label>

                                        <input type="radio" class="btn-check" name="salary-period" id="monthly" autocomplete="off" checked>
                                        <label class="btn btn-outline-monik" for="monthly">Monthly</label>

                                        <input type="radio" class="btn-check" name="salary-period" id="annually" autocomplete="off">
                                        <label class="btn btn-outline-monik" for="annually">Annually</label>
                                    </div>
								</li>
							</ul>
						</div>
                    </div>
                </form>
            </div>
            <div class="bg-white container d-flex">
                <div class="col">
                    <div class="justify-content-evenly m-3 d-flex align-text-center">
                        <span class="me-auto text-prussianblue fw-bold">Search Result</span>
                        <span class="ms-auto text-muted">Found <?php echo $total_rows ?> matches</span>
                    </div>

                    <div id="" class="row mb-3">
                        <?php foreach($employee as $value){
                                if($value->users_id != $_SESSION['user_id']){
                        ?>
                        <div class="col-12 col-xs-6 col-md-4 p-2">
                            <div class="card border-1">
                                <div class="card-body text-black">
									<div class="d-flex align-items-center mb-3">
										<div class="flex-shrink-0 d-flex mt-1">
        									<img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'job') ?>" alt="" srcset="" class="work-experience-img">
										</div>
										<div class="d-flex flex-grow-1 ms-3 flex-column">
                                            <a href="<?php echo site_url('job/'.$value->username); ?>"><span class="fw-semi fs-16"><?php echo $value->data_name ?></span></a>
											<span class="text-muted fs-14"><?php echo $value->fullname ?></span>
										</div>
									</div>
                                    <div class="fs-12">
                                        <div><span class="material-icons fs-12 text-gray me-2">place</span>
                                        <?php
                                              if(!empty($value->data_location)){
                                                $loc = json_decode($value->data_location);
                                                foreach($loc as $valuelocation){
                                                echo $valuelocation->city_name;
                                            }
                                        }
                                        ?>
                                        </div>
                                        <div><span class="material-icons fs-12 text-gray me-2">paid</span> IDR <?php echo $value->jb_salary_min ?>-<?php echo $value->jb_salary_max ?>/
                                         <?php foreach($salary_period as $period_val){
                                            if($value->jobs_salary_period_id == $period_val->id){
                                                echo $period_val->data_name;
                                            }
                                        }
                                        ?>
                                    </div>
                                        <div><span class="material-icons fs-12 text-gray me-2">work</span>
                                        <?php foreach($jobs_type as $type_val){
                                            if($value->jobs_types_id == $type_val->id){
                                                echo $type_val->data_name;
                                            }
                                        }
                                        ?>
                                        </div>
                                        <div><span class="material-icons fs-12 text-gray me-2">business</span>
                                        <?php foreach($jobs_categories as $cat_val){
                                            $result = json_decode($value->data_categories);
                                            foreach($result as $value_old){
                                                if($value_old == $cat_val->id){
                                                    echo $cat_val->data_name;
                                                }
                                            }
                                        }
                                        ?></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 bottom-0 me-3 mb-3" data-bs-toggle="button" aria-pressed="false" data-content-type="job" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>

                            </div>
                        </div>
                        <?php }} ?>
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_jobs']); ?>
