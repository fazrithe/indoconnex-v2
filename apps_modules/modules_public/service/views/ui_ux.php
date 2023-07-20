<style>
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

<div role="img" aria-label="UI/UX Design" class="mt-4 hero-guest image-banner" style="
	background-image: url('<?php echo base_url('public/themes/public/images/services/ui_ux/banner1.png') ?>');
	    -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
  "
>
    <div class="container">
        <section class="pb-5 pt-0 pt-sm-3 pt-lg-0 mb-5 mt-md-n2">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <h2 class="text-prussianblue">UI/UX Design</h2>
                    <p class="text-dark">Integrate top-of-the-line design to create a seamless <br />user experience for your web and mobile platforms.</p>
                </div>
                <div class="col-12 col-lg-4">
                    <img src="<?php echo base_url('public/themes/public/images/services/ui_ux/banner2.png') ?>" class="img-fluid float-end" alt="UI/UX Design">
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
                <p class="text-center" style="color: #333333;">Looking to work with a team that is able to establish a clear design process, never miss a deadline, with an accurate <br /> end result? For small and large businesses alike, we can tackle every kind of challenge to give your product an edge <br /> in UI/UX design.</p>
            </div>
        </div>
    </div>
</section>

<section class="my-5 py-5 bg-white">
    <div class="container">
        <h5 style="color: #808080;" class="text-center">Why</h5>
        <h2 class="text-center mb-4 text-prussianblue">Work with IndoConnex?</h2>
        <div class="row row-cols-1 row-cols-lg-2 gy-3 gy-md-4 g-lg-5">
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <img src="<?php echo base_url('public/themes/public/images/services/ui_ux/why_work_with_indoconnex1.png') ?>" class="img-fluid" alt="Designs">
                    </div>
                    <div class="col-sm-12">
                        <p class="mb-0">We focus our effort and create designs based on the needs of the user.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <img style="height: 169px;" src="<?php echo base_url('public/themes/public/images/services/ui_ux/why_work_with_indoconnex2.png') ?>" class="img-fluid" alt="Collaboration">
                    </div>
                    <div class="col-sm-12">
                        <p class="mb-0">Collaboration is key; we always work together as a team.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <img src="<?php echo base_url('public/themes/public/images/services/ui_ux/why_work_with_indoconnex3.png') ?>" class="img-fluid" alt="Possessing vast experience">
                    </div>
                    <div class="col-sm-12">
                        <p class="mb-0">Possessing vast experience in creating cross-platform designs, we mantain the same quality of work across the board.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <img src="<?php echo base_url('public/themes/public/images/services/ui_ux/why_work_with_indoconnex4.png') ?>" class="img-fluid" alt="Efficient, methodical">
                    </div>
                    <div class="col-sm-12">
                        <p class="mb-0">Efficient, methodical, with excellent results to back it up.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-5 py-5" style="background-color: #F2F4F8;">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-1 gy-3 gy-md-4 g-lg-5">
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h5 class="text-prussianblue">Client-First Design Process</h5>
                        <p class="mb-0">Whenever a client comes with a request, our designers and developers work in tandem to ensure that the final product isn’t only usable, but caters to the needs of the client —  with fantastic-looking results to boot.</p>
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo base_url('public/themes/public/images/services/ui_ux/client_first_design_process.png') ?>" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="<?php echo base_url('public/themes/public/images/services/ui_ux/comprehensive_end_to_end_solution.png') ?>" class="img-fluid" alt="Comprehensive, End-to-End Solution">
                    </div>
                    <div class="col-sm-6">
                        <h5 class="text-prussianblue">Comprehensive, End-to-End Solution</h5>
                        <p class="mb-0">From researching, sketching, prototyping, to the actual implementation, we offer an end-to-end solution for your every UI/UX design needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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