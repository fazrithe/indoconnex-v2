<div class="container mb-3">

    <h4 class="fw-light judul-section mt-4">About IndoConnex</h4>
    <div class="row">
        <div class="col-sm">
            <?php echo $about_us->data_description ?>
        </div>
    </div>
    <h4 class="fw-light mt-4">Join Our Community</h4>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <p>Join us now and be part of a global network that is committed to
                building a better future together.</p>
            <div class="row">
                <div class="col-5">
                    <a href="<?php echo base_url('user/register') ?>" class="btn btn-danger">Become a member</a>
                </div>
                <div class="col-6">
                    <p class="text-danger">Learn more about membership ›</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h4>Already a member</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 ">
				<a href="<?php echo base_url('user/register') ?>" class="btn btn-danger">Login to My Account</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <img src="<?php echo theme_user_locations(); ?>images/global/banner-join.png" alt="Gallery image 1" class=""/>
        </div>
    </div>
</div>
