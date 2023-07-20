
  <!-- Footer -->
  <footer
          class="text-center text-lg-start text-white"
          style="background-color: #d90000"
          >
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
	  <div class="row">
				  <div class="col-12">
				  <h6 class="text-uppercase mb-4 font-weight-bold"><img src="<?php echo theme_user_locations(); ?>images/logo/logo-footer.png" width="150px;" alt="Connecting Business"></h6>
				  </div> 
		</div>
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto">
			  
			<p>
              <a class="text-white"><a class="text-light" href="<?php echo site_url('partners')?>">Our Partners</a></a>
            </p>
            <p><a class="text-light" href="<?php echo site_url('contact-us')?>">Contact Us</a></p>
			<p><a class="text-light" href="<?php echo site_url('news')?>">News & Events</a></p>
            <p><a class="text-light" href="<?php echo site_url('covid/info')?>">COVID-19</a></p>
			<p><a class="text-light" href="<?php echo site_url('terms')?>">Terms of Use</a></p>
			<p><a class="text-light" href="<?php echo site_url('privacy')?>">Privacy & Policy</a></p>
			<p><a class="text-light" href="<?php echo site_url('infocenter')?>">Info Center</a></p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto">
		  <?php foreach($footer_menu1 as $value_page){ ?>
            <a class="text-light" href="<?php 
					if(!empty($value_page->data_name) and !empty($value_page->data_link_name)){
						echo base_url().$value_page->data_link.'/'.preg_replace('/[^a-zA-Z0-9-&]/', '-',$value_page->data_link_name);
					}else{
						echo base_url('#');
					} ?>"><p style=""><?php echo $value_page->data_name ?></p></a>
					<?php } ?>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
		  <?php foreach($footer_menu2 as $value_page){ ?>
            <a class="text-light" href="<?php 
					if(!empty($value_page->data_name) and !empty($value_page->data_link_name)){
						echo base_url().$value_page->data_link.'/'.preg_replace('/[^a-zA-Z0-9-&]/', '-',$value_page->data_link_name);
					}else{
						echo base_url('#');
					} ?>"><p style=""><?php echo $value_page->data_name ?></p></a>
					<?php } ?>
          </div>

          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
		  <?php foreach($footer_menu3 as $value_page){ ?>
            <a class="text-light" href="<?php 
					if(!empty($value_page->data_name) and !empty($value_page->data_link_name)){
						echo base_url().$value_page->data_link.'/'.preg_replace('/[^a-zA-Z0-9-&]/', '-',$value_page->data_link_name);
					}else{
						echo base_url('#');
					} ?>"><p style=""><?php echo $value_page->data_name ?></p></a>
					<?php } ?>
          </div>
          <!-- Grid column -->
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->

      <!-- <hr class="my-3"> -->

      <!-- Section: Copyright -->
	  <div
         class="text-left mt-2"
         >
		
		<div class="row mb-2">
		 <div class="col">
				<h4>Follow Us</h4>
		 </div>
		</div>
		<div class="row mb-2">
		 <div class="col">
				<i class="fa fa-facebook-square" style="font-size:24px"></i> <a href="https://www.facebook.com/IndoConnex" target="_blank" class="text-white">IndoConnex</a>
		 </div>
		</div>
		<div class="row mb-2">
		 <div class="col">
				<i class="fa fa-instagram" style="font-size:24px"></i> <a href="https://www.instagram.com/indoconnex/" target="_blank" class="text-white">@IndoConnex</a>
		 </div>
		</div>
		<div class="row mb-4">
		 <div class="col">
		 <i class="fa fa-linkedin-square" style="font-size:24px"></i> <a href="https://www.linkedin.com/company/indoconnex/" target="_blank" class="text-white">IndoConnex</a>
		 </div>
		</div>
		 <label><small>© 2022 - IndoConnex - All right reserved</small></label>
    </div>
      <!-- Section: Copyright -->
    </div>
    <!-- Grid container -->
  </footer>
  <!-- Footer -->
