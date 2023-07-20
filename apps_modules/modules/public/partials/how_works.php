<!-- SECTION - How does IndoConnex work? -->
<div class="section-wrapper bg-white">
    <div class="container mt-4 py-4">
        <div class="row p-6 mt-1 mb-4">
            <h2 class="mt-4 title-dark">How does IndoConnex work?</h2>
			<?php foreach($work as $value){ ?>
            <div class="col-6 col-xs-3 col-md-3">
                <div class="card border-0 bg-transparent">
                    <img class="card-img-top" src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" alt="connecting Business">
                    <div class="card-body p-0">
                        <h6 class="card-title mt-4"><?php echo $value->data_name ?></h6>
                        <p class="card-text"><?php echo $value->data_description ?></p>
                    </div>
                </div>
            </div>
			<?php } ?>
        </div>
    </div>
</div>
