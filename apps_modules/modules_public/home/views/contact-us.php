<?php $this->load->view($template['partial_banner']); ?>
<?php $this->load->view($template['partial_filter']); ?>

<div class="container mb-3">
    <div class="d-flex justify-content-start contact-us">
        <div class="col-md-6 bg-white px-4">
		<?php if ($this->session->flashdata('failed')): ?>
            <div class="alert alert-danger text-center d-flex align-items-center" role="alert">
                <?php echo $this->session->flashdata('failed'); ?>
				<button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <h4 class="fw-light my-4 judul-section"> Contact Us</h4>
            <div class="">
				<form action="<?php echo current_url(); ?>" method="post">
					<?php echo form_hidden(generate_csrf_nonce('contact-us')) ?>
					<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <div class="mb-3 row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="contact-name" >Name</label>
                            <input type="text" name="contact-name" id="contact-name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="contact-email">Email</label>
                            <input type="email" name="contact-email" id="contact-email" class="form-control" placeholder="JohnDoe@company.com" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="contact-business-name">Business Name</label>
                            <input type="text" name="contact-business-name" id="contact-business-name" class="form-control" placeholder="John Incorporate">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="contact-phone" >Phone No</label>
                            <input type="number" name="contact-phone" id="contact-phone" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact-subject" >Subject</label>
                        <input type="text" name="contact-subject" id="contact-subject" class="form-control" required >
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact-message" >Messages</label>
                        <textarea name="contact-message" id="contact-message" rows="5" class="form-control" maxlength="1500" minlength="50"></textarea>
                    </div>
					<div class="mb-3">
                   		<div class="g-recaptcha d-flex" data-sitekey="6LcDKpIcAAAAAC6nvq1LH7f8y6z1b2vz0qGRoDPp"></div>
                	</div>
                    <div class="mb-3 col-md-6 d-grid">
                        <button type="submit" class="btn btn-outline-danger">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
