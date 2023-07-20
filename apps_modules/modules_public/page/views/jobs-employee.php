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

<!-- Gallery Pages -->
<div class="container">
    <h2 class="mt-4 title-dark">Jobs Categories</h2>
    <div class="row mt-1">
		<?php foreach ($cards as $card):?>
            <div class="col-4 col-md-2">
                <div class="card border-0">
                    <a href="<?php echo $card->data_link?>">
                        <img class="card-img-top" src="<?php echo base_url() . $card->file_path . $card->file_name_original; ?>" alt="">
                    </a>
                    <div class="card-body">
                        <h6 class="card-title"><?php echo $card->data_name ?></h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
 <!-- SECTION - JUMBOTRON-->
      
 <div class="container py-4">
        <h2 class="mt-4 title-dark">Jobs Type </h2>

        <div class="row align-items-md-stretch">
					<?php foreach($job_types as $value){ ?>
          <div class="col-md-6">
            <div class="p-5 text-white bg-dark rounded-3" style="    background-image:
            linear-gradient(to bottom, rgba(0, 0, 0, 0.52), rgba(49, 49, 49, 0.73)),
            url('<?php echo base_url() . $value->file_path . $value->file_name_original; ?>');
           -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;">
            <div class="mx-auto" style="width: 200px;">
              <span class="align-middle">
			  	<a href="<?php echo site_url("public/jobs/discover/filter?job-type=").$value->id; ?>"><h2 class="text-white"><?php echo $value->data_name ?></h2></a>
              </span>
            </div>
            </div>
          </div>
				<?php } ?>
        </div>
      </div>
      <!-- SECTION - Jobs-Discover Employee Page -->
	  <div class="container">
        <div class="d-flex align-items-center mb-4">
            <div>
                <h2 class="mt-4 title-dark">Discover Employee</h2>
                </div>
            <div class="ms-auto">
                <div class="dropdown">
					<?php  if(!empty($this->session->userdata('is_login') == FALSE)){ ?>
                    	<a href="<?php echo site_url("public/jobs/employee/") ?>" style="color:#EE0202 ;">View all</a>
					<?php }else{ ?>
						<a href="<?php echo site_url("jobs/employee/") ?>" style="color:#EE0202 ;">View all</a>
					<?php } ?>
				</div>
            </div>
        </div>
      <!-- Jobs - 1 -->
          <div class="row mt-1">
		  <?php foreach($employee as $value){
                        ?>
            <div class="col-6 col-xs-6 col-md-2" >
            <div class="card border-0">
			
			  <div class="card-body">
			  <div class="d-flex align-items-center mb-3">
              <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'job') ?>" class="card-img-top" alt="Fan Page" style="width:100px; object-fit: cover; margin:10px;">
				</div>
                <h6 class="card-title"><?php echo $value->data_name ?></h6>
				<a href="<?php echo site_url('public/user/profile/about/'.$value->username); ?>">
				<P><?php echo $value->fullname ?></P>
				</a>
                <p>
				<span class="material-icons fs-12 text-gray me-2">paid</span> IDR <?php echo $value->jb_salary_min ?>-<?php echo $value->jb_salary_max ?>/
                                         <?php foreach($salary_period as $period_val){
                                            if($value->jobs_salary_period_id == $period_val->id){
                                                echo $period_val->data_name;
                                            }
                                        }
                                        ?></p>
                <p><img src="<?php echo base_url('public/themes/user/images/icons/icon-work.svg'); ?>" class="me-2">  <?php foreach($jobs_type as $type_val){
                                            if($value->jobs_types_id == $type_val->id){
                                                echo $type_val->data_name;
                                            }
                                        }
                                        ?></p>
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
 
