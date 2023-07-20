
<!-- content -->
<div class="layout-register-row">
	<div class="layout-register-col-desc">
		<main role="main" class="container">
			<div class="bg-login">
				<div class="col-sm-4 mx-auto">
				<?php if ($this->session->flashdata('output_error') != '') { ?>
				<div class="callout callout-danger text-danger">
					<h4><?php echo ($this->session->flashdata('output_error_title') != '') ? $this->session->flashdata('output_error_title') : 'Error'; ?></h4>
					<p><?php echo $this->session->flashdata('output_error'); ?></p>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php } ?>
				<?php if ($this->session->flashdata('output_success') != '') { ?>
            		<div class="alert alert-danger text-center d-flex align-items-center" role="alert">
						<h4><?php echo ($this->session->flashdata('output_success_title') != '') ? $this->session->flashdata('output_success_title') : 'Success'; ?></h4>
						<p><?php echo $this->session->flashdata('output_success'); ?></p>
						<button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php } ?>
					<div class="card mb-3" >
						<div class="card-header bg-danger text-white">Register</div>
						<div class="card-body text-black">
						<form action="<?php echo current_url(); ?>" method="post">
						<?php echo form_hidden(generate_csrf_nonce('user/register')) ?>
            			<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
							<div class="mb-3">
								<label class='form-label' for="inputEmail">Display Name</label>
								<input type="text" name="name_full" id="inputName" class="form-control" placeholder="Display Name" autofocus>
							</div>
							<div class="mb-3">
								<label class='form-label' for="inputEmail">Email</label>
								<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
							</div>
							<div class="mb-3">
								<label class='form-label' for="country">Country</label>
								<input type="text" name="country" class="form-control col-xs-4" id="country_selector">
							</div>
							<div class="mb-3">
							<input type="submit" class="btn btn-outline-danger" value="Register">
							</div>
							<div class="row justify-content-center align-items-center">
								<span>Already have an account? <a href="site_url('user/login')">Login</a></span>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</div>
      <!-- content -->
