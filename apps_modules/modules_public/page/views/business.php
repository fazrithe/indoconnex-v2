<!-- banner -->
<div class="bg-image d-flex hero-guest mt-4" style="
	background-image: url('<?php echo theme_user_locations(); ?>images/banner/business-page.png');
	 -webkit-background-size: cover;
	  -moz-background-size: cover;
	  background-size: cover;
	  -o-background-size: cover;
  "
>
<div class="container">
	<div class="row">
		<div class="col-12 mt-8 mb-8" class="align-middle" style="text-align: center;">
			<h4 class="text-white"></h4>
			<h2 class="text-white"><?php echo $title ?></h2>
			<p class="text-white fst-italic">Connect and engage with international and local businesses at every scale
			</p>
		</div>
	</div>
	</div>
</div>
<?php $this->load->view($template['partial_filter']); ?>

<!-- Gallery Pages -->
<div class="container">
    <h2 class="mt-4 title-dark"><?php echo $title ?></h2>
    <div class="row mt-1">
        <?php foreach ($cards as $card):?>
			<?php 
				if(!empty($this->session->userdata('is_login') == FALSE)){
                    $url = base_url('public/discover/business/').$card->data_link;
				}else{
					$url = base_url('business/discover/').$card->data_link; 
				}
			?>
            <div class="col-4 col-md-2">
                <div class="card border-0">
                    <a href="<?php echo $url ?>">
                        <img class="card-img-top" src="<?php echo base_url() . $card->file_path . $card->file_name_original; ?>" alt="">
                    <div class="card-body">
                        <h6 class="card-title"><?php echo $card->data_name ?></h6>
                    </div>
					</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
	<?php echo $pagination; ?>
</div>
 <!-- SECTION - JUMBOTRON-->
      
 <div class="container py-4">
        <h2 class="mt-4 title-dark">Business Type </h2>

        <div class="row align-items-md-stretch">
		<?php 
		if(!empty($business_types)){
		foreach($business_types as $value){ ?>
			<?php 
				if(!empty($this->session->userdata('is_login') == FALSE)){
					$url = site_url('public/discover/business/filter?business-type=').$value->id; 
				}else{
					$url = site_url('discover/business/filter?business-type=').$value->id;  
				}
			?>
          <div class="col-md-6">
		  <a href="<?php
		 	if(!empty($url)){ 
		  		echo $url; 
			} 
			?>">
            <div class="p-5 text-white bg-dark rounded-3" style="    background-image:
            linear-gradient(to bottom, rgba(0, 0, 0, 0.52), rgba(49, 49, 49, 0.73)),
            url('<?php echo base_url() . $value->file_path . $value->file_name_original; ?>');
           -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;">
            <div class="mx-auto" style="width: 200px;">
              <span class="align-middle">
                <h2><?php echo $value->data_name ?></h2>
              </span>
            </div>
            </div>
			
			</a>
            </div>
		<?php }} ?>
        </div>
      </div>
 <!-- SECTION - BUSINESS-Discover Business Page -->
 <div class="container">
      <div class="d-flex align-items-center mb-4">
          <div>
              <h2 class="mt-4 title-dark">Discover Business Page</h2>
              </div>
          <div class="ms-auto">
              <div class="dropdown">
			  <?php 
				if(!empty($this->session->userdata('is_login') == FALSE)){
					$url = base_url('public/business/discover/'); 
				}else{
					$url = base_url('business/discover/'); 
				}
			?>
                  <a href="<?php echo $url ?>" style="color:#EE0202 ;">View all</a>
              </div>
          </div>
      </div>
    <!-- BUSINESS - 1 -->
      <div class="row row-cols-2 row-cols-md-4">
				<?php foreach($business as $value){ ?>
					<?php 
				if(!empty($this->session->userdata('is_login') == FALSE)){
					$url = base_url('public/business/about/').urlencode($value->data_username); 
				}else{
					$url = base_url('business/about/').urlencode($value->data_username); 
				}
			?>
        <div class="col-4 col-xs-6 col-md-2">
          <div class="card border-0">
			<?php if(empty($value->file_name_original)){ ?>
				<img src="<?php echo base_url()."public/themes/user/images/placehold/business-1x1.png" ?>" class="card-img-top w-100" alt="Fan Page" style="height:150px;object-fit:contain;padding:10px;">
			<?php }else{ ?>
				<img src="<?php echo base_url() . $value->file_path . $value->file_name_original; ?>" class="card-img-top w-100" alt="Fan Page" style="height:150px;object-fit:contain;padding:10px;">
			<?php } ?>
            <div class="card-body">
              <h6 class="card-title"><a classs="link-primary" href="<?php echo $url; ?>"><?php echo $value->data_name ?></a> 
			  <!-- <span class="ms-2 material-icons text-verified md-16">check_circle</span> -->
			</h6>
              <!-- <P><?php echo $value->data_username ?></P> -->
			  	<div class="card-footer bg-transparent border-0 justify-content-center d-flex px-3 pb-3">
					<span class="fs-12 rounded-pill badge bg-light text-black text-wrap fw-normal" id="bsn-rand1-tag">
										<?php
										$once = 0;
										foreach($business_categories as $categories){
											if($value->data_categories && empty($once)) {
												$result = json_decode($value->data_categories);
												foreach($result as $value_old){
													if($value_old== $categories->id && empty($once)) {
														echo "$categories->data_name ";
														$once++;
													}
												}
											}
										}
										?>
					</span>
				</div>
            </div>
          </div>
        </div>
				<?php } ?>
    </div>
      <!-- SECTION - How does IndoConnex work? -->
    <div class="section-wrapper bg-white">
        <div class="container mt-4 py-4">
      <div class="row p-2 mt-1 mb-4">
			<h4 class="fw-light judul-section mt-1">About IndoConnex</h4>
    <div class="row">
        <div class="col-sm">
            <?php echo $about_us->data_description ?>
        </div>
    </div>
    <h4 class="fw-light mt-1">Join Our Community</h4>
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
        <div class="col-md-3 d-sm-none d-md-block mx-auto mb-3">
            <img src="<?php echo theme_user_locations(); ?>images/global/banner-join.png" alt="Gallery image 1" class=""/>
        </div>
    </div>
    </div>

    </div>
 </div>
 </div>
 
