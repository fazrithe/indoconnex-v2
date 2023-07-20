<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_favourite']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >
            <div class="d-flex align-items-center mb-4">
                <div>
                    <h4 class="mt-4 title-dark">All Category</h4>
                </div>
            </div>
            <div class="row mt-1">
            <div class="mb-4 p-4 rounded-3 msn-widget" >
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/business-icon.svg') ?>" class="img-circle" alt="business-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('favourite/business') ?>" class="text-prussianblue fw-bold ">Pages</a>
                    </div>
                    <div class="flex-shrink-0 ps-auto">
                        <a href="<?php echo site_url('favourite/business') ?>" class="btn btn-sm btn-danger-outline">View All</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="bsns-rand">
                        <?php foreach ($business as $value){ ?>
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
                                    <span class="fs-14 text-muted" id="bsn-rand1-name"><?php echo $value->data_username ?></span>
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
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="mb-4 p-4 rounded-3 msn-widget" >
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/product.png') ?>" class="img-circle" alt="product-service-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('favourite/market') ?>" class="text-prussianblue fw-bold ">Product & Service</a>
                    </div>
                    <div class="flex-shrink-0 ps-auto">
                        <a href="<?php echo site_url('favourite/market') ?>" class="btn btn-sm btn-danger-outline">View All</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="prod-rand">
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
                                    <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pbd_items'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="market" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body flex-column d-flex placeholder-glow px-3 pt-3 pb-0">
                                    <span class="fs-14 text-muted text-wrap" id="bsn-rand1-tag">
                                        <?php echo !empty($value->data_type) ? $value->data_type : '-'; ?>
                                    </span>
                                    <span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
                                        <a href="#product-detail" data-bs-toggle="modal" class="text-black" role="button" data-bs-productid="<?php echo $value->id?>">
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
                                                echo $value->price_low;
                                            if($value->price_type == 3)
                                                echo 'Starting at ' . $value->price_low;
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
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/jobs.svg') ?>" class="img-circle" alt="job-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('favourite/job') ?>" class="text-prussianblue fw-bold ">Job</a>
                    </div>
                    <div class="flex-shrink-0 ps-auto text-right">
                        <a href="<?php echo site_url('favourite/job') ?>" class="btn btn-sm btn-danger-outline">View All</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="prod-rand">
                        <?php foreach ($jobs as $value){ ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="placeholder-glow pt-4 px-4">
                                    <div class="d-flex flex-row align-items-start">
                                        <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'job') ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top work-experience-img fit-cover border-gray-2 border-1">
                                        <button type="button" class="btn btn-favourite ms-auto fs-18 text-danger bg-light rounded-circle p-2 <?php echo active_favourite($value->id,'pcj_jobs'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="jobs" data-content-id="<?php echo $value->id ?>" autocomplete="off">
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body flex-column d-flex placeholder-glow px-3 pt-2 pb-0">
                                    <span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
                                        <a class="text-black" href="<?php echo site_url('jobs/detail/'.$value->id)?>"><?php echo $value->data_name ?></a>
                                    </span>
                                    <span class="fs-14 text-muted text-wrap" id="bsn-rand1-tag">
                                        <a class="text-muted" href="<?php echo site_url('jobs/detail/'.$value->id)?>"><?php echo $value->username ?></a>
                                    </span>
                                </div>
                                <div class="card-footer bg-transparent d-flex border-0 p-4">
                                    <div class="vstack align-items-start">
                                        <div class="text-black fs-12 d-flex"><span class="material-icons text-gray fs-16 me-1">paid</span> IDR100.000 - 130.000 /Hours</div>
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
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/community.svg') ?>" class="img-circle" alt="community-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('favourite/community') ?>" class="text-prussianblue fw-bold ">Community</a>
                    </div>
                    <div class="flex-shrink-0 ps-auto text-right">
                        <a href="<?php echo site_url('favourite/community') ?>" class="btn btn-sm btn-danger-outline">View All</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="prod-rand">
                        <?php foreach ($communities as $value){ ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="placeholder-glow business-card position-relative">
                                    <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'community', '16x9') ?>" alt="<?php echo slug(words('$value->data_name', 5)) ?>" class="card-img-top w-100">
                                    <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pcs_communities'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="communities" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body flex-column d-flex placeholder-glow px-3">
                                    <span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
                                        <a class="text-black" href="<?php echo site_url('community/post/'.$value->id)?>"><?php echo $value->data_name ?></a>
                                    </span>
                                    <span class="fs-14 text-muted text-wrap align-items-center d-flex">
                                        <span class="material-icons fs-14 me-1">people</span>
                                        <abbr class="abbrevNum2Str me-1" title="0" ></abbr> Followers
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

			<div class="mb-4 p-4 rounded-3 msn-widget" >
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/buy.png') ?>" class="img-circle" alt="product-service-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('favourite/buy') ?>" class="text-prussianblue fw-bold ">Product & Service</a>
                    </div>
                    <div class="flex-shrink-0 ps-auto">
                        <a href="<?php echo site_url('favourite/buy') ?>" class="btn btn-sm btn-danger-outline">View All</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="prod-rand">
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
                                    <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pbd_items'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="market" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body flex-column d-flex placeholder-glow px-3 pt-3 pb-0">
                                    <span class="fs-14 text-muted text-wrap" id="bsn-rand1-tag">
                                        <?php echo !empty($value->data_type) ? $value->data_type : '-'; ?>
                                    </span>
                                    <span class="d-flex align-items-center fs-16 fw-semi" id="prod-rand1-name">
                                        <a href="#product-detail" data-bs-toggle="modal" class="text-black" role="button" data-bs-productid="<?php echo $value->id?>">
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
                                                echo $value->price_low;
                                            if($value->price_type == 3)
                                                echo 'Starting at ' . $value->price_low;
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
				<div class="d-flex align-items-center mb-3">
					<div class="flex-shrink-0">
						<img src="<?php echo site_url('public/themes/user/images/icons/partnership.png') ?>" class="img-circle" alt="business-icon">
					</div>
					<div class="flex-grow-1 ms-3 flex-column d-flex">
						<a href="<?php echo site_url('business/discover') ?>" class="text-prussianblue fw-bold ">Tender</a>
						<span class="fs-14 text-muted ">Get an invitation to bid for a project or accept a formal offer as a takeover bid</span>
					</div>
					<div class="flex-shrink-0 ps-auto">
						<a href="<?php echo site_url('favourite/tender') ?>" class="btn btn-sm btn-danger-outline">View All</a>
					</div>
				</div>
				<div class="border-0">
					<div class="row row-cols-2 row-cols-md-4" id="bsns-rand">
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
									<span class="fs-14 text-muted" id="bsn-rand1-name"></span>
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

            <div class="mb-4 p-4 rounded-3 msn-widget" >
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/article.svg') ?>" class="img-circle" alt="article-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('favourite/article') ?>" class="text-prussianblue fw-bold ">Article</a>
                        <span class="fs-14 text-muted ">Find and explore articles on a certain topic</span>
                    </div>
                    <div class="flex-shrink-0 ps-auto text-right">
                        <a href="<?php echo site_url('favourite/article') ?>" class="btn btn-sm btn-danger-outline">View All</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-md-4" id="artic-rand">
                        <?php foreach ($article as $value){ ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="placeholder-glow business-card position-relative">
                                    <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'article', '16x9') ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top fit-cover">
                                    <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pfe_articles'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="articles" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
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
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
<?php $this->load->view($template['partials_modal_market_detail']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
