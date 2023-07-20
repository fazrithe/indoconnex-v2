
<div class="container">
    <h4 class="text-lg-left mt-4 mb-2 fs-24 text-prussianblue fw-bold"><?php echo $vision->data_name ?></h4>
    <div class="row justify-content-start h-100">
        <p class="ps-md-3 pt-2"><?php echo $vision->data_description ?></p>
    </div>
    <h4 class="text-lg-left mt-4 mb-2 fs-24 text-prussianblue fw-bold">Mission</h4>
    <div class="row h-100">
		<?php foreach($mission as $value){?>
        <div class="col">
            <div class="card border-0 h-100">
                <img src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" class="card-img-top" alt="...">
                <div class="card-body text-prussianblue">
                    <h5 class="card-title fw-semi fs-16"><?php echo $value->data_name ?></h5>
                    <h7 class="card-subtitle fw-semi fs-16"></h7>
                    <div class="card-text pt-3 fs-16"><?php echo $value->data_description ?>
                    </div>
                </div>
            </div>
        </div>
       <?php } ?>
	</div>
    <h4 class="fw-light mt-4 mb-4 fs-24 text-prussianblue">Be Part of Our Growing Global Community</h4>
    <div class="row justify-content-start mb-4 text-prussianblue">
        <p class="ps-md-3 col-md-4">Ready to expand your reach and make an impact every day? IndoConnex offers unlimited possibilities to help you envision your goals and reach your full potential while building a better future for all.
        </p>
    </div>
</div>
