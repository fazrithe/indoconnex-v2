<!-- banner -->
<div class="justify-content-center d-flex hero-guest">
    <img class="w-100" src="<?php echo theme_user_locations(); ?>images/banner/banner-business.png" alt="" />
</div>

<?php $this->load->view($template['partial_filter']); ?>

<!-- Gallery Pages -->
<div class="container">
    <h2 class="mt-4 title-dark">Category Highlights</h2>
    <div class="row mt-1">
        <?php foreach ($cards as $card):?>
            <div class="col-4 col-md-2">
                <div class="card border-0">
                    <a href="<?php echo $card['route']?>">
                        <img class="card-img-top" src="<?php echo $card['image'] ?>" alt="">
                    </a>
                    <div class="card-body">
                        <h6 class="card-title"><?php echo $card['title'] ?></h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <section id="tabs" class="project-tab">
    <h5 class="fw-light text-lg-left mt-4 mb-3">Business Industries</h5>
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active bg-transparent" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Supplier & Distributor</a>
                        <a class="nav-item nav-link bg-transparent" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Business Service & Consulting</a>
                    </div>
                </nav>
                <div class="text-prussianblue" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table class="table tab-list" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Agribusiness  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Electronics  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Health and Medical  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Restaurant and Lounge  ›</a></td>
                                </tr>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Automotive  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Fabrication and Machinery  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Home Appliance  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Security and Protection  ›</a></td>
                                </tr>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Beauty and Personal Care  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Fashion  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Home and Garden  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Lights and Lighting  ›</a></td>
                                </tr>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Consulting  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Financial  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Lights and Lighting  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Toys and Hobbies  ›</a></td>
                                </tr>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Consumer Good  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Furniture  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Office and School  ›</a></td>
                                    <td><div class="card border-0"><a href="#"></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table class="table tab-list" cellspacing="0">
                        <tbody>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Agribusiness  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Electronics  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Health and Medical  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Restaurant and Lounge  ›</a></td>
                                </tr>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Automotive  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Fabrication and Machinery  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Home Appliance  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Security and Protection  ›</a></td>
                                </tr>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Beauty and Personal Care  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Fashion  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Home and Garden  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Lights and Lighting  ›</a></td>
                                </tr>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Consulting  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Financial  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Lights and Lighting  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Toys and Hobbies  ›</a></td>
                                </tr>
                                <tr>
                                    <td><div class="card border-0"><a href="#">Consumer Good  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Furniture  ›</a></td>
                                    <td><div class="card border-0"><a href="#">Office and School  ›</a></td>
                                    <td><div class="card border-0"><a href="#"></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div >
        <img class="w-100 mb-2" src="<?php echo theme_user_locations(); ?>images/banner/business1.png" alt="" />
        <img class="w-100 mb-2" src="<?php echo theme_user_locations(); ?>images/banner/business2.png" alt="" />
        <img class="w-100 mb-2" src="<?php echo theme_user_locations(); ?>images/banner/business3.png" alt="" />
        <img class="w-100 mb-2" src="<?php echo theme_user_locations(); ?>images/banner/business4.png" alt="" />
    </div>
    <div class="justify-content-center mb-4">
        <h5 class="fw-light text-lg-left mt-4 mb-3">Discover Partnership Opportunities</h5>
        <div class="d-flex text-white">
            <div class="col">
                <div class="card h-100 w-100 rounded-0" style="background-color: #f5524b;">
                    <div class="ratio ratio-1x1">
                        <p class="card-text d-flex justify-content-center align-items-center">Business Partner</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 w-100 bg-danger rounded-0">
                    <div class="ratio ratio-1x1">
                        <p class="card-text d-flex justify-content-center align-items-center">Investor</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 w-100 bg-bright-blue1 rounded-0">
                    <div class="ratio ratio-1x1">
                        <p class="card-text d-flex justify-content-center align-items-center">Distributor</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 w-100 rounded-0" style="background-color: #3b5998;">
                    <div class="ratio ratio-1x1">
                        <p class="card-text d-flex justify-content-center align-items-center">Wholesaler</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 w-100 rounded-0" style="background-color: #3aa2eb;">
                    <div class="ratio ratio-1x1">
                        <p class="card-text d-flex justify-content-center align-items-center">Reseller</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-10">
            <h5 class="fw-light text-left mt-4 mb-3">Find Business Groups and Forums</h5>
        </div>
        <div class="col-2 ml-auto">
            <a href=""><p class="fw-light text-right mt-4 mb-3 text-danger">View All</p></a>
        </div>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-4 mb-3">
        <div class="col-6 col-md-3">
            <div class="card h-100">
                <img src="<?php echo theme_user_locations() ?>images/pages/business6.png" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Import - Export Business</h5>
                <p class="card-text"><small class="text-muted">1.2K Members</small></p>
                <p class="card-text">Basic group guidelines 1. All post must be in ENGLISH (all other po..</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card h-100">
                <img src="<?php echo theme_user_locations() ?>images/pages/business7.png" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Business IDEAS</h5>
                <p class="card-text"><small class="text-muted">1.2K Members</small></p>
                <p class="card-text">Post your product ideas. Ask each other for idea, Give good suggesti...</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card d-none d-md-block h-100">
                <img src="<?php echo theme_user_locations() ?>images/pages/business8.png" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Enterpreneurs & StartUps</h5>
                <p class="card-text"><small class="text-muted">1.2K Members</small></p>
                <p class="card-text">This group is for small business owners, enterpreneurs, startup b...</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card d-none d-md-block h-100">
                <img src="<?php echo theme_user_locations() ?>images/pages/business9.png" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Promote your business</h5>
                <p class="card-text"><small class="text-muted">1.2K Members</small></p>
                <p class="card-text">Promote your business online group post ypur offers and oppor...</p>
                </div>
            </div>
        </div>
    </div>
</div>
