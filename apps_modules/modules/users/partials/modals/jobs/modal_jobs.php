<?php foreach($jobs as $value){ ?>
    <form action="<?php echo base_url('jobs/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
    <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
        <div class="modal fade" id="modal_edit_jobs<?php echo $value->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Edit Jobs</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Product/Service
                                    Title Job</label>
                                <input type="text" name="job-name" class="form-control form-control-sm" id="formGroupExampleInput"
                                    placeholder="Input jobs name" value="<?php echo $value->data_name ?>">
                                <input type="hidden" name="job-id" value="<?php echo $value->id ?>">
                            </div>
                            <div class="mb-3">
                                <label for="inputState" class="form-label">Job Type</label>
                                <select id="inputState" name="job-types" class="form-select form-select-sm">
                                        <?php foreach($types as $type_val){
                                            if($type_val->id == $value->jobs_types_id){
                                            echo '<option value="'.$type_val->id.'" selected>'.$type_val->data_name.'</option>';
                                        }else{
                                            echo '<option value="'.$type_val->id.'">'.$type_val->data_name.'</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" name="job-category" for="">Job Category</label>
                                    <select class="js-example-basic-multiple w-100 form-select" name="job-categories[]" multiple>
                                        <?php
                                        $result = json_decode($value->data_categories);
                                        foreach($categories as $cat_val){
                                            $selected = '';
                                            if(in_array($cat_val->id, $result)) {
                                                $selected = 'selected';
                                            };

                                            echo "<option value='$cat_val->id' $selected>$cat_val->data_name</option>";
                                            }
                                        ?>
                                    </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="job-period">Salary Period</label>
                                    <select class="form-select" name="job-period" id="jobPeriod">
                                        <option value="">Select Salary Period</option>
                                            <?php foreach($salary_period as $period_val){
                                                    if($period_id->id == $value->jobs_salary_period_id){
                                                        echo "<option value=".$period_val->id ." selected>".$period_val->data_name."</option>";
                                                    }else{
                                                        echo "<option value=".$period_val->id .">".$period_val->data_name."</option>";
                                                    }
                                                }
                                            ?>
                                    </select>
                            </div>
                            <div class="mb-3">
                                    <label class="form-label" for="currency">Currency</label>
                                    <select class="form-select form-select-sm mb-3" onchange="init_mask_money_jobs(this.value)" name="currency" id="currency">
										<?php foreach($currency as $val_currency){ 
										 	if($value->jb_salary_currency == $val_currency){
												echo "<option value='".$val_currency."' selected>".$val_currency."</option>";
											}else{
												echo "<option value='".$val_currency."'>".$val_currency."</option>";
											}} ?>
                                    </select>
                                </div>
                            <div class="mb-3">
                                <label for="exampleFormControl" class="form-label">Salary Range</label>
                                <div class="hstack d-flex gap-2">
                                <label for="job-min-salary">Min</label>
                                        <input type="text" value="<?php echo $value->jb_salary_min ?>" id="job-min-salary" class="form-control form-control-sm" name="job-min-salary_copy" onkeyup="inputsalary_min()">
                                        <input type="hidden" value="<?php echo $value->jb_salary_min ?>" id="job-min-salary-copy" class="form-control form-control-sm" name="job-min-salary">
                                        <label for="job-max-salary">Max</label>
                                        <input type="text" value="<?php echo $value->jb_salary_max ?>" id="job-max-salary" class="form-control form-control-sm" name="job-max-salary_copy" onkeyup="inputsalary_max()">
                                        <input type="hidden" value="<?php echo $value->jb_salary_max ?>" id="job-max-salary-copy" class="form-control form-control-sm" name="job-max-salary">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea name="job-description" class="form-control form-control-sm" id="exampleFormControlTextarea1"
                                    placeholder="Input description" rows="3"><?php echo $value->data_description ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="">Job Photo</label>
                                <input type="file" class="form-control" name="__logo_files[]" accept="image/*" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="">Job Cover</label>
                                    <input type="file" class="form-control" name="__cover_files[]" id="" accept="image/*" >
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="Submit">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>

<?php foreach($jobs as $value){ ?>
    <form action="<?php echo base_url('jobs/delete') ?>" method="post" role="form" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
        <div class="modal fade" id="deletejobModal" tabindex="-1" aria-labelledby=""
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Are you sure to delete this job?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" name="job-id" value="" id="job-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="Yes">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
