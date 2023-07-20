
<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_pages']); ?>

<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-12 col-md-7 mx-auto px-0">
		<div class="row mt-3">
			<div class="col-sm-6">
				<div class="card">
				<div class="card-body">
					<h5 class="card-title">Business</h5>
					<a href="<?php echo site_url('business/discover')?>" class="btn btn-danger">View</a>
				</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card">
				<div class="card-body">
					<h5 class="card-title">Places</h5>
					<a href="<?php echo site_url('place/discover')?>" class="btn btn-danger">View</a>
				</div>
				</div>
			</div>
		</div>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
