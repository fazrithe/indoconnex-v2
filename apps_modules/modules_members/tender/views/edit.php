<?php $this->load->view($template['partials_sidebar_tender']); ?>
<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                    <select name="businessSelector" onchange="selectUser(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                        <?php foreach($business_list as $value){ ?>
                        <option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class=""><?php echo $value->data_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <span class="d-flex fw-bold mb-3">Edit Tender <?php echo validation_errors(); ?></span>
                <?php  if($business_count > 0){ ?>
                <form action="<?php echo base_url('tender/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
                    <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <input type="hidden" name="tender-id" value="<?= $tender->id; ?>">
                    <input type="hidden" id="select_user_id" name="select_user_id">
                    <input type="hidden" id="select_business_id" name="select_business_id" value="<?php echo $business->id ?>">
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/profile-tender.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Profile</span>
                                    <span class="fs-12 text-black">Your tender profile.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
							<div class="mb-3">
                                    <label class="form-label" name="tender-name" for="tender-name">Tender Name</label>
                                    <input type="text" name="tender-name" value="<?= $tender->data_name; ?>" id="tender-name" class="form-control form-control-sm" required>
                                </div>
								<div class="mb-3">
                                    <label class="form-label" for="">Description</label>
                                    <textarea name="tender-description" id="" cols="10" rows="5" maxlength="350" class="form-control form-control-sm"><?= $tender->data_description; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="tender-type">Type</label>
                                    <input type="hidden" name="user_id" value=" <?php echo $users->id ?>">
                                    <select name="tender-type" id="tender-type" class="form-select form-select-sm" required>
									<?php 
                                        foreach ($types as $value) {   
                                            $selected = '';
                                            
                                            if ($tender->data_types == $value->id) {
                                                $selected = 'selected';
                                            } 

                                            echo "<option value='$value->id' $selected>$value->data_name</option>";
									    } 
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="tender-category" for="tender-category">Category</label>
                                    <select class="w-100 form-select form-select-sm" name="tender-category" required>
									<?php
                                        foreach ($categories as $value) {
                                            $selected = '';
                                            
                                            if ($tender->data_categories == $value->id) {
                                                $selected = 'selected';
                                            } 

                                            echo "<option value='$value->id' $selected>$value->data_name</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
								<div class="mb-3">
                                    <label class="form-label" for="">Open Until</label>
                                    <input type="date" class="form-control form-control-sm" name="tender-open" value="<?= date('Y-m-d', strtotime($tender->date_open)); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Photo</label>
                                    <input type="file" class="form-control form-control-sm" name="__logo_files[]" accept="image/x-png,image/gif,image/jpeg" onchange="loadFile(event)" />
                                </div>
                                <div id="previewPhotoContainer" class="mb-3 d-none">
                                    <div>Preview Photo:</div>
                                    <img class="img-fluid" />
                                </div>
                                <div class="mb-3">
                                    <div>Current Photo:</div>
                                    <img class="img-fluid" src="<?php echo placeholder($tender->file_path, $tender->file_name_original); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/business-location.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Location</span>
                                    <span class="fs-12 text-black">Your tender location.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
							<div class="mb-3">
                                    <label class="form-label" for="selCountry">Country</label>
                                    <select class="form-select form-select-sm business-country" name="tender-country" id="selCountry" required>
                                        <option value="<?php echo $country->id ?>"><?php echo $country->name ?></option>
                                    </select>
                                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selState">State / Region</label>
                                    <select class="form-select form-select-sm" name="tender-state" id="selState" required>
                                        <option value="<?php echo $state->id ?>"><?php echo $state->name ?></option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selCity">City / Regency</label>
                                    <select class="form-select form-select-sm" name="tender-city" id="selCity" required>
                                        <option value="<?php echo $city->id ?>"><?php echo $city->name ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid ">
                            <button type="submit" class="btn btn-sm btn-danger">Update Tender</button>
                        </div>
                    </div>
                </form>
                <?php }else{ ?>
                    <div class="card-body bg-white border-0">
                            <div class="d-flex align-items-center flex-column">
                                <div class="mb-3">
                                    <img src="<?php echo site_url('public/themes/user/images/products/default.png') ?>" alt="no-product-service">
                                </div>
                                <div class="mb-3">
                                    <span class="text-muted fw-semi fs-18">You must have a business page first before creating products and services!</span>
                                </div>
                                <div class="mb-3">
                                    <a href="<?php echo site_url('business/create') ?>" class="btn btn-danger fw-bold fs-14">Create Business Page</a>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>

<script>
    const loadFile = function(event) {
        $('#previewPhotoContainer').removeClass('d-none');
        const output = document.getElementById('previewPhotoContainer').children[1];
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
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

    function mountCity(state_id)
    {
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
