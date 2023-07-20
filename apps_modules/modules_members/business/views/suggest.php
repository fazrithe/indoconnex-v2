<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_business']); ?>

<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <span class="d-flex fw-bold mb-3">Create Suggestion</span>
                <form action="<?php echo base_url('business/profile/suggest') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">

                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/business-profile.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Profile</span>
                                    <span class="fs-12 text-black">Info you share to your business profile.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" for="">Business Username</label>
                                    <input type="hidden" name="user_id" value="<?php echo $users->id ?>">
                                    <input type="hidden" name="business-id" value="<?php echo $business->id ?>">
									<input type="hidden" name="status_page" value="<?php echo $business->status_page ?>">
                                    <input type="text" name="business-username" class="form-control form-control-sm" value="<?php echo $business->data_username ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Business Name</label>
                                    <input type="text" name="business-name" class="form-control form-control-sm"  value="<?php echo $business->data_name ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="business-type" for="">Business Type</label>
                                    <select class="form-select form-select-sm" name="business-types[]">
                                    <?php
                                    $result = json_decode($business->data_types);
                                    foreach($types as $value){
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
                                    <label class="form-label" name="business-category" for="">Business Category</label>
                                    <select class="js-example-basic-multiple w-100 form-control form-control-sm" name="business-categories[]" multiple="multiple">
                                    <?php
                                    $result = json_decode($business->data_categories);
                                    foreach($categories as $value){
                                        $selected = '';
                                        if(in_array($value->id, $result)) {
                                            $selected = 'selected';
                                        };

                                        echo "<option value='$value->id' $selected >$value->data_name</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Business Description</label>
                                    <textarea class="form-control form-control-sm" name="business-description" id="" cols="30" rows="5"><?php echo $business->data_description ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Business Logo</label>
                                    <input type="file" class="form-control form-control-sm" name="__logo_files[]" id="" accept="image/*" >
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Business Cover</label>
                                    <input type="file" class="form-control form-control-sm" name="__cover_files[]" id="" accept="image/*" >
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/business-location.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Location</span>
                                    <span class="fs-12 text-black">Your business location.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">

                                <div class="mb-3">
                                    <label class="form-label" for="">Business Address</label>
                                    <input type="text" class="form-control form-control-sm" name="business-address" value="<?php echo $business->bd_address ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selCountry">Business Country</label>
                                    <select class="form-select form-select-sm business-country" name="business-country" id="selCountry" >
                                        <option value="<?php echo $country->id ?>"><?php echo $country->name ?></option>
                                    </select>
                                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selState">Business State / Region</label>
                                    <select class="form-select form-select-sm" name="business-state" id="selState">
                                    <option value="<?php echo $state->id ?>"><?php echo $state->name ?></option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selCity">Business City / Regency</label>
                                    <select class="form-select form-select-sm" name="business-city" id="selCity">
                                    <option value="<?php echo $city->id ?>"><?php echo $city->name ?></option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="zipCode">Postal Code</label>
                                    <input type="text" class="form-control form-control-sm" name="zip-code" value="<?php echo $business->bd_address_zipcode ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Google Maps Embed Link</label>
                                    <input type="text" class="form-control form-control-sm" name="maps" id="inputMaps" placeholder="" value="<?php echo $business->bd_maps ?>" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/business-location.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Contact Info</span>
                                    <span class="fs-12 text-black">Your business contact information.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" for="">Phone Number</label>
                                    <input type="text" class="form-control form-control-sm" name="business-phone"  value="<?php echo $business->bd_phone ?>" placeholder="+62 21 80989999">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Business Email</label>
                                    <input type="text" class="form-control form-control-sm" name="business-email"  value="<?php echo $business->bd_email ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/business-location.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Detailed Info</span>
                                    <span class="fs-12 text-black">More detailed information about your business.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" name="business-open" for="">Work Day</label>
                                    <?php
                                    $resultday = json_decode($business->bd_hours_work);
                                    $day_const  = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

                                    foreach($day_const as $key2 => $val2){
                                    ?>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"  name="day[]" value="<?php echo $val2 ?>" aria-expanded="true" id="flexSwitchCheck<?php echo $val2 ?>" data-bs-toggle="collapse" data-bs-target="#work<?php echo $val2 ?>">
                                                <label class="form-check-label" for="flexSwitchCheck<?php echo $val2 ?>"><?php echo $val2 ?></label>
                                            </div>
                                        </div>
                                        <div class="col-8 collapse collapse-horizontal justify-content-evenly hstack" id="work<?php echo $val2 ?>">
                                            <input type="time" name="start[]" value="" class="form-time" id="work<?php echo $val2 ?>Start" placeholder="hh:mm">
                                            <hr class="mx-2 my-1 d-flex border border-dark ">
                                            <input type="time" name="end[]" value="" class="form-time" id="work<?php echo $val2 ?>End" placeholder="hrs:mins">
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="">Facility</label>
                                    <select class="js-example-basic-multiple w-100 form-control form-control-sm" name="business-facility[]" multiple="multiple">
                                    <?php
                                    $result = json_decode($business->data_facilities);
                                    foreach($facilities as $value){
                                        $selected = '';
                                        if(in_array($value->id, $result)) {
                                            $selected = 'selected';
                                        };

                                        echo "<option value='$value->id' $selected>$value->data_name</option>";
                                        }
                                    ?>
                                    </select>
                                    <!-- <textarea name="business-facility" id="" cols="30" rows="5" class="form-control form-control-sm"><?php echo $business->data_facilities ?></textarea> -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="label-team" for="business-team">Number of Team/Staff</label>
                                    <select name="business-team" id="business-team" class="form-select form-select-sm">
                                        <option value="0" <?php echo $business->bd_team_number = 0 ? 'selected' : ''; ?>>Self-Employeed</option>
                                        <option value="1" <?php echo $business->bd_team_number = 1 ? 'selected' : ''; ?>>1-10 Employees</option>
                                        <option value="2" <?php echo $business->bd_team_number = 2 ? 'selected' : ''; ?>>11-50 Employees</option>
                                        <option value="3" <?php echo $business->bd_team_number = 3 ? 'selected' : ''; ?>>51-200 Employees</option>
                                        <option value="4" <?php echo $business->bd_team_number = 4 ? 'selected' : ''; ?>>201-500 Employees</option>
                                        <option value="5" <?php echo $business->bd_team_number = 5 ? 'selected' : ''; ?>>501-1000 Employees</option>
                                        <option value="6" <?php echo $business->bd_team_number = 6 ? 'selected' : ''; ?>>1001-5000 Employees</option>
                                        <option value="7" <?php echo $business->bd_team_number = 7 ? 'selected' : ''; ?>>5001-10000 Employees</option>
                                        <option value="8" <?php echo $business->bd_team_number = 8 ? 'selected' : ''; ?>>10001+ Employees</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="" for="">Payment Method</label>
                                    <select name="business-pyment" id="" class="form-select form-select-sm">
                                        <option value="0">Select Payment Method</option>
                                        <option value="web">Checkout on Website</option>
                                        <option value="wa">Contact via Whatsapp</option>
                                        <option value="phone">Contact via Phone</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-sm btn-danger mb-3">Submit</button><br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>
    <div class="modal fade" id="modal_delete_business<?php echo $business->id ?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
					<h3 class="modal-title" id="myModalLabel">Delete Work Experience</h3>
				</div>
				<form action="<?php echo base_url('business/delete') ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="profile/setting" />
					<div class="modal-body">
						<p>Are you sure you want to delete <b><?php echo $business->data_name;?></b></p>
					</div>
					<div class="modal-footer border-top">
						<input type="hidden" name="business_id" value="<?php echo $business->id; ?>">
						<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
						<button class="btn btn-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
<?php $this->load->view($template['action_ajax_business']); ?>

