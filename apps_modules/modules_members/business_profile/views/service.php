<!-- navbar -->
<?php $this->load->view($template['partials_navbar_business']); ?>

<div class="container mb-4">
    <div class="p-4 msn-widget rounded-3">
        <div class="d-flex align-items-start mb-3">
            <h6 class="text-lg-left text-prussianblue fw-bold">Product & Service</h6>
            <div class="ms-auto">
                <div class="dropdown">
                    <a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="text-muted material-icons">more_horiz</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="<?php echo base_url() . 'market/create'?>" role="button" aria-expanded="false">Add Product</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if (empty($products)) : ?>
        <div class="d-flex align-items-center flex-column">
            <div class="mb-3">
                <img src="<?php echo site_url('public/themes/user/images/products/default.png') ?>" alt="no-product-service">
            </div>
            <div class="mb-3">
                <span class="text-muted "><?php echo $business->data_name ?> do not have any product or service</span>
            </div>
        </div>
        <?php endif; ?>
        <div class="row row-cols-2 row-cols-md-4 g-2 mb-3">
            <?php foreach($products as $value){ ?>
            <div class="col">
                <div class="card rounded-3">
                    <div class="card-header discover-img">
                        <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'product', '16x9') ?>" alt="" class="img-card-top">
                    </div>
                    <div class="card-body">
                        <div class="d-flex fw-bold"><?php echo $value->data_name ?></div>
                        <div class="d-flex align-items-start">
                            <span class="ms-auto text-prussianblue fw-bold toPrice" data-low="<?php echo $value->price_low ?>" data-high="<?php echo $value->price_high ?>" data-currency="<?php echo $value->price_currency ?>" data-type="<?php echo $value->price_type ?>">
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
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php $this->load->view($template['action_ajax_market']); ?>