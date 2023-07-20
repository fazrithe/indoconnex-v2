<div class="bg-login d-flex">
	<div class="col-10 col-md-4 mx-auto mt-5 pt-5">
		<?php if ($this->session->flashdata('output_error') != '') { ?>
			<div class="alert alert-danger ">
				<span>
					<?php echo $this->session->flashdata('output_error'); ?>
				</span>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php } ?>
		<?php if ($this->session->flashdata('output_success') != '') { ?>
            <div class="alert alert-success text-center">
                <span>
					<?php echo $this->session->flashdata('output_success'); ?>
				</span>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
		<div class="card mb-3 card-login rounded-3">
			<div class="card-header bg-primary text-white p-4 fw-bold fs-18">Register</div>
			<div class="card-body text-black fs-12 p-4">
				<form action="<?php echo current_url(); ?>" method="post">
					<?php echo form_hidden(generate_csrf_nonce('user/register')) ?>
					<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
					<div class="mb-3">
						<label class="form-label" for="inputEmail">Email</label>
						<input type="email" name="email" id="inputEmail" class="form-control form-control-sm" placeholder="Email address" required autocomplete="email">
					</div>
					<div class="mb-3">
						<label class="form-label" for="selCountry">Country</label>
						<select class="form-select business-country" name="country" id="selCountry" required>
						<?php
							if(!empty($users->data_locations)){
							$result = json_decode($users->data_locations);
							foreach($result as $value){
							?>
							<option value="<?php echo $value->country_id ?>"><?php echo $value->country_name ?></option>
							<?php }} ?>
						</select>
					</div>
					<div class="mb-3">
						<div class="g-recaptcha d-flex justify-content-center" data-sitekey="6LcDKpIcAAAAAC6nvq1LH7f8y6z1b2vz0qGRoDPp"></div>
					</div>
					<div class="mb-3 d-grid">
					<button type="submit" class="btn btn-lg btn-danger fs-14 fw-bold">Register</button>
					</div>
					<div class="row">
						<span class="text-black text-center">Already have an account? <a href="<?php echo site_url('user/login') ?>" class="text-danger">Login</a></span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
	$(document).ready(function(){
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	$("#selCountry").select2({
		theme: "bootstrap5",
		ajax: {
			url: '<?php echo site_url('home/country');?>',
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
					[csrfName]: csrfHash
				};
			},
			processResults: function (response) {
				$(".txt_csrfname").val(response.token);
				return {
					results: response.response
				};
			},
			cache: true
		}
	});
});
</script>

