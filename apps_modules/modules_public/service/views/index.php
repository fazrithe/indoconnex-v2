<?php $this->load->view($template['partial_banner']); ?>
<?php $this->load->view($template['partial_filter']); ?>

<div class="container">
		<div class="row mt-1 align-items-center h-100 mb-4">
		  <div class="col-lg-6 col-xs-12 col-md-6 mx-auto justify-content-center text-prussianblue">
                <h4 class="fw-semi">Make it easier for your website to appear on 
the first search engine results page.</h4>
                <p class="">Comes equipped with advanced SEO settings to give your e-commerce 
website a higher chance to appear among the first pages of 
search engine results such as Google.</p>
        	</div>
			<div class="col-lg-6 col-xs-12 col-md-6 mx-auto justify-content-center text-prussianblue">
                <img src="<?php echo base_url('public/themes/public/images/services/search.png') ?>" class="card-img-top" alt="...">
        	</div>
		</div>
		<div class="card">
  <div class="card-body">
		<div class="row mt-1 align-items-center h-100">
			<div class="col-lg-6 col-xs-12 col-md-6 mx-auto justify-content-center text-prussianblue">
                <img src="<?php echo base_url('public/themes/public/images/services/analytical.png') ?>" class="card-img-top" alt="...">
        	</div>
			<div class="col-lg-6 col-xs-12 col-md-6 mx-auto justify-content-center text-prussianblue">
                <h4 class="fw-semi">Analytical Reports to Measure Your Website 
Performance</h4>
                <p class="">Integrated with Google Analytics tools to make it easier
 for you to monitor website visitor statistics.</p>
        	</div>
		</div>
  </div>
		</div>
		<div class="row mt-1 align-items-center h-100">
		  <div class="col-lg-6 col-xs-12 col-md-6 mx-auto justify-content-center text-prussianblue">
                <h4 class="fw-semi">Amplify Your Sales and Increase
Customer Loyalty</h4>
                <p class="">Yobiweb's website comes equipped with a coupon/voucher feature 
that you can set yourself in order to maximize your business’ promotion.</p>
        	</div>
			<div class="col-lg-6 col-xs-12 col-md-6 mx-auto justify-content-center text-prussianblue">
                <img src="<?php echo base_url('public/themes/public/images/services/loyalti.png') ?>" class="card-img-top" alt="...">
        	</div>
		</div>
		<div class="row mt-1">
			<div class="col-12 col-xs-12 col-md-12">
		<h4 class="mt-4 title-dark">Start Project</h4>
		<div class="card text-dark bg-light mb-3" style="">
			<div class="card-body">
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
								<input type="number" name="contact-phone" id="contact-phone" class="form-control" placeholder="08122****">
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label" for="contact-subject" >Subject</label>
							<input type="text" name="contact-subject" id="contact-subject" class="form-control" required placeholder="Message">
						</div>
						<div class="mb-3">
							<label class="form-label" for="contact-message" >Messages</label>
							<textarea name="contact-message" id="contact-message" rows="5" class="form-control" maxlength="1500" minlength="50"></textarea>
						</div>
						<div class="mb-3">
							<div class="g-recaptcha d-flex" data-sitekey="6LcDKpIcAAAAAC6nvq1LH7f8y6z1b2vz0qGRoDPp"></div>
						</div>
						<div class="mb-3 col-md-1 d-grid">
							<button type="submit" class="btn btn-danger">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
		<div class="card mb-4">
  			<div class="card-body">
				<?php $this->load->view($template['partial_about_join']); ?>
  			</div>
		</div>
		</div>
</div>

