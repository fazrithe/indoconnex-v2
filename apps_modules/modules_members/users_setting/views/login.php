<div class="layout-register-row">
	<div class="layout-register-col-desc">
		<main role="main" class="container">
			<div class="bg-login">
                <div class="col-sm-4 mx-auto">
                <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('failed')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('failed'); ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                    <div class="card mb-3" >
                        <div class="card-header bg-danger text-white">Login</div>
                        <div class="card-body text-black">
                            <form action="<?php echo current_url(); ?>" method="post">
								<?php echo form_hidden(generate_csrf_nonce('user/login')) ?>
								<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
								<div class="mb-3">
								<label class='form-label' for="inputEmail">Email</label>
								<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
								</div>
								<div class="mb-3">
								<label class='form-label' for="inputPassword">Password</label>
								<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
								</div>
									<a href="index.php?pages=home"><input type="submit" class="btn btn-lg btn-outline-danger" value="Login"></a>
								</div>
								<div class="row justify-content-center align-items-center">
									<span>Dont have an account? <a href="<?php echo site_url('user/register') ?>">Create account</a></span>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
			</div>
		</main>
	</div>
</div>
