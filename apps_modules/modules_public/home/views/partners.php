<?php $this->load->view($template['partial_banner']); ?>
<?php $this->load->view($template['partial_filter']); ?>

<!-- Gallery Pages -->
<div class="container mb-3">

    <h4 class="fw-light mt-4 mb-4 judul-section">Partners</h4>
    <h4 class="fw-light mt-4 mb-4 judul-section">Corporate, Members & Sponsors</h4>
    <div class="row row-cols-md-6 row-cols-2 mb-3 justify-content-center">
	<?php foreach($partners as $value){ ?>
        <div class="col">
            <div class="card g-2">
                <img src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" class="card-img-top" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $value->data_name ?>">
            </div>
        </div>
	<?php } ?>
    </div>
    <h4 class="fw-light mt-4 judul-section">Supported By</h4>
    <div class="row row-cols-md-6 row-cols-2 align-items-center mb-3">
		<?php foreach($supports as $value){ ?>
        <div class="col">
            <div class="card g-2">
                <img src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" class="img-thumbnail" style="width: 300px; height: 100px; object-fit: scale-down;" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $value->data_name ?>"/>
            </div>
        </div>
		<?php } ?>
    </div>
</div>

<?php $this->load->view($template['partial_about_join']); ?>
