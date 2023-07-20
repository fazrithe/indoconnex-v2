<!-- ASIDE -->
<div class="col-md-3 d-none d-md-block">
    <div class="mb-4 rounded-3 msn-widget">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button bg-white" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <b>Profile</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $business->data_username ?>" data-check="profile_business">
                            <span class="material-icons me-4 align-middle text-prussianblue">share</span>Share
                            </button>
                            <a href="<?php echo base_url().'business/profile/pdf/'.$business->id ?>" class="list-group-item list-group-item-action">
                                <span class="material-icons-outlined me-4 align-middle text-prussianblue">file_download</span>Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button bg-white collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseTwo">
                        <b>Total Followers</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="list-group">
                            <li class="list-group-item d-flex align-items-center">
                                <span class="material-icons me-4 align-middle text-prussianblue">people</span><?php echo $count_follows ?> Followers
                            </li>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingSos">
                    <button class="accordion-button bg-white collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseSos" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseSos">
                        <b>Sosial Media & Links</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSos" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingSos">
                    <div class="accordion-body">
                        <div class="list-group">
                            <?php
                            $result_web = json_decode($business->data_contact_website);
                            if(!empty($result_web)){
                                $once = false;
                                foreach($result_web as $value){
                                    if($once == false){

                                        echo "<a href='https://".$value->website."' target='_blank'
                                        class='list-group-item list-group-item-action'>".$value->website."</a>";
                                        $once = true;
                                    }
                                }
                            } else {
                                echo "<span class='fs-14 text-dark px-3 py-2'>This account hasn't inserted any website yet</span>";
                            }
                            ?>
                        </div>
                        <div class="list-group">
                            <?php
                            $result = json_decode($business->data_social_links);
                            if(!empty($result)){
                                $once = false;
                                foreach($result as $value){
                                    if($once == false){

                                        echo "<a href='https://".$value->linkedin."' target='_blank'
                                        class='list-group-item list-group-item-action'><img src='" . theme_user_locations() ."images/logo/linkedin-brands.svg' class='me-4 svg-color' width='18'>".$value->linkedin."</a>";

                                        echo "<a href='https://".$value->facebook."' target='_blank' class='list-group-item list-group-item-action'><img src='" . theme_user_locations() ."images/logo/facebook-square-brands.svg' class='me-4 svg-color' width='18'>".$value->facebook."</a>";

                                        echo "<a href='https://".$value->instagram."' target='_blank' class='list-group-item list-group-item-action'><img src='" . theme_user_locations() ."images/logo/instagram-square-brands.svg' class='me-4 svg-color' width='18'>".$value->instagram."</a>";
                                        $once = true;
                                    }
                                }
                            } else {
                                echo "<span class='fs-14 text-dark px-3 py-2'>This account hasn't inserted any social media and links yet</span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-H4">
                    <button class="accordion-button bg-white collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-C4" aria-expanded="false"
                        aria-controls="panelsStayOpen-C4">
                        <b>Contact Us</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-C4" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-H4">
                    <div class="accordion-body">
                        <div class="list-group">
                            <?php
                            if(!empty($business->bd_email) || !empty($business->bd_phone)) {
                                if(!empty($business->bd_email)) {
                                    echo "<a href='mailto:".$business->bd_email."' target='_blank' class='list-group-item list-group-item-action text-truncate fs-14'><span class='material-icons me-4 align-middle text-prussianblue'>mail</span>". $business->bd_email ."</a>";
                                }
                                if(!empty($business->bd_phone)) {
                                    echo "<a href='' target='_blank' class='list-group-item list-group-item-action text-truncate fs-14'><span class='material-icons me-4 align-middle text-prussianblue'>phone</span>". $business->bd_phone ."</a>";
                                }
                            } else {
                                echo "<span class='fs-14 text-dark px-3 py-2'>This account hasn't inserted any contact info yet</span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 d-grid">
        <button type="button" class="btn btn-danger btn-lg">Claim This Business</button>
    </div>
</div>
</div>
<nav class="d-flex d-md-none offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-evenly mb-3">
		<div class="d-flex flex-shrink-0 ms-auto text-right">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    </div>
    <div class="offcanvas-body">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button bg-white" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <b>Profile</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $business->id ?>">
                                <span class="material-icons me-4 align-middle text-prussianblue">share</span>Share
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <span class="material-icons me-4 align-middle text-prussianblue">save</span>Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button bg-white collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseTwo">
                        <b>Total Followers</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <span class="material-icons me-4 align-middle text-prussianblue">people</span><?php echo $count_follows ?> Followers
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button bg-white collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseThree">
                        <b>Website and Links</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        <div class="list-group">
                            <?php
                            $result = json_decode($business->data_contact_info);
                            if(!empty($result)){
                                $once = false;
                                foreach($result as $value){
                                    echo "<a href='https://".$value->website."' target='_blank' class='list-group-item list-group-item-action'><span class='material-icons me-4 align-middle text-prussianblue'>link</span>".$value->website."</a>";
                                    if($once == false){

                                        echo "<a href='https://".$value->linkedin."' target='_blank'
                                        class='list-group-item list-group-item-action'><img src='" . theme_user_locations() ."images/logo/linkedin-brands.svg' class='me-4 svg-color' width='18'>LinkedIn</a>";

                                        echo "<a href='https://".$value->facebook."' target='_blank' class='list-group-item list-group-item-action'><img src='" . theme_user_locations() ."images/logo/facebook-square-brands.svg' class='me-4 svg-color' width='18'>Facebook</a>";

                                        echo "<a href='https://".$value->instagram."' target='_blank' class='list-group-item list-group-item-action'><img src='" . theme_user_locations() ."images/logo/instagram-square-brands.svg' class='me-4 svg-color' width='18'>Instagram</a>";
                                        $once = true;
                                    }
                                }
                            } else {
                                echo "<span class='fs-14 text-dark px-3 py-2'>This account hasn't inserted any social media and links yet</span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 d-grid">
            <button type="button" class="btn btn-danger btn-lg">Claim This Business</button>
        </div>
    </div>
</nav>
