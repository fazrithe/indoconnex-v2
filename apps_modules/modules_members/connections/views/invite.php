<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_connection']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >
            <span class="d-flex fw-bold mb-3">Invite Friends</span>
            <div class="bg-white container d-flex">
                <div class="col-12">
                    <div class="card-body bg-white border-0">
						<div class="d-flex align-items-center flex-column">
							<div class="mb-3">
								<img src="<?php echo site_url('public/themes/user/images/connections/empty.png') ?>" alt="no-business">
							</div>
							<div class="mb-3">
								<span class="text-muted ">Invite Your Friend Via</span>
							</div>
							<div class="mb-3 hstack gap-2 justify-content-center flex-wrap">
								<button class="btn btn-outline-monik social_share" data-type="fb"><i class="fab fa-facebook"></i></button>
								<button class="btn btn-outline-monik social_share" data-type="linkedin"><i class="fab fa-linkedin-in"></i></button>
								<button class="btn btn-outline-monik social_share" data-type="twitter"><i class="fab fa-twitter"></i></button>
								<button class="btn btn-outline-monik social_share" data-type="whatsapp"><i class="fab fa-whatsapp"></i></button>
							</div>
							<div class="mb-3 gap-2 justify-content-center vstack align-items-center">
								<span class="text-muted ">or copy this link</span>
								<code><?php echo site_url('post/'.$this->session->userdata('username')) ?></code>
							</div>

						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_connection']); ?>
