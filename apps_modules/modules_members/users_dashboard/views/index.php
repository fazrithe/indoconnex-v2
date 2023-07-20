<style>

#basicSlider { position: relative; }

#basicSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 2%;
  height: 240px;
  padding-bottom: 30%;
}

@media (max-width: 991px) {

#basicSlider .MS-content .item { width: 25%; }
}
@media (max-width: 767px) {

#basicSlider .MS-content .item { width: 35%; }
}
@media (max-width: 500px) {

#basicSlider .MS-content .item { width: 50%; }
}

#basicSlider .MS-content .item a {
  line-height: 50px;
  vertical-align: middle;
}

#basicSlider .MS-controls button { position: absolute; }

#basicSlider .MS-controls .MS-left {
  top: 35px;
  left: 10px;
}

#basicSlider .MS-controls .MS-right {
  top: 35px;
  right: 10px;
}

</style>
<?php $this->load->view($template['partials_sidebar_dashboard']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="container-fluid">
	<div class="row">
		<div class="col-11 col-md-7 mx-auto px-0">
			<div class="col pt-4 mr-0 bg-indoconnex" >
				<?php $this->load->view($template['partial_user_post_dashboard']); ?>

				<div class="mb-4 p-4 rounded-3 msn-widget" >
					<div class="d-flex align-items-start mb-3">
						<div class="flex-shrink-0">
							<img src="<?php echo site_url('public/themes/user/images/icons/business-icon.svg') ?>" class="img-circle" alt="business-icon">
						</div>
						<div class="flex-grow-1 ms-3 flex-column d-flex">
							<a href="<?php echo site_url('business/discover') ?>" class="text-prussianblue fw-bold ">Pages</a>
							<span class="fs-14 text-muted ">Build a page to expand your company's internet presence</span>
						</div>
						<div class="flex-shrink-0 ps-auto">
							<a href="<?php echo site_url('business/discover') ?>" class="btn btn-sm btn-danger-outline">View All</a>
						</div>
					</div>
					<div class="border-0">
					<div id="basicSlider">
						<div class="MS-content">
						<div class="row row-cols-2 row-cols-md-4 custom-horizontal-scrollbar">
							<?php foreach ($business as $value){ ?>
								<div class="item">
								<div class="col">
								<div class="card h-100">
									<div class="placeholder-glow business-card position-relative">
									<?php
									$url = base_url() . 'public/themes/user/images/placehold/business-16x9.png';
									if(!empty($value->file_name_original)) {
										$url = base_url() . $value->file_path . $value->file_name_original;
									}
									?>
										<img src="<?php echo $url ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top w-100">

										<button type="button" aria-pressed="true" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pbd_business'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="business" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
									</div>
									<div class="card-body flex-column d-flex placeholder-glow">
										<span class="fs-16 fw-bold" id="bsn-rand1-name">
											<a class="text-black" href="<?php if(empty($value->data_username)){
												echo site_url('business/about/null');
											}else{echo site_url('business/about/'.urlencode($value->data_username));}?>">
												<?php echo str_limit($value->data_name, 14) ?>
											</a>
										</span>
										<!-- <span class="fs-14 text-muted" id="bsn-rand1-name">@<?php echo $value->data_username ?></span> -->
									</div>
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
						</div></div>
						</div>
					</div>
				</div>

				<div class="mb-4 p-4 rounded-3 msn-widget" >
					<div class="d-flex align-items-start mb-3">
						<div class="flex-shrink-0">
							<img src="<?php echo site_url('public/themes/user/images/icons/product.png') ?>" class="img-circle" alt="product-service-icon">
						</div>
						<div class="flex-grow-1 ms-3 flex-column d-flex">
							<a href="<?php echo site_url('market/discover') ?>" class="text-prussianblue fw-bold ">Product & Service</a>
							<span class="fs-14 text-muted ">Find product & services you need from official pages</span>
						</div>
						<div class="flex-shrink-0 ps-auto">
							<a href="<?php echo site_url('market/discover') ?>" class="btn btn-sm btn-danger-outline">View All</a>
						</div>
					</div>
					<div class="border-0">
						<div class="row row-cols-2 row-cols-md-4 custom-horizontal-scrollbar" id="prod-rand">
							<?php foreach ($product as $value){ ?>
							<div class="col">
								<div class="card h-100">
									<div class="placeholder-glow business-card position-relative">
									<?php
									$url = base_url() . 'public/themes/user/images/placehold/product-16x9.png';
									if(!empty($value->file_name_original)) {
										$url = base_url() . $value->file_path . $value->file_name_original;
									}
									?>
										<img src="<?php echo $url ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top w-100">
										<button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite_home($value->id,'pbd_items'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="market" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
									</div>
									<div class="card-body flex-column d-flex placeholder-glow px-3 pt-3 pb-0">
										<span class="fs-14 text-muted text-wrap" id="bsn-rand1-tag">
											<?php echo !empty($value->data_type) ? title($value->data_type) : '-'; ?>
										</span>
										<span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
											<a href="#product-detail" data-bs-toggle="modal" class="text-black" role="button" data-bs-productid="<?php echo $value->id ?>">
												<?php echo str_limit($value->data_name, 30) ?>
											</a>
										</span>
									</div>
									<div class="card-footer bg-transparent align-items-end d-flex border-0">
										<span class="d-flex text-prussianblue fs-16 ms-auto toPrice px-3 pt-0 pb-3" data-low="<?php echo $value->price_low ?>" data-high="<?php echo $value->price_high ?>" data-currency="<?php echo $value->price_currency ?>" data-type="<?php echo $value->price_type ?>">
											<?php
												if($value->price_type == 1)
													echo 'Free / Giveaway';
												if($value->price_type == 2)
													echo number_format((float)$value->price_low,2,",",".");
												if($value->price_type == 3)
													echo 'Starting at ' . number_format((float)$value->price_low,2,",",".");
												if($value->price_type == 4)
													echo 'Ask for Price';
												if($value->price_type == 5)
													echo 'Price Varies';
											?>
										</span>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>

				<div class="mb-4 p-4 rounded-3 msn-widget" >
					<div class="d-flex align-items-start mb-3">
						<div class="flex-shrink-0">
							<img src="<?php echo site_url('public/themes/user/images/icons/jobs.svg') ?>" class="img-circle" alt="job-icon">
						</div>
						<div class="flex-grow-1 ms-3 flex-column d-flex">
							<a href="<?php echo site_url('jobs/discover') ?>" class="text-prussianblue fw-bold ">Job</a>
							<span class="fs-14 text-muted ">Find a Job and recruit the best talents</span>
						</div>
						<div class="flex-shrink-0 ps-auto text-right">
							<a href="<?php echo site_url('jobs/discover') ?>" class="btn btn-sm btn-danger-outline">View All</a>
						</div>
					</div>
					<div class="border-0">
						<div class="row row-cols-2 row-cols-md-4 custom-horizontal-scrollbar" id="prod-rand">
							<?php foreach ($jobs as $value){ ?>
							<div class="col">
								<div class="card h-100">
									<div class="placeholder-glow pt-4 px-4">
										<div class="d-flex flex-row align-items-start">
											<img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'job') ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top work-experience-img fit-cover border-gray-2 border-1">
											<button type="button" class="btn btn-favourite ms-auto fs-18 text-danger bg-light rounded-circle p-2 <?php echo active_favourite_home($value->id,'pcj_jobs'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="jobs" data-content-id="<?php echo $value->id ?>" autocomplete="off">
											</button>
										</div>
									</div>
									<div class="card-body flex-column d-flex placeholder-glow px-3 pt-2 pb-0">
										<span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
											<a class="text-black" href="<?php echo site_url('jobs/detail/'.$value->id)?>"><?php echo $value->data_name ?></a>
										</span>
										<span class="text-muted text-wrap" id="bsn-rand1-tag" style="font-size: .700rem !important;">
											<a class="text-muted" href="<?php echo site_url('jobs/detail/'.$value->id)?>">post by: <br /> <?php echo mb_strimwidth($value->username, 0, 25, '...') ?></a>
										</span>
									</div>
									<div class="card-footer bg-transparent d-flex border-0 p-4">
										<div class="vstack align-items-start">
											<div class="text-black fs-12 d-flex"><span class="material-icons text-gray fs-16 me-1">paid</span> <?php echo $value->jb_salary_currency ?> <?php echo number_format((float)$value->jb_salary_max,2,",",".") ?> - <?php echo number_format((float)$value->jb_salary_min,2,",",".") ?> /Hours</div>
											<div class="text-black fs-12 d-flex"><span class="material-icons text-gray fs-16 me-1">work</span> Full-Time</div>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>

				<div class="mb-4 p-4 rounded-3 msn-widget" >
					<div class="d-flex align-items-start mb-3">
						<div class="flex-shrink-0">
							<img src="<?php echo site_url('public/themes/user/images/icons/community.svg') ?>" class="img-circle" alt="community-icon">
						</div>
						<div class="flex-grow-1 ms-3 flex-column d-flex">
							<a href="<?php echo site_url('community/discover') ?>" class="text-prussianblue fw-bold ">Community</a>
							<span class="fs-14 text-muted ">Build trust-based communities on common interests, culture, or current affairs</span>
						</div>
						<div class="flex-shrink-0 ps-auto text-right">
							<a href="<?php echo site_url('community/discover') ?>" class="btn btn-sm btn-danger-outline">View All</a>
						</div>
					</div>
					<div class="border-0">
						<div class="row row-cols-2 row-cols-md-4 custom-horizontal-scrollbar" id="prod-rand">
							<?php foreach ($communities as $value){ ?>
							<div class="col">
								<div class="card h-100">
									<div class="placeholder-glow business-card position-relative">
										<img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'community', '16x9') ?>" alt="<?php echo slug(words('$value->data_name', 5)) ?>" class="card-img-top w-100">
										<button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite_home($value->id,'pcs_communities'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="communities" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
									</div>
									<div class="card-body flex-column d-flex placeholder-glow px-3">
										<span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
											<a class="text-black" href="<?php echo site_url('community/post/'.$value->id)?>"><?php echo $value->data_name ?></a>
										</span>
										<span class="fs-14 text-muted text-wrap align-items-center d-flex">
											<span class="material-icons fs-14 me-1">people</span>
											<abbr class="abbrevNum2Str me-1" title="<?php echo total_followers($value->id);?>" ><?php echo total_followers($value->id);?></abbr> Followers
										</span>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>

				<div class="mb-4 p-4 rounded-3 msn-widget" >
					<div class="d-flex align-items-start mb-3">
						<div class="flex-shrink-0">
							<img src="<?php echo site_url('public/themes/user/images/icons/article.svg') ?>" class="img-circle" alt="article-icon">
						</div>
						<div class="flex-grow-1 ms-3 flex-column d-flex">
							<a href="<?php echo site_url('articles/discover') ?>" class="text-prussianblue fw-bold ">Article</a>
							<span class="fs-14 text-muted ">Find out and explore what's happening around the world Today</span>
						</div>
						<div class="flex-shrink-0 ps-auto text-right">
							<a href="<?php echo site_url('articles/discover') ?>" class="btn btn-sm btn-danger-outline">View All</a>
						</div>
					</div>
					<div class="border-0">
						<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4" id="artic-rand">
							<?php foreach ($article as $value){ ?>
							<div class="col">
								<div class="card h-100">
									<div class="placeholder-glow business-card position-relative">
										<img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'article', '16x9') ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top fit-cover">
										<button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite_home($value->id,'pfe_articles'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="articles" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
									</div>
									<div class="card-body flex-column d-flex placeholder-glow px-3">
										<span class="d-flex align-items-center fs-16 fw-bold" id="prod-rand1-name">
											<a class="text-black fw-semi fs-16 text-break" href="<?php echo site_url('articles/detail/'.$value->id)?>"><?php echo str_limit($value->data_name, 90) ?></a>
										</span>
									</div>
									<div class="card-footer bg-transparent align-items-end d-flex border-0">
										<abbr title="<?php echo carbon_long($value->published)?>" class="text-decoration-none ms-auto fs-14"><span class="text-muted"><?php echo carbon_human($value->published);?></span></abbr>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>

				<div class="mb-4 p-4 rounded-3 msn-widget" >
					<div class="d-flex align-items-start mb-3">
						<div class="flex-shrink-0">
							<img src="<?php echo site_url('public/themes/user/images/icons/buy.png') ?>" class="img-circle" alt="product-service-icon">
						</div>
						<div class="flex-grow-1 ms-3 flex-column d-flex">
							<a href="<?php echo site_url('buysells/discover') ?>" class="text-prussianblue fw-bold ">Buy & Sell</a>
							<span class="fs-14 text-muted ">Buy any product you want or sell your product</span>
						</div>
						<div class="flex-shrink-0 ps-auto">
							<a href="<?php echo site_url('buysells/discover') ?>" class="btn btn-sm btn-danger-outline">View All</a>
						</div>
					</div>
					<div class="border-0">
						<div class="row row-cols-2 row-cols-md-4 custom-horizontal-scrollbar" id="prod-rand">
							<?php foreach ($product_buy as $value){ ?>
							<div class="col">
								<div class="card h-100">
									<div class="placeholder-glow business-card position-relative">
									<?php
									$url = base_url() . 'public/themes/user/images/placehold/product-16x9.png';
									if(!empty($value->file_name_original)) {
										$url = base_url() . $value->file_path . $value->file_name_original;
									}
									?>
										<img src="<?php echo $url ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top w-100">
										<button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite_home($value->id,'pbd_items'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="market" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
									</div>
									<div class="card-body flex-column d-flex placeholder-glow px-3 pt-3 pb-0">
										<span class="fs-14 text-muted text-wrap" id="bsn-rand1-tag">
											<?php echo !empty($value->data_type) ? title($value->data_type) : ''; ?>
										</span>
										<span class="d-flex flex-column align-items-start fs-16 fw-semi" id="prod-rand1-name">
											<a href="#product-detail" data-bs-toggle="modal" class="text-black" role="button" data-bs-productid="<?php echo $value->id?>">
												<?php echo str_limit($value->data_name, 30) ?>
											</a>
											<?php if ($value->data_status) { ?>
												<br />

												<div class="d-flex flex-row flex-wrap">
													<span class="text-muted bg-light" style="padding: .35em .65em;border-radius: 50rem !important;font-size: .75em;"><?php echo $value->data_status; ?></span>
											<?php } ?>
													<span class="text-muted" style="padding: .35em .65em;border-radius: 50rem !important;font-size: .75em;"><?php echo get_buy_and_sells_category($value->data_categories); ?></span>
											</div>
										</span>
									</div>
									<div class="card-footer bg-transparent align-items-end d-flex border-0">
										<span class="d-flex text-prussianblue fs-16 ms-auto toPrice px-3 pt-0 pb-3" data-low="<?php echo $value->price_low ?>" data-high="<?php echo $value->price_high ?>" data-currency="<?php echo $value->price_currency ?>" data-type="<?php echo $value->price_type ?>">
											<?php
												if($value->price_type == 1)
													echo 'Free / Giveaway';
												if($value->price_type == 2)
													echo number_format((float)$value->price_low,2,",",".");
												if($value->price_type == 3)
													echo 'Starting at ' . number_format((float)$value->price_low,2,",",".");
												if($value->price_type == 4)
													echo 'Ask for Price';
												if($value->price_type == 5)
													echo 'Price Varies';
											?>
										</span>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>

				
				<div class="mb-4 p-4 rounded-3 msn-widget" >
					<div class="d-flex align-items-start mb-3">
						<div class="flex-shrink-0">
							<img src="<?php echo site_url('public/themes/user/images/icons/partnership.png') ?>" class="img-circle" alt="business-icon">
						</div>
						<div class="flex-grow-1 ms-3 flex-column d-flex">
							<a href="<?php echo site_url('business/discover') ?>" class="text-prussianblue fw-bold ">Tender</a>
							<span class="fs-14 text-muted ">Get an invitation to bid for a project or accept a formal offer as a takeover bid</span>
						</div>
						<div class="flex-shrink-0 ps-auto">
							<a href="<?php echo site_url('tender/discover') ?>" class="btn btn-sm btn-danger-outline">View All</a>
						</div>
					</div>
					<div class="border-0">
						<div class="row row-cols-2 row-cols-md-4 custom-horizontal-scrollbar" id="bsns-rand">
							<?php foreach ($tender as $value){ ?>
							<div class="col">
								<div class="card h-100">
									<div class="placeholder-glow business-card position-relative">
									<?php
									$url = base_url() . 'public/themes/user/images/placehold/business-16x9.png';
									if(!empty($value->file_name_original)) {
										$url = base_url() . $value->file_path . $value->file_name_original;
									}
									?>
										<img src="<?php echo $url ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top w-100">

										<button type="button" aria-pressed="true" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pbt_tender'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="tender" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
									</div>
									<div class="card-body flex-column d-flex placeholder-glow">
										<span class="fs-16 fw-bold" id="bsn-rand1-name">
											<a href="#tender-detail" data-bs-toggle="modal" class="text-black" role="button" data-bs-tenderid="<?php echo $value->id?>">
												<?php echo str_limit($value->data_name, 30) ?>
											</a>
										</span>
										<span class="fs-14 text-muted" id="bsn-rand1-name">@<?php echo $value->business_username ?></span>
									</div>
									<div class="card-footer bg-transparent border-0 justify-content-center d-flex px-3 pb-3">
										<span class="fs-12 rounded-pill badge bg-light text-black text-wrap fw-normal" id="bsn-rand1-tag">
											<?php
											$once = 0;
											foreach($tender_categories as $categories_tender){
												if($value->data_categories== $categories_tender->id) {
													echo "$categories_tender->data_name ";
												}
											}
											?>
										</span>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>


				<div id="postsinfinite"></div>
				<div id="posts-infinite">
					<?php
					$this->load->view('index_load', $posts);
					?>
				</div>
				<div class="d-flex justify-content-center pb-8">
					<div class="spinner-border text-primary loader" style="width: 3rem; height: 3rem;"  role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view($template['partials_footer']);
$this->load->view($template['partials_sidebar_ads']);
$this->load->view($template['partials_modal_user']);
$this->load->view($template['partials_modal_post']);
$this->load->view($template['partials_modal_share']);
$this->load->view($template['partials_modal_market_detail']);

$this->load->view($template['action_ajax_notify']);
$this->load->view($template['action_ajax_favourite']);
$this->load->view($template['action_ajax_profile']);

$this->load->view($template['partials_modal_article']);
$this->load->view($template['partials_modal_tender_delete']);
$this->load->view($template['partials_modal_job_delete']);
$this->load->view($template['partials_modal_buysells_delete']);
$this->load->view($template['action_ajax_market']);

$this->load->view($template['partials_modal_tender_detail']);
$this->load->view($template['action_ajax_tender']);
?>
<!-- showing product & services modal -->
<!-- Emoji -->
<script src='<?php echo theme_user_locations(); ?>plugins/emoji-picker-input/inputEmoji.js'></script>


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> 
<script src="<?php echo theme_user_locations(); ?>plugins/slide/js/multislider.js"></script>
<script>
	$('#product-detail').on('show.bs.modal', function (sender) {
	$productid = $(sender.relatedTarget).data('bs-productid');
	if($productid) {
		$.ajax({
			type  : 'GET',
			url   : '<?php echo site_url('market/show');?>/'+$productid,
		}).done( function ( response ) {
			$response = JSON.parse(response);
			console.log($response.email);
			$('#product-detail-img').attr('src', ''+$response.image);
			$('#product-detail-name').text($response.name);
			$('#product-detail-cat').text($response.category.data_name);
			$('#product-detail-desc').text($response.description);
			$('#product-detail-email').text($response.email);
			$('#product-detail-phone').text($response.phone);

			//set default
			$('#product-detail-seller').text('-');
			$('#product-detail-seller').attr('href', '#');
			if($response.seller) {
				$('#product-detail-seller-img').parent('a').prop('href', "<?php echo base_url('business/post/') ?>"+$response.seller.data_username);
				$('#product-detail-seller').text($response.seller.name);
				$('#product-detail-seller').attr('href', "<?php echo base_url('business/post/') ?>"+$response.seller.data_username);
				$('#product-detail-seller-img').attr('src', $response.compimg);
			
			}
			$('#product-detail-location').text('-, -');
			if($response.location) {
				$loc = JSON.parse($response.location);
				$('#product-detail-location').text($loc[0].city_name+', '+$loc[0].country_name);
			}

			if($response.price.type) {
				if($response.price.type == 1) {
					$('#product-detail-price').text('Free / Giveaway');
					$('#product-detail-table').addClass('d-none');
					$('#product-detail-price').removeClass('d-none');
				} else if($response.price.type == 2) {
					$('#product-detail-price').data('currency', $response.price.currency);
					$('#product-detail-price').data('low', $response.price.low);
					$('#product-detail-price').text(formatNumber($response.price.low, $response.price.currency));
					$('#product-detail-table').addClass('d-none');
					$('#product-detail-price').removeClass('d-none');
				} else if($response.price.type == 3) {
					$('#product-detail-price').data('currency', $response.price.currency);
					$('#product-detail-price').data('low', $response.price.low);
					$('#product-detail-price').data('high', $response.price.high);
					$('#product-detail-price').text('Starting at ' . formatNumber($response.price.low, $response.price.currency));
					$('#product-detail-table').addClass('d-none');
					$('#product-detail-price').removeClass('d-none');
				} else if($response.price.type == 4) {
					$('#product-detail-price').text("Ask Price (Via Whatsapp/Email)");
					$('#product-detail-table').addClass('d-none');
					$('#product-detail-price').removeClass('d-none');
				} else if($response.price.type == 5) {
					$('#product-detail-price').addClass('d-none');
					$('#product-detail-table').removeClass('d-none');
					$.each($response.price.table, function (key, val) {
						$row = '<tr scope="row"><td>' + val.qty + '</td><td>' + val.price + '</td></tr>';
						$('#product-detail-table table tbody').append($row);
					})
				}
			}

		}).fail( function (params) {
			console.log('fail');
		}).always( function (params) {
		});
	}
});
</script>
<script>
    var baseURL = "<?php echo base_url(); ?>";
    var page = 1;
    var triggerScrollLoader = true;
    var isLoading = false;
	var total_pages = <?php echo $total_pages?>;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 555) {
            if (isLoading == false) {
                isLoading = true;
                page++;
				if(page < total_pages) {
                    initLoadMore(page);
                }
            }
        }
    });

    function initLoadMore(page) {
        $.ajax({
            url: '<?php echo site_url('user/dashboard/page/');?>'+page,
            type: "GET",
            dataType: "html",
			beforeSend: function()
             {
                 $('.loader').show();
             }
        }).done(function (data) {
            isLoading = false;
            if (data.length == 0) {
                triggerScrollLoader = false;
                $('.loader').hide();
                return;
            }
            $('.loader').hide();
            $('#posts-infinite').append(data).show('slow');
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Nothing to display');
        });
    }
</script>
<script>
	$(function () {
		$('.emoji-comment').emoji({
			button:'&#x1F642;',
			place:'after',
			listCSS: {
                position:'absolute',
                border:'none',
                display:'none', 
                width: '300px',
                height: '150px',
                overflowY: 'scroll'
			},
			rowSize: 10,
			emojis: ['&#x1F642;','&#x1F641;','&#x1f600;','&#x1f601;','&#x1f602;','&#x1f603;','&#x1f604;','&#x1f605;','&#x1f606;','&#x1f607;','&#x1f608;','&#x1f609;','&#x1f60a;','&#x1f60b;','&#x1f60c;','&#x1f60d;','&#x1f60e;','&#x1f60f;','&#x1f610;','&#x1f611;','&#x1f612;','&#x1f613;','&#x1f614;','&#x1f615;','&#x1f616;','&#x1f617;','&#x1f618;','&#x1f619;','&#x1f61a;','&#x1f61b;','&#x1f61c;','&#x1f61d;','&#x1f61e;','&#x1f61f;','&#x1f620;','&#x1f621;','&#x1f622;','&#x1f623;','&#x1f624;','&#x1f625;','&#x1f626;','&#x1f627;','&#x1f628;','&#x1f629;','&#x1f62a;','&#x1f62b;','&#x1f62c;','&#x1f62d;','&#x1f62e;','&#x1f62f;','&#x1f630;','&#x1f631;','&#x1f632;','&#x1f633;','&#x1f634;','&#x1f635;','&#x1f636;','&#x1f637;','&#x1f638;','&#x1f639;','&#x1f63a;','&#x1f63b;','&#x1f63c;','&#x1f63d;','&#x1f63e;','&#x1f63f;','&#x1f640;','&#x1f643;','&#x1f4a9;','&#x1f644;','&#x2620;','&#x1F44C;','&#x1F44D;','&#x1F44E;','&#x1F648;','&#x1F649;','&#x1F64A;']
		});
	})
</script>
	<script>
	$('#basicSlider').multislider({
		continuous:false,
		slideAll:false, 
		interval: 2000,
		duration: 500,     
		hoverPause:true,
		pauseAbove:null,  
		pauseBelow:null,
		repeat: true
	});
</script>
