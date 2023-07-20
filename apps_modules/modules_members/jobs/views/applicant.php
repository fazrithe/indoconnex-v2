<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_jobs']); ?>

<!-- Page Content  -->
<main class="py-4">
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                <select name="businessSelector" onchange="selectFilterjobs_applicant(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                <option value="1" data-id="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
                    <?php foreach($business_list as $value) {
                        $selected = '';
                    if ($filter_id == $value->id) $selected = 'selected'; ?>
                        <option value="<?php echo $value->id ?>"
                            data-id="<?php echo $value->id ?>"
                            data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class="" <?php echo $selected?> data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $value->data_name ?>">
                                <?php echo $value->data_name ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <span class="d-flex fw-bold mb-3">Job Applicant</span>
            <?php foreach($jobs as $value){ ?>
            <div class="card ">
            <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <div class="card-header bg-white border-0 pt-3">
                    <div class="flex-row d-flex mb-3 align-items-center">
                        <div class="flex-shrink-0 placeholder-glow">
                            <img data-src="<?php echo placeholder($value->file_path, $value->file_name_original) ?>" class="work-experience-img rounded-3 border placeholder" alt="<?php echo slug('') ?>" data-imgtype="work">
                        </div>
                        <div class="flex-grow-1 ms-3 flex-column d-flex">
                            <span class="fw-semi fs-16 fw-bold text-black align-items-center d-flex"><?php echo $value->data_name ?></span>
                            <div class="text-muted fs-14"><?php echo count_applicant($value->id) ?> Applicants</div>
                        </div>
                        <?php foreach($applicants as $app_val){
                            if($app_val->jobs_id == $value->id){ ?>
                        <div class="flex-shrink-0 ps-auto align-self-start collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $value->id ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $value->id ?>">
                            <a href="#" class="btn btn-sm btn-danger-outline">View All</a>
                        </div>
                        <?php }} ?>
                    </div>
                </div>
                <div id="flush-collapse<?php echo $value->id ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    <div class="card-body">
                    <?php foreach($applicants as $app_val){
                          if($app_val->jobs_id == $value->id){
                    ?>
                    <div class="mb-3 border-1 border-muted">
                        <div class="flex-column d-flex">
                            <div class="flex-row d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 placeholder-glow">
                                    <img data-src="<?php echo placeholder($app_val->file_path, $app_val->file_name_original) ?>" class="rounded-circle work-experience-img border placeholder" alt="<?php echo slug('') ?>" data-imgtype="work">
                                </div>
                                <div class="flex-grow-1 ms-3 flex-column d-flex">
                                    <h6 class="fs-14 text-black align-items-center d-flex"><?php echo $app_val->fullname ?></h6>
                                    <div class="text-muted fs-14">@<?php echo $app_val->username ?></div>
                                </div>
                            </div>
                            <div class="text-black text-break mb-3"><?php echo words($app_val->data_description, 100) ?></div>
                            <div class="flex-row d-flex ">
                                <button class="btn btn-prussianblue me-3 fw-bold fs-14" role="button" data-bs-toggle="modal" data-bs-target="#modal_cv<?php echo $app_val->id ?>">View CV</button>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
            </div>
            </div>
               
            </div>
            <hr>
            <?php } ?>
        </div>
    </div>
</main>
<?php foreach($applicants as $app_val){
?>
<div class="modal fade" id="modal_cv<?php echo $app_val->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">CV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <embed type="application/pdf" src="<?php echo base_url()?><?php echo $app_val->upload_file_path ?><?php echo $app_val->upload_file_name ?>" width="480" height="400"></embed>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_jobs']); ?>