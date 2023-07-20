<?php
$this->load->view($template['partials_sidebar_setting']); ?>
<!-- Page Content  -->
<div id="setting-general" class="row">
    <div class="col-11 col-md-7 mx-auto px-0 mt-4">
		<div class="row">
			<div class="col">
				<?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
			</div>
		</div>
        <div class="row">
            <div class="col-6">
				<div class="card mb-3" >
					<div class="card-header bg-transparent text-primary border-0 pt-3 d-flex">
						<div class="flex-shrink-0 d-flex">
							<img src="<?php echo base_url()?>public/themes/user/images/icons/setting-account.svg" class="img-circle" alt="">
						</div>
						<div class="flex-grow-1 ms-2 d-flex flex-column">
							<span id="account" class="text-prussianblue fw-bold fs-16">Account</span>
							<span class="fs-12">Info about your account</span>
						</div>
					</div>
					<div class="card-body fs-12 text-black">
						<form action="<?php echo current_url(); ?>" method="post">
						<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
						<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
						<input type="hidden" name="id" value="<?php echo $users->id ?>" />
						<div class="mb-3">
							<label for="inputEmail" class='form-label'>Username</label>
							<input type="text" name="username" id="inputUsername" onKeyPress="return angkadanhuruf(event,'abcdefghijklmnopqrstuwvxyz0123456789',this)" class="form-control-sm form-control input-text" value="<?php echo $users->username ?>" placeholder="username" required >
						</div>
						<div class="mb-3">
							<label for="inputEmail" class='form-label'>Primary Email</label>
							<input type="email" name="email" id="inputEmail" class="form-control-sm form-control" value="<?php echo $users->email ?>" placeholder="Email address" disabled aria-disabled="true">
						</div>
						<div class="mb-3">
							<label class="form-label" for="selCountry">Country</label>
							<select class="form-select business-country" name="country" id="selCountry" >
							<?php
								if(!empty($users->data_locations)){
								$result = json_decode($users->data_locations);
								foreach($result as $value){
								?>
								<option value="<?php echo $value->country_id ?>"><?php echo $value->country_name ?></option>
								<?php }} ?>
							</select>
						</div>
						</form>
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
							<form action="<?php echo base_url('setting/email/store') ?>" method="post" role="form" enctype="multipart/form-data">
							<div class="mb-2 flex-column">
							<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
							<label for='inputEmail' class='form-label'>Additional Email</label>
								<?php
									if(!empty($users->data_contact_info)):
									$result = json_decode($users->data_contact_info);
									foreach($result as $value): ?>
									<div class="input-group mb-3">
									<input type="text" name="email[]" id="inputEmail" class="form-control-sm form-control" value="<?php echo $value->email_contact ?>">
									<a href='<?php echo base_url('setting/email/delete/'.$value->id) ?>' class='text-black close ms-auto'><span class='btn text-danger fs-10 flex-row-reverse d-flex'>remove</span></a>
									</div>
									<br>
									<?php endforeach;
											endif;
									?>
									<div id="insert-form"></div>
									<div class="mb-3 d-grid">
										<span id="writeroot"></span>
										<button class="btn btn-outline-monik btn-sm" id="btn-tambah-form" onclick="btnAdd()"> Add Email</button>
									</div>
							</div>
						</form>
					</div>
					<div class="card-body fs-12 text-black">
							<form action="<?php echo base_url('setting/phone/store') ?>" method="post" role="form" enctype="multipart/form-data">
							<div class="mb-2 flex-column">
							<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
							<label for='inputEmail' class='form-label'>Phone Number</label>

								<?php
									if(!empty($users->phone)):
									$result = json_decode($users->phone);
									foreach($result as $value): ?>
									<div class="input-group">
									<input type="text" name="phone[]" id="inputEmail" class="form-control-sm form-control" value="<?php echo $value->phone_number ?>">
									<a href='<?php echo base_url('setting/phone/delete/'.$value->id) ?>' class='text-black close ms-auto'><span class='btn text-danger fs-10 flex-row-reverse d-flex'>remove</span></a>
									</div>
									<br>
									<?php endforeach;
											endif;
									?>
									<div id="insert-form-phone"></div>
									<div class="mb-3 d-grid">
										<span id="writeroot"></span>
										<button class="btn btn-outline-monik btn-sm" id="btn-tambah-form-phone" onclick="btnAddphone()"> Add Phone Number</button>
									</div>
							</div>
						</form>
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
                            <form action="<?php echo base_url('setting/website/store') ?>" method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
							<label for='inputWebsite' class='form-label'>Website</label>
                            <?php
                                if(!empty($users->data_contact_website)):
                                $result = json_decode($users->data_contact_website);
                                foreach($result as $value): ?>
                            <div class="mb-2 flex-column">
								<input type="text" name="website[]" id="" class="form-control-sm form-control" value="<?php echo $value->website ?>">
                                <?php echo "<a href='".base_url('setting/website/delete/'.$value->id)."' class='text-black close ms-auto'><span class='btn text-danger fs-10 flex-row-reverse d-flex'>remove</span></a>" ?>
							</div>
                                <?php endforeach;
                                      endif;
                                ?>
							<div id="insert-form-website"></div>
							<div class="mb-3 d-grid">
								<span id="writeroot"></span>
								<button class="btn btn-outline-monik btn-sm" id="btn-tambah-form" onclick="btnAddWebsite()">Add Website</button>
							</div>
				            </form>
							<?php
							if(!empty($users->data_contact_socialmedia)){
                                $result = json_decode($users->data_contact_socialmedia);
                                foreach($result as $value): ?>
                            <form action="<?php echo base_url('setting/socmed/store') ?>" method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                            <div class='mb-3'>
								<label for='inputFacebook' class='form-label'>Facebook</label>
								<input type='text' name='facebook' value='<?php echo $value->facebook ?>' id='inputFacebook' class='form-control-sm form-control' placeholder='username'>
							</div>
							<div class='mb-3'>
								<label for='inputLoinkedin' class='form-label'>Linkedin</label>
								<input type='text' name='linkedin' value='<?php echo $value->linkedin ?>' id='inputLoinkedin' class='form-control-sm form-control' placeholder='username'>
							</div>
							<div class='mb-3'>
								<label for='inputInstagram' class='form-label'>Instagram</label>
								<input type='text' name='instagram' value='<?php echo $value->instagram ?>' id='inputInstagram' class='form-control-sm form-control' placeholder='username'>
							</div>
						</div>
                    </div>
                    </form>
					<?php endforeach;
							}else{
                                ?>
							<form action="<?php echo base_url('setting/socmed/store') ?>" method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
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

                    </form>
					<?php } ?>
					<input type="hidden" id="jumlah-form" value="1">
                    <input type="hidden" id="jumlah-form-website" value="1">
					<input type="hidden" id="jumlah-form-phone" value="1">
                </div>
				<div class="mb-3 d-grid">
					<input id="btnSaveGeneral" type="button" class="btn btn-danger btn-sm" value="Save Changes">
				</div>
            </div>

        </div>
    </div>
</div>
    <?php $this->load->view($template['partials_sidebar_ads']); ?>
    <?php
     if(!empty($users->data_contact_info)){
     $result = json_decode($users->data_contact_info);
     foreach($result as $value){
        $id = $value->id;
    ?>
    <div class="modal fade" id="modal_delete_contact<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
					<h3 class="modal-title" id="myModalLabel">Delete Contact Info</h3>
				</div>
				<form action="<?php echo base_url('user/profile/delete_contact/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="setting/general" />
					<div class="modal-body">
						<p>Are you sure you want to delete <b></b></p>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="contact_id" value="<?php echo $id;?>">
						<button class="btn btn-muted" data-bs-dismiss="modal" aria-hidden="true">Close</button>
						<button class="btn btn-danger">Delete</button>
					</div>
				</form>
            </div>
		</div>
	</div>
    <?php }} ?>
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
		"<input type='text' name='website[]' id='inputWebsite' class='form-control-sm form-control' placeholder='Website' required>"+
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
