<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_jobs']); ?>

<!-- Page Content  -->
<main class="py-4">
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0 mt-4">
            <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                <select name="businessSelector" onchange="selectUserArticle(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                    <option value="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
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

			<span class="d-flex fw-bold mb-3">Manage Job</span>

            <div class="row row-cols-2 g-3">
                <?php foreach($jobs as $value){ ?>
                <div class="col-6 d-flex">
                    <div class="d-flex bg-white flex-column p-3 w-100">
                        <div class="flex-row d-flex mb-3">
                            <div class="flex-shrink-0 placeholder-glow">
                                <?php
                                    $image = 'public/themes/user/images/placehold/job-1x1.png';
                                    if (!empty($value->file_name_original)) {
                                        $image = base_url() . $value->file_path . $value->file_name_original;
                                    }
                                ?>
                                <img data-src="<?php echo $image ?>" class="company-logos rounded-3 border placeholder" alt="<?php echo slug('') ?>" data-imgtype="work">
                            </div>
                            <div class="flex-grow-1 ms-3 fs-12 flex-column d-flex">
                                <h6 class="fw-semi fs-12 text-black align-items-center d-flex"><?php echo $value->data_name ?></h6>
                                <div>
                                    <span class="material-icons fs-12 text-gray me-2">place</span> 
                                    <?php
                                        if (! empty($value->data_location)) {
                                            foreach (json_decode($value->data_location) as $location) {
                                                echo $location->city_name;
                                            }
                                        }
                                    ?>
                                </div>
                                <div><span class="material-icons fs-12 text-gray me-2">paid</span> <?php echo $value->jb_salary_currency ?> <?php echo number_format($value->jb_salary_min,2,",","."); ?>-<?php echo number_format($value->jb_salary_max,2,",","."); ?>/Hours</div>
                                <div><span class="material-icons fs-12 text-gray me-2">work</span>
                                <?php foreach($types as $type_val){
                                      if($type_val->id == $value->jobs_types_id){
                                            echo $type_val->data_name;
                                      }
                                } ?></div>
                                <div class="d-flex flex-row">
                                    <span class="material-icons fs-12 text-gray" style="margin-right: .80rem !important;">business</span> 
                                    <div class="d-flex flex-column">
                                    <?php         
                                        if (! empty($value->data_categories)) {
                                            $categories = json_decode($value->data_categories);
                                            foreach($categories as $category){
                                                echo '<span>'.get_job_category_by_id($category).'</span>';
                                            }
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start ms-auto">
                                <div class="badge rounded-pill bg-danger p-1 d-flex">
                                    <!-- <button class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_jobs<?php echo $value->id ?>">
                                        <span class="material-icons text-white md-16">edit</span>
                                    </button> -->
                                    <a href="<?= base_url() . 'jobs/edit/' . $value->id; ?>" class="btn btn-sm d-flex align-items-center px-1 py-0" role="button">
                                        <span class="material-icons text-white md-16">edit</span>
                                    </a>
                                    <div class="vr opacity-100"></div>
                                    <button class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" id="deleteJob" onclick="deletejob('<?php echo $value->id ?>')" data-itemid="">
                                        <span class="material-icons text-white md-16">delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="text-break me-auto fs-12 text-black"><?php echo words($value->data_description, 50) ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php echo $pagination; ?>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['partials_modal_jobs']); ?>
<?php $this->load->view($template['action_ajax_jobs']); ?>
