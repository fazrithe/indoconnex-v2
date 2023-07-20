
<?php $this->load->view($template['partials_sidebar_dashboard']); ?>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <ul class="nav nav-pills justify-content-start mt-4 fw-semi fs-14" role="tablist">
            <li class="nav-item me-1 my-1" role="presentation">
                <a class="nav-link monik active rounded-pill" aria-current="page" href="#" id="tab-all" data-bs-toggle="tab" role="tab" aria-selected="true">All Category</a>
            </li>
            <li class="nav-item me-1 my-1" role="presentation">
                <a class="nav-link monik rounded-pill" href="#business" id="tab-business" data-bs-toggle="tab" role="tab" aria-controls="business" aria-selected="false">Business Page</a>
            </li>
            <li class="nav-item me-1 my-1" role="presentation">
                <a class="nav-link monik rounded-pill" href="#product" id="tab-product" data-bs-toggle="tab" role="tab" aria-controls="product" aria-selected="false">Product & Service</a>
            </li>
            <li class="nav-item me-1 my-1" role="presentation">
                <a class="nav-link monik rounded-pill" href="#jobs" id="tab-job" data-bs-toggle="tab" role="tab" aria-controls="jobs" aria-selected="false">Job</a>
            </li>
            <li class="nav-item me-1 my-1" role="presentation">
                <a class="nav-link monik rounded-pill" href="#connection" id="tab-connection" data-bs-toggle="tab" role="tab" aria-controls="connection" aria-selected="false">Connection</a>
            </li>
            <li class="nav-item me-1 my-1" role="presentation">
                <a class="nav-link monik rounded-pill" href="#community" id="tab-community" data-bs-toggle="tab" role="tab" aria-controls="community" aria-selected="false">Community</a>
            </li>
            <!-- <li class="nav-item me-1 my-1" role="presentation">
                <a class="nav-link monik rounded-pill" href="#market" id="tab-market" data-bs-toggle="tab" role="tab" aria-controls="market" aria-selected="false">Buy & Sell</a>
            </li> -->
            <li class="nav-item me-1 my-1" role="presentation">
                <a class="nav-link monik rounded-pill" href="#" id="tab-article" data-bs-toggle="tab" role="tab" aria-controls="article" aria-selected="false">Article</a>
            </li>
            <!-- <li class="nav-item me-1 my-1" role="presentation">
                <a class="nav-link monik rounded-pill" href="#" id="tab-tender" data-bs-toggle="tab" role="tab" aria-controls="tender" aria-selected="false">Tender</a>
            </li> -->
        </ul>
        <div class="col pt-4 mr-0 tab-content" >
            <div class="mb-2 p-3 rounded-3 msn-widget tab-pane fade show active" role="tabpanel" id="business" aria-labelledby="tab-business">
				<div class="d-flex align-items-center mb-3">
					<div class="flex-grow-1 ms-3 flex-column d-flex">
						<a href="<?php echo site_url('business/discover') ?>" class="text-prussianblue fw-bold ">Business Pages</a>
                        <span class="text-muted fs-14">About <?php echo $business['count'] ?> results</span>
                    </div>
				</div>
            <?php
            if(!empty($business['query'])){
                foreach($business['query'] as $value){ ?>
                <div class="d-flex bg-white align-items-center mb-3">
                    <div class="flex-shrink-0 placeholder-glow align-self-start">
                        <img class="search-thumbs ms-3 rounded-3 border placeholder" data-src="<?php echo placeholder($value->file_path, $value->file_name_original, 'business', '1x1') ?>" alt="">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex" style='min-width:0px;'>
                        <h6 class="fw-semi text-black align-items-center d-flex"><a href="<?php echo base_url() . 'business/post/'.urlencode($value->data_username) ?>"><?php echo $value->data_name ?></a>
                        <?php if (!empty($value->status_verification)) { ?>
                        <span class="ms-2 material-icons text-verified md-16">check_circle</span>
                    <?php }?>
                    </h6>
                        <span class="d-flex mb-3"><a class="text-muted fs-12" href="<?php echo base_url() . 'business/post/'.urlencode($value->data_username) ?>">@<?php echo $value->data_username ?></a></span>
                        <div class="d-flex flex-no-wrap align-content-start">
                        <?php
                        $category = json_decode($value->data_categories);
                        $count = 1;
                        if (!empty($category)) :
                        foreach ($category as $key) :
                            $count++;
                            // get only 4 category
                            if ($count == 6) {
                                break;
                            }
                        ?>
                            <span class="badge fs-12 fw-normal bg-light text-black rounded-pill"><?php echo $business_categories[$key]; ?></span>
                        <?php
                        endforeach;
                        endif;
                        ?>
                        </div>
                        <span class="text-break d-flex mt-3"><?php echo words($value->data_description, 50) ?></span>
                        <span class="hstack my-2">
                            <span class="material-icons md-16 me-2 text-muted">location_on</span>
                            <span class="text-truncate">
                                <?php
                                $loc = json_decode($value->data_locations);
                                if(!empty($loc))
                                echo $loc[0]->country_name;
                                ?>
                            </span>
                        </span>
                    </div>
                </div>
                <hr>
                <?php }
            } ?>
            </div>
            <div class="mb-2 p-3 rounded-3 msn-widget tab-pane fade show active" role="tabpanel" id="product" aria-labelledby="tab-product">
				<div class="d-flex align-items-center mb-3">
					<div class="flex-grow-1 ms-3 flex-column d-flex">
						<a href="<?php echo site_url('business/discover') ?>" class="text-prussianblue fw-bold ">Products Pages</a>
                        <span class="text-muted fs-14">About <?php echo $products['count'] ?> results</span>
                    </div>
				</div>
                <?php if(!empty($products['query'])) { ?>
                    <?php
                        foreach($products['query'] as $value){ ?>
                        <div class="d-flex bg-white align-items-center mb-3">
                            <div class="flex-shrink-0 placeholder-glow align-self-start">
                                <img class="search-thumbs ms-3 rounded-3 border placeholder" data-src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-imgtype="shopping_bag" alt="">
                            </div>
                            <div class="flex-grow-1 ms-3 flex-column">
                                <span class="fw-semi fs-14 text-black d-flex"><?php echo $value->data_name ?></span>
                                <span class="fs-12 text-muted d-flex mb-3"><?php

                                $prod = json_decode($value->data_categories);
                                if(!empty($prod)) {
                                    $row = '';
                                    $row = $this->db->get_where('pbd_items_categories', ['id' => $prod[0]])->row();
                                    if(!empty($row)) {
                                        echo $row->data_name;
                                    }
                                    else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                                ?></span>
                                <span class="text-black fs-12 d-flex text-break"><?php echo words($value->data_description, 50) ?></span>
                                <span class="text-prussianblue fw-semi d-flex toPrice" data-low="<?php echo $value->price_low ?>" data-high="<?php echo $value->price_high ?>" data-currency="<?php echo $value->price_currency ?>" data-type="<?php echo $value->price_type ?>">-</span>
                            </div>
                            <div class="flex-shrink-0 ps-auto text-right mx-2 d-grid">
                            </div>
                        </div>
                        <hr>
                        <?php } ?>
                <?php } ?>
            </div>
			<div class="mb-2 p-3 rounded-3 msn-widget tab-pane fade show active" role="tabpanel" id="jobs" aria-labelledby="tab-jobs">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1 ms-3 flex-column d-flex">
                            <a href="<?php echo site_url('jobs/discover') ?>" class="text-prussianblue fw-bold ">Job</a>
                            <span class="text-muted fs-14">About <?php echo $jobs['count'] ?> results</span>
                        </div>
                    </div>
					<?php foreach($jobs['query'] as $value){ ?>
                        <div class="col-12 col-xs-6 col-md-4" >
                            <div class="card border-1">
                                <div class="card-body text-black">
									<div class="d-flex align-items-center mb-3">
										<div class="flex-shrink-0 d-flex mt-1">
											<img src="<?php echo placeholder_jobs($value->file_path,$value->file_name_original) ?>" class="work-experience-img"  id="" alt="Job Directory">
										</div>
										<div class="d-flex flex-grow-1 ms-3 flex-column">
											<a href="<?php echo site_url('jobs/detail/'.$value->id); ?>"><span class="fw-semi fs-16"><?php echo $value->data_name ?></span></a>
										</div>
									</div>
                                    <div class="fs-12">
                                        <div><span class="material-icons fs-12 text-gray me-2">place</span>
                                        <?php
                                              if(!empty($value->data_location)){
                                                $loc = json_decode($value->data_location);
                                                foreach($loc as $valuelocation){
                                                echo $valuelocation->city_name;
                                            }
                                        }
                                        ?>
                                        </div>
                                        <div><span class="material-icons fs-12 text-gray me-2">paid</span> <?php echo $value->jb_salary_currency ?> <?php echo number_format($value->jb_salary_min,2,",","."); ?>-<?php echo number_format($value->jb_salary_max,2,",","."); ?>/Hours</div>
                                        <div><span class="material-icons fs-12 text-gray me-2">work</span>
                                        <?php foreach($jobs_types as $type_val){
                                            if($value->jobs_types_id == $type_val->id){
                                                echo $type_val->data_name;
                                            }
                                        }
                                        ?>
                                        </div>
                                        <div><span class="material-icons fs-12 text-gray me-2">business</span>
                                        <?php foreach($jobs_categories as $cat_val){
                                                if(!empty($value->data_categories)){
                                                $result = json_decode($value->data_categories);
                                                foreach($result as $value_old){
                                                    if($value_old == $cat_val->id){
                                                        echo $cat_val->data_name;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<hr>
                        <?php } ?>
                </div>
                <div class="mb-2 p-3 rounded-3 msn-widget tab-pane fade show active" role="tabpanel" id="connection" aria-labelledby="tab-connection">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1 ms-3 flex-column d-flex">
                            <a href="<?php echo site_url('connections/discover') ?>" class="text-prussianblue fw-bold ">Connections Pages</a>
                            <span class="text-muted fs-14">About <?php echo $connections['count'] ?> results</span>
                        </div>
                    </div>
                    <div class="p-4 bg-white">
                        <?php if(!empty($connections['query'])){ ?>
                            <?php foreach($connections['query'] as $value) {
                            ?>
                            <div class="d-flex bg-white align-items-center mb-3">
                                <div class="flex-shrink-0 placeholder-glow">
                                    <img class="search-thumbs m-3 rounded-circle border" src="<?php echo placeholder_users($value->file_path,$value->file_name_original) ?>" data-imgtype="person" alt="">
                                </div>
                                <div class="flex-grow-1 ms-3 flex-column d-flex">
                                    <a href="<?php echo site_url('post/'.$value->username) ?>">
                                    <span><?php echo trim($value->name_first .' '. $value->name_middle .' '. $value->name_last) ?></span></a>

                                    <span class="text-muted"><?php echo $value->username ?></span>
                                    <span class="hstack">
                                        <span class="material-icons md-16 me-2 text-muted">work</span>
                                        <?php
                                        $work = json_decode($value->data_exp_work);
                                        if(!empty($work)) {
                                            $row = '';
                                            $row = $this->db->get_where('mst_works_experiences', ['id' => $work[0]->company_id])->row();
                                            if(!empty($row)) {
                                                echo $row->data_name;
                                            }
                                            else {
                                                echo '-';
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                        <div class="vr m-2"></div>
                                        <span class="material-icons md-16 me-2 text-muted">school</span><?php
                                        $edu = json_decode($value->data_education);
                                        if(!empty($edu)) {
                                            $row = '';
                                            $row = $this->db->get_where('mst_educations', ['id' => $edu[0]->id, 'status' => 1])->row();
                                            if(!empty($row)) {
                                                echo $row->data_name;
                                            }
                                            else {
                                                echo '-';
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <?php }} ?>
                    </div>
                </div>
                <div class="mb-2 p-3 rounded-3 msn-widget tab-pane fade show active" role="tabpanel" id="community" aria-labelledby="tab-community">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1 ms-3 flex-column d-flex">
                            <a href="<?php echo site_url('community/discover') ?>" class="text-prussianblue fw-bold ">Community</a>
                            <span class="text-muted fs-14">About <?php echo $communities['count'] ?> results</span>
                        </div>
                    </div>
					<?php if(!empty($communities['query'])) { ?>
                        <?php
                            foreach($communities['query'] as $value){ ?>
                            <div class="d-flex bg-white align-items-center mb-3">
                                <div class="flex-shrink-0 placeholder-glow align-self-start">
                                    <img class="search-thumbs ms-3 rounded-3 border" src="<?php echo placeholder_communities($value->file_path,$value->file_name_original) ?>" data-imgtype="shopping_bag" alt="">
                                </div>
                                <div class="flex-grow-1 ms-3 flex-column">
									<div class="d-flex flex-grow-1 flex-column">
										<a href="<?php echo site_url('community/post/'.$value->id); ?>"><?php echo $value->data_name ?></a>
									</div>
                                    <span class="fs-12 text-muted d-flex mb-3"><?php
                                    if(!empty($value->data_categories)) {
                                        $row = '';
                                        $row = $this->db->get_where('pcs_communities_categories', ['id' => $value->data_categories])->row();
                                        if(!empty($row)) {
                                            echo $row->data_name;
                                        }
                                        else {
                                            echo '-';
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?></span>
                                    <span class="text-black fs-12 d-flex text-break"><?php echo words($value->data_description, 50) ?></span>
                                    
                                </div>
                                <div class="flex-shrink-0 ps-auto text-right mx-2 d-grid">
                                </div>
                            </div>
                            <hr>
                            <?php } ?>
                    <?php } ?>
                </div>
                <div class="mb-2 p-3 rounded-3 msn-widget tab-pane fade show active" role="tabpanel" id="article" aria-labelledby="tab-article">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1 ms-3 flex-column d-flex">
                            <a href="<?php echo site_url('articles/discover') ?>" class="text-prussianblue fw-bold ">Article</a>
                            <span class="text-muted fs-14">About <?php echo $articles['count'] ?> results</span>
                        </div>
                    </div>
					<?php if(!empty($articles['query'])) { ?>
                        <?php
                            foreach($articles['query'] as $value){ ?>
                            <div class="d-flex bg-white align-items-center mb-3">
                                <div class="flex-shrink-0 placeholder-glow align-self-start">
                                    <img class="search-thumbs ms-3 rounded-3 border" src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-imgtype="shopping_bag" alt="">
                                </div>
                                <div class="flex-grow-1 ms-3 flex-column">
										<div class="d-flex flex-grow-1 flex-column">
											<a href="<?php echo site_url('community/post/'.$value->id); ?>"><?php echo $value->data_name ?></a>
										</div>
                                    <span class="fs-12 text-muted d-flex mb-3"><?php
                                    if(!empty($value->data_categories)) {
                                        $row = '';
                                        $row = $this->db->get_where('pfe_articles_categories', ['id' => $value->data_categories])->row();
                                        if(!empty($row)) {
                                            echo $row->data_name;
                                        }
                                        else {
                                            echo '-';
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?></span>
                                    <span class="text-black fs-12 d-flex text-break"><?php echo words($value->data_description, 20) ?></span>
                                    
                                </div>
                            </div>
                            <hr>
                            <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_search']); ?>
