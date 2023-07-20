<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_favourite']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >
            <div class="mb-4 p-4 rounded-3 msn-widget" >
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/business-icon.svg') ?>" class="img-circle" alt="business-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('business/discover') ?>" class="text-prussianblue fw-bold ">Pages</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-2 row-cols-md-4" id="bsns-rand">
                        <?php foreach ($business as $value){ 
                        ?>
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
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
