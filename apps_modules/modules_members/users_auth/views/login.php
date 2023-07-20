<div class="bg-login d-flex ">
    <div class="col-10 col-md-4 mx-auto mt-5 pt-5">
            <?php if ($this->session->flashdata('failed')): ?>
            <div class="alert alert-danger text-center d-flex align-items-center" role="alert">
                <?php echo $this->session->flashdata('failed'); ?>
				<button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
        <div class="card mb-3 card-login rounded-3">
            <div class="card-header bg-primary text-white p-4 fw-bold fs-18">Login</div>
            <div class="card-body text-black fs-12 p-4">
                <form action="<?php echo current_url(); ?>" method="post" role="form" enctype="multipart/form-data">
                <?php echo form_hidden(generate_csrf_nonce('user/login')) ?>
                <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" id="inputEmail" name="email" class="form-control form-control-sm" placeholder="Email address" required autofocus autocomplete="email">
                </div>
                <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control form-control-sm" placeholder="Password" required autocomplete="current-password">
                </div>
                <div class="mb-3">
                    <div class="g-recaptcha d-flex justify-content-center" data-sitekey="6LcDKpIcAAAAAC6nvq1LH7f8y6z1b2vz0qGRoDPp"></div>
                </div>
                <div class="mb-3 d-grid">
                    <button type="submit" class="btn btn-lg btn-danger fs-14 fw-bold">Login</button>
					<hr>
					<div align="center"><?php echo $login_button ?></div>
				</div>
                <div class="row">
                <span class="text-center">
                    <a href="<?php echo site_url('user/reset') ?>" class="text-black">Forgot Password?</a></span>
                    <span class="text-center">Dont have an account? <a href="<?php echo site_url('user/register') ?>" class="text-danger">Register</a></span>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>
