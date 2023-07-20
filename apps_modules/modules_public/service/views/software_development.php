<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<style>
.card {
    box-shadow: 0px 4px 8px 0px #BDBDBD;
}

.profile-pic {
    width: 100px !important;
    height: 100px;
    box-shadow: 0px 4px 8px 0px #BDBDBD;
}

.owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev {
    background: 0 0;
    color: #1E88E5 !important;
    border: none;
    padding: 5px 20px !important;
    font: inherit;
    font-size: 50px !important;
}

.owl-carousel .owl-nav button.owl-next:hover, .owl-carousel .owl-nav button.owl-prev:hover {
    color: #0D47A1 !important;
    background-color: transparent !important;
}

.owl-dots {
    display: none; 
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0;
}

.item {
    display: none;
	margin: auto;
}

.next {
    display: block !important;
    position: relative;
    transform: scale(0.8);
    transition-duration: 0.3s;
    opacity: 0.6;
}

.prev {
    display: block !important;
    position: relative;
    transform: scale(0.8);
    transition-duration: 0.3s;
    opacity: 0.6;
}

.item.show {
    display: block;
    transition-duration: 0.4s;
}

@media screen and (max-width: 999px) {
    .next, .prev {
        transform: scale(1);
        opacity: 1;
    }

    .item {
        display: block !important;
    }
}

body {
    background-color:#fff !important;
}
@media screen and (min-width: 1140px) {
  .image-banner {
    height: 340px;
  }
}
@media screen and (min-width: 1400px) {
  .image-banner {
    height: 340px;
  }
}
@media screen and (min-width: 1600px) {
  .image-banner {
    height: 340px;
  }
}
@media screen and (min-width: 1900px) {
  .image-banner {
    height: 340px;
  }
}
</style>
<div role="img" aria-label="Graphic Design" class="mt-4 hero-guest image-banner" style="
	background-image: url('<?php echo base_url('public/themes/public/images/services/graphic_design/banner1.png') ?>');
	    -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
  "
>
    <div class="container">
        <section class="pb-5 pt-0 pt-sm-3 pt-lg-0 mb-5 mt-md-n5">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <h2 class="text-prussianblue">Graphic Design</h2>
                    <p class="text-dark">Create aesthetically pleasing and meaningful designs that are <br /> on-brand according to your needs.</p>
                </div>
                <div class="col-12 col-lg-4">
                    <img style="height: 276px;" src="<?php echo base_url('public/themes/public/images/services/graphic_design/banner2.png') ?>" class="img-fluid float-end" alt="Graphic Design">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <form method="GET" action="<?php echo site_url('/query') ?>">
                        <div class="d-none d-md-flex justify-content-md-evenly align-items-md-center">
                            <div class="col-2">
                                <input type="search" name="query" class="form-control form-control-sm" placeholder="<?php echo $search_place ?>" onkeyup="" value="<?php echo !empty($query) ? $query : '' ?>">
                            </div>
                            <div class="col-3">
                                <select class="form-select form-select-sm" name="business-country" id="selCountry_public" >
                                    <option value="">Select Country</option>
                                </select>
                                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            </div>
                            <div class="col-3">
                                <select class="form-select form-select-sm" name="business-state" id="selState_public" disabled>
                                    <option value="">Select State</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <select class="form-select form-select-sm" name="business-city" id="selCity_public" disabled>
                                    <option value="">Select City</option>
                                </select>
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-danger d-flex align-items-center mx-auto">
                                    <span class="material-icons">search</span>
                                </button>
                            </div>
                        </div>

                        <div class="input-group d-inline-flex d-md-none align-items-xs-center">
                            <input class="form-control py-2 rounded-pill-left me-1 pe-5 w-80" type="search" placeholder="search" name="qm" >
                            <button class="btn btn-danger rounded-pill-right border-0 ms-n5 d-flex align-items-center" type="submit">
                            <span class="material-icons">search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<section style="background-color: #F2F4F8;">
    <div class="container">
        <div class="row p-5 my-5">
            <div class="col-12">
                <p class="text-center" style="color: #333333;">In a crowded, oversaturated space that features thousands of indistinct designs, yours should stand out from the <br /> crowd, head and shoulders above the rest; and our graphic design services will accomplish just that. We will help you <br /> visually communicate your brand to your audience’s minds and ensure that it stays. Your imagination’s the limit, and <br /> we will bring it to life.</p>
            </div>
        </div>
    </div>
</section>

