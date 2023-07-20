<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_business']); ?>

<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-10 col-md-7 mx-5 mx-md-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                    <select name="businessSelector"  class=" border-0 bg-white p-2 js-businessSelector" onchange="manage(this.value)">
                        <?php foreach($business_list as $value){
                            if($value->id == $business->id){
                        ?>
                         <option value="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class="" selected><?php echo $value->data_name ?></option>
                         <?php }else{?>
                        <option value="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class=""><?php echo $value->data_name ?></option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <h6 class="text-lg-left text-prussianblue fw-bold">Manage Product & Service</h6>
                    <div class="ms-auto">
                        <div class="dropdown">
                            <a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-muted material-icons">more_horiz</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="#" role="button" aria-expanded="false" aria-controls="workExperience" data-bs-toggle="modal" data-bs-target="#productserviceModal">Add Product</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white row p-2">
                    <div class="col">
                        <div class="row row-cols-1 row-cols-md-2 g-2 mb-3">
                            <div class="col">
                                <div class="card card-product rounded-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="<?php echo theme_user_locations(); ?>images/products/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <div class="d-flex d-flex align-items-center">
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
                                                <div class="d-flex fw-bold">Laptop M530PZK Pro</div>
                                                <span class="d-flex">Lorem Ipsum</span>
                                                <div class="d-flex align-items-start">
                                                    <span class="ms-auto text-prussianblue fw-bold">IDR15.999.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-product rounded-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="<?php echo theme_user_locations(); ?>images/products/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <div class="d-flex d-flex align-items-center">
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
                                                <div class="d-flex fw-bold">Laptop M530PZK Pro</div>
                                                <span class="d-flex">Lorem Ipsum</span>
                                                <div class="d-flex align-items-start">
                                                    <span class="ms-auto text-prussianblue fw-bold">IDR15.999.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-product rounded-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="<?php echo theme_user_locations(); ?>images/products/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <div class="d-flex d-flex align-items-center">
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
                                                <div class="d-flex fw-bold">Laptop M530PZK Pro</div>
                                                <span class="d-flex">Lorem Ipsum</span>
                                                <div class="d-flex align-items-start">
                                                    <span class="ms-auto text-prussianblue fw-bold">IDR15.999.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-product rounded-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="<?php echo theme_user_locations(); ?>images/products/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <div class="d-flex d-flex align-items-center">
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
                                                <div class="d-flex fw-bold">Laptop M530PZK Pro</div>
                                                <span class="d-flex">Lorem Ipsum</span>
                                                <div class="d-flex align-items-start">
                                                    <span class="ms-auto text-prussianblue fw-bold">IDR15.999.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-product rounded-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="<?php echo theme_user_locations(); ?>images/products/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <div class="d-flex d-flex align-items-center">
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
                                                <div class="d-flex fw-bold">Laptop M530PZK Pro</div>
                                                <span class="d-flex">Lorem Ipsum</span>
                                                <div class="d-flex align-items-start">
                                                    <span class="ms-auto text-prussianblue fw-bold">IDR15.999.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-product rounded-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="<?php echo theme_user_locations(); ?>images/products/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <div class="d-flex d-flex align-items-center">
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
                                                <div class="d-flex fw-bold">Laptop M530PZK Pro</div>
                                                <span class="d-flex">Lorem Ipsum</span>
                                                <div class="d-flex align-items-start">
                                                    <span class="ms-auto text-prussianblue fw-bold">IDR15.999.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-product rounded-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="<?php echo theme_user_locations(); ?>images/products/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <div class="d-flex d-flex align-items-center">
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
                                                <div class="d-flex fw-bold">Laptop M530PZK Pro</div>
                                                <span class="d-flex">Lorem Ipsum</span>
                                                <div class="d-flex align-items-start">
                                                    <span class="ms-auto text-prussianblue fw-bold">IDR15.999.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-product rounded-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="<?php echo theme_user_locations(); ?>images/products/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <div class="d-flex d-flex align-items-center">
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
                                                <div class="d-flex fw-bold">Laptop M530PZK Pro</div>
                                                <span class="d-flex">Lorem Ipsum</span>
                                                <div class="d-flex align-items-start">
                                                    <span class="ms-auto text-prussianblue fw-bold">IDR15.999.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['partials_modal_product']); ?>
