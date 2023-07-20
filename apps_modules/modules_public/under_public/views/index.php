<!-- banner -->
<div class="justify-content-center d-flex hero-guest">

</div>

<!-- SECTION - BUSINESS -->
<div class="container">
	<div class="row mt-1">
		<div class="card border-0">
			<h4 class="mt-4 text-dark text-center">Coming Soon</h4>
			<img class="w-100" src="<?php echo theme_user_locations(); ?>images/global/under.png" alt="" />
		</div>
	</div>
</div>

<?php $this->load->view($template['partial_how_works']);
$this->load->view($template['partial_partners']);
$this->load->view($template['partial_ajax_public']);