<section class="my-5 bg-white">
    <div class="container">
        <h5 style="color: #808080;" class="text-center">Why</h5>
        <h2 class="text-center mb-4 text-prussianblue">Work with IndoConnex?</h2>
        <div class="row row-cols-1 row-cols-lg-1 gy-3 gy-md-4 g-lg-5">
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h5 style="color: #333333;">Your Brand. Our Solution.</h5>
                        <p style="color: #333333;" class="mb-0">We will work closely with your team so that ours can deliver a final product that satisfy your vision and accomplish your goals. When you reach your audience, we draw them in.</p>
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo base_url('public/themes/public/images/services/graphic_design/your_brand_our_solution.png') ?>" class="img-fluid float-end" alt="Your Brand. Our Solution.">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid px-3 px-sm-5 my-5 text-center">
	<h5 style="color: #808080;" class="text-center">Our</h5>
    <h2 class="text-center mb-4 text-prussianblue">Services</h2>
	<!-- <center> -->
    <div class="owl-carousel owl-theme">
        <div class="item first prev" style="width: 400px;">
			<div class="card bg-white p-5 h-100" style="margin: 0px;">
                <img src="<?php echo base_url('public/themes/public/images/services/graphic_design/branding_and_logo_design.png') ?>" class="card-img-top" alt="Branding and Logo Design">
                <div class="card-body">
                	<h5 class="card-title text-center">Branding and Logo Design</h5>
                </div>
            </div>
        </div>
        <div class="item show" style="width: 400px;">
			<div class="card bg-white p-2 h-100" style="margin: auto;">
                <img src="<?php echo base_url('public/themes/public/images/services/graphic_design/print_and_layout_design.png') ?>" class="card-img-top" alt="Print and Layout Design">
                <div class="card-body">
                    <h5 class="card-title text-center">Print and Layout Design</h5>
                </div>
            </div>
        </div>
        <div class="item next" style="width: 400px;">
			<div class="card bg-white h-100" style="padding: 10px;">
                <img src="<?php echo base_url('public/themes/public/images/services/graphic_design/marketing_collaterals_design.png') ?>" class="card-img-top" alt="Marketing Collaterals Design">
                <div class="card-body">
                    <h5 class="card-title text-center">Marketing Collaterals Design</h5>
                </div>
            </div>
        </div>
        <div class="item last" style="width: 400px;">
			<div class="card bg-white h-100" style="padding: 8px;">
                <img src="<?php echo base_url('public/themes/public/images/services/graphic_design/social_media_content.png') ?>" class="card-img-top" alt="Social Media Content">
                <div class="card-body">
                	<h5 class="card-title text-center">Social Media Content</h5>
                </div>
            </div>
        </div>
    </div>
	<!-- </center> -->
</div>

<section>
    <div class="container">
        <div class="row mt-1">
            <div class="col-12 col-xs-12 col-md-12">
                <h5 class="title-dark">Looking to elevate your designs?</h5>
                <h2 class="mt-4 title-dark">Tell us what you need.</h2>
                <div class="card text-dark bg-light mb-3">
                    <div class="card-body">
                        <form action="<?php echo current_url(); ?>" method="post">
                            <?php echo form_hidden(generate_csrf_nonce('contact-us')) ?>
                            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                            <div class="mb-3 row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="contact-name" >Name</label>
                                    <input type="text" name="contact-name" id="contact-name" class="form-control" placeholder="Insert name" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="contact-email">Email</label>
                                    <input type="email" name="contact-email" id="contact-email" class="form-control" placeholder="Insert email" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="contact-business-name">Business Name</label>
                                    <input type="text" name="contact-business-name" id="contact-business-name" class="form-control" placeholder="Insert business name">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="contact-phone" >Phone No</label>
                                    <input type="number" name="contact-phone" id="contact-phone" class="form-control" placeholder="Insert phone number">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="contact-subject" >Subject</label>
                                <input type="text" name="contact-subject" id="contact-subject" class="form-control" required placeholder="Insert subject">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="contact-message" >Message</label>
                                <textarea name="contact-message" id="contact-message" rows="5" class="form-control" maxlength="1500" minlength="50" placeholder="Insert message"></textarea>
                            </div>
                            <div class="mb-3">
                                <div class="g-recaptcha d-flex" data-sitekey="6LcDKpIcAAAAAC6nvq1LH7f8y6z1b2vz0qGRoDPp"></div>
                            </div>
                            <div class="mb-3 col-md-1 d-grid">
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <?php $this->load->view($template['partial_about_join']); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
	$(document).ready(function() {

$('.owl-carousel').owlCarousel({
    mouseDrag:false,
    loop:true,
    margin:2,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:3
        }
    }
}); 

$('.owl-prev').click(function() {
    $active = $('.owl-item .item.show');
    $('.owl-item .item.show').removeClass('show');
    $('.owl-item .item').removeClass('next');
    $('.owl-item .item').removeClass('prev');
    $active.addClass('next');
    if($active.is('.first')) {
        $('.owl-item .last').addClass('show');
        $('.first').addClass('next');
        $('.owl-item .last').parent().prev().children('.item').addClass('prev');
    }
    else {
        $active.parent().prev().children('.item').addClass('show');
        if($active.parent().prev().children('.item').is('.first')) {
            $('.owl-item .last').addClass('prev');
        }
        else {
            $('.owl-item .show').parent().prev().children('.item').addClass('prev');
        }
    }
});

$('.owl-next').click(function() {
    $active = $('.owl-item .item.show');
    $('.owl-item .item.show').removeClass('show');
    $('.owl-item .item').removeClass('next');
    $('.owl-item .item').removeClass('prev');
    $active.addClass('prev');
    if($active.is('.last')) {
        $('.owl-item .first').addClass('show');
        $('.owl-item .first').parent().next().children('.item').addClass('prev');
    }
    else {
        $active.parent().next().children('.item').addClass('show');
        if($active.parent().next().children('.item').is('.last')) {
            $('.owl-item .first').addClass('next');
        }
        else {
            $('.owl-item .show').parent().next().children('.item').addClass('next');
        }
    }
});

});
</script>
