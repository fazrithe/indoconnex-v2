<?php $this->load->view($template['partial_banner']); ?>
<?php $this->load->view($template['partial_filter']); ?>

<div class="container mb-3">
    <div class="row">
        <div class="col-md-7 col-12">
            <h4 class="fw-light mt-4 mb-4 judul-section"><?php echo $about_us->data_name ?></h4>
            <?php echo $about_us->data_description ?>
        </div>
        <div class="col-md-1 d-none d-md-block"></div>
        <div class="col-md-4 mt-md-4 col-12">
            <blockquote class="blockquote mt-4">
                <p class="pt-4"><?php echo $quote->data_description ?></p>
            </blockquote>
        </div>
    </div>
</div>

<?php $this->load->view($template['partial_vision_mission']); ?>
