<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_market']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>" />

<!-- Page Content  -->
<main class="py-4">
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                    <select name="businessSelector" onchange="selectUserMarketmanage(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
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
                </div>
                <span class="d-flex fw-bold mb-3">Manage Product/Service</span>
                <?php  if($business > 0){ ?>
                <div class="row">
                    <div class="col-6">
                        <div class="bg-white">
                            <h3 class="text-prussianblue fw-semi fs-14 pt-4 px-4">
                                Products
                            </h3>
                            <div class="card p-3 border-0">
                                <?php foreach($items_list_product as $value){ ?>
								<div class="container">
                                <div class="row">
                                    <div class="col-sm-3 rounded-3">
                                        <img src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" alt="" srcset="" class="ratio ratio-4x3 rounded-3">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="d-flex flex-row">
                                            <div class="d-flex flex-column">
                                                <span class="fw-semi text-prussianblue fs-12"><?php echo $value->data_name ?></span>
                                                <span class="text-muted fs-12">
                                                <?php if(!empty($value->data_categories)){
                                                $categories = json_decode($value->data_categories);
                                                foreach($categories as $categories_val){
                                                    foreach($item_categories as $category_val){
                                                            if($categories_val == $category_val->id ){
                                                                echo $category_val->data_name;
                                                            }
                                                        }
                                                    }
                                                }
                                                ?></span>
                                            </div>

                                        </div>
                                        <span id="product-detail-label" class="text-danger fw-bold fs-10 my-4 d-flex">
                                            <?php foreach($item_labels as $labels_val){
                                                    if($value->data_label == $labels_val->id ){
                                                        echo $labels_val->data_name;
                                                    }
                                                }
                                            ?></span>
                                        <span class="text-prussianblue fw-semi fs-12 d-flex">
                                        <?php
                                            switch ((int)$value->price_type) {
                                                case 1:
                                                    echo 'Free / Giveaway';
                                                    break;

                                                case 2:
                                                    echo $value->price_low;
                                                    break;

                                                case 3:
                                                    echo 'Starting at ' . $value->price_low;
                                                    break;

                                                case 4:
                                                    echo 'Ask for Price';
                                                    break;

                                                case 5:
                                                    echo 'Variable Pricing';
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }
                                            ?>
                                        </span>
                                    </div>
									<div class="col-sm-3">
										<div class="ms-auto d-flex align-items-center">
                                                <div class="badge rounded-pill bg-danger p-1 d-flex align-items-center">
                                                    <!-- <button class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_product<?php //echo $value->id ?>" data-itemid="asdasd">
                                                        <span class="material-icons text-white md-16">edit</span>
                                                    </button> -->
                                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="<?= base_url() . 'market/edit/' . $value->id ?>"><span class="material-icons text-white md-16">edit</span></a>
                                                    <div class="vr opacity-100"></div>
                                                    <button class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" id="deleteProduct" onclick="deleteproduct('<?php echo $value->id ?>')" data-itemid="">
                                                        <span class="material-icons text-white md-16">delete</span>
                                                    </button>
                                                </div>
                                            </div>
									</div>
                                </div>
								</div>
                                <div class="row">
                                    <span class="text-black text-break text-pre-wrap fs-12">
                                    <?php echo !empty(character_limiter($value->data_description, 20)) ? $value->data_description : 'No Description' ?>
                                    </span>
                                </div>
                                <hr>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="bg-white">
                            <h3 class="text-prussianblue fw-semi fs-14 pt-4 px-4">
                                Service
                            </h3>
                            <div class="card p-3 border-0">
                            <?php foreach($items_list_service as $value){ ?>
                                <div class="row">
                                    <div class="col-4 rounded-3">
                                        <img src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" alt="" srcset="" class="ratio ratio-4x3 rounded-3">
                                    </div>
                                    <div class="col-8 p-3">
                                        <div class="d-flex flex-row">
                                            <div class="d-flex flex-column">
                                                <span class="fw-semi text-prussianblue fs-12">"<?php echo $value->data_name ?>"</span>
                                                <span class="text-muted fs-12">  <?php if(!empty($value->data_categories)){
                                                $categories = json_decode($value->data_categories);
                                                foreach($categories as $categories_val){
                                                    foreach($item_categories as $category_val){
                                                            if($categories_val == $category_val->id ){
                                                                echo $category_val->data_name;
                                                            }
                                                        }
                                                    }
                                                }
                                                ?></span>
                                            </div>

                                            <div class="d-flex align-items-center ms-auto">
                                                <div class="badge rounded-pill bg-danger p-1 d-flex">
                                                    <!-- <button class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_jasa<?php echo $value->id ?>">
                                                        <span class="material-icons text-white md-16">edit</span>
                                                    </button> -->
                                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="<?= base_url() . 'market/edit/' . $value->id ?>"><span class="material-icons text-white md-16">edit</span></a>
                                                    <div class="vr opacity-100"></div>
                                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" onclick="deleteproduct('<?php echo $value->id ?>')" data-itemid="">
                                                        <span class="material-icons text-white md-16">delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger fw-bold fs-10 my-4 d-flex"> <?php
                                            switch ((int)$value->price_type) {
                                                case 1:
                                                    echo 'Free / Giveaway';
                                                    break;

                                                case 2:
                                                    echo $value->price_low;
                                                    break;

                                                case 3:
                                                    echo 'Starting at ' . $value->price_low;
                                                    break;

                                                case 4:
                                                    echo 'Ask for Price';
                                                    break;

                                                case 5:
                                                    echo 'Variable Pricing';
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }
                                            ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="text-black text-break text-pre-wrap fs-12">
                                        <?php echo !empty(character_limiter($value->data_description, 20)) ? $value->data_description : 'No Description' ?>
                                    </span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
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

        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['partials_modal_market_detail']); ?>
<?php $this->load->view($template['partials_modal_product']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
