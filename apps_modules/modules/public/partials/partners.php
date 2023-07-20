<div class="section-wrapper bg-white">
    <div class="container py-4">
        <div class="row p-6 mt-1 mb-4 justify-content-start d-flex">
            <span class="fs-semi fs-24 mt-4 text-saphire">Corporate Members & Sponsors</span>
            <div class="row supported-slider align-items-center">
				<?php foreach($partners as $value){ ?>
                <div class="col-2">
                    <img class="w-100" src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php $value->data_name ?>">
                </div>
				<?php } ?>
            </div>
        </div>
        <div class="row p-6 mt-1 mb-4 justify-content-start d-flex">
            <span class="fs-semi fs-24 mt-4 text-saphire">Supported By</span>
            <div class="row supported-slider align-items-center">
				<?php foreach($supports as $value){ ?>
                <div class="col-2">
                    <img class="w-100" src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php $value->data_name ?>" style="width: 300px; height: 100px; object-fit: scale-down;">
                </div>
				<?php } ?>
            </div>
        </div>
    </div>
</div>
