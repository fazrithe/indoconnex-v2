<?php $this->load->view($template['partials_sidebar_pages']); ?>
<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0 g-3">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <span class="d-flex fw-bold mb-3">Create Place <?php echo validation_errors(); ?></span>
                <form action="<?php echo base_url('place/profile/store') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/business-profile.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Profile</span>
                                    <span class="fs-12 text-black">Info you share to your place profile.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" for="">Place Name</label>
                                    <input type="hidden" name="user_id" value=" <?php echo $users->id ?>">
									<input type="hidden" name="status_page" value="place">
                                    <input type="text" name="business-name" class="form-control form-control-sm" placeholder="Place Name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Place URL Name</label>
                                    <input type="text" name="username" class="form-control form-control-sm input-text" onKeyPress="return angkadanhuruf(event,'abcdefghijklmnopqrstuwvxyz0123456789',this)" placeholder="Place URL Name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="business-type" for="">Place Type</label>
                                    <select class="form-select form-select-sm" name="business-types[]">
                                    <?php foreach($types as $value){
                                            echo "<option value='$value->id'>$value->data_name</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="business-category" for="">Place Category</label>
                                    <select class="js-example-basic-multiple w-100 form-select form-select-sm" name="business-categories[]" multiple>
                                    <?php foreach($categories as $value){
                                            echo "<option value='$value->id'>$value->data_name</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="business-description" for="">Place Description</label>
                                    <textarea class="form-control form-control-sm" name="business-description" id="" cols="30" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Place Logo</label>
                                    <input type="file" class="form-control form-control-sm" name="__logo_files[]" accept=".jpg, .jpeg, .png" >
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Place Cover</label>
                                    <input type="file" class="form-control form-control-sm" name="__cover_files[]" id="" accept=".jpg, .jpeg, .png" >
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
                                    <span class="fs-12 text-black">Your place location.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" name="address" for="">Place Address</label>
                                    <input type="text" class="form-control form-control-sm" name="business-address">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selCountry">Place Country</label>
                                    <select class="form-select form-select-sm business-country" name="business-country" id="selCountry" >
                                        <option value="">Select Country</option>
                                    </select>
                                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selState">Place State / Region</label>
                                    <select class="form-select form-select-sm" name="business-state" id="selState" disabled>
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selCity">Place City / Regency</label>
                                    <select class="form-select form-select-sm" name="business-city" id="selCity" disabled>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="zipCode">Postal Code</label>
                                    <input type="text" class="form-control form-control-sm" name="zip-code" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Google Maps Embed Link</label>
                                    <input type="text" class="form-control form-control-sm" name="maps" id="inputMaps" placeholder="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent text-primary border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/setting-contact.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Contact Info</span>
                                    <span class="fs-12">Info about your place contact.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" for="">Business Email</label>
                                    <input type="email" class="form-control form-control-sm" name="business-email" required placeholder="support@company.com">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Phone Number</label>
                                    <input type="number" class="form-control form-control-sm" name="business-phone" required placeholder="+1 123 456 789">
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent text-primary border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/setting-social.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Social Media</span>
                                    <span class="fs-12">Info about your social media and others.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label for='inputWebsite' class='form-label'>Website</label>
                                    <div id="insert-form-website"></div>
                                    <div class="mb-3 d-grid">
                                        <span id="writeroot"></span>
                                        <a class="btn btn-outline-monik btn-sm" id="btn-tambah-form" onclick="btnAddWebsite()">Add Website</a>
                                    </div>
                                    </form>
                                    <div class='mb-3'>
                                        <label for='inputFacebook' class='form-label'>Facebook</label>
                                        <input type='text' name='facebook' value='' id='inputFacebook' class='form-control-sm form-control' placeholder='username'>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='inputLoinkedin' class='form-label'>Linkedin</label>
                                        <input type='text' name='linkedin' value='' id='inputLoinkedin' class='form-control-sm form-control' placeholder='username'>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='inputInstagram' class='form-label'>Instagram</label>
                                        <input type='text' name='instagram' value='' id='inputInstagram' class='form-control-sm form-control' placeholder='username'>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="jumlah-form-website" value="1">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-sm btn-danger">Create Business Page</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>

<?php $this->load->view($template['action_ajax_profile']); ?>
<?php $this->load->view($template['action_ajax_business']); ?>

<script>
    	function btnAddWebsite() {
		var jumlah = parseInt($("#jumlah-form-website").val());
		var nextform = jumlah + 1;

		$("#insert-form-website").append(
		"<div class='mb-2 input-group'>"+
		"<input type='text' name='website[]' id='inputWebsite' class='form-control-sm form-control' placeholder='Website'>"+
		"<button onclick='btn_reset_website(this)' class='btn' role='button'>"+
		"<span class='material-icons text-black'>delete</span>"+
		"</button>"+
		"</div>");

		$("#jumlah-form-website").val(nextform);
		console.log($("#jumlah-form-website").val());
	}

	function btn_reset_website($button) {
		$($button).closest('.input-group').remove();
		$("#jumlah-form-website").val($("#jumlah-form-website").val() - 1);
	}

</script>
