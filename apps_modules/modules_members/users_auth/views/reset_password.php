@@ -1,32 +0,0 @@
<div class="bg-login d-flex min-vh-100 overflow-y-hidden">
    <div class="col-10 col-md-4 mx-auto mt-5 pt-5">
    <?php if ($this->session->flashdata('output_error') != '') { ?>
		<div class="alert alert-danger text-center d-flex align-items-center" role="alert">
			<span>
				<?php echo $this->session->flashdata('output_error'); ?>
			</span>
				<button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php } ?>
	<?php if ($this->session->flashdata('success') != '') { ?>
        <div class="alert alert-success text-center">
            <span>
                <?php echo $this->session->flashdata('success'); ?>
            </span>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
        <div class="card mb-3 card-login rounded-3">
            <div class="card-header bg-primary text-white p-4 fw-bold fs-18">Forgot Password</div>
                <div class="card-body text-black fs-12 p-4">
                <form action="<?php echo current_url(); ?>" method="post" id="form-forgot">
                    <?php echo form_hidden(generate_csrf_nonce('user/reset')) ?>
                    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <div class="mb-3">
                    <label for="inputEmail" class="form-label">We'll send a recovery link to</label>
                    <input type="email" id="inputEmail" name="email" class="form-control form-control-sm" placeholder="Enter email" required autofocus autocomplete="email">
                    </div>
                    <div class="mb-3">
                        <div class="g-recaptcha d-flex justify-content-center" data-sitekey="6LcDKpIcAAAAAC6nvq1LH7f8y6z1b2vz0qGRoDPp"></div>
                    </div>
                    <div class="mb-3 d-grid">
                        <button type="submit" id="forgot-submit" class="btn btn-lg btn-outline-danger fs-14 fw-bold">Send Recovery Link</button>
                    </div>
                    <div class="row">
                        <span class="text-black text-center">Dont have an account? <a href="<?php echo site_url('user/register') ?>" class="text-danger">Create account</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
	$('#form-forgot').submit(function (event) {
		$('#forgot-submit').prop('disabled','disabled');
		$('#check').toggleClass('d-none');
	});
</script>
