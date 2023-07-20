<?php $this->load->view($template['partials_sidebar_setting']); ?>
<!-- Page Content  -->
<div id="content">
    <div class="row">
        <div class="col-sm pt-4 bg-indoconnex">
            <div class="row d-flex justify-content-center">
                <div class="col-7">
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
                            <div class="card-body">
                            <h5 class="card-title">Privacy</h5>
                            <h7 class="card-subtitle mb-4 text-muted">Account Visibility</h7>
                            <form action="<?php echo current_url(); ?>" method="post">
                            <?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
                            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
                            <div class="row mt-4">
                                <div class="col-8">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="privacy" value="0" <?php echo ($users->status_privacy == 0 ? ' checked' : ''); ?> class="custom-control-input">
                                    <label  class="form-label" for="customRadio1">
                                    <div class="row">
                                        <div class="col-sm">
                                            Public
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <span class="text-muted"><small>Make this account visible to anyone.</small></span>
                                        </div>
                                    </div></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="privacy" value="1" <?php echo ($users->status_privacy == 1 ? ' checked' : ''); ?> class="custom-control-input">
                                    <label class="form-label" for="customRadio2">
                                    <div class="row">
                                        <div class="col-sm">
                                            Private
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <span class="text-muted"><small>Hide this account from the public.</small></span>
                                        </div>
                                    </div></label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-4">
                            <input type="submit" class="btn btn-danger" value="Save Changes">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view($template['partials_sidebar_ads']); ?>
    </div>
</div>
