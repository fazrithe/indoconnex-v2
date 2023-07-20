<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_education']); ?>
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
                        <a href="<?php echo site_url('education/business') ?>" class="text-prussianblue fw-bold ">Pages</a>
                    </div>
                    <div class="flex-shrink-0 ps-auto">
                        <a href="<?php echo site_url('education/business') ?>" class="btn btn-sm btn-danger-outline">View All</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="bsns-rand">
                        <?php foreach (array_slice($business, 0, 4) as $value){?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="placeholder-glow business-card position-relative">
                                <?php
                                $url = base_url() . 'public/themes/user/images/placehold/business-16x9.png';
                                if(!empty($value['file_name_original'])) {
                                    $url = base_url() . $value['file_path'] . $value['file_name_original'];
                                }
                                ?>
                                    <img src="<?php echo $url ?>" alt="<?php echo slug(words($value['data_name'], 5)) ?>" class="card-img-top w-100">
                                    <button type="button" aria-pressed="true" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value['id'],'pbd_business'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="business" data-content-id="<?php echo $value['id'] ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body flex-column d-flex placeholder-glow">
                                    <span class="fs-16 fw-bold" id="bsn-rand1-name">
                                        <a class="text-black" href="<?php if(empty($value['data_username'])){
                                            echo site_url('business/post/null');
                                        }else{echo site_url('business/post/'.urlencode($value['data_username']));}?>">
                                            <?php echo str_limit($value['data_name'], 14) ?>
                                        </a>
                                    </span>
                                    <span class="fs-14 text-muted" id="bsn-rand1-name"><?php echo $value['data_username'] ?></span>
                                </div>
                                <div class="card-footer bg-transparent border-0 justify-content-center d-flex px-3 pb-3">
                                    <span class="fs-12 rounded-pill badge bg-light text-black text-wrap fw-normal" id="bsn-rand1-tag">
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
                        <img src="<?php echo site_url('public/themes/user/images/icons/community.svg') ?>" class="img-circle" alt="community-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('education/community') ?>" class="text-prussianblue fw-bold ">Community</a>
                    </div>
                    <div class="flex-shrink-0 ps-auto text-right">
                        <a href="<?php echo site_url('education/community') ?>" class="btn btn-sm btn-danger-outline">View All</a>
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
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
<?php $this->load->view($template['partials_modal_market_detail']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
