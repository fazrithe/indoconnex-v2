
<div class="col-md-3 d-none d-md-block">
    <div class="mb-4 rounded-3 msn-widget">
        <div class="accordion" id="profileWidgetAccordionD">
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
                            <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $users->username ?>" data-check="profile">
                            <span class="material-icons me-4 align-middle text-prussianblue">share</span>Share
                            </button>
                            <a href="<?php echo base_url().'user/profile/pdf/'.$users_profile->username ?>" class="list-group-item list-group-item-action">
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
                                <span class="material-icons me-4 align-middle text-prussianblue">people</span><?php if(empty($count_follows)){ echo 0;}else{ echo $count_follows; } ?> Followers
                            </li>
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
                            if(!empty($users_profile->data_contact_website)){
                                $result = json_decode($users_profile->data_contact_website);
                                if(!empty($result)){
                                    foreach($result as $value){
                                        echo "<a href='https://".$value->website."' target='_blank' class='list-group-item list-group-item-action text-truncate'><span class='material-icons-outlined me-3 align-middle text-prussianblue'>link</span>".$value->website."</a>";
                                    }
                                }
                            } else {
                                echo "";
                            }
                            ?>
                             <?php
                            $result = json_decode($users_profile->data_contact_socialmedia);
                            if(!empty($result)){
                                $once = false;
                                foreach($result as $value){
                                    if($once == false){
                                        if(!empty($value->linkedin)) {
                                            echo "<a href='https://".$value->linkedin."' target='_blank'
                                            class='list-group-item list-group-item-action'><img src='" . theme_user_locations() ."images/logo/linkedin-brands.svg' class='me-4 svg-color svg-icon'>".$value->linkedin."</a>";
                                        }
                                        if(!empty($value->facebook)) {
                                            echo "<a href='https://".$value->facebook."' target='_blank' class='list-group-item list-group-item-action'><img src='" . theme_user_locations() ."images/logo/facebook-square-brands.svg' class='me-4 svg-color svg-icon'>".$value->facebook."</a>";
                                        }
                                        if(!empty($value->instagram)) {
                                            echo "<a href='https://".$value->instagram."' target='_blank' class='list-group-item list-group-item-action'><img src='" . theme_user_locations() ."images/logo/instagram-square-brands.svg' class='me-4 svg-color svg-icon'>".$value->instagram."</a>";
                                        }
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
    </div>

    <div class="mb-4 rounded-3 msn-widget">
        <div class="accordion" id="communityWidgetAccordionD">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-community">
                    <button class="accordion-button bg-white" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseCom" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseCom">
                        <b>Community</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseCom" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-community">
                    <div class="accordion-body">
                        <div class="list-group">
                            <?php
                            if ($community) {
                                foreach($community as $value) {
                                ?>
                                <a href="<?php echo base_url().'community/post/'.$value->id ?>" class="list-group-item list-group-item-action align-items-center d-flex">
                                    <img class="work-experience-img rounded-circle" src="<?php echo placeholder($value->file_path, $value->file_name_original, 'community')?>"/>
                                    <span class="ms-3 text-truncate"><?php echo $value->data_name ?></span>
                                </a>
                                <?php
                                }
                            } else {
                                echo "<span class='list-group-item'><img src=".site_url('public/themes/user/images/empty/user-community.png')." alt=''></span>";
                                $dis_user = trim($users_profile->name_first . ' ' . $users_profile->name_middle . ' ' . $users_profile->name_last);
                                if(!empty($checkusers_profile)) {
                                    $dis_user = 'You';
                                }
                                echo "<span class='list-group-item'>".$dis_user." have not joined any Community</span>";
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
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
        <div class="accordion" id="profileWidgetAccordionM">
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
                            <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $users->id ?>">
                                <span class="material-icons me-4 align-middle text-prussianblue">share</span>Share
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <span class="material-icons me-4 align-middle text-prussianblue">file_download</span>Download
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
                                <span class="material-icons me-4 align-middle text-prussianblue">people</span>0 Followers
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
                            $result = json_decode($users->data_contact_info);
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
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion" id="communityWidgetAccordionM">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-community">
                    <button class="accordion-button bg-white" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseCom" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseCom">
                        <b>Community</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseCom" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-community">
                    <div class="accordion-body">
                        <div class="list-group">
                            <?php
                            if ($community) {
                                foreach($community as $value) {
                                ?>
                                <a href="<?php echo base_url().'community/post/'.$value->id ?>" class="list-group-item list-group-item-action align-items-center d-flex">
                                    <img class="work-experience-img rounded-circle" src="<?php echo placeholder($value->file_path, $value->file_name_original, 'community')?>"/>
                                    <span class="ms-3 text-truncate"><?php echo $value->data_name ?></span>
                                </a>
                                <?php
                                }
                            } else {
                                echo "<span class='list-group-item'><img src=".site_url('public/themes/user/images/empty/user-community.png')." alt=''></span>";
                                $dis_user = trim($users_profile->name_first . ' ' . $users_profile->name_middle . ' ' . $users_profile->name_last);
                                if(!empty($checkusers_profile)) {
                                    $dis_user = 'You';
                                }
                                echo "<span class='list-group-item'>".$dis_user." have not joined any Community</span>";

                                if(!empty($checkusers_profile)) {
                                    echo "<a href='".site_url('community/create')."' role='button' class='btn btn-danger'>Create Community</a>";
                                    echo "<a href='".site_url('community/discover')."' role='button' class='btn btn-danger'>Join Community</a>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
