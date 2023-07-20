<!-- navbar -->
<?php $this->load->view($template['partials_navbar_business']); ?>

<?php if(empty($community->status_privacy) || !empty($checkusers_profile)) { ?>
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
                            <a class="dropdown-item" href="#" role="button" aria-expanded="false" aria-controls="workExperience" data-bs-toggle="modal" data-bs-target="#addproductserviceModal">Add Product</a>
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
                <span class="text-muted ">You do not have any product or service</span>
            </div>
        </div>
        <?php endif; ?>
        <div class="row row-cols-2 row-cols-md-4 g-2 mb-3">
            <?php foreach($products as $value){ ?>
            <div class="col">
                <div class="card card-product rounded-3">
                    <div class="placeholder-glow discover-img">
                        <img src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" alt="" class="card-img-top placeholder h-100">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <h6 class="text-muted">Computer</h6>
                            <div class="ms-auto">
                                <div class="dropdown">
                                    <a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <span class="text-muted material-icons">more_horiz</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item" href="#" role="button" aria-expanded="false" aria-controls="workExperience" data-bs-toggle="modal" data-bs-target="#editproductserviceModal" data-bs-id="">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" role="button" aria-expanded="false" aria-controls="workExperience" data-bs-toggle="modal" data-bs-target="#deleteproductserviceModal">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex fw-bold"><?php echo $value->data_name ?></div>
                        <span class="d-flex">Lorem Ipsum</span>
                        <div class="d-flex align-items-start">
                            <span class="ms-auto text-prussianblue fw-bold">
                            <?php if(empty($value->price_variant)){
                                            echo  number_amount($value->price_currency,$value->price_low);
                                          }else{
                                            if(!empty($value->price_variant)){
                                                $result = json_decode($value->price_variant);
                                                foreach($result as $price){
                                                echo 'Qty : '.$price->qty.' = ';
                                                echo number_amount($value->price_currency,$price->price).'<br>';
                                                }
                                            }
                                        } ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php $this->load->view($template['partials_modal_product']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
<?php } else { ?>
    <div class="container mb-4">
        <div class="row">
            <div class="col mx-auto">
                <div class="mb-4 rounded-3 msn-widget">
                    <div class="text-center p-md-4 p-2">
                        This account is Private
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
