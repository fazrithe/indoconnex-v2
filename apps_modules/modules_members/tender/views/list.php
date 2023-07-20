<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_tender']); ?>

<!-- Page Content  -->
<main class="py-4">
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                    <select name="businessSelector" onchange="selectUserTender(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
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
                <span class="d-flex fw-bold mb-3">My Tender</span>
                <?php
                if($business > 0){
                    if(!empty($tender_list)):
                    foreach($tender_list as $value){ ?>
                    <div class="d-flex bg-white align-items-center mb-3">
                        <div class="flex-shrink-0 placeholder-glow">
                            <img class="company-logos placeholder m-3 rounded-3 border" data-src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-imgtype="shopping_bag" alt="">
                        </div>
                        <div class="flex-grow-1 ms-3 flex-column">
                        <span class="fw-bold text-prussianblue align-items-center d-flex fw-bold fs-16"><?php echo $value->data_name ?>
                            <?php if (!empty($value->status_verification)) { ?>
                                <span class="ms-2 material-icons text-verified md-16">check_circle</span>
                            <?php }?>
                        </span>
                            <span class="text-muted fs-14"> <?php if(!empty($value->data_categories)){
                                                    foreach($tender_categories as $category_val){
                                                            if($value->data_categories == $category_val->id ){
                                                                echo $category_val->data_name;
                                                            }
                                                        }
                                                    }
                                                ?></span>
                        </div>
                        <div class="flex-shrink-0 ps-auto text-right mx-2 d-grid">
                            <a href="#tender-detail" data-bs-toggle="modal" class="btn btn-danger fs-14 fw-bold" role="button" data-bs-tenderid="<?php echo $value->id?>">View Tender Detail</a>
                        </div>
                    </div>
                    <?php }; else: ?>
                        <div class="card-body bg-white border-0">
                            <div class="d-flex align-items-center flex-column">
                                <div class="mb-3">
                                    <img src="<?php echo site_url('public/themes/user/images/products/default.png') ?>" alt="no-product-service">
                                </div>
                                <div class="mb-3">
                                    <span class="text-muted fw-semi fs-18">You do not have any tender</span>
                                </div>
                                <div class="mb-3">
                                    <a href="<?php echo site_url('tender/create') ?>" class="btn btn-danger fw-bold fs-14">Create Tender</a>
                                </div>
                            </div>
                        </div>
				    <?php endif ?>
                <?php }else{ ?>
                    <div class="card-body bg-white border-0">
                            <div class="d-flex align-items-center flex-column">
                                <div class="mb-3">
                                    <img src="<?php echo site_url('public/themes/user/images/products/default.png') ?>" alt="no-product-service">
                                </div>
                                <div class="mb-3">
                                    <span class="text-muted fw-semi fs-18">You must have a business page first before creating products and services!</span>
                                </div>
                                <div class="mb-3">
                                    <a href="<?php echo site_url('business/create') ?>" class="btn btn-danger fw-bold fs-14">Create Business Page</a>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div>
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['partials_modal_tender_detail']); ?>
<?php $this->load->view($template['action_ajax_tender']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
