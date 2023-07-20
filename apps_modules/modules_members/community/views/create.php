<?php $this->load->view($template['partials_sidebar_community']); ?>
<!-- Page Content  -->
	<div id="setting-general" class="row">
		<div class="col-11 col-md-7 mx-auto px-0 mt-4">
			<div class="row">
				<form action="<?php echo base_url('community/store') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
				<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<div class="col-6">
					<div class="card mb-3" >
						<div class="card-header bg-transparent border-0 pt-3 d-flex">
								<div class="flex-shrink-0 d-flex">
									<img src="<?php echo base_url()?>public/themes/user/images/icons/community-profile.svg" class="img-circle" alt="">
								</div>
								<div class="flex-grow-1 ms-2 d-flex flex-column">
									<span class="text-prussianblue fw-bold fs-16">Profile</span>
								<span class="fs-12 text-black">Your community profile.</span>
							</div>
						</div>
						<div class="card-body fs-12 text-black">
							<div class="mb-3">
								<label class="form-label" name="com-name">Community Name</label>
								<input type="text" name="com-name" class="form-control" required>
							</div>
							<div class="mb-3">
								<label class="form-label" name="com-category">Category</label>
								<select class="form-control community-category" name="com-category">
								<?php foreach($categories as $value){
										echo "<option value='$value->id'>$value->data_name</option>";
									}
								?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label" name="">Privacy</label>
								<div class="form-check form-switch">
									<input class="form-check-input" id="com-privacy" name="com-privacy" type="checkbox" role="switch" id="flexSwitchCheckDefault">
									<label class="form-check-label" for="flexSwitchCheckDefault">Make Private</label>
								</div>
							</div>
							<div class="mb-3">
								<label class="form-label" for="">Description</label>
								<textarea name="com-description" id="" cols="10" rows="5" maxlength="350" class="form-control"></textarea>
							</div>
							<div class="mb-3">
								<label class="form-label" for="">Profile Photo</label>
								<input type="file" class="form-control" name="__logo_files[]" accept=".jpg, .jpeg, .png" >
							</div>
							<div class="mb-3">
								<label class="form-label" for="">Cover Photo</label>
								<input type="file" class="form-control" name="__cover_files[]" id="" accept=".jpg, .jpeg, .png" >
							</div>
						</div>
					</div>
					<div class="card mb-3" >
						<div class="card-header bg-transparent text-primary border-0 pt-3 d-flex">
							<div class="flex-shrink-0 d-flex">
								<img src="<?php echo base_url()?>public/themes/user/images/icons/setting-contact.svg" class="img-circle" alt="">
							</div>
							<div class="flex-grow-1 ms-2 d-flex flex-column">
								<span class="text-prussianblue fw-bold fs-16">Contact Info</span>
								<span class="fs-12">Info about your contact.</span>
							</div>
						</div>
						<div class="card-body fs-12 text-black">
								<div class="mb-2 flex-column">
								<label for='inputEmail' class='form-label'>Email</label>
								<input type='email' name='email[]' id='inputEmail' class='form-control-sm form-control' placeholder='Email address'></br>
								<div id="insert-form"></div>
										<div class="mb-3 d-grid">
											<span id="writeroot"></span>
											<button class="btn btn-outline-monik btn-sm" id="btn-tambah-form" onclick="btnAdd()"> Add Email</button>
										</div>
							</div>
						</div>
						<div class="card-body fs-12 text-black">
								<div class="mb-2 flex-column">
									<label for='inputEmail' class='form-label'>Phone Number</label>
									<input type='number' name='phone[]' id='inputEmail' class='form-control-sm form-control' placeholder='phone Number'><br>
									<div id="insert-form-phone"></div>
										<div class="mb-3 d-grid">
											<span id="writeroot"></span>
											<button class="btn btn-outline-monik btn-sm" id="btn-tambah-form-phone" onclick="btnAddphone()"> Add Phone Number</button>
										</div>
								</div>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card mb-3" >
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
									<button class="btn btn-outline-monik btn-sm" id="btn-tambah-form" onclick="btnAddWebsite()">Add Website</button>
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
						<input type="hidden" id="jumlah-form" value="1">
						<input type="hidden" id="jumlah-form-website" value="1">
						<input type="hidden" id="jumlah-form-phone" value="1">
					</div>
					<div class="mb-3 d-grid">
					<button type="submit" class="btn btn-danger">Create Community Page</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
    <?php $this->load->view($template['partials_sidebar_ads']); ?>
    <?php $this->load->view($template['action_ajax_profile']); ?>
	<script>
		$('#btnSaveGeneral').click(function (button) {
			$('#setting-general form').each(function (key, val) {
				var username = $("#inputUsername").val();
				$.ajax({
					type  : 'POST',
					url   : $(val).attr('action'),
					data  : $(val).serialize(),
					async : true,
				}).done(
					function(data){
						console.log(data)
						location.href = '<?php echo site_url('setting/general/') ?>'+username;
					}
				);
			})
		})

		function btnAdd() {
			var jumlah = parseInt($("#jumlah-form").val());
			var nextform = jumlah + 1;

			$("#insert-form").append(
			"<div class='mb-2 input-group'>"+
			"<input type='email' name='email[]' id='inputEmail' class='form-control-sm form-control' placeholder='Email address' required >"+
			"<button onclick='btn_reset(this)' class='btn' role='button'>"+
			"<span class='material-icons text-black'>delete</span>"+
			"</button></div>"+
			"</div>");

			$("#jumlah-form").val(nextform);

		}

		function btnAddphone() {
			var jumlah = parseInt($("#jumlah-form-phone").val());
			var nextform = jumlah + 1;

			$("#insert-form-phone").append(
			"<div class='mb-2 input-group'>"+
			"<input type='number' name='phone[]' id='inputEmail' class='form-control-sm form-control' placeholder='phone Number' required >"+
			"<button onclick='btn_reset(this)' class='btn' role='button'>"+
			"<span class='material-icons text-black'>delete</span>"+
			"</button></div>"+
			"</div>");

			$("#jumlah-form-phone").val(nextform);

		}

		function btn_reset($button) {
			$($button).closest('.input-group').remove();
			$("#jumlah-form").val($("#jumlah-form").val() - 1);
		}

		function btnAddWebsite() {
			var jumlah = parseInt($("#jumlah-form-website").val());
			var nextform = jumlah + 1;

			$("#insert-form-website").append(
			"<div class='mb-2 input-group'>"+
			"<input type='text' name='website[]' id='inputWebsite' class='form-control-sm form-control' placeholder='Website' required >"+
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

