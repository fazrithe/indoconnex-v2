<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_market']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<main class="py-4">
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                    <select name="businessSelector" onchange="selectUserMarket(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                         <?php
						 	$once = 0;
							foreach($business_list as $value) {
                            	$selected = '';
								if(!empty($filter_id)) {
									if ($filter_id == $value->id) $selected = 'selected';
								}
							?>
                            <option value="<?php echo $value->id ?>"
                                data-id="<?php echo $value->id ?>"
                                data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class="" <?php echo $selected?> data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $value->data_name ?>">
                                    <?php echo $value->data_name ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <span class="d-flex fw-bold mb-3">My Product/Service</span>
                <?php
                if($business > 0){
                    if(!empty($items_list)):
                    foreach($items_list as $value){ ?>
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
                            <span class="text-muted fs-14"><?php echo $value->data_type ?></span>
                        </div>
                        <div class="ps-auto text-right mx-2">
                            <a href="#product-detail" data-bs-toggle="modal" class="btn btn-danger fs-14 fw-bold" role="button" data-bs-productid="<?php echo $value->id?>">View Product Detail</a>
                        </div>
                    </div>
                    <?php }; else: ?>
                        <div class="card-body bg-white border-0">
                            <div class="d-flex align-items-center flex-column">
                                <div class="mb-3">
                                    <img src="<?php echo site_url('public/themes/user/images/products/default.png') ?>" alt="no-product-service">
                                </div>
                                <div class="mb-3">
                                    <span class="text-muted fw-semi fs-18">You do not have any product or service</span>
                                </div>
                                <div class="mb-3">
                                    <a href="<?php echo site_url('market/create') ?>" class="btn btn-danger fw-bold fs-14">Create Product & Service</a>
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
<?php $this->load->view($template['partials_modal_market_detail']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
