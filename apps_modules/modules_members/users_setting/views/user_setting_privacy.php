<?php $this->load->view($template['partials_sidebar_setting']); ?>
<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0 mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-6 pt-5">
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
                <div class="card mb-3 text-primary" >
					<div class="card-header bg-transparent border-0 pt-3 d-flex">
						<div class="flex-shrink-0 d-flex">
							<img src="<?php echo base_url()?>public/themes/user/images/icons/setting-privacy.svg" class="img-circle" alt="">
						</div>
						<div class="flex-grow-1 ms-2 d-flex flex-column">
							<span class="text-prussianblue fw-bold fs-16">Privacy</span>
							<span class="fs-12">Your Account Visibility.</span>
						</div>
					</div>
                    <div class="card-body fs-12 text-black">
                        <form action="<?php echo current_url(); ?>" method="post">
                        <?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
                        <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                        <input type="hidden" name="id" value="<?php echo $users->id ?>" />
                        <div class="row mt-4">
                            <div class="col-12 ">
                                <div class="d-flex align-items-center">
                                <input type="radio" id="customRadio1" name="privacy" value="0" <?php echo ($users->status_privacy == 0 ? ' checked' : ''); ?> class="form-check-input">
                                <label class="form-label ms-3" for="customRadio1">
                                    <div class="row">
                                        <div class="col-sm">
                                            Public
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <span class="text-muted"><small>Make this account visible to anyone.</small></span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                                <div class="d-flex align-items-center">
                                <input type="radio" id="customRadio2" name="privacy" value="1" <?php echo ($users->status_privacy == 1 ? ' checked' : ''); ?> class="form-check-input">
                                <label class="form-label ms-3" for="customRadio2">
                                    <div class="row">
                                        <div class="col-sm">
                                            Private
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <span class="text-muted"><small>Hide this account from the public.</small></span>
                                        </div>
                                    </div>
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-4 d-grid">
                        <input type="submit" class="btn btn-danger" value="Save Changes">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
