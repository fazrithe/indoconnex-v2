<!-- banner -->
<div class="bg-image d-flex hero-guest mt-4" style="
	background-image: url('<?php echo theme_user_locations(); ?>images/banner/publi-area-job-search.png');
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

     <!-- SECTION - BUSINESS-Higlights -->
      <div class="container">
        <div class="d-flex align-items-center mb-4">
            <div><h2 class="mt-4 title-dark">Discover <?php echo $title ?> Business Page</h2>
            </div>
            <div class="ms-auto">
                <div class="dropdown">
                    <a href="#" style="color:#EE0202 ;">View all</a>
                </div>
            </div>
        </div>
      <!-- BUSINESS - 1 -->
          <div class="row mt-1">
						<?php foreach($business as $value){ ?>
             <div class="col-6 col-xs-2 col-md-2" >
                <div class="card border-1 h-100">
                    <div class="placeholder-glow discover-img position-relative">
										<img class="card-img-top h-100" src="<?php echo placeholder($value['file_path'], $value['file_name_original'], 'business', '16x9') ?>" id="product-feed" alt="<?php strtolower(str_replace($value['data_name'], '-', ' ')) ?>" data-imgtype="business">
            				</div>
                    <div class="card-body">
										<span class="fs-16 card-title fw-bold"><a class="link-primary" href="<?php echo site_url('business/post/'.urlencode($value['data_username'])) ?>"><?php echo $value['data_name'] ?> <span class="ms-2 material-icons text-verified md-16">check_circle</span>
										</a></span>
										<h6 class="card-subtitle mb-2 text-muted">
											<small class="text-muted">@<?php echo $value['data_username'] ?></small>
										</h6>
                    <div class="justify-content-start d-flex flex-wrap gap-2">
                    <?php
												$category = json_decode($value['data_categories']);
												if (!empty($category)) {
                            foreach ($category as $valuecategory) {
                              $this->db->select('*');
                              $this->db->where('id',$valuecategory);
                              $query = $this->db->get('pbd_business_categories')->row();
                        ?>
										<span class="badge bg-light text-black mt-2 rounded-3 fw-normal"><?php echo !empty($query->data_name) ? $query->data_name : '' ?></span>
                    <?php }
										} else { ?>
										<span class="badge bg-light text-black mt-2 rounded-3 fw-normal">Uncategorized</span>
										<?php } ?>
                    </div>
                        <div class="d-flex justify-content-center  my-2 text-black">
                            <div class="d-flex mt-2 mx-2 align-items-center bordered">
                                <span class="material-icons md-16 me-2 text-black">business</span>
                                  <?php
                                    	if(!empty($value['data_types'])){
                                      $types = json_decode($value['data_types']);
																			$c = 0;
                                      foreach($types as $valuetype){
                                      $this->db->select('*');
                                      $this->db->where('id',$valuetype);
                                      $query = $this->db->get('pbd_business_types')->row();
																			$c++;
																			if($c == 2){
																				break;
																			}
                                  ?>
                                <span class="fs-10"><?php if(!empty($query->data_name)){echo $query->data_name;} ?></span>
                                <?php }} ?>
                                </div>
                                <div  class="vr mt-2"></div>
                                      
                            	</div>
                            </div>
                          </div>
                    </div>
						<?php } ?>
         </div>
      </div>

     <!-- SECTION - BUSINESS-Higlights -->
      <div class="container">
        <div class="d-flex align-items-center mb-4">
            <div><h2 class="mt-4 title-dark"><?php echo $title ?> Articles</h2>
            </div>
            <div class="ms-auto">
							<div class="dropdown">
                    <a href="<?php echo site_url("public/discover/articles"); ?>" style="color:#EE0202 ;">View all</a>
                </div>
            </div>
        </div>
      <!-- BUSINESS - 1 -->
          <div class="row mt-1">
					<?php foreach($articles as $value){ ?>
            <div class="col-6 col-xs-6 col-md-3">
              <div class="card border-0">
                <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'article', '16x9') ?>" class="card-img-top" alt="Arts & Entertainment">
                 <div class="card-body border-0">
                  <h6 class="card-title"><a classs="link-primary" href=""><?php echo str_limit($value->data_name, 90) ?></a></h6>
                  <?php
												if($categories_article->id == $value->data_categories){
									?>
										<span class="badge badge bg-light text-dark"><?php echo $categories_article->data_name ?></span><br>
									<?php } ?>
                  <span style="font-size: 10px; color:#696969; text-align:right;">Post by: <?php echo $value->fullname ?></span><br>
                  <span style="font-size: 10px; color:#696969; text-align:right;"><?php echo carbon_human($value->updated_at) ?></span>
                </div>
                </div>
            </div>
						<?php } ?>
         </div>
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
 
