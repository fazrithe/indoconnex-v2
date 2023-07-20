<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_favourite']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >
            <div class="mb-4 p-4 rounded-3 msn-widget" >
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/jobs.svg') ?>" class="img-circle" alt="job-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('jobs/discover') ?>" class="text-prussianblue fw-bold ">Job</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="prod-rand">
                        <?php foreach ($jobs as $value){ ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="placeholder-glow pt-4 px-4">
                                    <div class="d-flex flex-row align-items-start">
                                        <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'job') ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top work-experience-img fit-cover border-gray-2 border-1">
                                        <button type="button" class="btn btn-favourite ms-auto fs-18 text-danger bg-light rounded-circle p-2 <?php echo active_favourite($value->id,'pcj_jobs'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="jobs" data-content-id="<?php echo $value->id ?>" autocomplete="off">
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body flex-column d-flex placeholder-glow px-3 pt-2 pb-0">
                                    <span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
                                        <a class="text-black" href="<?php echo site_url('jobs/detail/'.$value->id)?>"><?php echo $value->data_name ?></a>
                                    </span>
                                    <span class="fs-14 text-muted text-wrap" id="bsn-rand1-tag">
                                        <a class="text-muted" href="<?php echo site_url('jobs/detail/'.$value->id)?>"><?php echo $value->username ?></a>
                                    </span>
                                </div>
                                <div class="card-footer bg-transparent d-flex border-0 p-4">
                                    <div class="vstack align-items-start">
                                        <div class="text-black fs-12 d-flex"><span class="material-icons text-gray fs-16 me-1">paid</span> IDR100.000 - 130.000 /Hours</div>
                                        <div class="text-black fs-12 d-flex"><span class="material-icons text-gray fs-16 me-1">work</span> Full-Time</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>