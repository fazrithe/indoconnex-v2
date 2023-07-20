
<!-- navbar -->
<?php $this->load->view($template['partials_navbar_business']); ?>

<!-- BODY -->
<div class="container mb-4">
    <!-- SECTION -->
    <div class="col-lg-12 msn-widget p-4 rounded-3">
        <div class="d-flex align-items-start">
            <h5 class="mb-4 text-prussianblue fw-bold">General Information</h5>
            <div class="ms-auto">
                <!-- Modal Delete Post Text -->
                <div class="modal fade" id="posttextdeleteModal" tabindex="-1"
                    aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="">Are you sure to delete this
                                    post?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-muted"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <p><?php echo $business->data_description ?></p>
        </div>
        <?php if(!empty($business->bd_maps)){ ?>
        <div class="row mb-3">
            <iframe class="maps" src="<?php echo $business->bd_maps ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <?php } ?>
        <div class="row d-flex row-cols-1 row-cols-md-3 mb-3">
            <div class="d-flex text-gray align-items-start">
                <div class="flex-shrink-0 d-flex mt-1">
                    <span class="material-icons md-18">business</span>
                </div>
                <div class="d-flex flex-grow-1 ms-1 flex-row flex-md-column">
                    <span class="fw-bold">Business Type</span>
                    <span class="text-black ms-2 ms-md-0">
					<?php
                            if(!empty($business->data_types)){
                                $types = json_decode($business->data_types);
									$c = 0;
                                    foreach($types as $valuetype){
                                    $this->db->select('*');
                                    $this->db->where('id',$valuetype);
                                    $query = $this->db->get('pbd_business_types')->row();
									$c++;
									if($c == 2){
										break;
									}
								?>
                            <span class="text-black ms-2 ms-md-0"><?php if(!empty($query->data_name)){echo $query->data_name;} ?></span>
                    <?php }} ?>
					</span>
                </div>
            </div>
            <div class="d-flex text-gray align-items-start">
                <div class="flex-shrink-0 d-flex mt-1">
                    <span class="material-icons md-18">phone</span>
                </div>
                <div class="d-flex flex-grow-1 ms-1 flex-row flex-md-column">
                    <span class="fw-bold">Phone Number</span>
                    <span class="text-black ms-2 ms-md-0"><?php echo $business->bd_phone ?></span>
                </div>
            </div>
            <div class="d-flex text-gray align-items-start">
                <div class="flex-shrink-0 d-flex mt-1">
                    <span class="material-icons md-18">location_city</span>
                </div>
                <div class="d-flex flex-grow-1 ms-1 flex-row flex-md-column">
                    <span class="fw-bold">Facility</span>
                    <span class="text-black ms-2 ms-md-0 flex-grow-1">
                        <div class="row mb-1">
                            <div class="col">
                                <?php foreach($facilities as $value){
                                if($business->data_facilities){
                                    $result = json_decode($business->data_facilities);
                                        foreach($result as $value_old){
                                            if($value_old== $value->id){
                                                echo "$value->data_name </br>";
                                            }
                                        }
                                    }
                                }
                            ?>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="row d-flex row-cols-1 row-cols-md-3 mb-3">
            <div class="d-flex text-gray align-items-start">
                <div class="flex-shrink-0 d-flex mt-1">
                    <span class="material-icons md-18">email</span>
                </div>
                <div class="d-flex flex-grow-1 ms-1 flex-row flex-md-column">
                    <span class="fw-bold">Email</span>
                    <span class="text-black ms-2 ms-md-0"><?php echo $business->bd_email ?></span>
                </div>
            </div>
            <div class="d-flex text-gray align-items-start">
                <div class="flex-shrink-0 d-flex mt-1">
                    <span class="material-icons md-18">schedule</span>
                </div>
                <div class="d-flex flex-grow-1 ms-1 flex-row flex-md-column">
                    <span class="fw-bold ms-2 ms-md-0">Working Hour</span>
                    <?php
                    if(!empty($business->bd_hours_work)){
                    $hours = json_decode($business->bd_hours_work);
                            foreach($hours as $key => $val){
                                foreach($val as $key1 => $val1){
                    ?>
                    <span class="text-black ms-2 ms-md-0"><?php echo $key1 ?> <?php if(!empty($val1->start)){echo $val1->start;} ?> - <?php if(!empty($val1->end)){echo $val1->end; }?> PM</span>
                    <?php  }}} ?>
                </div>
            </div>
            <div class="d-flex text-gray align-items-start">
                <div class="flex-shrink-0 d-flex mt-1">
                    <span class="material-icons md-18">payment</span>
                </div>
                <div class="d-flex flex-grow-1 ms-1 flex-row flex-md-column">
                    <span class="fw-bold">Payment Method</span>
                    <span class="text-black ms-2 ms-md-0"><?php echo $business->bd_paymentmethod ?></span>
                </div>
            </div>
        </div>
        <div class="row d-flex row-cols-1 row-cols-md-3 mb-3">
            <div class="d-flex text-gray align-items-start">
                <div class="flex-shrink-0 d-flex mt-1">
                    <span class="material-icons md-18">place</span>
                </div>
                <div class="d-flex flex-grow-1 ms-1 flex-row flex-md-column">
                    <span class="fw-bold">Address</span>
                    <span class="text-black ms-2 ms-md-0"><?php echo $business->bd_address ?></span>
                    <?php
                    if(!empty($value->data_locations)){
                    $locations =  json_decode($business->data_locations);
                            foreach($locations as $valuelocation){
                    ?>
                    <span class="fw-bold">City</span>
                    <span class="text-black ms-2 ms-md-0"><?php echo $valuelocation->city_name ?></span>
                    <span class="fw-bold">Country</span>
                    <span class="text-black ms-2 ms-md-0"><?php echo $valuelocation->country_name ?></span>
                    <?php }} ?>
                </div>
            </div>
            <div class="d-flex text-gray align-items-start">
                <div class="flex-shrink-0 d-flex mt-1">
                    <span class="material-icons md-18">people</span>
                </div>
                <div class="d-flex flex-grow-1 ms-1 flex-row flex-md-column">
                    <span class="fw-bold">Number of Team</span>
                    <span class="text-black ms-2 ms-md-0"><?php echo $business->bd_team_number ?> Team Members</span>
                </div>
            </div>
        </div>
    </div>
</div>
