<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_jobs_public']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >

            <span class="d-flex fw-bold mb-3">Discover Job Page</span>

            <div class="d-flex bg-white mb-3">
                <form action="<?php echo base_url('public/jobs/discover/filter') ?>" class="row p-2 w-100" method="get" role="form">
                <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <div class="d-flex justify-content-evenly">
                        <div class="input-group input-group-sm border-0 d-flex align-items-center py-1 mx-auto">
                            <span class="input-group-text bg-white border-0" id="basic-addon1">
                                <span class="material-icons text-danger">search</span>
                            </span>
                            <input type="text" class="form-control border-end-2 border-start-0 border-top-0 border-bottom-0 border border-2 rounded-0" placeholder="Search" aria-label="" aria-describedby="basic-addon1" id="" name="job-name">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span class="d-none d-md-block text-white px-3">Search</span>
                                <span class="material-icons text-white d-block d-md-none">search</span>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex flex-md-row flex-column gap-2">
                        <select name="job-type" id="job-type" class="form-select border-0 fw-semi fs-12">
							<option value="">Select Job Type</option>
                            <?php foreach($jobs_type as $value){
                                echo "<option value='".$value->id."'>".$value->data_name."</option>";
                            } ?>
                        </select>
                        <select name="job-category" id="job-category" class="form-select border-0 fw-semi fs-12">
                            <option value="">Job Category</option>
                            <?php foreach($jobs_categories as $value){
                                echo "<option value='".$value->id."'>".$value->data_name."</option>";
                            } ?>
                        </select>
						<div class="dropdown rounded-2 ps-1" style="border: 1px solid rgba(73, 80, 87, .5); -webkit-background-clip: padding-box; background-clip: padding-box;">
							<button id="job-salary" type="button" class="p-0 text-start w-100 col-12 btn fw-normal opacity-50 fs-15 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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

                        <select name="job-location" id="job-location" class="form-select border-0 fw-semi fs-12">
                            <option value="">Country</option>
                            <?php foreach($countries as $value){
                                echo "<option value='".$value->id."'>".$value->name."</option>";
                            } ?>
                        </select>
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
                        <?php foreach($jobs as $value){ ?>
                        <div class="col-12 col-xs-6 col-md-4" >
                            <div class="card border-1">
                                <div class="card-body text-black">
									<div class="d-flex align-items-center mb-3">
										<div class="flex-shrink-0 d-flex mt-1">
											<img src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" class="work-experience-img"  id="" alt="Job Directory">
										</div>
										<div class="d-flex flex-grow-1 ms-3 flex-column">
											<a href="<?php echo site_url('public/jobs/detail/'.$value->id); ?>"><span class="fw-semi fs-16"><?php echo $value->data_name ?></span></a>
										</div>
                                        <button type="button" class="btn btn-favourite ms-auto fs-18 text-danger bg-light rounded-circle p-2 <?php echo active_favourite($value->id,'pcj_jobs'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="jobs" data-content-id="<?php echo $value->id ?>" autocomplete="off">
                                        </button>
									</div>
                                    <div class="d-flex">
                                        <span class="text-muted" style="font-size: .700rem !important;">
                                        post by: <br />
                                        <?php echo mb_strimwidth($value->fullname, 0, 25, "...") ?> <span class="material-icons mx-2 text-verified align-middle" style="font-size: 14px;">check_circle</span></span>
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
                                        <div><span class="material-icons fs-12 text-gray me-2">paid</span> <?php echo $value->jb_salary_currency ?> <?php echo number_format($value->jb_salary_min,2,",","."); ?>-<?php echo number_format($value->jb_salary_max,2,",","."); ?>/Hours</div>
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
                                                if(!empty($value->data_categories)){
                                                $result = json_decode($value->data_categories);
                                                foreach($result as $value_old){
                                                    if($value_old == $cat_val->id){
                                                        echo $cat_val->data_name;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- <div id="listdatajob"></div> -->
                    </div>
	                    <?php echo $pagination; ?>
                </div>
            </div>

        </div>

    </div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_jobs']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
