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
                        <img src="<?php echo site_url('public/themes/user/images/icons/product.png') ?>" class="img-circle" alt="product-service-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('market/discover') ?>" class="text-prussianblue fw-bold ">Product & Service</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="prod-rand">
                        <?php foreach ($product as $value){ ?>
                            <div class="col">
                            <div class="card h-100">
                                <div class="placeholder-glow business-card position-relative">
                                <?php
                                $url = base_url() . 'public/themes/user/images/placehold/product-16x9.png';
                                if(!empty($value->file_name_original)) {
                                    $url = base_url() . $value->file_path . $value->file_name_original;
                                }
                                ?>
                                    <img src="<?php echo $url ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top w-100">
                                    <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pbd_items'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="market" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body flex-column d-flex placeholder-glow px-3 pt-3 pb-0">
                                    <span class="fs-14 text-muted text-wrap" id="bsn-rand1-tag">
                                        <?php echo !empty($value->data_type) ? $value->data_type : '-'; ?>
                                    </span>
                                    <span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
                                        <a href="#product-detail" data-bs-toggle="modal" class="text-black" role="button" data-bs-productid="<?php echo $value->id?>">
                                            <?php echo str_limit($value->data_name, 30) ?>
                                        </a>
                                    </span>
                                </div>
                                <div class="card-footer bg-transparent align-items-end d-flex border-0">
                                    <span class="d-flex text-prussianblue fs-16 ms-auto toPrice px-3 pt-0 pb-3" data-low="<?php echo $value->price_low ?>" data-high="<?php echo $value->price_high ?>" data-currency="<?php echo $value->price_currency ?>" data-type="<?php echo $value->price_type ?>">
                                        <?php
                                            if($value->price_type == 1)
                                                echo 'Free / Giveaway';
                                            if($value->price_type == 2)
                                                echo $value->price_low;
                                            if($value->price_type == 3)
                                                echo 'Starting at ' . $value->price_low;
                                            if($value->price_type == 4)
                                                echo 'Ask for Price';
                                            if($value->price_type == 5)
                                                echo 'Price Varies';
                                        ?>
                                    </span>
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
<?php $this->load->view($template['partials_modal_market_detail']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>